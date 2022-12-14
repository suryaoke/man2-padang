<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Request password reset';
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request password reset</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>dist/css/adminlte.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>assets01/css/login.css">
</head>
<?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
<div class="site-login ">

    <main>
        <div class="container-fluid " style="background-color: #0093dd;">
            <div class="row">

                <div class="col-md-7 px-0 d-none d-sm-block">
                    <img src="<?= Yii::$app->getHomeUrl(); ?>dist/img/1.jpg" alt="login image" class="login-img">
                </div>
                <div class="col-md-5 mt-5  ">
                    <div class="mt-5 offset-lg-2 col-lg-6">
                    <div class="login-box">
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <a href=" <?= Url::toRoute(['/']) ?>" <button type="button" class="close" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                            </button>
                        </a>
                        <h3 class="login-box-msg"><?= Html::encode($this->title) ?></h3>
                        <h6 class="login-box-msg">Please fill out your email. A link to reset password will be sent there</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Email") ?>

                                <div class="form-group float-right">
                                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php ActiveForm::end(); ?>

</div>