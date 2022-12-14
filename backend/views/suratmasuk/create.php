<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */

$this->title = 'Buat Surat Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suratmasuk-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'model4' => $model4,
    ]) ?>

</div>