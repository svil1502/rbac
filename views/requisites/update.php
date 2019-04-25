<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requisites */

$this->title = 'Обновить реквизиты: ' . $model->req;
$this->params['breadcrumbs'][] = ['label' => 'Requisites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="requisites-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
    ]) ?>

</div>
