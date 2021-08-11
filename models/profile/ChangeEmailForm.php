<?php

namespace app\models\profile;

use yii\base\Model;
use app\models\site\User;

class ChangeEmailForm extends Model
{
    public $email;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email is required
            [['email'], 'required'],
            [['email'], 'trim'],
            // email has to be a valid email address
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\site\User', 'targetAttribute' => 'email'],
        ];
    }

    public function update($id)
    {
        if ($this->validate()) {
            $user = User::findIdentity($id);
            $user->email = $this->email;

            return $user->save();
        }
        return false;
    }
}
