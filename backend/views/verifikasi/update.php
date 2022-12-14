<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Verifikasi $model */

$this->title = 'Update Verifikasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Verifikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="verifikasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
