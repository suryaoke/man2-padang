<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Reportsm $model */

$this->title = 'Create Reportsm';
$this->params['breadcrumbs'][] = ['label' => 'Reportsms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportsm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
