<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Smdisposisi */

$this->title = 'Create Smdisposisi';
$this->params['breadcrumbs'][] = ['label' => 'Smdisposisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smdisposisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
