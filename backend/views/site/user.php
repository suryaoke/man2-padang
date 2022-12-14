<?php

use backend\models\Smdisposisi;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\User;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AsalsuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MAN2 | User';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


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
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                        &emsp;
                        <span class="">
                            <?= Html::a('Tambah', ['signup'], ['class' => 'btn btn-success btn-sm waves-effect waves-light']) ?>

                        </span>
                    </div> 
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Tanda Tangan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user as $value) : ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $value["nama"]; ?></td>
                                        <td><?php echo $value["username"]; ?></td>
                                        <td><?php echo $value["role"]; ?></td>
                                        <td><?php echo $value["jabatan"]; ?></td>
                                        <td>
                                            <?php if (!$value["foto"]) { ?>
                                                <image src="<?= Url::toRoute(['upload/user/user2-160x160.jpg']) ?>" height="60" width="50"></image>
                                            <?php } else { ?>
                                                <image src="<?= Url::toRoute(['upload/user/' . $value->foto]) ?>" height="60" width="50"></image>
                                            <?php } ?>
                                        </td>

                                        <td align="center">
                                            <?php if (!$value["file"]) { ?>
                                                <image src="<?= Url::toRoute(['upload/tandatangan/blank.jpg']) ?>" height="60" width="50"></image>
                                            <?php } else { ?>
                                                <image src="<?= Url::toRoute(['upload/tandatangan/' . $value->file]) ?>" height="60" width="50"></image>
                                            <?php } ?>
                                        </td>

                                        <td align="center">
                                            <?php if ($value["status"] == "10") { ?>
                                                <div class="bg-success">Aktif</div>

                                            <?php } else { ?>
                                                <div class="bg-danger"> Tidak Aktif</div>
                                            <?php } ?>

                                        </td>
                                        <td align="center">

                                            <?= Html::a('<span class="fa fa-eye"></span>', ['user/update', 'id' => $value->id], ['class' => 'btn btn-info', 'style'=> 'font-size: 10px;']) ?>
                                          
                                            <?= Html::a('<span class="fa fa-edit"></span>', ['user/status', 'id' => $value->id], ['class' => 'btn btn-danger', 'style'=> 'font-size: 10px;']) ?>
                                           
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




        </html>

    </div>