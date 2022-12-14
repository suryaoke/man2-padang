<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php foreach ($user as $value) : ?>
    <?php endforeach; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-md-6">

                <!-- Profile Image -->
                <div class="card card-info card-outline">

                    <div class="card-body box-profile">
                        <a href=" <?= Url::toRoute(['/']) ?>" <button type="button" class="close" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                            </button>
                        </a>
                        <div class="text-center">

                            <?php if (!Yii::$app->user->identity->foto) { ?>

                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="profile-user-img img-fluid img-circle" alt="User Image">
                                <!-- //"// Url::toRoute(['upload/user/' . $value->foto]) " -->
                            <?php } else { ?>
                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="profile-user-img img-fluid img-circle" alt="User Image">

                            <?php } ?>


                        </div>

                        <h3 class="profile-username text-center"></h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <div class="text-center">
                                <li class="list-group-item ">
                                    <b class="float-left">Nama&emsp;&emsp;&emsp;:</b> <a><?= Yii::$app->user->identity->nama ?></a>
                                </li>
                                

                                <li class="list-group-item">
                                    <b class="float-left">Jabatan&emsp;&emsp;:</b> <a><?= Yii::$app->user->identity->jabatan ?></a>
                                </li>


                                <li class="list-group-item">
                                    <b class="float-left">Tanda Tangan&emsp;:</b> <a>

                                        <?php if (!$value["file"]) { ?>
                                            <image src="<?= Url::toRoute(['upload/tandatangan/blank.jpg']) ?>" height="40" width="50"></image>
                                        <?php } else { ?>
                                            <image src="<?= Url::toRoute(['upload/tandatangan/' . $value->file]) ?>" height="40" width="50"></image>
                                        <?php } ?>

                                    </a>


                                </li>
                                <div>
                        </ul>

                        <span class="float-left">
                            <?= Html::a('Change Password', ['site/changepassword'], ['class' => 'btn btn-warning', 'title' => 'Tambahkan Foto']) ?>

                        </span>

                        <span class="float-right">
                            <?= Html::a('Update Profile', ['user/update', 'id' => $value->id], ['class' => 'btn btn-success', 'title' => 'Tambahkan Foto']) ?>

                        </span>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>