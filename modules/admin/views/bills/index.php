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

    <p>
        <?= Html::a('Создать счет', ['create'], ['class' => 'btn btn-success']) ?>
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

            [
                'attribute' => 'actsName',
                'value' => function($data_acts){
                    return $data_acts->acts->number;
                },
            ],
            'number',
            'date:date',
            //[
              //  'attribute' => 'date',

                //'value' => function($dataProvider){
        //return Yii::$app->formatter->asDate($dataProvider->date, 'php:d.m.Y H:i');
//return Yii::$app->formatter->asDatetime($dataProvider->date, 'php:d.m.Y H:i');
//return date('Y-m-d H:i:s', $dataProvider->date/1000);
                  //  return Yii::$app->formatter->asDate($dataProvider->date);
  //return  gmdate("Y-m-d\TH:i:s\Z",  $dataProvider->date);
                //},
            //],



            ['class' => 'yii\grid\ActionColumn'],
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
