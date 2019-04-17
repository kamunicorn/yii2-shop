<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 17.04.2019
 * Time: 18:07
 */

namespace app\models;
use yii\db\ActiveRecord;

class Good extends ActiveRecord
{
    public static function tableName()
    {
        return 'good';
    }

    public function getAllGoods()
    {
        $goods = Good::find()->asArray()->all();
        return $goods;
    }

}