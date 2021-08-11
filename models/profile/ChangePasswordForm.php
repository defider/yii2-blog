<?php

namespace app\models\profile;

use Yii;
use yii\base\Model;
use app\models\site\User;

class ChangePasswordForm extends Model
{
    public $email;
    public $password;
    public $newPassword;
    public $confirmNewPassword;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'default', 'value'=> Yii::$app->user->identity->email],
            // password is required
            [['password'], 'required'],
            [['password'], 'trim'],
            // password is validated by validatePassword()
            [['password'], 'validatePassword'],
            [['newPassword'], 'required'],
            [['newPassword'], 'trim'],
            [['confirmNewPassword'], 'required'],
            [['confirmNewPassword'], 'trim'],
            [['confirmNewPassword'], 'compare', 'compareAttribute' => 'newPassword', 'message' => "Passwords don't match" ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmNewPassword' => 'Confirm New Password',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect Password');
            }
        }
    }

    public function update($id)
    {
        if ($this->validate()) {
            $user = User::findIdentity($id);
            $user->password = $this->newPassword;

            return $user->save();
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
