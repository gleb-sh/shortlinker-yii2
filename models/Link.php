<?php

namespace app\models;

use Yii;

class Link extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'links';
    }
}