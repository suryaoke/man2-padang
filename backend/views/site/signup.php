<?php

use backend\models\Asalsurat;
use backend\models\Jabatan;
use backend\models\Role;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Pembuatan User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$role =  Role::find()->all();
$jabatan =  Jabatan::find()->all();
?>

<div class="suratmasuk-form">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row ">
            <div class="col-10">
                <div class="card ">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>

                    <div class="card-body ">
                       <div class="row">
                        <div class="col-md-6">
                        <?= $form->field($model, 'nama')->textInput()->label("Nama Lengkap") ?>
                        </div>
                        <div class="col-md-6">
                        <?= $form->field($model, 'email') ?>
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'password')->passwordInput() ?>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'jabatan')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map($jabatan, 'nama_jabatan', 'nama_jabatan'),
                                    'options' => ['placeholder' => 'Pilih Jabatan'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Jabatan'); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'role')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map($role, 'nama', 'nama'),
                                    'options' => ['placeholder' => 'Pilih Role'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Role'); ?>
                            </div>

                        </div>


                        <span class="float-right">

                            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'title' => 'save']) ?>
                        </span>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>