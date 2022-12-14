<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tujuansurat */

$this->params['breadcrumbs'][] = ['label' => 'Tujuan Surat', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tujuansurat-update">



    <?= $this->render('_form', [
        'model' => $model,
        'informasi' =>  $informasi,
        'isi' => $isi,
        'tanda' => $tanda,
        'pembuat' => $pembuat,
    ]) ?>

</div>
