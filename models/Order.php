<?php

namespace app\models;

use Yii;


class Order extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['email'], 'email'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    public function getOrderGoods() {
        return $this->hasMany(OrderGood::class, ['order_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        ];
    }
}
