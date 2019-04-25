<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequisitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Реквизиты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisites-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Реквизиты', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',

            [
                'attribute' => 'companiesName',
                'value' => function($data){
                    return $data->companies->name;
                },
            ],


            'req:ntext',


            [
                'attribute' => 'requisites_default',
                'value' => function($data) {
                    return !$data->requisites_default ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],




            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
