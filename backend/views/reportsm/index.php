<?php

use backend\models\Reportsb;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/** @var yii\web\View $this */
/** @var backend\models\SearchReportsb $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'LAPORAN SURAT MASUK';

?>
<div class="reportsb-index content">
  
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
          
            [
                'attribute' => 'tanggal_surat',
                'label' =>'Filter Berdasarka Tanggal Surat',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'tanggal_surat',
                    'options' => ['placeholder' => 'Pilih Tanggal Surat'],
                    'pluginOptions' => [

                        'format' => 'dd MM yyyy',
                        'todayHighlight' => true
                    ]
                ])
            ],




        ],
    ]); ?>

         



    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
    

            'asal_surat',
            'tanggal_surat',
            [
                'label' => 'Nomor Surat',
                'value' => 'no_surat',
            ],
            'perihal',
            [
                'label' => 'Nama Pengirim',
                'value' => 'nama',
            ],
           

        ],

        'clientOptions' => [
            "lengthMenu" => [[20, -1], [20, Yii::t('app', "All")]],

            "responsive" => true,
            "dom" => 'Bfrtip',
            "buttons" => [
                'copy', 'excel', 'pdf'
            ],
            "language" => [
                "search" => "pencarian",
                "searchPlaceholder" => "Masukan kata"
            ]

        ],



    ]);
    ?>



</div>
