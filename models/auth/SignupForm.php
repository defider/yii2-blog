<?php

namespace app\models\auth;

use yii\base\Model;
use app\models\site\User;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email and password are required
            [['name', 'email','password'], 'required'],
            [['name', 'email','password'], 'trim'],
            [['name'], 'string'],
            // email has to be a valid email address
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\site\User', 'targetAttribute' => 'email'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;

            return $user->save();
        }
        return false;
    }
}
