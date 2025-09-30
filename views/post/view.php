<?php
use yii\helpers\Html;

/** @var app\models\Post $model */
$this->title = $model->title;
?>
<div class="post-view">
    <h1><?= Html::encode($model->title) ?></h1>
    <p><strong>Tanggal:</strong> <?= $model->date ?></p>
    <p><strong>Penulis:</strong> <?= Html::encode($model->username) ?></p>
    <p><?= nl2br(Html::encode($model->content)) ?></p>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idpost], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idpost], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Yakin hapus post ini?', 'method' => 'post'],
        ]) ?>
    </p>
</div>
