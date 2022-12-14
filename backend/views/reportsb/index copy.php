<?php

use backend\models\Reportsb;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SearchReportsb $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reportsbs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportsb-index content">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'tujuan_surat',
            'perihal',
            'id_naskah_dinas',
            'nomor_agenda',
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
            //'tanggal_surat',
            //'no_surat',
            //'status',
            //'kirim_at',

        ],
    ]); ?>


    <div class="card-body ">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Asal Surat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($dataProvider->getModels() as $mahasiswa) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $mahasiswa->id ?></td>
                        
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</div>