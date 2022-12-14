<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Contoh $model */

$this->title = 'Update Contoh: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contohs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contoh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
