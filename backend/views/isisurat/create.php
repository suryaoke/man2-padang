<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Isisurat */

$this->title = 'Create Isisurat';
$this->params['breadcrumbs'][] = ['label' => 'Isisurats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="isisurat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
