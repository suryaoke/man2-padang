<?php



use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Profil';

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
                        <a href=" <?= Url::toRoute(['/']) ?>" <button type="button" class="close" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                            </button>
                        </a>
                        <h3 class="profile-username text-center">Update Profile</h3>
                        </li>
                                <li class="list-group-item ">
                                    <b class="float-left">Nama&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:</b> <a>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?>
                                    </a>
                            </div>
                    </div>
                    </li>

                        <ul class="list-group list-group-unbordered mb-3">
                            <div class="text-center">
                            <li class="list-group-item ">
                                    <b class="float-left">User Name&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <a>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false) ?>
                                    </a>
                            </div>
                    </div>

                    </li>
                                <li class="list-group-item ">
                                    <b class="float-left">email&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:</b> <a>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
                                    </a>
                            </div>
                    </div>
                    </li>

                    
                    <li class="list-group-item ">
                        <b class="float-left">Foto&emsp;&emsp;&emsp;&emsp;&emsp;:</b> <a>
                            <div class="row">
                                <div class="col-md-10">
                                    <?= $form->field($model, 'foto')->fileInput(['maxlength' => true])->label(false) ?>
                        </a>
                </div>
            </div>

            <li class="list-group-item ">
                <b class="float-left">Tanda Tangan&emsp;:</b> <a>
                    <div class="row">
                        <div class="col-md-10">
                            <?= $form->field($model, 'file')->fileInput(['maxlength' => true])->label(false) ?>
                </a>
        </div>
    </div>
    </li>
    <div>
        </ul>

        <span class="float-right">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'title' => 'save']) ?>

        </span>
        

    </div>
    <!-- /.card-body -->
</div>


<?php ActiveForm::end(); ?>