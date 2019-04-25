<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bills */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bills-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Уверены удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

     echo DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'contractsName',
                'value' => function($data){
                    return $data->contracts->number;
                },
            ],

            [
                'attribute' => 'actsName',
                'value' => function($data_acts){
                    return $data_acts->acts->number;
                },
            ],
            'number',
            'date:date',


        ],
    ])





    ?>

</div>
