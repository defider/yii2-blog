<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\site\User;

class UserController extends Controller
{
    /**
     * Displays index page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = User::getAll();

        return $this->render('/user',[
            'users' => $data['users'],
            'pagination' => $data['pagination'],
        ]);
    }

    /**
     * Set admin action.
     */
    public function actionSetAdmin($id)
    {
        $user = User::findIdentity($id);

        if ($user->setAdmin()) {
            return $this->redirect(['/admin/user']);
        }
        return false;
    }

    /**
     * Unset admin action.
     */
    public function actionUnsetAdmin($id)
    {
        $user = User::findIdentity($id);

        if ($user->unsetAdmin()) {
            return $this->redirect(['/admin/user']);
        }
        return false;
    }

    /**
     * Set ban action.
     */
    public function actionSetBan($id)
    {
        $user = User::findIdentity($id);

        if ($user->setBan()) {
            return $this->redirect(['/admin/user']);
        }
        return false;
    }

    /**
     * Unset ban action.
     */
    public function actionUnsetBan($id)
    {
        $user = User::findIdentity($id);

        if ($user->unsetBan()) {
            return $this->redirect(['/admin/user']);
        }
        return false;
    }

    /**
     * Delete action.
     */
    public function actionDelete($id)
    {
        $user = User::findIdentity($id);

        if ($user->delete()) {
            return $this->redirect(['/admin/user']);
        }
        return false;
    }
}
