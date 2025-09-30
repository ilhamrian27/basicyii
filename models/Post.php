<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName() {
        return 'post';
    }

    public function rules() {
        return [
            [['title','content'], 'required'],
            ['date', 'safe'],
            ['username', 'string', 'max' => 45],
        ];
    }

    public function getAuthor() {
        return $this->hasOne(Account::class, ['username' => 'username']);
    }
}
