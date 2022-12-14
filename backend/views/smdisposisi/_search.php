<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SmdisposisiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smdisposisi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_sm_disposisi') ?>

    <?= $form->field($model, 'id_sm') ?>

    <?= $form->field($model, 'id_pengirim') ?>

    <?= $form->field($model, 'isi') ?>

    <?= $form->field($model, 'kirim_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'id_penerima') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
