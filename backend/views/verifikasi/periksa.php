<?php

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Log;
use backend\models\Verifikasi;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Verifikasi Surat';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
?>

<div class="content">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card o">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h3 class="card-title">Verifikasi Surat </h3>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tujuan Surat</th>
                                    <th>Perihal</th>
                                    <th>Nomor Agenda</th>
                                    <th>Tanggal Surat</th>
                                    <th>Detail Surat</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datainformasi as $informasi) : ?>
                                    <tr>
                                        <td><?php echo $informasi['tujuan_surat'] ?></td>
                                        <td><?php echo $informasi['perihal'] ?></td>
                                        <td><?php echo $informasi['nomor_agenda'] ?></td>
                                        <td><?php echo $informasi['tanggal_surat'] ?></td>
                                        <td> <?= Html::a('<span class="fa fa-eye"></span>', ['informasisurat/update', 'id' => $informasi->id], ['class' => 'btn bg-info ']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>

                            </thead>
                            <tbody align="center">
                                <td> <?= $form->field($dataisi, 'isi')->textarea(['rows' => 6, 'id' => 'content2', 'value' => $dataisi->isi])->label(false) ?></td>
                            </tbody>
                        </table>

                        <div class="row">
                            <br>
                        </div>
                        <?php if (Yii::$app->user->identity->role == "verificator") { ?>
                            <?php if ($model1['status'] == "diperiksa") { ?>
                                <div class="float-left">
                                    <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleModalCenter">
                                        Perbaiki
                                    </button>
                                </div>
                                <div class="float-right">
                                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModalCenter2">
                                        konfirmasi
                                    </button>
                                </div>
                            <?php } ?>

                            
                        <?php } ?>

                        <?php if ($datainfo->status == "diterima") { ?>
                                <div class="float-right">
                                <?= Html::a('Print Surat ', ['verifikasi/print?id=' . $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <!-- Modal Perbaiki-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Keterangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $form->field($model, 'ket')->textarea(['rows' => 6, 'maxlength' => true])->label(false) ?>
                    <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'value' => "perbaiki"])->label(false) ?>
                    <?= $form->field($model, 'id_informasi')->hiddenInput(['maxlength' => true, 'value' => $informasi->id])->label(false) ?>
                    <?= $form->field($model, 'id_user')->hiddeninput(['maxlength' => true, 'value' =>  Yii::$app->user->identity->id])->label(false) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <?= Html::submitButton('Kirim', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>



    <?php $form = ActiveForm::begin(); ?>
    <!-- Modal Konfirmasi-->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLongTitle">Yakin Tidak Ada Perubahan lagi ?</h5>
                    <?= $form->field($model1, 'status')->hiddeninput(['value' => "diterima"])->label(false) ?>
                    <?= $form->field($model1, 'ket')->hiddeninput(['value' => "&#9989;"])->label(false) ?>

                    <!-- //Tandatangan // -->
                    <?php $user = User::find()->where(['role' => "kepsek"])->one(); ?>
                    <?= $form->field($model2, 'id_informasi')->hiddeninput(['value' => $model1->id_informasi])->label(false) ?>
                    <?= $form->field($model2, 'id_user')->hiddeninput(['value' => $user->id])->label(false) ?>
                    <?= $form->field($model2, 'status')->hiddeninput(['value' => "diperiksa"])->label(false) ?>
                    <?= $form->field($model2, 'ket')->hiddeninput(['value' => "-"])->label(false) ?>
                    <?= $form->field($model2, 'statusnotif')->hiddeninput(['value' => "belum dibaca"])->label(false) ?>


                    <!-- // Notif2 // -->

                    <?= $form->field($model3, 'id_sk')->hiddeninput(['value' => $informasi->id])->label(false) ?>
                    <?= $form->field($model3, 'created_at')->hiddeninput(['value' => date('Y-m-d H:i:s')])->label(false) ?>
                    <?= $form->field($model3, 'tujuan')->hiddeninput(['value' => $user->id])->label(false) ?>
                    <?= $form->field($model3, 'isi')->hiddeninput(['value' =>  $informasi->perihal])->label(false) ?>
                    <?= $form->field($model3, 'header')->hiddeninput(['value' => "Surat Baru"])->label(false) ?>
                    <?= $form->field($model3, 'status')->hiddeninput(['value' => "belum dibaca"])->label(false) ?>
                    <?= $form->field($model3, 'id_pengirim')->hiddeninput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                    <?= $form->field($model3, 'kategori')->hiddeninput(['value' => 2])->label(false) ?>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <?= Html::submitButton('Kirim', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>