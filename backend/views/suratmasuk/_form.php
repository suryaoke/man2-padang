<?php

use backend\models\Asalsurat;
use backend\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */
/* @var $form yii\widgets\ActiveForm */

$asalsurat =  Asalsurat::find()->all();

?>

<div class="suratmasuk-form">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'asal_surat')->widget(Select2::classname(), [
                                    'data' => ["Luar Sekolah" => "Luar Sekolah"],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Asal Surat'); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true])->label("No.Surat") ?>

                            </div>
                            <div class="col-md-4">


                                <?= $form->field($model, 'tanggal_surat')->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => 'Pilih Tanggal Surat'],
                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd MM yyyy'
                                    ]
                                ])->label('Tanggal Surat');
                                ?>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label("Nama Pengirim"); ?>
                            </div>
                            <div class="col-md-4">

                                <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4">
                               
                        <?php $user = User::find()->where(['role' =>  ['guru','kepsek','wakil']])->all(); ?>
                                <?= $form->field($model, 'tujuan')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map($user, 'id', 'nama'),
                                    'options' => ['placeholder' => 'Pilih Tujuan'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Tujuan'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                                <?= $form->field($model, 'file')->fileInput(['maxlength' => true])->label("Upload Surat") ?>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                  
                       <div class="row float-right">
                      
                        
                        <span>
                            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'title' => 'save']) ?>
                        </span>
                       </div>
                       
                      
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>