<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 17.04.2019
 * Time: 18:02
 */

namespace app\controllers;
use app\models\Good;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $goods = new Good();
        $goods = $goods->getAllGoods();
        return $this->render('index', compact('goods'));
    }
}