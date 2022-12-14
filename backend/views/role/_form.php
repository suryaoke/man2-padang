<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Jabatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-form jabatan">

<div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row ">
            <div class="col-8">
                <div class="card ">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>

                    <div class="card-body ">
                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>

                        <span>
                            <?= Html::submitButton('<span class="fa fa-check"></span>', ['class' => 'btn btn-success','title' => 'save']) ?>
                            </span>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
