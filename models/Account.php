<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Account extends ActiveRecord implements IdentityInterface
{
    public static function tableName() {
        return 'account';
    }

    // IdentityInterface methods
    public static function findIdentity($id) {
        return static::findOne(['username' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    public function getId() {
        return $this->username;
    }

    public function getAuthKey() {
        return null;
    }

    public function validateAuthKey($authKey) {
        return false;
    }


    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }
    public static function primaryKey()
    {
        return ['username'];
    }


    public function rules() {
        return [
            [['username','password','name','role'], 'required'],
            [['username','name','role'], 'string', 'max' => 45],
            ['password','string','max'=>250],
        ];
    }
}
