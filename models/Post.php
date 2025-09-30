<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'post'; 
    }
    

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['title', 'username'], 'string', 'max' => 255],
        ];
    }
}
