<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';
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
    <title>AdminLTE 3 | Log in</title>

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
                <div class="col-md-5 mt-2 ">
                    <div class=" offset-lg-2 col-lg-6">
                        <div class="login-box">
                          
                            <h4 class="login-box-msg text-white "><img src="<?= Yii::$app->getHomeUrl(); ?>dist/img/350-MAN_2_PADANG.png" height="130" width="120"> <br> Login <br> MAN2 Padang </h4>

                            <!-- /.login-logo -->
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <div class="login-logo">

                                    </div>

                                    <?= $form
                                        ->field($model, 'username', $fieldOptions1)
                                        ->label(false)
                                        ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

                                    <?= $form
                                        ->field($model, 'password', $fieldOptions2)
                                        ->label(false)
                                        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                                    <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-3 col-5">
                                                <?= $form->field($model, 'bilangan_pertama', [
                                                    'options' =>
                                                    [
                                                        'tag' => 'div',
                                                        'class' => ''
                                                    ],

                                                ])->textInput(['class' => 'form-control h-auto text-black text-center placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0  mb-2', 'readonly' => true,])->label(false) ?>
                                            </div>
                                            <div class="col-md-1 col-2 ">
                                                <p class="align-middle" style=" font-size: 15px;">+</p>

                                            </div>
                                            <div class="col-md-3 col-5">
                                                <?= $form->field($model, 'bilangan_kedua', [

                                                    'options' =>
                                                    [
                                                        'tag' => 'div',
                                                        'class' => '',

                                                    ],

                                                ])->textInput(['class' => 'form-control h-auto text-black text-center placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0  mb-2',  'readonly' => true,])->label(false) ?>
                                            </div>
                                            <div class="col-md-1 col-12 ">
                                                <p class="align-middle" style="font-size: 15px;">=</p>
                                            </div>
                                           
                                                <?= $form->field($model, 'bilangan_hasil', [
                                                    'options' =>
                                                    [
                                                        'tag' => 'div',
                                                        'class' => ''
                                                    ],

                                                ])->textInput(['class' => 'form-control h-auto text-black text-center placeholder-white opacity-70 bg-dark-o-70 rounded-pill ',  ])->label(false) ?>
                                       
                                        </div>
                                    </div>

                                    <div class="row">
                                        &emsp;
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox"> Remember Me
                                            </label>
                                            &emsp;&emsp;&emsp;&nbsp;&nbsp;
                                        </div>
                                        <!-- /.col -->
                                        <div class="float-right"> <a href=" <?= Url::toRoute(['site/request-password-reset']) ?>">
                                                Forgot Password?
                                            </a> </div>
                                    </div>
                                    <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                                    <!-- /.col -->
                                </div>
                            </div>
                            <!-- /.login-box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("

	$(function () {
    
    // Remember Me checkbox style
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    // Auto-focus
    $('input[type=text]').first().focus();
  });

", $this::POS_END);
?>