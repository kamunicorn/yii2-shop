<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 17.04.2019
 * Time: 19:01
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getCategories()
    {
        $categories = Yii::$app->cache->get('categories');
        if (!$categories) {
            $categories = Category::find()->asArray()->all();
            Yii::$app->cache->set('categories', $categories, 60);
        }
        return $categories;
    }

    //    Получение названия категории для отображения в title
    public function getCategoryTitle($cat_id) {
        $categoryTitle = Yii::$app->cache->get('categoryTitle_' . $cat_id);
        if (!$categoryTitle) {
            $categoryTitle = Category::find()->where(['cat_name' => $cat_id])->asArray()->one();
            Yii::$app->cache->set('categoryTitle_' . $cat_id, $categoryTitle, 60);
        }
        return $categoryTitle;
    }
}