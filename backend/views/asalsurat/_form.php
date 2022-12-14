<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Asalsurat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asalsurat-form content">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row ">
            <div class="col-8">
                <div class="card ">
                    <div class="card-header" ">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>
                    <div class="card-body ">
                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        <span>
                            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'title' => 'save']) ?>
                        </span>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>