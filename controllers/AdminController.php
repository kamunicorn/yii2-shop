<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;

/** AdminController implements the CRUD actions for Order model. */
class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $this->layout = 'admin-layout';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect([Url::to('/admin/')]);

            /*$dataProvider = new ActiveDataProvider([
                'query' => Order::find(),
            ]);
            return $this->render('index', compact('dataProvider'));*/
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $dataProvider = new ActiveDataProvider([
                'query' => Order::find(),
            ]);
            return $this->redirect([Url::to('/admin/')]);
//            return $this->render('index', compact('dataProvider'));
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $dataProvider = new ActiveDataProvider([
                'query' => Order::find(),
            ]);
            $this->layout = 'admin-layout';

            return $this->render('index', compact('dataProvider'));
        } else {
            return $this->goHome();
        }
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'admin-layout';
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->goHome();
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $this->layout = 'admin-layout';

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->goHome();
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            return $this->goHome();
        }
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
