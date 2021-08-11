<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\site\Comment;

class CommentController extends Controller
{
    /**
     * Displays index page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Comment::getAll();

        return $this->render('/comment',[
            'comments' => $data['comments'],
            'pagination' => $data['pagination'],
        ]);
    }

    /**
     * Allow action.
     */
    public function actionAllow($id)
    {
        $comment = Comment::findOne($id);

        if ($comment->allow()) {
            return $this->redirect(['/admin/comment']);
        }
        return false;
    }

    /**
     * Disallow action.
     */
    public function actionDisallow($id)
    {
        $comment = Comment::findOne($id);

        if ($comment->disallow()) {
            return $this->redirect(['/admin/comment']);
        }
        return false;
    }

    /**
     * Delete action.
     */
    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);

        if ($comment->delete()) {
            return $this->redirect(['/admin/comment']);
        }
        return false;
    }
}
