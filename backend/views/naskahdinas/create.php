<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Naskahdinas */

$this->title = 'Buat Naskah dinas';
$this->params['breadcrumbs'][] = ['label' => 'Naskah dinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="naskahdinas-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
