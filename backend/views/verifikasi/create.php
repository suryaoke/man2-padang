<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Verifikasi $model */

$this->title = 'Create Verifikasi';
$this->params['breadcrumbs'][] = ['label' => 'Verifikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verifikasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
