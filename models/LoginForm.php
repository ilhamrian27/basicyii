<?php
namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public function rules() {
        return [
            [['username','password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = Account::findByUsername($this->username);
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Username atau password salah.');
            }
        }
    }

    public function login() {
        if ($this->validate()) {
            $user = Account::findByUsername($this->username);
            return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
