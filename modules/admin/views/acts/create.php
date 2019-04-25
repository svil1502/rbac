<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acts */

$this->title = 'Создать Акты';
$this->params['breadcrumbs'][] = ['label' => 'Акты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
    ]) ?>

</div>
