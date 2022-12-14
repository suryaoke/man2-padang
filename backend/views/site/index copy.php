<?php

/** @var yii\web\View $this */

use backend\models\Naskahdinas;
use backend\models\Pembuatsurat;
use backend\models\Suratmasuk;
use backend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$no = 1;


$this->title = 'MAN2 ';
$this->params['breadcrumbs'][] = $this->title;


$total = [];
$total1 = [];
$total2 = [];
foreach ($jumlah0 as $data0) :


    $total[] = $data0["kirim_at"];


    $total1[] = $data0["jumlah"];

endforeach;




?>

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .chartMenu {
            width: 100vw;
            height: 40px;
            background: #1A1A1A;
            color: rgba(255, 26, 104, 1);
        }

        .chartMenu p {
            padding: 10px;
            font-size: 20px;
        }

        .chartCard {
            width: 100vw;
            height: calc(100vh - 40px);
            background: rgba(255, 26, 104, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chartBox {
            width: 700px;
            padding: 20px;
            border-radius: 20px;
            border: solid 3px rgba(255, 26, 104, 1);
            background: white;
        }
    </style>
</head>
<div class="site-index content">


    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $count ?></h3>
                            <p>Surat Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="<?= Url::toRoute(['suratmasuk/index']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu" || Yii::$app->user->identity->role == "guru") { ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $count2 ?></h3>

                                <p>Surat Baru</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= Url::toRoute(['informasisurat/index']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                <?php } ?>


                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $count1 ?></h3>
                                <p>Surat Masuk Terkirim</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= Url::toRoute(['suratmasuk/smterkirim']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $count3 ?></h3>
                                <p>Data Surat Baru</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= Url::toRoute(['informasisurat/data']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                <?php } ?>


                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "kepsek") { ?>


                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?php echo $count5 ?></h3>
                                <p>Tanda Tangan Surat</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= Url::toRoute(['tandatangan/index']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                <?php } ?>

                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "verificator") { ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?php echo $count4 ?></h3>
                                <p>Verifikasi Surat</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= Url::toRoute(['verifikasi/index']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
            </div>
        <?php } ?>



        <div class="row">
            <div class="col-md-6">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Surat Baru</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input onchange="filterData()" type="date" id="startdate" value="">
                        <input onchange="filterData()" type="date" id="enddate" value="">
                        <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Surat</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Surat Baru</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <select onchange="renderChart(this)">
                            <option value="">Pilih </option>
                            <option value="bar1">Semester 1</option>
                            <option value="bar2">Semester 2</option>


                        </select>
                        <canvas id="myChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?> || SURAT BARU
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
                                    <th>Pembuat Surat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($informasisurat as $value) : ?>

                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $value["tujuan_surat"]; ?></td>
                                        <td><?php echo $value["nomor_agenda"]; ?></td>
                                        <td><?php echo $value["perihal"]; ?></td>
                                        <td><?php
                                            $naskah = Naskahdinas::find()->where(['id' => $value["id_naskah_dinas"]])->one();
                                            echo $naskah['nama']; ?></td>
                                        <td><?php echo $value["tanggal_surat"]; ?></td>
                                        <?php $data3 = Pembuatsurat::find()->where(['id' => $value->id])->one(); ?>
                                        <?php $data4 = User::find()->where(['id' => $data3->id_user])->one(); ?>
                                        <td><?php echo $data4["nama"]; ?></td>

                                        <td align="center">
                                            <?php if ($value["status"] ==  "diperiksa") { ?>
                                                <div class="bg-danger"><?php echo $value["status"]; ?></div>
                                            <?php } else if ($value["status"] == "ditandatangan") { ?>
                                                <div class="bg-warning"><?php echo $value["status"]; ?></div>
                                            <?php } ?>
                                            <?php if ($value["status"] == "dikirim") { ?>
                                                <div class="bg-info"><?php echo $value["status"]; ?></div>
                                            <?php } ?>
                                            <?php if ($value["status"] == "diterima") { ?>
                                                <div class="bg-success"><?php echo $value["status"]; ?></div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>


                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>




        </div>

    </section>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</div>
<!-- // config Bar Surat Baru // -->
<script>
    const dates = <?php echo json_encode($total); ?>;
    const datapoints = <?php echo json_encode($total1); ?>;
    const data = {
        labels: dates,
        datasets: [{
                label: 'Surat Baru',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: datapoints,
            },

        ]
    };
    // config 
    const config = {
        type: 'bar',
        data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    // render init block
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    function filterData() {
        const dates2 = [...dates];

        const startdate = document.getElementById('startdate');
        const enddate = document.getElementById('enddate');

        const indexstartdate = dates2.indexOf(startdate.value);
        const indexenddate = dates2.indexOf(enddate.value);

        const filterDate = dates2.slice(indexstartdate, indexenddate + 1);
        myChart.config.data.labels = filterDate;


        const datapoints2 = [...datapoints];
        const filterDatapoints = datapoints2.slice(indexstartdate, indexenddate + 1);
        myChart.config.data.datasets[0].data = filterDatapoints;
        myChart.update();
    }
</script>


<!-- // config Bar SURAT baru vs Surat Masuk // -->
<script>
    const data2 = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };
    // config 
    const config2 = {
        type: 'pie',
        data: data2,
    };
    // render init block
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
</script>




<!-- // pie // -->
<script>

    const datafull = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100, 37.89],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const dataawal = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100, 37.89],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const dataakhir = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const configdatafull = {
        type: 'pie',
        data: datafull,
    };



    const configdataawal = {
        type: 'pie',
        data: dataawal,
    };



    const configdataakhir = {
        type: 'pie',
        data: dataakhir,
    };



    // render init block
    let myChart3 = new Chart(
        document.getElementById('myChart3'),
        configdataawal
    );

    function renderChart(type) {
        myChart3.destroy();
        if (type.value === 'bar2') {
            myChart3 = new Chart(
                document.getElementById('myChart3'),
                configdataakhir
            );

        }
        if (type.value === 'bar1') {
            myChart3 = new Chart(
                document.getElementById('myChart3'),
                configdataawal
            );

        }
    }
</script>