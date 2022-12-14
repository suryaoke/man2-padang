<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SearchReportsm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reportsm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_sm') ?>

    <?= $form->field($model, 'asal_surat') ?>

    <?= $form->field($model, 'perihal') ?>

    <?= $form->field($model, 'tanggal_surat') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'no_surat') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'kirim_at') ?>

    <?php // echo $form->field($model, 'file2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
