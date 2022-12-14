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
                                    <a class="nav-item nav-link text-light " href="">TTD</span></a>
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
                                              
                                                <th>Tanggal Surat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-light">
                                            <?php foreach ($datainformasi as $value) : ?>
                                                <tr>

                                                    <td><?php echo $value["tujuan_surat"]; ?></td>
                                                    <td><?php echo $value["nomor_agenda"]; ?></td>
                                                    <td><?php echo $value["perihal"]; ?></td>                                                   
                                                    <td><?php echo $value["tanggal_surat"]; ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- // Informasi Surat // end -->

                        </div>

                        <div class="float-right">
                            <?php if ($model1["status"] == "perbaiki") { ?>

                                <?= Html::submitButton('Kirim Perbaikan', ['class' => 'btn btn-success']) ?>
                            <?php } ?>
                        </div>
                        <div class="float-right">
                            <?php if ($datainfo["status"] == "ditandatangan") { ?>

                                <?php if ($pembuat["id_user"] == Yii::$app->user->identity->id) { ?>
                                    <?= Html::a('Kirim Surat ', ['suratmasukdalam', 'id' => $model1->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>

                                <?php  } ?>
                            <?php  } ?>
                            <?php if ($datainfo["status"] == "diperiksa") { ?>
                                <?php if ($pembuat["id_user"] == Yii::$app->user->identity->id) { ?>
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title " align="center">Tanda Tangan</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="card-body ">
                                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModalCenter2">
                                                Langsung
                                            </button>

                                            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#exampleModalCenter3">
                                                Gambar
                                            </button>

                                            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleModalCenterr">
                                                Digital
                                            </button>
                                        </div>

                                    </div>


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





<!-- // Modal Tandatang Gambar // -->

<div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php $form = ActiveForm::begin(); ?>
            <h5 class="modal-title" id="exampleModalLongTitle">Silahkan klik Tanda Tangan</h5>
                <?= $form->field($model1, 'status')->hiddenInput(['value' => "ditandatangan"])->label(false) ?>
                <div class="form-group">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Tanda Tangan', ['class' => 'btn btn-success']) ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- // Modal Tandatang Gambar end // -->


<!-- // Modal Tandatang Langsung // -->

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLongTitle">Silahkan klik Tanda Tangan</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?= Html::a('Tanda Tangan ', ['langsung', 'id' => $model1->id], ['class' => 'btn btn-success']) ?>

            </div>
        </div>
    </div>
</div>
<!-- // Modal Tandatang Langsung end // -->



<!-- // Modal Tandatangan Digital// -->
<div class="modal fade bd-example-modal-xl" id="exampleModalCenterr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tanda Tangan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table border="1">
                    <tr>
                        <td>
                            <div id="signature">

                            </div>
                        </td>
                    </tr>
                </table>

                <br />

                <!-- <input type='button' id='click' value='click'> -->
                <form enctype="multipart/form-data" method="POST" action="<?= Url::toRoute(['/informasisurat/acc-ttd?id=' . $model1->id]) ?>" class="form-horizontal" onsubmit="return confirm('Yakin tidak ada perubahan pada tanda tangan anda ?')">
                    <textarea id='output' name="img" style="display:none;"></textarea><br />
                    <img src='' id='sign_prev' style='display: none;' />
                    <br>
                    <br>
                    <div id="tombol-cek" style="display: block;">
                        <input type="button" class="btn btn-success" id="click" value="Cek">
                    </div>
                    <div id="tombol-simpan" style="display: none;">
                        <input type="submit" class="btn btn-success" id="click-simpan" value="Simpan Tanda Tangan">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- // Modal Tandatangan  end// -->