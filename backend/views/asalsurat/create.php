<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Asalsurat */

$this->title = 'MAN2 | Create Asal surat';
$this->params['breadcrumbs'][] = ['label' => 'Asalsurats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asalsurat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
