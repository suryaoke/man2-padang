<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Reportsm $model */

$this->title = $model->id_sm;
$this->params['breadcrumbs'][] = ['label' => 'Reportsms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reportsm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_sm' => $model->id_sm], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_sm' => $model->id_sm], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_sm',
            'asal_surat',
            'perihal',
            'tanggal_surat',
            'nama',
            'no_surat',
            'file',
            'tujuan',
            'status',
            'kirim_at',
            'file2:ntext',
        ],
    ]) ?>

</div>
