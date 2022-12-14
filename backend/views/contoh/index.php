<?php

use backend\models\Contoh;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SearchContoh $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contohs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contoh-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contoh', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [

                'attribute' => 'kirim_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'kirim_at',
                    'options' => ['placeholder' => 'Pilih Tanggal Surat'],
                    'pluginOptions' => [

                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ])
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Contoh $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
