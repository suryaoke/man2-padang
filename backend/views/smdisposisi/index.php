<?php

use common\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AsalsuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MAN2 | Surat Masuk Disposisi';
$this->params['breadcrumbs'][] = $this->title;
$no=1;
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>dist/css/adminlte.min.css">
</head>
<div class="asalsurat-index content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Status</th>
                                    <th>Isi</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataProvider->getModels() as $key => $value) : ?>
                                    <tr align="center">

                                       <td><?php echo $no; ?></td>
                                        
                                        <td>
                                            <?php
                                            $posisi = User::find()->where(['id' => $value["id_pengirim"]])->one();
                                            echo $posisi['username'];
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            $posisi = User::find()->where(['id' => $value["id_penerima"]])->one();
                                            echo $posisi['username'];
                                            ?>
                                        </td>
                                        <td><?php echo $value["status"]; ?></td>
                                        <td><?php echo $value["isi"]; ?></td>
                                        <td><?php echo $value["kirim_at"]; ?></td>
                  


                                        <td align="right">

                                            <?= Html::a('<span class="fa fa-edit"></span>', ['update', 'id_sm_disposisi' => $value->id_sm_disposisi], ['class' => 'btn btn-info', 'title' => 'Edit']) ?>
                                            <?= Html::a('<span class="fa fa-trash"></span>', ['delete', 'id_sm_disposisi' => $value->id_sm_disposisi], [
                                                'class' => 'btn btn-danger',
                                                'title' => 'delete',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',

                                                ],
                                            ]) ?>
                                        </td>

                                    </tr>
                                  <?php  $no++;?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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

        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>


        </html>

    </div>