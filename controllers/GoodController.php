<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 18.04.2019
 * Time: 18:34
 */

namespace app\controllers;
use yii\web\Controller;
use app\models\Good;

class GoodController extends Controller
{
    public function actionIndex($name) {
        $good = new Good();
        $good = $good->getOneGood($name);
        return $this->render('index', compact('good'));
    }
}