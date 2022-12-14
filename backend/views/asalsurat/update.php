<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Asalsurat */

$this->title = 'MAN2 | Update Asalsurat' ;
$this->params['breadcrumbs'][] = ['label' => 'Asalsurats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asalsurat-update">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
