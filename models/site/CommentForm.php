<?php

namespace app\models\site;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // comment is required
            [['comment'], 'required'],
            [['comment'], 'trim'],
            [['comment'], 'string', 'length' => [1, 140]]
        ];
    }

    public function saveComment()
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->status = 0;
        $comment->date = date('Y-m-d H:i:s');

        return $comment->save();
    }
}
