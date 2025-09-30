<?php
use yii\helpers\Html;

$this->title = 'Buat Post Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Post', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
