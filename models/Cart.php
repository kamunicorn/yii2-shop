<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 18.04.2019
 * Time: 20:11
 */

namespace app\models;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($good) {
//        unset($_SESSION['cart']);
        if (isset($_SESSION['cart'][$good['id']])) {
            $_SESSION['cart'][$good['id']]['goodQuantity'] += 1;
        } else {
            $_SESSION['cart'][$good['id']] = [
                'name' => $good['name'],
                'price' => $good['price'],
                'img' => $good['img'],
                'goodQuantity' => 1,
            ];
        }
        $_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity'])
            ? $_SESSION['cart.totalQuantity']+1 : 1;
        $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum'])
            ? $_SESSION['cart.totalSum']+$good['price'] : $good['price'];
    }

    public function recalcCart($id) {
        $goodQuantity = $_SESSION['cart'][$id]['goodQuantity'];
        $goodPrice = $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.totalQuantity'] -= $goodQuantity;
        $_SESSION['cart.totalSum'] -= $goodPrice * $goodQuantity;
        unset($_SESSION['cart'][$id]);
    }
}