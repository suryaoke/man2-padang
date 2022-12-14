<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Isisurat */

$this->title = 'Update Isisurat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Isi Surat', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="isisurat-update">


    <?= $this->render('_form', [
        'model' => $model,
        'isi' => $isi,
        'informasi' => $informasi,
        'tujuann' => $tujuann,
        'tanda' => $tanda,
        'pembuat' => $pembuat,
        'dataverifikasi' => $dataverifikasi,
    ]) ?>

</div>