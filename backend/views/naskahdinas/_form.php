<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Naskahdinas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="naskahdinas-form content">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>
                    <div class="card-body center">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"> <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <?= $form->field($model, 'body')->textarea(['rows' => 6, 'id' => 'content1']) ?></div>
                        </div>
                        
                            <div class="form-group float-right">
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>