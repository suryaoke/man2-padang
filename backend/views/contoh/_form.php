<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Contoh $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contoh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kirim_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
