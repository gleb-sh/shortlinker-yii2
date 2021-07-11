<?php

namespace app\models;

use Yii;

class Click extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'clicks';
    }
}