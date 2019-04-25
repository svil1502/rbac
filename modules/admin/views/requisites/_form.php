<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Requisites */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisites-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_company')->widget(Select2::classname(), [
        'data' => $data,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбор компании ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>


    <?= $form->field($model, 'req')->textarea(['rows' => 6]) ?>




    <?= $form->field($model, 'requisites_default')->checkbox([ '0', '1', ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
