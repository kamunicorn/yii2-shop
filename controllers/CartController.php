<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 18.04.2019
 * Time: 19:39
 */

namespace app\controllers;
use app\models\Good;
use app\models\Cart;
use app\models\Order;
use app\models\OrderGood;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class CartController extends Controller
{
    public function actionOpen() {
        $session = Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart', compact('session'));
    }

    public function actionAdd($name) {
        $good = new Good();
        $good = $good->getOneGood($name);
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($good);
        return $this->renderPartial('cart', compact('good', 'session'));
    }

    public function actionOrder() {
        $session = Yii::$app->session;
        $session->open();
        if (!isset($session['cart.totalSum']) && isset($session['lastOrderId'])) {
            return Yii::$app->response->redirect(Url::to('success'));
        } elseif (!isset($session['cart.totalSum'])) {
            return Yii::$app->response->redirect(Url::to('/'));
        }
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->date = date('Y-m-d H:i:s');
            $order->sum = $session['cart.totalSum'];
            if ($order->save()) {
                $currentId = $order->id;
                $this->saveOrderInfo($session['cart'], $currentId);
                Yii::$app->mailer->compose('order-mail', ['session' => $session, 'order' => $order])
                    ->setFrom(['mail.test2019@mail.ru' => 'Sushi Company'])
                    ->setTo($order->email)
                    ->setSubject('Ваш заказ принят')
                    ->send();

                $session['lastOrderId'] = $currentId;
                $session->remove('cart');
                $session->remove('cart.totalQuantity');
                $session->remove('cart.totalSum');
                return Yii::$app->response->redirect(Url::to('success'));
            }
        }
        $this->layout = 'empty-layout';
        return $this->render('order', compact('order', 'session'));
    }

    public function actionSuccess() {
        $session = Yii::$app->session;
        $session->open();

        if (!isset($session['cart.totalSum']) && isset($session['lastOrderId'])) {
            return $this->render('success', ['currentId' => $session['lastOrderId']]);
        }
        return Yii::$app->response->redirect(Url::to('/'));
    }

    protected function saveOrderInfo($goods, $orderId) {
        foreach ($goods as $id => $good) {
            $orderInfo = new OrderGood();
            $orderInfo->order_id = $orderId;
            $orderInfo->product_id = $id;
            $orderInfo->name = $good['name'];
            $orderInfo->price = $good['price'];
            $orderInfo->quantity = $good['goodQuantity'];
            $orderInfo->sum = $good['goodQuantity'] * $good['price'];
            $orderInfo->save();
        }
    }

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.totalQuantity');
        $session->remove('cart.totalSum');
        return $this->renderPartial('cart', compact('session'));
    }

    public function actionDelete($id) {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalcCart($id);
        return $this->renderPartial('cart', compact('session'));
    }
}