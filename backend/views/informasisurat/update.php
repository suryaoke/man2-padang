<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */


$this->params['breadcrumbs'][] = ['label' => 'Informasi Surat', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="informasisurat-update">



    <?= $this->render('_form', [
        'model' => $model,
        'asal' => $asal,
        'naskah' => $naskah,
        'update' => $update,
        'kondisi' => $kondisi,
        'dataverifikasi' =>  $dataverifikasi,
        'naskah1' => $naskah1,
    ]) ?>

</div>
