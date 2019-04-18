<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 17.04.2019
 * Time: 18:02
 */

namespace app\controllers;
use app\models\Category;
use app\models\Good;
use yii\web\Controller;
use Yii;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $goods = new Good();
        $goods = $goods->getAllGoods();
        return $this->render('index', compact('goods'));
    }

    public function actionView($cat_id) {
        $goods = new Good();
        $goods = $goods->getGoodsCategorized($cat_id);
        $goodsName = new Category();
        $goodsName = $goodsName->getGoodsCategory($cat_id);
        return $this->render('view', compact('goods', 'goodsName'));
    }

    public function actionSearch() {
        $search = htmlspecialchars(Yii::$app->request->get('search'));
//        $search = strip_tags(Yii::$app->request->get('search'));
        $goods = new Good();
        $goods = $goods->getSearchResults($search);
        return $this->render('search', compact('goods', 'search'));
    }
}