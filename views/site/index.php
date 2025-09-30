<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Post[] $posts */

$this->title = 'Beranda';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-4 mb-4">
        <h1 class="display-4">Selamat Datang di Aplikasi Yii!</h1>
        <p class="lead">Berikut adalah daftar posting terbaru.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= Html::encode($post->title) ?></h5>
                                <p class="card-text">
                                    <?= Html::encode(mb_substr($post->content, 0, 100)) ?>...
                                </p>
                                <p><small><b>Oleh:</b> <?= Html::encode($post->username) ?> | 
                                    <?= Yii::$app->formatter->asDatetime($post->date) ?></small></p>
                                <?= Html::a('Baca Selengkapnya', ['post/view', 'id' => $post->id], ['class' => 'btn btn-primary btn-sm']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada posting tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
