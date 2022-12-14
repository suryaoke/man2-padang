<?php

use backend\models\Asalsurat;
use backend\models\Log;
use backend\models\Naskahdinas;
use backend\models\User;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$user = User::find()->all();


/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Verifikasi';

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
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $datainfo->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $datainfo->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $dataisi->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $dataisi->id]) ?>">Lampiran </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $dataisi->id]) ?>">Tembusan</span></a>
                                </div>

                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="">Verification </span></a>
                                </div>
                            </nav>
                        </h5>
                    </div>
                    <div class="card-body  ">
                        <div class="card-body ">
                            <!-- // Informasi Surat // -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tujuan Surat</th>
                                                <th>Nomor Agenda </th>
                                                <th>Perihal</th>
                                                <th>Naskah Dinas</th>
                                                <th>Tanggal Surat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-light">
                                            <?php foreach ($datainformasi as $value) : ?>
                                                <tr>

                                                    <td><?php echo $value["tujuan_surat"]; ?></td>
                                                    <td><?php echo $value["nomor_agenda"]; ?></td>
                                                    <td><?php echo $value["perihal"]; ?></td>
                                                    <?php $naskah = Naskahdinas::find()->where(['id' => $value->id_naskah_dinas])->one(); ?>
                                                    <td><?php echo $naskah["nama"]; ?></td>
                                                    <td><?php echo $value["tanggal_surat"]; ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- // Informasi Surat // end -->

                            <div class="row">
                                <br>
                            </div>

                            <div class="row">
                                <!-- // Verifikasi Surat // -->
                                <div class="col-md-7">
                                    <div class="card ">
                                        <div class="card-header" style="background-color: #0093dd;">
                                            <h4 class="card-title">
                                                Verifikasi Surat

                                            </h4>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body ">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Verifikator</th>
                                                        <th>status</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataverifikasi as $value1) : ?>
                                                        <tr>
                                                            <?php $user = User::find()->where(['id' => $value1->id_user])->one(); ?>
                                                            <td><?php echo $user["nama"]; ?></td>
                                                            <td align="center">
                                                                <?php if ($value1["status"] ==  "diperiksa") { ?>
                                                                    <div class="bg-danger"><?php echo $value1["status"]; ?></div>
                                                                <?php } else if ($value1["status"] == "perbaiki") { ?>
                                                                    <div class="bg-warning"><?php echo $value1["status"]; ?></div>
                                                                <?php } ?>
                                                                <?php if ($value1["status"] == "diterima") { ?>
                                                                    <div class="bg-success"><?php echo $value1["status"]; ?></div>
                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo $value1["ket"]; ?></td>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                </div>
                                <!-- // Verifikasi Surat end // -->

                                <!-- // Tanda Tangan // -->
                                <div class="col-md-5">
                                    <div class="card ">
                                        <div class="card-header" style="background-color: #0093dd;">
                                            <h4 class="card-title">
                                                Tanda Tangan Surat
                                            </h4>
                                        </div>
                                        <div class="card-body ">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Penandatangan</th>
                                                        <th>status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($datatandatangan as $value2) : ?>
                                                        <tr>
                                                            <?php $user2 = User::find()->where(['id' => $value2->id_user])->one(); ?>
                                                            <td><?php echo $user2["nama"]; ?></td>
                                                            <td align="center">
                                                                <?php if ($value2["status"] ==  "diperiksa") { ?>
                                                                    <div class="bg-danger"><?php echo $value2["status"]; ?></div>
                                                                <?php } else if ($value2["status"] == "ditandatangan") { ?>
                                                                    <div class="bg-warning"><?php echo $value2["status"]; ?></div>
                                                                <?php } ?>
                                                                <?php if ($value2["status"] == "diterima") { ?>
                                                                    <div class="bg-success"><?php echo $value2["status"]; ?></div>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- // Tanda Tangan end// -->
                            </div>
                        </div>


                        <?= $form->field($model, 'ket')->hiddenInput(['maxlength' => true, 'value' => "-"])->label(false) ?>
                        <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'value' => "diperiksa"])->label(false) ?>
                        <?= $form->field($model, 'id_informasi')->hiddenInput(['maxlength' => true, 'value' => $model1->id_informasi])->label(false) ?>
                        <?php $user = User::find()->where(['role' => "verificator"])->one(); ?>
                        <?= $form->field($model, 'id_user')->hiddeninput(['maxlength' => true, 'value' =>  $user->id])->label(false) ?>
                        <div class="float-right">
                            <?php if ($model1["status"] == "perbaiki") { ?>

                                <?= Html::submitButton('Kirim Perbaikan', ['class' => 'btn btn-success']) ?>
                            <?php } ?>
                        </div>
                        <div class="float-right">
                            <?php if ($datainfo["status"] == "diterima") { ?>

                                <?php if ($pembuat["id_user"] == Yii::$app->user->identity->id) { ?>

                                    <?php if ($datainfo['tujuan_surat'] ==  "Dalam Sekolah") { ?>
                                        <?= Html::a('Kirim Surat ', ['suratmasukdalam', 'id' => $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                                    <?php } else if ($datainfo['tujuan_surat'] ==  "Luar Sekolah") { ?>
                                        <?= Html::a('Kirim Surat ', ['suratmasukkeluar', 'id' => $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                                    <?php } ?>

                                <?php  } ?>
                            <?php  } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>