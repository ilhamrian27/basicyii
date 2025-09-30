<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Accounts';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Account', ['create'], ['class'=>'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'username',
        'name',
        'role',
        ['class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
        return \yii\helpers\Url::to([$action, 'username' => $model->username]);
    }, 'template'=>'{view} {update} {delete}'],
    ],
]); ?>
