<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Contoh $model */

$this->title = 'Create Contoh';
$this->params['breadcrumbs'][] = ['label' => 'Contohs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contoh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
