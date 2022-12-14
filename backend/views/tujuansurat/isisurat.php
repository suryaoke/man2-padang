<?php

use backend\models\Asalsurat;
use backend\models\Naskahdinas;
use backend\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

foreach ($data as $value) :
endforeach;
foreach ($data1 as $values) :
endforeach;
/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Tujuan Surat';
$this->params['breadcrumbs'][] = ['label' => 'Informasi Surat', 'url' => ['informasisurat/update', 'id' => $value->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="informasisurat-form content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>
                            <nav class="navbar navbar-expand-lg   float-right">
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $value->id]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['tujuansurat/update', 'id' => $values->id]) ?>">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['tujuansurat/isisurat', 'id' => $value->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Lampiran</span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Tembusan</span></a>
                                    </div>
                                    <div class="bg-light disabled">
                                        <a class="nav-item nav-link text-light disabled" href="#">Verification</span></a>
                                    </div>
                            </nav>
                        </h5>
                    </div>

                    <div class="card-body  ">
                        <div class="row">

                            <div class="col-md-2">
                            </div>

                            <?= $form->field($model, 'isi')->textarea(['rows' => 6, 'id' => 'content1']) ?>



                            <?= $form->field($model, 'id_informasi')->hiddenInput(['value' => $value->id])->label(false) ?>


                        </div>

                    </div>


                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>