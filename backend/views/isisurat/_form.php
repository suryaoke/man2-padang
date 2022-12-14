<?php


use backend\models\User;
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
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/update', 'id' => $informasi->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $informasi->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $model->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $model->id]) ?>">Lampiran</span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $model->id]) ?>">Tembusan</span></a>
                                </div>
                                <?php if ($dataverifikasi) { ?>
                                    <div class="bg-light ">
                                        <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['verifikasi/hasil', 'id' =>  $dataverifikasi->id]) ?>">Verfication</span></a>
                                    </div>
                                    <?php } else { ?>
                                    <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/ttd', 'id' => $informasi->id]) ?>">TTD </span></a>
                                    </div>
                                <?php } ?>
                            </nav>
                        </h5>
                    </div>
                    <div class="card-body ">

                        <h3 class="card-header text-center">ISI SURAT</h3>
                        <div class="row">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-6 ">
                                <?= $form->field($model, 'id_informasi')->hiddenInput()->label(false) ?>
                                <?php if ($informasi["status"] == "diperiksa") { ?>

                                    <?= $form->field($model, 'isi')->textarea(['rows' => 6, 'id' => 'content1'])->label(false) ?>
                                <?php } else { ?>
                                    <?= $form->field($model, 'isi')->textarea(['rows' => 6, 'id' => 'content2'])->label(false) ?>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                        </div>

                        <div class="row float-right">
                            <?php if ($informasi["status"] == "diperiksa") { ?>
                                <?php if (Yii::$app->user->identity->id = $pembuat) { ?>


                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                                <?php } ?>
                            <?php } ?>

                            <?php if ($informasi["status"] != "diperiksa") { ?>
                               

                                <?= Html::a('Print Surat ', ['isisurat/print?id=' . $model->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                              
                            <?php } ?>
                            &nbsp;
                            <?= Html::a('Lanjutkan', ['lampiran', 'id' => $model->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>

                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>