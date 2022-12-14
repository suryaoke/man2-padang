<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */

$this->title = 'Buat Informasi surat';
$this->params['breadcrumbs'][] = ['label' => 'Informasi surat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasisurat-create">

    <?= $this->render('_form', [
        'model' => $model,
        'asal' => $asal,
        'naskah' => $naskah,
        'update' => $update,
        'kondisi' => $kondisi,
        'naskah1' => $naskah1,
        'dataverifikasi' =>  $dataverifikasi ,
    ]) ?>


</div>
