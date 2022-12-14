<?php

use backend\models\Isisurat;
use backend\models\Naskahdinas;
use backend\models\Tandatangan;
use backend\models\Tujuansurat;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */
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

                                <?php if ($update) { ?>
                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $model->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <?php $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model->id])->one(); ?>
                                    <div class="bg-light ">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $model->id]) ?>">Tujuan Surat <i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <?php $isi = Isisurat::find()->where(['id_informasi' => $model->id])->one(); ?>
                                    <div class="bg-light ">
                                        <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $isi->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light ">
                                        <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $isi->id]) ?>">Lampiran</span></a>
                                    </div>
                                    <div class="bg-light ">
                                        <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $isi->id]) ?>">Tembusan</span></a>
                                    </div>
                                    <?php if ($dataverifikasi) { ?>
                                        <div class="bg-light ">
                                            <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['verifikasi/hasil', 'id' =>  $dataverifikasi->id]) ?>">Verification </span></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="bg-light ">
                                            <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/ttd', 'id' => $model->id]) ?>">TTD </span></a>
                                        </div>
                                    <?php } ?>
                                <?php } else if ($model->id) { ?>
                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $model->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light ">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['tujuansurat', 'id' => $model->id]) ?>">Tujuan Surat <i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Lampiran</span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Tembusan</span></a>
                                    </div>
                                    <?php if ($dataverifikasi) { ?>
                                        <div class="bg-light disabled">
                                            <a class="nav-item nav-link text-light disabled" href="#">Verification </span></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="bg-light disabled">
                                            <a class="nav-item nav-link text-light disabled" href="">TTD </span></a>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>

                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/create']) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light disabled ">
                                        <a class="nav-item nav-link text-light disabled" href="#">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Lampiran</span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Tembusan </span></a>
                                    </div>
                                    <?php if (Yii::$app->user->identity->role == "tu" || Yii::$app->user->identity->role == "admin") { ?>
                                        <div class="bg-light disabled">
                                            <a class="nav-item nav-link text-light disabled" href="#">Verification </span></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="bg-light disabled ">
                                            <a class="nav-item nav-link text-light disabled" href="">TTD </span></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </nav>

                        </h5>
                    </div>

                    <div class="card-body ">

                        <div class="row">
                            <div class="col-md-4">

                                <?php if (Yii::$app->user->identity->role == "tu" || Yii::$app->user->identity->role == "admin") { ?>
                                    <?= $form->field($model, 'tujuan_surat')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($asal, 'nama', 'nama'),
                                        'options' => ['placeholder' => 'Pilih Tujuan Surat'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->label('Tujuan Surat'); ?>
                                <?php } else if (Yii::$app->user->identity->role == "guru") { ?>
                                    <?= $form->field($model, 'tujuan_surat')->widget(Select2::classname(), [
                                        'data' => ["Dalam Sekolah" => "Dalam Sekolah"],
                                        'options' => ['placeholder' => 'Pilih Tujuan Surat'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->label('Tujuan Surat'); ?>

                                <?php } ?>
                            </div>
                            <div class="col-md-4">


                                <?= $form->field($model, 'perihal')->textInput(['maxlength' => true])->label("Perihal") ?>
                            </div>
                            <div class="col-md-4">
                                <?php if (Yii::$app->user->identity->role == "tu" || Yii::$app->user->identity->role == "admin") { ?>
                                    <?= $form->field($model, 'id_naskah_dinas')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($naskah, 'id', 'nama'),
                                        'options' => ['placeholder' => 'Pilih naskah'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->label('Naskah Surat'); ?>
                                <?php } else if (Yii::$app->user->identity->role == "guru") { ?>
                                    <?= $form->field($model, 'id_naskah_dinas')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($naskah1, 'id', 'nama'),
                                        'options' => ['placeholder' => 'Pilih naskah'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->label('Naskah Surat'); ?>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true])->label("Nomor Surat") ?>

                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'nomor_agenda')->textInput(['maxlength' => true])->label("Nomor Agenda") ?>

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
                            <br>
                        </div>

                        <div class="row float-right">
                            <?php if ($kondisi == "1") { ?>
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                            <?php } else if ($kondisi == "2") { ?>

                            <?php  } ?>

                            <?php if ($update) { ?>
                                <?= Html::a('Lanjutkan', ['tujuansurat', 'id' => $model->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                            <?php } else if ($model->id) { ?>
                                <?= Html::a('Lanjutkan', ['tujuansurat', 'id' => $model->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?php ActiveForm::end(); ?>

</div>