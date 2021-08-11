<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">
    <main class="py-4">

        <?php if (Yii::$app->session->getFlash('profile')): ?>

            <div class="col-md-13 pb-1">
                <div class="alert alert-success text-center" role="alert">
                    <?= Yii::$app->session->getFlash('profile'); ?>
                </div>
            </div>

        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">

                                    <?php $form = ActiveForm::begin([
                                        'id' => 'changeName-form',
                                        'layout' => 'horizontal',
                                        'fieldConfig' => [
                                            'template' => "{label}\n<div class=\"col-form-label\">{input}</div>\n<div class=\"col-md-6\">{error}</div>",
                                            'labelOptions' => ['class' => 'col-form-label'],
                                        ],
                                    ]); ?>

                                    <?= $form->field($changeNameForm, 'name')->textInput(['placeholder' => Yii::$app->user->identity->name]) ?>

                                    <div class="form-group">
                                        <div class="col-form-label">
                                            <?= Html::submitButton('Change Name', ['class' => 'btn btn-success', 'name' => 'change-button']) ?>
                                        </div>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                    <hr/>

                                    <?php $form = ActiveForm::begin([
                                        'id' => 'newEmail-form',
                                        'layout' => 'horizontal',
                                        'fieldConfig' => [
                                            'template' => "{label}\n<div class=\"col-form-label\">{input}</div>\n<div class=\"col-md-6\">{error}</div>",
                                            'labelOptions' => ['class' => 'col-form-label'],
                                        ],
                                    ]); ?>

                                    <?= $form->field($changeEmailForm, 'email')->textInput(['placeholder' => Yii::$app->user->identity->email]) ?>

                                    <div class="form-group">
                                        <div class="col-form-label">
                                            <?= Html::submitButton('Change Email', ['class' => 'btn btn-success', 'name' => 'change-button']) ?>
                                        </div>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                    <hr/>

                                    <p>
                                        <?= Html::a('Change Password', ['change-password', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>

                                        <?= Html::a('Change Photo', ['change-photo', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
                                    <hr/>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your Profile?')"
                                       href="<?= Url::toRoute(['delete-profile', 'id' => $user->id]); ?>">Delete Profile</a>
                                    </p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= $user->getPhoto(); ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
