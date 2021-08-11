<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\site\Comment;
use app\models\site\CommentForm;
use app\models\site\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Comment::getAll(1);
        $commentForm = new CommentForm();

        return $this->render('index',[
            'comments' => $data['comments'],
            'pagination' => $data['pagination'],
            'commentForm' => $commentForm,
        ]);
    }

    /**
     * Displays Comments by the User page.
     *
     * @return string
     */
    public function actionUser($id)
    {
        $user = User::findIdentity($id);
        $data = $user->getUserComments();

        return $this->render('user',[
            'user' => $user,
            'comments' => $data['comments'],
            'pagination' => $data['pagination'],
        ]);
    }

    /**
     * Comment action.
     */
    public function actionComment()
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if($model->saveComment()) {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon');

                return $this->redirect(['index']);
            }
        }
        return false;
    }
}
