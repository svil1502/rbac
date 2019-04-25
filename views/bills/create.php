<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bills */

$this->title = 'Создать счет';
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
        'data_acts' => $data_acts,
    ]) ?>

</div>
