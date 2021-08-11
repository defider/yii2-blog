<?php

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Change Photo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-change-photo">
    <main class="py-4">

        <?php if (Yii::$app->session->getFlash('password')): ?>

            <div class="alert alert-success text-center" role="alert">
                <?= Yii::$app->session->getFlash('password'); ?>
            </div>

        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>

                    <div class="card-body">
                        <div class="new-photo-form">

                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
