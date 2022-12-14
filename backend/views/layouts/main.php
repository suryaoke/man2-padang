<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use backend\models\Isisurat;
use backend\models\Notif1;
use backend\models\Notif2;
use backend\models\Pembuatsurat;
use backend\models\Smpenerima;
use backend\models\Tandatangan;
use backend\models\Tujuansurat;
use backend\models\User;
use backend\models\Verifikasi;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\data\Pagination;
use yii\helpers\Url;

AppAsset::register($this);
//Notif1//
$notif3 = Notif1::find()->where(['tujuan' => Yii::$app->user->identity->id]);
$notif1 = Notif1::find()->where(['tujuan' => Yii::$app->user->identity->id])->count();
$c = "dibaca";
$status = Smpenerima::find()->where(['id_penerima' => Yii::$app->user->identity->id, 'status' => $c])->count();


$pages = new Pagination([
    "totalCount" => $notif1
]);
$pages->pageSize = 3;
$notif =  $notif3->limit($pages->limit)->orderBy('id DESC')->all();


///NOtif2
$notif2 = Notif2::find()->where(['tujuan' => Yii::$app->user->identity->id])->count();
$notif4 = Notif2::find()->where(['tujuan' => Yii::$app->user->identity->id]);
$tanda = Notif2::find()->where(['tujuan' => Yii::$app->user->identity->id, 'status' => $c])->count();

$pagess = new Pagination([
    "totalCount" => $notif2
]);

$pagess->pageSize = 3;
$notiff =  $notif4->limit($pagess->limit)->orderBy('id DESC')->all();

//total Notif
$totalnotif1 =   $notif1 - $status;

$totalnotif2 =  $notif2 - $tanda;

$total = $totalnotif1 + $totalnotif2;


?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/summernote/summernote-bs4.min.css">

</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed ">
    <?php $this->beginBody() ?>
    <div class=" wrapper ">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= Yii::$app->getHomeUrl(); ?>dist/img/350-MAN_2_PADANG.png" alt="MAN2" height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light " style="background-color: #0093dd; ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= Url::toRoute(['/']) ?>" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!--Notifikasi Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge"><?php echo $total ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"><?php echo $total ?> Notifications</span>
                        <div class="dropdown-divider"></div>
                        <?php foreach ($notif as $value) : ?>
                            <div class=" my-custom-scrollbar">
                                <a href="<?= Url::toRoute(['suratmasuk/smdisposisi', 'id_sm' => $value->id_sm]) ?>" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title ">
                                                <?php if ($value["status"] ==  "belum dibaca") { ?>
                                                    <span class="float-right badge badge-danger">New</span>
                                                <?php }   ?>
                                                <?php echo $value["header"]; ?>
                                                <p class=" float-right text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $value["created_at"]; ?></p>
                                            </h3>
                                            <?php $tampil_sebagian  = substr($value["isi"], 0, 30); ?>
                                            <p class="text-sm">Perihal : <?php echo $tampil_sebagian ?> </p>
                                            <p class="text-sm text-muted"><i class="fa fa-paper-plane"> :</i>
                                                <?php $status = Smpenerima::find()->where(['id_sm' => $value, 'id_penerima' => Yii::$app->user->identity->id])->one(); ?>
                                                <?php $user = User::find()->where(['id' => $status["id_pengirim"]])->one(); ?>
                                                <?php echo $user["nama"]; ?>

                                            </p>

                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                            </div>

                        <?php endforeach; ?>



                        <?php foreach ($notiff as $value) : ?>
                            <div class=" my-custom-scrollbar">
                                <?php if ($value["kategori"] == 1) { ?>
                                    <?php $verifikasi = Verifikasi::find()->where(['id_informasi' => $value->id_sk])->one(); ?>
                                    <a href="<?= Url::toRoute(['verifikasi/periksa', 'id' => $verifikasi->id]) ?>" class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <div class="media-body">
                                                <h3 class="dropdown-item-title ">
                                                    <?php if ($value["status"] ==  "belum dibaca") { ?>
                                                        <span class="float-right badge badge-danger">New</span>
                                                    <?php }   ?>
                                                    <?php echo $value["header"]; ?>
                                                    <p class=" float-right text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $value["created_at"]; ?></p>
                                                </h3>
                                                <?php $tampil_sebagian  = substr($value["isi"], 0, 30); ?>
                                                <p class="text-sm">Perihal : <?php echo $tampil_sebagian ?> </p>
                                                <p class="text-sm text-muted"><i class="fa fa-paper-plane"> :</i>

                                                    <?php $user = User::find()->where(['id' => $value["id_pengirim"]])->one(); ?>
                                                    <?php echo $user["nama"]; ?>

                                                </p>

                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </a>
                                <?php } ?>


                                <?php if ($value["kategori"] == 2) { ?>
                                    <?php $tanda = Tandatangan::find()->where(['id_informasi' => $value->id_sk])->one(); ?>
                                    <a href="<?= Url::toRoute(['tandatangan/update', 'id' => $tanda->id]) ?>" class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <div class="media-body">
                                                <h3 class="dropdown-item-title ">
                                                    <?php if ($value["status"] ==  "belum dibaca") { ?>
                                                        <span class="float-right badge badge-danger">New</span>
                                                    <?php }   ?>
                                                    <?php echo $value["header"]; ?>
                                                    <p class=" float-right text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $value["created_at"]; ?></p>
                                                </h3>
                                                <?php $tampil_sebagian  = substr($value["isi"], 0, 30); ?>
                                                <p class="text-sm">Perihal : <?php echo $tampil_sebagian ?> </p>
                                                <p class="text-sm text-muted"><i class="fa fa-paper-plane"> :</i>

                                                    <?php $user = User::find()->where(['id' => $value["id_pengirim"]])->one(); ?>
                                                    <?php echo $user["nama"]; ?>

                                                </p>

                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </a>
                                <?php } ?>
                            </div>

                        <?php endforeach; ?>
                        <div class="dropdown-divider"></div>

                     
                    </div>
                </li>

            </ul>
            <ul class="navbar-nav">
                <li class=" dropdown user user-menu">
                    <a data-toggle="dropdown" class="nav-link">
                        <?php if (!Yii::$app->user->identity->foto) { ?>

                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="user-image" alt="User Image">
                            <!-- //"// Url::toRoute(['upload/user/' . $value->foto]) " -->
                        <?php } else { ?>
                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="user-image" alt="User Image">

                        <?php } ?>

                        <?= Yii::$app->user->identity->nama ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="background-color: #0093dd;">
                            <?php if (!Yii::$app->user->identity->foto) { ?>

                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                <!-- //"// Url::toRoute(['upload/user/' . $value->foto]) " -->
                            <?php } else { ?>
                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="img-circle elevation-2" alt="User Image">

                            <?php } ?>
                            <p>
                                <?= Yii::$app->user->identity->nama ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="<?= Url::toRoute(['user/index']) ?>" class="btn btn-default btn-flat">Profile</a>
                            <a href="<?= Url::toRoute(['site/logout']) ?>" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= Url::toRoute(['/']) ?>" class="brand-link">
                <img src="<?= Yii::$app->getHomeUrl(); ?>dist/img/350-MAN_2_PADANG.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MAN2</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if (!Yii::$app->user->identity->foto) { ?>
                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        <?php } else { ?>
                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="img-circle elevation-2" alt="User Image">

                        <?php } ?>
                    </div>
                    <div>
                        <?php
                        if (Yii::$app->user->isGuest) {
                        } else {
                            echo Html::beginForm(['/user/index'])
                                . Html::submitButton(
                                    ' ' . Yii::$app->user->identity->nama . '',
                                    ['class' => 'btn  btn-dark text-decoration-none']
                                )
                                . Html::endForm();
                        }
                        ?>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= Url::toRoute(['/']) ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu"  || Yii::$app->user->identity->role == "guru") { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                    <i class="nav-icon  fa fa-plus-square"></i>
                                    <p>
                                        Buat Surat
                                    </p>
                                </a>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Surat
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['informasisurat/data']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Surat Baru</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['log/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                               Data Log 
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['log/guru']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Log Guru
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['log/kepsek']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Log Kepsek
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['log/wakil']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Log Wakil
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['log/verificator']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                Log Verificator
                                            </p>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['naskahdinas/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Naskah Dinas</p>
                                        </a>
                                    </li>

                                <?php } ?>


                                <li class="nav-item">
                                    <a href="<?= Url::toRoute(['suratmasuk/index']) ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Surat Masuk</p>
                                    </a>
                                </li>
                                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu"  || Yii::$app->user->identity->role == "guru") { ?>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['informasisurat/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Surat Baru</p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['suratmasuk/smterkirim']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Surat Masuk Terkirim</p>
                                        </a>
                                    </li>


                                <?php } ?>

                                <?php if (Yii::$app->user->identity->role == "kepsek" || Yii::$app->user->identity->role == "admin") { ?>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['tandatangan/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tanda Tangan Surat</p>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php if (Yii::$app->user->identity->role == "verificator" || Yii::$app->user->identity->role == "admin") { ?>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['verifikasi/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Verifikasi Surat</p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>





                        <?php if (Yii::$app->user->identity->role == "admin") { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Master
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['asalsurat/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asal Surat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['site/user']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['jabatan/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jabatan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['role/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Role</p>
                                        </a>
                                    </li>

                                </ul>

                            </li>

                        <?php } ?>


                        <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Report
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['reportsb/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Surat Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['reportsm/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Surat Masuk</p>
                                        </a>
                                    </li>
                                  

                                </ul>

                            </li>

                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">

                        <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>
                            <div class=""> <a href="<?= Url::toRoute(['suratmasuk/create']) ?>" style="background-color: #0093dd;" class="btn  btn-lg active" role="button" aria-pressed="true">&nbsp;Surat&nbsp;Masuk</a></div>
                        <?php } ?>

                        <div style="padding-top: 8px;"> <a href="<?= Url::toRoute(['informasisurat/create']) ?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">&nbsp;&nbsp;Surat Baru&nbsp;&nbsp;</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        <footer class="main-footer">

        </footer>
        <main role="main" class="flex-shrink-0">
            <div class="content-wrapper">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>
    <!-- jQuery -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/moment/moment.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>dist/js/adminlte.js"></script>
    <!-- jQuery -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="<?= Yii::$app->getHomeUrl(); ?>ckeditor/ckeditor.js" ?>

    </script>
    <script>
        CKEDITOR.replace('content1', {
            width: 832,
            height: 1060,
            filebrowserUploadUrl: "<?= Url::toRoute(['site/upload-ckeditor']) ?>",
            filebrowserUploadMethod: 'form',

            fullPage: true,
            allowedContent: true,

        });

        CKEDITOR.replace('content2', {
            width: 832,
            height: 1060,
            filebrowserUploadUrl: "<?= Url::toRoute(['site/upload-ckeditor']) ?>",
            filebrowserUploadMethod: 'form',
            toolbarCanCollapse: true, //Button to toggle toolbar (show/hide) 
            toolbarStartupExpanded: false, //This will hide toolbar by default.

            fullPage: true,
            allowedContent: true,

        });
    </script>





    <?php $this->endBody() ?>
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->getHomeUrl(); ?>jquery.signature/css/jquery.signature.css">
    <script src="<?= Yii::$app->getHomeUrl(); ?>signature/jSignature-master/libs/jSignature.min.js"> </script>
    <script>
        $(document).ready(function() {
            // var wrapper = document.getElementById("signature");
            // var canvas = wrapper.querySelector("canvas");

            // var parentWidth = $(canvas).parent().outerWidth();
            // Initialize jSignature
            var $sigdiv = $("#signature").jSignature({
                'UndoButton': true,
                lineWidth: 5,
                // width: 500,
                // width: "ratio",
                autoFit: true,
                height: 102,
            });

            $('#click').click(function() {
                // Get response of type image
                var data = $sigdiv.jSignature('getData', 'image');

                // Storing in textarea
                $('#output').val(data);

                // ketika button cek
                $('#tombol-simpan').show();
                $('#tombol-cek').hide();
                // menampilkan data image 
                $('#sign_prev').attr('src', "data:" + data);
                $('#sign_prev').show();
            });

            $("#signature").bind('change', function(e) {
                $('#tombol-simpan').hide();
                $('#tombol-cek').show();
            });




        });
    </script>
</body>

</html>
<?php $this->endPage();
