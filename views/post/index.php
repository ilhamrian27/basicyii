<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Post[] $posts */

$this->title = 'Daftar Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Buat Post Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Konten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= Html::encode($post->title) ?></td>
                        <td><?= Html::encode($post->content) ?></td>
                        <td>
 
                            <?= Html::a('Update', ['update', 'id' => $post->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $post->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Yakin mau hapus post ini?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Belum ada post</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
