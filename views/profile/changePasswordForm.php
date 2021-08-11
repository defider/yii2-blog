<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-change-password">
    <main class="py-4">

        <?php if (Yii::$app->session->getFlash('password')): ?>

        <div class="col-md-13 pb-1">
            <div class="alert alert-success text-center" role="alert">
                <?= Yii::$app->session->getFlash('password'); ?>
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
                                        'id' => 'changePassword-form',
                                        'layout' => 'horizontal',
                                        'fieldConfig' => [
                                            'template' => "{label}\n<div class=\"col-form-label\">{input}</div>\n<div class=\"col-md-6\">{error}</div>",
                                            'labelOptions' => ['class' => 'col-form-label'],
                                        ],
                                    ]); ?>

                                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                                    <?= $form->field($model, 'newPassword')->passwordInput() ?>

                                    <?= $form->field($model, 'confirmNewPassword')->passwordInput() ?>

                                    <div class="form-group">
                                        <div class="col-form-label">
                                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
                                        </div>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
