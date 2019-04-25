<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bills-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm}',
                'visibleButtons' => [
                    'confirm' => true,
                ],
                'buttons' => [
                    'confirm' => function ($data, $dataProvider) {

                        return Html::a('Скачать', ['/bills/download', 'id'=>$dataProvider->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]);


    ?>
</div>
