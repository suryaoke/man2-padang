<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Naskahdinas */

$this->title = 'Update Naskah dinas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Naskah dinas', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="naskahdinas-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
