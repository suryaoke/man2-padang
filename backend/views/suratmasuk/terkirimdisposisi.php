<?php

use backend\models\Notif1;
use backend\models\Role;
use backend\models\Smdisposisi;
use backend\models\Smpenerima;
use backend\models\Suratmasuk;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Pembuatan Surat Masuk Disposisi';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
foreach ($smterkirim as $value) :
endforeach;

?>

<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card o">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h3 class="card-title">Surat Masuk</h3>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>Asal Surat</th>
                                    <th>Nama Pengirim</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal <br> Surat</th>
                                </tr>

                            </thead>
                            <tbody>


                                <?php $surat = Suratmasuk::find()->where(['id_sm' => $value->id_sm])->one(); ?>
                                <tr align="center">

                                    <td><?php echo $surat["asal_surat"]; ?></td>
                                    <td><?php echo $surat["nama"]; ?></td>
                                    <td><?php echo $surat["no_surat"]; ?></td>
                                    <td><?php echo $surat["no_surat"]; ?></td>

                                </tr>

                            </tbody>

                        </table>
                        <?php $form = ActiveForm::begin(); ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">


                            </thead>
                            <tbody align="center">

                                <td>
                                    <?php if ($surat->file == '0') { ?>
                                        <?= $form->field($surat, 'file2')->textarea(['rows' => 6, 'id' => 'content2'])->label(false) ?>
                                        <div class="float-right">
                                            <?= Html::a('Print Surat ', ['suratmasuk/print?id_sm=' . $value->id_sm], ['class' => 'btn btn-success']) ?>
                                        </div>
                                    <?php } else { ?>
                                        <iframe src=" <?= Url::toRoute(['upload/suratmasuk/' . $surat->file]) ?>" height="900" width="900" class="flex-container" title="Iframe Example"></iframe>
                                        <div class="row">
                                            <br>
                                        </div>
                                        <div class="float-right">
                                            <?= Html::a('Download Surat', ['upload/suratmasuk/' . $surat->file], ['class' => 'btn btn-success', 'title' => 'Download Surat']) ?>
                                        </div>
                                </td>

                            <?php } ?>
                            </tbody>
                            <?php ActiveForm::end(); ?>
                        </table>
                    </div>
                </div>
                <?php if ($surat->asal_surat == "Luar Sekolah") {  ?>

                    <div class="card ">
                        <div class="card-header" style="background-color: #0093dd;">
                            <h4 class="card-title">
                                Surat Masuk Disposisi
                            </h4>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center">
                                        <th>No.</th>
                                        <th>Penerima</th>
                                        <th>Isi Disposisi</th>
                                        <th>Tanggal <br> Surat</th>
                                        <th>Status</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($querysmdisposisi as $a) : ?>

                                        <tr align="center">
                                            <td><?php echo $no; ?>
                                            </td>
                                            <td> <?php $disposisi = User::find()->where(['id' => $a["id_penerima"]])->one();
                                                    echo $disposisi['username']; ?>
                                            </td>
                                            <td> <?php echo $a['isi']; ?>
                                            </td>
                                            <td> <?php $disposisi = Suratmasuk::find()->where(['id_sm' => $a["id_sm"]])->one();
                                                    echo $disposisi['tanggal_surat']; ?>
                                            </td>
                                            <td>
                                                <?php if ($a["status"] ==  "belum dibaca") { ?>
                                                    <div class="bg-danger"><?php echo $a["status"]; ?></div>
                                                <?php } else if ($a["status"] == "dibaca") { ?>
                                                    <div class="bg-warning"><?php echo $a["status"]; ?></div>
                                                <?php } ?>
                                            </td>

                                            <td align="right">
                                                <?php if (Yii::$app->user->identity->id ==   $a["id_pengirim"] || Yii::$app->user->identity->role == "admin") { ?>
                                                    <?= Html::a('<span class="fa fa-trash"></span>', ['deletesmdisposisi', 'id_sm' => $a->id_sm], [
                                                        'class' => 'btn btn-danger',
                                                        'title' => 'delete',
                                                        'data' => [
                                                            'confirm' => 'Are you sure you want to delete this item?',
                                                            'method' => 'post',
                                                        ],
                                                    ]) ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php
                                    endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>