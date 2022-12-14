<?php


use backend\models\User;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$user = User::find()->all();


/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Verifikasi';

$this->params['breadcrumbs'][] = $this->title;


$no = 1;
?>

<div class="informasisurat-form content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>

                        </h5>
                    </div>
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>

                        </h5>
                    </div>
                    <div class="card-body  ">
                        <?php foreach ($tujuan as $value) { ?>
                            
                            <?= $form->field($model, 'id_sm')->textInput(['value' => "49"])->label() ?>
                            <?= $form->field($model, 'id_pengirim')->textInput(['value' => $value["id_user"]])->label() ?>
                            <?= $form->field($model, 'id_penerima')->textInput(['value' => $value["id_user"]])->label() ?>
                            <?= $form->field($model, 'status')->textInput(['value' => "belum dibaca"])->label() ?>
                        <p>---------------------------------------------------</p>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?= Html::submitButton('save', ['class' => 'btn btn-success']) ?>

        </div>
    </div>
</div>
</div>
</div>

<?php ActiveForm::end(); ?>


</div>