<?php

use backend\models\Informasisurat;
use backend\models\Naskahdinas;
use backend\models\Verifikasi;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AsalsuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MAN2 | Verifikasi Surat';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<div class="asalsurat-index content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>

                    </div>
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tujuan Surat</th>
                                    <th>Nomor Agenda</th>
                                    <th>Perihal</th>
                                    <th>Naskah Dinas</th>
                                    <th>Tanggal Surat</th>
                                    <th>Status</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataverifikasi  as $value) : ?>
                                    <tr>
                                        <?php $data = Verifikasi::find()->where(['id_informasi' => $value->id_informasi])->orderBy('id DESC')->one(); ?>
                                        <?php $data1 = Informasisurat::find()->where(['id' => $value->id_informasi])->orderBy('id DESC')->one(); ?>
                                        <?php $data2 = Naskahdinas::find()->where(['id' => $data1->id_naskah_dinas])->orderBy('id DESC')->one(); ?>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $data1["tujuan_surat"]; ?></td>
                                        <td><?php echo $data1["nomor_agenda"]; ?></td>
                                        <td><?php echo $data1["perihal"]; ?></td>
                                        <td><?php echo $data2["nama"]; ?></td>
                                        <td><?php echo $data1["tanggal_surat"]; ?></td>

                                        <td align="center">
                                            <?php if ($data["status"] ==  "diperiksa") { ?>
                                                <div class="bg-danger"><?php echo $data["status"]; ?></div>
                                            <?php } else if ($data["status"] == "perbaiki") { ?>
                                                <div class="bg-warning"><?php echo $data["status"]; ?></div>
                                            <?php } ?>
                                            <?php if ($data["status"] == "diterima") { ?>
                                                <div class="bg-success"><?php echo $data["status"]; ?></div>
                                            <?php } ?>
                                        </td>
                                        <td align="right"> <?= Html::a('<span class="fa fa-eye"></span>', ['periksa', 'id' => $data->id], ['class' => 'btn btn-info', 'title' => 'Edit', 'style'=> 'font-size: 10px;']) ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>


        </div>






    </div>

    <!-- ./wrapper -->
    <!-- DataTables  & Plugins -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>dist/js/adminlte.min.js"></script>


    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>