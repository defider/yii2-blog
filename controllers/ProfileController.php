<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use app\models\profile\ChangeNameForm;
use app\models\profile\ChangeEmailForm;
use app\models\profile\ChangePasswordForm;
use app\models\profile\PhotoUpload;
use app\models\site\User;

class ProfileController extends Controller
{
    /**
     * Displays index page.
     *
     * @return Response|string
     */
    public function actionIndex($id)
    {
        $user = User::findIdentity($id);
        $changeNameForm = new ChangeNameForm();
        $changeEmailForm = new ChangeEmailForm();

        if ($changeNameForm->load(Yii::$app->request->post()) && $changeNameForm->update($id) ||
            $changeEmailForm->load(Yii::$app->request->post()) && $changeEmailForm->update($id)) {
            Yii::$app->getSession()->setFlash('profile', 'You have successfully changed your profile');

            return $this->redirect(['index', 'id' => $user->id]);
        } else {
            return $this->render('index', [
                'user' => $user,
                'changeNameForm' => $changeNameForm,
                'changeEmailForm' => $changeEmailForm,
            ]);
        }
    }

    /**
     * Change password action.
     *
     * @return Response|string
     */
    public function actionChangePassword($id)
    {
        $user = User::findIdentity($id);
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->update($id)) {
            Yii::$app->getSession()->setFlash('password', 'You have successfully changed your password');

            return $this->redirect(['change-password', 'id' => $user->id]);
        } else {
            return $this->render('changePasswordForm', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Change photo action.
     *
     * @return Response|string
     */
    public function actionChangePhoto($id)
    {
        $model = new PhotoUpload();

        if (Yii::$app->request->isPost) {
            $user = User::findIdentity($id);
            $file = UploadedFile::getInstance($model, 'photo');

            if ($user->savePhoto($model->uploadFile($file, $user->photo))) {
                Yii::$app->getSession()->setFlash('profile', 'You have successfully changed your profile');

                return $this->redirect(['index', 'id' => $user->id]);
            }
        }
        return $this->render('changePhotoForm', ['model' => $model]);
    }

    /**
     * Delete profile action.
     */
    public function actionDeleteProfile($id)
    {
        $user = User::findIdentity($id);

        if ($user->delete()) {
            return $this->goHome();
        }
        return false;
    }
}
