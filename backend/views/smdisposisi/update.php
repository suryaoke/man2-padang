<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Smdisposisi */

$this->title = 'Update Smdisposisi: ' . $model->id_sm_disposisi;
$this->params['breadcrumbs'][] = ['label' => 'Smdisposisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sm_disposisi, 'url' => ['view', 'id_sm_disposisi' => $model->id_sm_disposisi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smdisposisi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
