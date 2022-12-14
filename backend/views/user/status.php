<?php



use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Status User';

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
                        <a href=" <?= Url::toRoute(['site/user']) ?>" <button type="button" class="close" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                            </button>
                        </a>
                        <h3 class="profile-username text-center">Status User</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <div class="text-center">
                                <li class="list-group-item ">
                                    <b class="float-left">Status User&emsp;:</b> <a>
                                        <div class="row">
                                            <div class="col-md-10">

                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                                    <label class="btn bg-olive active ">
                                                        <input type="radio" name="User[status]" id="gender" autocomplete="off" checked value="10"> &emsp; AKTIF &emsp;
                                                    </label>

                                                    <label class="btn bg-danger">
                                                        <input type="radio" name="User[status]" id="gender" autocomplete="off" value="9">  TIDAK AKTIF 
                                                    </label>

                                                </div>
                                            </div>
                                </li>

                            </div>
                            </li>
                            <div>
                        </ul>


                        <span class="float-left">
                            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleModalCenter">
                                Reset Password
                            </button>

                        </span>


                        <span class="float-right">
                            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'title' => 'save']) ?>

                        </span>


                    </div>
                    <!-- /.card-body -->
                </div>







<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
            <h5 class="modal-title" id="exampleModalLongTitle">Yakin Ingin Mereset Password ?</h5>
                <?= $form->field($model, 'password_hash')->hiddenInput(['value' => '$2y$13$Oh7n7plI0kN3FfPD64FkuuP3MYHS761FqoE8.4/gpfWMfnGarhTIu'])->label(false) ?>
                <div class="form-group">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Reset Password', ['class' => 'btn btn-warning']) ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


