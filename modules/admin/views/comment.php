<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>

                <?php if (!empty($comments)): ?>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 10%">Photo</th>
                                <th style="width: 20%">Author</th>
                                <th style="width: 25%">Text</th>
                                <th style="width: 20%">Date</th>
                                <th style="width: 25%">Actions</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php foreach ($comments as $comment): ?>

                            <tr>
                                <td>
                                    <img class="mr-3" src=<?= $comment->user->getPhoto(); ?> alt=" " width="70" height="70">
                                </td>
                                <td><?= $comment->user->name ?></td>
                                <td><?= $comment->text ?></td>
                                <td><?= $comment->getDate(); ?></td>
                                <td>
                                    <?php if ($comment->isAllowed()): ?>
                                        <a class="btn btn-warning" href="<?= Url::toRoute(['comment/disallow', 'id' => $comment->id]); ?>">Disallow</a>
                                    <?php else: ?>
                                        <a class="btn btn-success" href="<?= Url::toRoute(['comment/allow', 'id' => $comment->id]); ?>">Allow</a>
                                    <?php endif; ?>

                                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Comment?')"
                                       href="<?= Url::toRoute(['comment/delete', 'id' => $comment->id]); ?>">Delete</a>
                                </td>

                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>

            </div>
        </div>

        <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>

    </div>
</main>
