<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Smdisposisi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="smdisposisi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sm')->textInput() ?>

    <?= $form->field($model, 'id_pengirim')->textInput() ?>

    <?= $form->field($model, 'isi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kirim_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_penerima')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
