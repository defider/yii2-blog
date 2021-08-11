<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (!empty($comments)): ?>

<div class="site-index">
    <main class="py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>
                    <div class="card-body">

                        <?php foreach ($comments as $comment): ?>

                            <div class="media">
                                <img class="mr-3" src=<?= $comment->user->getPhoto(); ?> alt=" " width="70" height="70">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="<?= Url::toRoute(['site/user', 'id' => $comment->user->id]); ?>"> <?= $comment->user->name ?></a></h5>
                                    <span><small><?= $comment->getDate(); ?></small></span>
                                    <p>
                                        <?= $comment->text; ?>
                                    </p>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

<?php endif; ?>

            <?= $this->render('/site/commentForm', [
                'commentForm' => $commentForm,
            ])?>

            <?php
            echo LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>

        </div>
    </main>
</div>
