<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-md navbar-light" style="background-color: beige">
    <div class="container">
        <a class="navbar-brand" href="/">
            <?= Yii::$app->name ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/comment']) ?>"><b>Comments</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/user']) ?>"><b>Users</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/profile/index', 'id' => Yii::$app->user->id]) ?>">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/auth/logout']) ?>">Logout</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div class="container">

    <?= $content ?>

</div>

<!--footer start-->
<footer class="modal-footer" style="background-color: beige">
    <div class="container">
        <div class="text-center">
            <!--My GitHub account-->
            <a href="https://github.com/defider"><img src=<?=Url::to('/public/images/github.png')?> alt=" " id="logo" width="28" height="28"></a>
        </div>
    </div>
</footer>
<!-- end footer -->

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
