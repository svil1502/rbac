<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Договоры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'companiesName',
                'value' => function($data_c){
                    return $data_c->companies->name;
                },
            ],

            [
                'attribute' => 'requisitesName',
                'value' => function($data_r){
                    return $data_r->requisites->req;
                },
            ],
            'number',
            'date:date',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm}',
                'visibleButtons' => [
                    'confirm' => true,
                ],
                'buttons' => [
                    'confirm' => function ($data, $dataProvider) {

                        return Html::a('Скачать', ['/contracts/download', 'id'=>$dataProvider->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
