<script type="text/javascript">
    var value = '2022';

    function updatevariable(data) {
        var value = data;



        console.log(value);
    }
</script>

<?php
$tgla = '<script>document.write(value)</script>';


?>
<?php

/** @var yii\web\View $this */

use backend\models\Naskahdinas;
use backend\models\Pembuatsurat;
use backend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$no = 1;


$this->title = 'MAN2 ';
$this->params['breadcrumbs'][] = $this->title;
$D = Yii::$app->db;
$tgl = date('Y');
//var_dump($tgl) ;
$semesterfull = $D->createCommand("SELECT *,COUNT(kirim_at) AS jumlah FROM `informasisurat`
WHERE YEAR(kirim_at ) IN ('$tgl') 
GROUP BY MONTH(kirim_at) , YEAR(kirim_at) ORDER BY YEAR(kirim_at) DESC , MONTH(kirim_at) ASC")->queryAll();



$total = [];
$total1 = [];
foreach ($jumlah0 as $data0) :


    $total[] = $data0["kirim_at"];
    $total1[] = $data0["jumlah"];

endforeach;
// data pie surat baru //

$totalsemesterfull = [];
$totalsemesterfulldata = [];
foreach ($semesterfull as $datafull) :

    $datafull1 =  date(' F ', strtotime($datafull["kirim_at"]));
    $totalsemesterfull[] = $datafull1;
    $totalsemesterfulldata[] = $datafull["jumlah"];
endforeach;

$totalsemester1label = [];
$totalsemester1data = [];
foreach ($semester1 as $dataawal) :

    $dataawal1 =  date(' F ', strtotime($dataawal["kirim_at"]));
    $totalsemester1label[] = $dataawal1;
    $totalsemester1data[] = $dataawal["jumlah"];

endforeach;


$totalsemester2label = [];
$totalsemester2data = [];
foreach ($semester2 as $dataakhir) :

    $dataakhir1 =  date(' F ', strtotime($dataakhir["kirim_at"]));
    $totalsemester2label[] =  $dataakhir1;
    $totalsemester2data[] = $dataakhir["jumlah"];

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


        <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>

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


                            <select onchange="renderChart(this)" class="mb-2">
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

            <?php } ?>

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
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#a6009f', '#5a00a6', '#a65a00', '#a60700', '#000905', '#baffdf'],


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



<!-- // pie Data Surat BAru// -->
<script>
    const totalsemesterfull = <?php echo json_encode($totalsemesterfull); ?>;
    const totalsemesterfulldata = <?php echo json_encode($totalsemesterfulldata); ?>;

    const totalsemester1label = <?php echo json_encode($totalsemester1label); ?>;
    const totalsemester1data = <?php echo json_encode($totalsemester1data); ?>;

    const totalsemester2label = <?php echo json_encode($totalsemester2label); ?>;
    const totalsemester2data = <?php echo json_encode($totalsemester2data); ?>;

    const datafull = {
        labels: totalsemesterfull,
        datasets: [{
            label: 'My First Dataset',
            data: totalsemesterfulldata,
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#a6009f', '#5a00a6', '#a65a00', '#a60700', '#000905', '#baffdf'],

        }]
    };

    const dataawal = {
        labels: totalsemester1label,
        datasets: [{
            label: 'My First Dataset',
            data: totalsemester1data,
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],

        }]
    };

    const dataakhir = {
        labels: totalsemester2label,
        datasets: [{
            label: 'My First Dataset',
            data: totalsemester2data,
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],

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
        configdatafull
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

        var value = "test";

        function updatevariable(data) {
            value = data;
            alert(value);
            console.log(value);
        }

    }
</script>
<!-- // config Bar SURAT baru vs Surat Masuk // -->
<script>
    $(function() {
        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                    label: 'Surat Baru',
                    backgroundColor: '#f56954',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Surat Masuk',
                    backgroundColor: '#00a65a',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    })
</script>






<!-- <script>

    const datafull = {
        datasets: [{
            label: 'Weekly Sales',
            data: [{
                    id: '10',
                    financials: {
                        2024: {
                            semester1: 1,
                            semester2: 2
                        },
                        2023: {
                            semester1: 2,
                            semester2: 5
                        },
                    }
                },
                
                {
                    id: '10',
                    financials: {
                        2024: {
                            semester1: 1,
                            semester2: 2
                        },
                        2023: {
                            semester1: 2,
                            semester2: 5
                        },
                    }
                },


                {
                    id: '11',
                    financials: {
                        2023: {
                            semester1: 3,
                            semester2: 4
                        },
                        2022: {
                            semester1: 9,
                            semester2: 8
                        },
                    }
                },
                {
                    id: '12',
                    financials: {
                        2022: {
                            semester1: 5,
                            semester2: 6
                        },

                    }
                }
            ],
            backgroundColor: [
                'rgba(255, 26, 104, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(0, 0, 0, 0.2)'
            ],
            borderColor: [
                'rgba(255, 26, 104, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1
        }]
    };


    const config = {
        type: 'bar',
        data: datafull,

        options: {
            parsing: {
                xAxisKey: 'id',
                yAxisKey: 'financials.2022.semester1'
            },

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const myChart3 = new Chart(
        document.getElementById('myChart3'),
        config
    );

    function change() {

        const year = document.getElementById('year').value;
        const financial = document.getElementById('financial').value;

        myChart3.config.options.parsing.yAxisKey = `financials.${year}.${financial}`;
        myChart3.update();
    }
</script> -->


<!-- <select id="year" onchange="change()" class="mb-2">
                            <option value="">Pilih </option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>


                        <select id="financial" onchange="change()" class="mb-2">
                            <option value="">Pilih </option>
                            <option value="semester1">semester1</option>
                            <option value="semester2">semester2</option>
                        </select> -->