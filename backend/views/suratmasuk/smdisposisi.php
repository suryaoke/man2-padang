<?php

use backend\models\Log;
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
                                <tr>
                                    <th>Asal Surat</th>
                                    <th>Nama Pengirim</th>
                                    <th>Nomor Agenda Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Detail Surat</th>

                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($querysm  as $value) : ?>
                                    <tr>
                                        <td><?php echo $value["asal_surat"]; ?></td>
                                        <td><?php echo $value["nama"]; ?></td>
                                        <td><?php echo $value["no_surat"]; ?></td>
                                        <td><?php echo $value["tanggal_surat"]; ?></td>
                                        <td></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                        <?php $form = ActiveForm::begin(); ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <?php foreach ($data as $d) : ?>

                            </thead>
                            <tbody align="center">
                                <td>
                                    <?php if ($surat->file == '0') { ?>
                                        <?= $form->field($surat, 'file2')->textarea(['rows' => 6, 'id' => 'content2'])->label(false) ?>
                                        <div class="float-right">
                                            <?= Html::a('Print Surat ', ['suratmasuk/print?id_sm=' . $d->id_sm], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                                        </div>
                                    <?php } else if ($surat->file2 == '0') { ?>
                                        <iframe src=" <?= Url::toRoute(['upload/suratmasuk/' . $d->file]) ?>" height="900" width="900" class="flex-container" title="Iframe Example"></iframe>
                                    <?php } ?>
                                </td>

                            <?php endforeach; ?>
                            </tbody>
                            <?php ActiveForm::end(); ?>
                        </table>
                    </div>
                </div>
                <?php if ($surat->asal_surat == "Luar Sekolah") {  ?>

                    <?php if (Yii::$app->user->identity->role == "kepsek") {  ?>
                        <div class="card ">
                            <div class="card-header" style="background-color: #0093dd;">
                                <h3 class="card-title">Surat Masuk Disposisi</h3>
                            </div>
                            <div class="card-body">

                                <?php $form = ActiveForm::begin(); ?>
                                <?= $form->field($model1, 'id_sm')->hiddenInput(['value' => $d->id_sm])->label(false) ?>
                                <?= $form->field($model1, 'id_pengirim')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                                <?php $user = User::find()->where(['role' =>  ['guru', 'wakil', 'tu']])->all(); ?>
                                <?= $form->field($model1, 'id_penerima')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map($user, 'id', 'nama'),
                                    'options' => ['placeholder' => 'Pilih Penerima'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Disposisi Kepada'); ?>
                                <?= $form->field($model1, 'isi')->textarea(['maxlength' => true])->label("Isi Disposisi") ?>
                                <div class="row">
                                    <div class="col-md-10">
                                        <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9"></div>
                                    <?php if ($surat->file2 == '0') { ?>
                                        <?= Html::a('Download Surat', ['upload/suratmasuk/' . $d->file], ['class' => 'btn btn-success', 'title' => 'Download Surat']) ?>
                                        <?php $log = new Log();
                                        $log->id_user =  Yii::$app->user->identity->id;
                                        $log->perihal = "Download Surat Masuk";
                                        $log->date = Date("d-m-Y ");
                                        $log->save(); ?>
                                    <?php } ?>

                                    <div class="col-md-1"> <?= Html::submitButton('Teruskan', ['class' => 'btn btn-success', 'title' => 'Teruskan']) ?> </div>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    <?php } ?>

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
                                    <tr>
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
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td> <?php $disposisi = User::find()->where(['id' => $a["id_penerima"]])->one();
                                                    echo $disposisi['nama']; ?>
                                            </td>
                                            <td> <?php echo $a['isi']; ?> </td>
                                            <td> <?php $disposisi = Suratmasuk::find()->where(['id_sm' => $a["id_sm"]])->one();
                                                    echo $disposisi['tanggal_surat']; ?>
                                            </td>


                                            <td align="center">
                                                <?php if ($a["status"] ==  "belum dibaca") { ?>
                                                    <div class="bg-danger"><?php echo $a["status"]; ?></div>
                                                <?php } else if ($a["status"] == "dibaca") { ?>
                                                    <div class="bg-warning"><?php echo $a["status"]; ?></div>
                                                <?php } ?>
                                            </td>

                                            </td>
                                            <?php if ($a["status"] ==  "belum dibaca") { ?>
                                                <td align="right">
                                                    <?php if (Yii::$app->user->identity->id ==   $a["id_pengirim"]) { ?>
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
                                            <?php } ?>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>