<?php


use kartik\date\DatePicker;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/** @var yii\web\View $this */
/** @var backend\models\SearchReportsb $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'LAPORAN SURAT KELUAR
';

?>
<div class="reportsb-index content">
  
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
          
            [
                'attribute' => 'tanggal_surat',
                'label' =>'Filter Berdasarkan Tanggal Surat',
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
    

            'tujuan_surat',
            'nomor_agenda',
            'perihal',
        [
            'label' => 'Naskah Dinas',
            'value' => 'naskah.nama',
        ],
        [
            'label' => 'Tanggal Surat',
            'value' => 'tanggal_surat',
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
