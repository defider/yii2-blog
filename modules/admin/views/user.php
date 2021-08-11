<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>

                <?php if (!empty($users)): ?>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 10%">Photo</th>
                                <th style="width: 20%">Name</th>
                                <th style="width: 25%">Email</th>
                                <th style="width: 20%">Status</th>
                                <th style="width: 25%">Actions</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php foreach ($users as $user): ?>

                                <tr>
                                    <td>
                                        <img class="mr-3" src=<?= $user->getPhoto(); ?> alt=" " width="70" height="70">
                                    </td>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                        <?php if ($user->isAdmin()): ?>
                                            <a class="btn btn-dark" href="<?= Url::toRoute(['user/unset-admin', 'id' => $user->id]); ?>">Admin</a>
                                        <?php else: ?>
                                            <a class="btn btn-light" href="<?= Url::toRoute(['user/set-admin', 'id' => $user->id]); ?>">User</a>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if (!$user->isAdmin() && $user->isBanned()): ?>
                                            <a class="btn btn-success" href="<?= Url::toRoute(['user/unset-ban', 'id' => $user->id]); ?>">Unban</a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this User?')"
                                               href="<?= Url::toRoute(['user/delete', 'id' => $user->id]); ?>">Delete</a>
                                        <?php elseif (!$user->isAdmin() && !$user->isBanned()): ?>
                                            <a class="btn btn-warning" href="<?= Url::toRoute(['user/set-ban', 'id' => $user->id]); ?>">Ban</a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this User?')"
                                               href="<?= Url::toRoute(['user/delete', 'id' => $user->id]); ?>">Delete</a>
                                        <?php endif; ?>

                                        <?php if ($user->isAdmin() && $user->isBanned()): ?>
                                            <a class="btn btn-success disabled">Unban</a>
                                            <a class="btn btn-danger disabled">Delete</a>
                                        <?php elseif ($user->isAdmin() && !$user->isBanned()): ?>
                                            <a class="btn btn-warning disabled">Ban</a>
                                            <a class="btn btn-danger disabled">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

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
