<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 17.04.2019
 * Time: 18:07
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Good extends ActiveRecord
{
    public static function tableName()
    {
        return 'good';
    }

    public function getAllGoods()
    {
        $goods = Yii::$app->cache->get('goods');
        if (!$goods) {
            $goods = Good::find()->asArray()->all();
            Yii::$app->cache->set('goods', $goods, 10);

        }
        return $goods;
    }

// cat_id - название категории
    public function getGoodsCategorized($cat_id)
    {
        $goods = Good::find()->where(['category' => $cat_id])->asArray()->all();
        return $goods;
    }

    public function getSearchResults($search)
    {
        $searchResults = Good::find()->where(['like', 'name', $search])->asArray()->all();
        return $searchResults;
    }

}