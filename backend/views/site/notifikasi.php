<?php


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AsalsuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MAN2 | Asal Surat';
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
      <div class="col-6">



        <div class="card card-primary card-outline card-outline-tabs">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs " id="custom-tabs-four-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">surat Masuk</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Surat Baru</a>
              </li>
            </ul>
          </div>

          <div class="card-body ">
            <div class="tab-content" id="custom-tabs-four-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Asal Surat</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>1</td>
                      <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum vero vel quas, voluptas, doloribus fugiat modi ad debitis corrupti provident facere neque, illo ea dignissimos saepe maiores rem itaque velit?</td>
                    </tr>


                  </tbody>
                </table>
              </div>

              <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
              <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Asal Surat</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <a href="">
                      <td>1</td>
                      <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum vero vel quas, voluptas, doloribus fugiat modi ad debitis corrupti provident facere neque, illo ea dignissimos saepe maiores rem itaque velit?</td>
                      </a>
                    </tr>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
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
    <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready(function() {
        $('#example1').DataTable();
      });
    </script>


<script>
      $(document).ready(function() {
        $('#example2').DataTable();
      });
    </script>

    </html>

  </div>