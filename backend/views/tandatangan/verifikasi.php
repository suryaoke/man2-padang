<?php

use backend\models\Log;
use backend\models\User;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$user = User::find()->all();


/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Verifikasi';
$this->params['breadcrumbs'][] = ['label' => 'Tembusan Surat', 'url' => ['isisurat/tembusan', 'id' => $isi->id]];
$this->params['breadcrumbs'][] = $this->title;


$no = 1;
?>

<div class="informasisurat-form content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>
                            <nav class="navbar navbar-expand-lg   float-right">
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $datainformasi->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $datainformasi->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $isi->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $isi->id]) ?>">Lampiran </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $isi->id]) ?>">Tembusan</span></a>
                                </div>

                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['tandatangan/verifikasi', 'id' => $model1->id]) ?>">Verification </span></a>
                                </div>
                            </nav>
                        </h5>
                    </div>

                    <div class="card-body  ">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card ">
                                    <!-- /.card-header -->
                                    <div class="card-body ">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr align="center">
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                    <th>Ket</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataverifikasi as $verifikasi) : ?>
                                                    <tr align="center">
                                                        <td><?php echo $no ?></td>
                                                        <?php $user =  user::find()->where(['id' => $verifikasi['id_user']])->one(); ?>
                                                        <td><?php echo $user["username"]; ?></td>

                                                        <td>
                                                            <?php if ($verifikasi["status"] ==  "diperiksa") { ?>
                                                                <div class="bg-danger"><?php echo $verifikasi["status"]; ?></div>
                                                            <?php } else if ($verifikasi["status"] == "perbaiki") { ?>
                                                                <div class="bg-warning"><?php echo $verifikasi["status"]; ?></div>
                                                            <?php } ?>
                                                            <?php if ($verifikasi["status"] == "diterima") { ?>
                                                                <div class="bg-success"><?php echo $verifikasi["status"]; ?></div>
                                                            <?php } ?>
                                                            <?php if ($verifikasi["status"] == "ditandatangan") { ?>
                                                                <div class="bg-success"><?php echo $verifikasi["status"]; ?></div>
                                                            <?php } ?>
                                                            <?php if ($verifikasi["status"] == "dikirim") { ?>
                                                                <div class="bg-info"><?php echo $verifikasi["status"]; ?></div>
                                                            <?php } ?>


                                                        </td>
                                                        <td><?php echo $verifikasi["ket"]; ?></td>
                                                    </tr>
                                                    <?php $no++; ?>
                                                <?php endforeach; ?>

                                                <!-- // verifikasi // -->
                                                <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'value' => "diperiksa"])->label(false) ?>
                                                <?= $form->field($model, 'ket')->hiddenInput(['maxlength' => true, 'value' => "-"])->label(false) ?>
                                                <?php $user = User::find()->where(['role' =>  Yii::$app->user->identity->role = "kepsek"])->one(); ?>
                                                <?= $form->field($model, 'id_user')->hiddenInput(['value' => $user->id])->label(false) ?>
                                                <?= $form->field($model, 'id_informasi')->hiddenInput(['value' => $model1->id_informasi])->label(false) ?>

                                                <!-- // Tandatangan // -->
                                                <?= $form->field($model2, 'status')->hiddenInput(['value' => "diperiksa"])->label(false) ?>
                                                <?= $form->field($model2, 'ket')->hiddenInput(['value' => "-"])->label(false) ?>
                                                <?= $form->field($model2, 'statusnotif')->hiddenInput(['value' => "belum dibaca"])->label(false) ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"> </div>
                            <?php if ($model1["status"] == "perbaiki") { ?>
                                <?= Html::submitButton('Kirim Perbaikan', ['class' => 'btn btn-success']) ?>
                                <?php $log = new Log();
                                $log->id_user =  Yii::$app->user->identity->id;
                                $log->perihal = "Kirim Perbaikan Surat Baru";
                                $log->date = Date("d-m-Y ");
                                $log->save(); ?>
                            <?php } ?>
                            <?php if ($model1["status"] == "diterima") { ?>
                                <?php if ($datainformasi['tujuan_surat'] ==  "Dalam Sekolah") { ?>
                                    <?= Html::a('Kirim Surat ', ['suratmasuk', 'id' => $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                                    <?php $log = new Log();
                                    $log->id_user =  Yii::$app->user->identity->id;
                                    $log->perihal = "Kirim Surat ketujuan Surat Baru";
                                    $log->date = Date("d-m-Y ");
                                    $log->save(); ?>
                                <?php } else { ?>
                                    <?= Html::a('Kirim Surat ', ['suratmasukk', 'id' => $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                                    <?php $log = new Log();
                                    $log->id_user =  Yii::$app->user->identity->id;
                                    $log->perihal = "Kirim Surat ketujuan Surat Baru";
                                    $log->date = Date("d-m-Y ");
                                    $log->save(); ?>
                            <?php }
                            } ?>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>