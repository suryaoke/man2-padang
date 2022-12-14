<?php

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Log;
use backend\models\Pembuatsurat;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Tanda Tangan Surat';
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
                        <h3 class="card-title">Tandatangan Surat </h3>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Pembuat Surat </th>
                                    <th>Perihal</th>
                                    <th>Nomor Agenda Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Detail Surat</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datainformasi as $informasi) : ?>
                                    <tr>
                                        <?php $data3 = Pembuatsurat::find()->where(['id' => $informasi->id])->one(); ?>
                                        <?php $data4 = User::find()->where(['id' => $data3->id_user])->one(); ?>
                                        <td><?php echo $data4["nama"]; ?></td>
                                        <td><?php echo $informasi['perihal'] ?></td>
                                        <td><?php echo $informasi['nomor_agenda'] ?></td>
                                        <td><?php echo $informasi['tanggal_surat'] ?></td>
                                        <td> <?= Html::a('<span class="fas fa-eye"></span>', ['informasisurat/update', 'id' => $informasi->id], ['class' => 'btn bg-info ']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>

                            </thead>
                            <tbody align="center">
                                <td> <?= $form->field($isi, 'isi')->textarea(['rows' => 6, 'id' => 'content2', 'value' => $isi->isi])->label(false) ?></td>
                            </tbody>
                        </table>

                        <div class="row">
                            <br>
                        </div>

                        <div class="float-right">
                            <?php if ($model->status == "ditandatangan") { ?>

                                <?= Html::a('Kirim Surat ', ['kirim', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                            <?php } ?>

                            <?php if ($model->status == "diperiksa") { ?>
                                <!-- Default box Tandatangan-->
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
                                <!-- /.card -->
                            <?php } ?>

                            <?php if ($model->status == "diterima") { ?>
                                <?= Html::a('Print Surat ', ['tandatangan/print?id=' . $model->id], ['class' => 'btn btn-success', 'title' => 'next']) ?>

                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php ActiveForm::end(); ?>



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
                <?= $form->field($model, 'status')->hiddenInput(['value' => "ditandatangan"])->label(false) ?>
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
                <?= Html::a('Tanda Tangan ', ['langsung', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

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
                <form enctype="multipart/form-data" method="POST" action="<?= Url::toRoute(['/tandatangan/acc-ttd?id=' . $model->id]) ?>" class="form-horizontal" onsubmit="return confirm('Yakin tidak ada perubahan pada tanda tangan anda ?')">
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