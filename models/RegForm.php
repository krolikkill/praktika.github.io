<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use function Sodium\compare;

class RegForm extends \yii\base\Model
{
    public $username;
    public $password;
    public $email;
    public $surname;
    public $name;
    public $patronymic;
    public $password_repeat;


    public function rules()
    {
        return [
            [['username','password','email','surname','name','patronymic','password_repeat'],'required'],
            ['password','string','min'=>6],
            ['email','email'],
            ['username','unique','targetClass'=>'app\models\User', 'message'=>'Пользователь с таким логином уже существует'],
            ['email','unique','targetClass'=>'app\models\User', 'message'=>'Пользователь с такой почтой уже существует'],
            ['patronymic', 'string'],
            ['password_repeat','string'],
            ['password','compare','compareAttribute'=>'password_repeat','message'=>'Пароли не совпадают'],
        ];
    }

    public function attributeLabels()
    {
        return[
            'username'=>'Логин',
            'surname'=>'Фамилия',
            'name'=>'Имя',
            'patronymic'=>'Отчество',
            'password'=>'Повтор пароля',
            'password_repeat'=>'пароль',
        ];
    }

    public function registr()
    {
        if (!$this->validate()){
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->surname = $this->surname;
        $user->name = $this->name;
        $user->patronymic = $this->patronymic;
        $user->email = $this->email;
        $user->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);


        return $user->save()? $user:null;
    }
}