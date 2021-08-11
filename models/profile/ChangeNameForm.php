<?php

namespace app\models\profile;

use yii\base\Model;
use app\models\site\User;

class ChangeNameForm extends Model
{
    public $name;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name is required
            [['name'], 'required'],
            [['name'], 'trim'],
            [['name'], 'string'],
        ];
    }

    public function update($id)
    {
        if ($this->validate()) {
            $user = User::findIdentity($id);
            $user->name = $this->name;

            return $user->save();
        }
        return false;
    }
}
