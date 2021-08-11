<?php

namespace app\models\site;

use Yii;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $user_id
 * @property int|null $status
 * @property string|null $date
 *
 * @property User $user
 */
class Comment extends ActiveRecord
{
    const STATUS_DISALLOW = 0;
    const STATUS_ALLOW = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }

    public static function getAll($status = null, $pageSize = 5)
    {
        $query = Comment::getQuery($status);

        return Comment::getPagination($query, $pageSize);
    }

    public static function getQuery($status)
    {
        if ($status === 0 || $status === 1) {
            // build a DB query to get all comments with a valid status
            $query = Comment::find()
            ->orderBy('id desc')
            ->where(['status' => $status]);

        } elseif ($status == null) {
            // build a DB query to get all comments
            $query = Comment::find()
            ->orderBy('id desc');

        } else {
            return false;
        }

        return $query;
    }

    public static function getPagination($query, $pageSize)
    {
        // get the total number of comments (but do not fetch the comment data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        // limit the query using the pagination and retrieve the comments
        $comments = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['comments'] = $comments;
        $data['pagination'] = $pagination;

        return $data;
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDatetime($this->date);
    }

    public function isAllowed()
    {
        return $this->status;
    }

    public function allow()
    {
        $this->status = self::STATUS_ALLOW;

        return $this->save(false);
    }

    public function disallow()
    {
        $this->status = self::STATUS_DISALLOW;

        return $this->save(false);
    }
}
