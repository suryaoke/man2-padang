<?php

use backend\models\Asalsurat;
use backend\models\Informasisurat;
use backend\models\Naskahdinas;
use backend\models\User;
use backend\models\Verifikasi;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Tujuan Surat';
$this->params['breadcrumbs'][] = ['label' => 'Informasi Surat', 'url' => ['informasisurat/update', 'id' => $model0->id]];
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
?>

<div class="informasisurat-form content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>

                            <?php if ($tujuan) { ?>
                                <nav class="navbar navbar-expand-lg   float-right">
                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $model0->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $model0->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
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
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/ttd', 'id' => $model0->id]) ?>">TTD </span></a>
                                    </div>
                                <?php } ?>
                                </nav>

                            <?php } else { ?>

                                <nav class="navbar navbar-expand-lg   float-right">
                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $model0->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                    </div>
                                    <div class="bg-light">
                                        <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $model0->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
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
                                        <a class="nav-item nav-link text-light disabled " href="">TTD </span></a>
                                    </div>
                                <?php } ?>
                                </nav>


                            <?php } ?>

                        </h5>
                    </div>

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-4">
                                <!-- //tujuan surat // -->

                                <?php $user = User::find()->where(['role' =>  ['guru', 'wakil', 'kepsek','verificator']])->all(); ?>
                                <?php if ($model0["tujuan_surat"] == "Luar Sekolah") { ?>
                                <?= $form->field($model, 'id_user')->textInput()->label('Tujuan Surat');
                                } else if ($model0["tujuan_surat"] == "Dalam Sekolah") { ?>
                                <?= $form->field($model, 'id_user')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($user, 'id', 'nama'),

                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'placeholder' => 'Pilih Tujuan Surat',
                                        ],
                                    ])->label('Tujuan Surat');
                                } ?>

                                <?= $form->field($model, 'id_informasi_surat')->hiddenInput(['value' => $model0->id])->label(false) ?>

                                <?= $form->field($model, 'status')->hiddenInput(['value' => "belum dibaca"])->label(false) ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <br>

                            </div>


                        </div>
                        <div class="row float-right">
                            <?php if ($model0["status"] == "diperiksa") { ?>

                                <?php if (Yii::$app->user->identity->id == $pembuat['id_user']) { ?>
                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                                <?php } ?>
                            <?php } ?>
                            &nbsp;
                            <?php if ($tujuan) { ?>
                                <?= Html::a('Lanjutkan', ['isisurat/update', 'id' => $isi->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                            <?php } ?>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <div style="font-family: Helvetica;">
            <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-body ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Tujuan </th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($tujuan as $value) : ?>
                                        <?php $info = Informasisurat::find()->where(['id' => $value['id_informasi_surat']])->one(); ?>
                                        <?php if ($info["tujuan_surat"] == "Luar Sekolah") { ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $value["id_user"]; ?></td>
                                                <td>
                                                    <?php if (Yii::$app->user->identity->role == "tu" || Yii::$app->user->identity->role == "admin") { ?>

                                                        <?= Html::a('<span class="fa fa-trash"></span>', ['delete2', 'del' => $value['id']], [
                                                            'class' => 'btn btn-danger',
                                                            'title' => 'delete',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>
                                                    <?php  } ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <?php if ($info["tujuan_surat"] == "Dalam Sekolah") { ?>
                                            <?php $info = User::find()->where(['id' => $value['id_user']])->one(); ?>
                                            <tr>
                                                <td><?php echo $no ?></td>

                                                <td><?php echo $info["nama"]; ?></td>

                                                <td align="right">
                                                    <?php if ($model0["status"] == "diperiksa") { ?>

                                                        <?php if (  $pembuat["id_user"]  == Yii::$app->user->identity->id) { ?>

                                                            <?= Html::a('<span class="fa fa-trash"></span>', ['delete2', 'del' => $value['id']], [
                                                                'class' => 'btn btn-danger',
                                                                'title' => 'delete',
                                                                'data' => [
                                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                                    'method' => 'post',
                                                                ],
                                                            ]) ?>
                                                        <?php } ?>

                                                    <?php } ?>



                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



</div>