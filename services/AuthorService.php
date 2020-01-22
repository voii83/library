<?php

namespace app\services;

use app\models\Authors;
use yii\helpers\ArrayHelper;

class AuthorService
{
    public static function getAll()
    {
        $authors = Authors::find()->all();
        return ArrayHelper::map($authors,'id','name');
    }
}