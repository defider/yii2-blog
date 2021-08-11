<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php if (Yii::$app->user->isGuest): ?>

    <div class="col-md-12 pt-3">
        <div class="alert alert-info text-center" role="alert">
            <a href="<?= Url::toRoute(['/auth/login']) ?>"><b>Log in</b></a> or <a href="<?= Url::toRoute(['/auth/signup']) ?>"><b>Sign up</b></a> to add a comment
        </div>
    </div>

<?php elseif (Yii::$app->user->identity->ban): ?>

    <div class="col-md-12 pt-3">
        <div class="alert alert-warning text-center" role="alert">
            You're not able to add a comment due to ban
        </div>
    </div>

<?php else: ?>

<?php if (Yii::$app->session->getFlash('comment')): ?>

    <div class="col-md-12 pt-3">
        <div class="alert alert-success text-center" role="alert">
            <?= Yii::$app->session->getFlash('comment'); ?>
        </div>
    </div>

<?php endif; ?>

    <div class="col-md-12 py-3">
        <div class="card">
            <div class="card-header"><h3>Add a comment as <b><?= Yii::$app->user->identity->name ?></b></h3></div>
            <div class="card-body">
                <div class="form-group">

                <?php $form = ActiveForm::begin([
                    'action' => ['site/comment'],
                    'options' => ['class' => 'form-group', 'role' => 'form']]) ?>

                    <?= $form->field($commentForm, 'comment')->textarea(['autofocus' => true, 'class' => 'form-control', 'rows' => "2"])->label(false) ?>

                </div>

                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

<?php endif; ?>
