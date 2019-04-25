<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requisites */

$this->title = 'Создать Реквизиты';
$this->params['breadcrumbs'][] = ['label' => 'Requisites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisites-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
    ]) ?>

</div>
