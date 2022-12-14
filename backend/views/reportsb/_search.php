<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SearchReportsb $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reportsb-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tujuan_surat') ?>

    <?= $form->field($model, 'perihal') ?>

    <?= $form->field($model, 'id_naskah_dinas') ?>

    <?= $form->field($model, 'nomor_agenda') ?>

    <?php // echo $form->field($model, 'tanggal_surat') ?>

    <?php // echo $form->field($model, 'no_surat') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'kirim_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
