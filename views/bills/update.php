<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bills */

$this->title = 'Обновить счет: ' . $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="bills-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
        'data_acts' => $data_acts,
    ]) ?>

</div>
