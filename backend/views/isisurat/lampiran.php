<?php

use backend\models\Pembuatsurat;
use backend\models\Tembusansurat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;






/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Lampiran Surat';
$this->params['breadcrumbs'][] = ['label' => 'Isi Surat', 'url' => ['isisurat/update', 'id' => $model1->id]];
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
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $informasi->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/tujuansurat', 'id' => $informasi->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $model1->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $model1->id]) ?>">Lampiran </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $model1->id]) ?>">Tembusan </span></a>
                                </div>
                                <?php if ($dataverifikasi) { ?>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['verifikasi/hasil', 'id' =>  $dataverifikasi->id]) ?>">Verification</span></a>
                                </div>
                                <?php } else { ?>
                                    <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['informasisurat/ttd', 'id' => $informasi->id]) ?>">TTD </span></a>
                                    </div>
                                <?php } ?>
                            </nav>
                        </h5>
                    </div>

                    <div class="card-body  ">

                        <?= $form->field($model, 'id_informasi')->hiddenInput(['value' => $model1->id_informasi])->label(false) ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4 ">

                                <?= $form->field($model, 'file')->fileInput(['maxlength' => true])->label("Lampiran Surat") ?>

                            </div>

                        </div>
                        <div class="row">
                                <br>
                        </div>
                        <div class="row float-right">

                            <?php $pembuat = Pembuatsurat::find()->where(['id_informasi' => $model1->id_informasi])->one(); ?>
                            <?php if ($informasi["status"] == "diperiksa") { ?>
                                <?php if (Yii::$app->user->identity->id == $pembuat['id_user'] ) { ?>

                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>

                                <?php } ?>
                            <?php } ?>
                            &nbsp;
                            <?= Html::a('Lanjutkan', ['tembusan', 'id' => $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card ">
            <!-- /.card-header -->
            <div class="card-body ">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>File</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datalampiran as $lampiran) : ?>
                            <tr align="center">
                                <td><?php echo $no ?></td>
                                <td><?php echo $lampiran["file"]; ?></td>

                                <td align="center">
                                    <?= Html::a('<span class="fa fa-file-pdf"></span>', ['upload/lampiran/' . $lampiran->file], ['class' => 'btn btn-success', 'title' => ' Dwonload Surat']) ?>

                                    <?php if ($informasi["status"] == "diperiksa") { ?>
                                        <?php if (Yii::$app->user->identity->id == $pembuat['id_user']) { ?>

                                            <?= Html::a('<span class="fa fa-trash"></span>', ['delete2', 'del' => $lampiran['id']], [
                                                'class' => 'btn btn-danger',
                                                'title' => 'delete',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                        <?php } ?> <?php } ?>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>