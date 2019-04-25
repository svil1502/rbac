<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Акты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать акт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'contractsName',
                'value' => function($data){
                    return $data->contracts->number;
                },
            ],
            'number',
            'date:date',

            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm}',
                'visibleButtons' => [
                    'confirm' => true,
                ],
                'buttons' => [
                    'confirm' => function ($data, $dataProvider) {

                        return Html::a('Скачать', ['/acts/download', 'id'=>$dataProvider->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

