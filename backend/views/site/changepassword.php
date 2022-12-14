<?php



use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Change Password';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-form">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-md-6">

                <!-- Profile Image -->
                <div class="card card-info card-outline">

                    <div class="card-body box-profile">
                    
             
                        <a href=" <?= Url::toRoute(['/']) ?>"  type="button" class="close" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                            </button>
                        </a>
                        <h3 class="profile-username text-center">Change Password</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <div class="text-center">
                                <li class="list-group-item ">
                                    <b class="float-left">Old Password&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:</b> <a>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?= $form->field($model, 'oldpass', ['inputOptions' => [
                                                   
                                                ]])->passwordInput()->label(false) ?>
                                    </a>
                            </div>
                    </div>
                    </li>

                    <li class="list-group-item ">
                        <b class="float-left">New Password&emsp;&emsp;&emsp;&emsp;:</b> <a>
                            <div class="row">
                                <div class="col-md-10">
                                    <?= $form->field($model, 'newpass', ['inputOptions' => [
                                       
                                    ]])->passwordInput()->label(false) ?>

                        </a>
                </div>
            </div>
            <li class="list-group-item ">
                <b class="float-left">Repeat New Passwor&emsp;&nbsp;:</b> <a>
                    <div class="row">
                        <div class="col-md-10">
                            <?= $form->field($model, 'repeatnewpass', ['inputOptions' => [
                            
                            ]])->passwordInput()->label(false) ?>
                </a>
        </div>
    </div>
    </li>
    <div>
        </ul>

        <span class="float-right">
            <?= Html::submitButton('Change Password', ['class' => 'btn btn-success']) ?>

        </span>
     

    </div>
    <!-- /.card-body -->
</div>


<?php ActiveForm::end(); ?>