<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-login">
    <main class="py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5><?= Html::encode($this->title) ?></h5></div>
                    <div class="card-body">

                        <?php if (Yii::$app->session->getFlash('signup')): ?>

                            <div class="alert alert-success" role="alert">
                                <?= Yii::$app->session->getFlash('signup'); ?>
                            </div>

                        <?php endif; ?>

                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-md-6\">{input}</div>\n<div class=\"col-md-6\">{error}</div>",
                                'labelOptions' => ['class' => 'col-md-4 col-form-label'],
                            ],
                        ]); ?>

                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="col-md-6">
                            <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password', 'label' => 'Show Password']); ?>
                        </div>

                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => "<div class=\"col-md-6\">{input} {label}</div>\n<div class=\"col-md-6\">{error}</div>",
                        ]) ?>

                        <div class="form-group">
                            <div class="col-md-8">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#loginform-password').attr('type',this.checked?'text':'password');})");
?>
