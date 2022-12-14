<?php

use backend\models\Asalsurat;
use backend\models\Naskahdinas;
use backend\models\Pembuatsurat;
use backend\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */

$user = User::find()->all();
?>

<div class="informasisurat-form content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>
                            <nav class="navbar navbar-expand-lg   float-right">

                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $informasi->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light nav-item  ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['tujuansurat/update', 'id' => $model->id]) ?>">Tujuan Surat <i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $isi->id]) ?>">Isi Surat <i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $isi->id]) ?>">Lampiran</span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $isi->id]) ?>">Tembusan</span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['tandatangan/verifikasi', 'id' => $tanda->id]) ?>">Verification </span></a>
                                </div>
                            </nav>
                        </h5>
                    </div>

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    <?php if ($informasi["tujuan_surat"] == "Luar Sekolah") { ?>
                                    <?= $form->field($model, 'id_user')->textInput()->label('Tujuan Surat');
                                    } else if ($informasi["tujuan_surat"] == "Dalam Sekolah") { ?>
                                    <?= $form->field($model, 'id_user')->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map($user, 'id', 'username'),
                                            'options' => ['placeholder' => 'Pilih Tujuan Surat'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ])->label('Tujuan Surat');
                                    } ?>
                                </div>
                                <?= $form->field($model, 'id_informasi_surat')->hiddenInput()->label(false) ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="form-group">
                                <?php if (Yii::$app->user->identity->id == $pembuat['id_user'] || Yii::$app->user->identity->role == "admin" ) { ?>
                                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                <?php } ?>

                                <?= Html::a('Lanjutkan', ['isisurat/update', 'id' => $isi->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>