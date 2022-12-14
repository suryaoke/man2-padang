<?php

use backend\models\Reportsm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SearchReportsm $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reportsms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportsm-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reportsm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sm',
            'asal_surat',
            'perihal',
            'tanggal_surat',
            'nama',
            //'no_surat',
            //'file',
            //'tujuan',
            //'status',
            //'kirim_at',
            //'file2:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reportsm $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_sm' => $model->id_sm]);
                 }
            ],
        ],
    ]); ?>


</div>
