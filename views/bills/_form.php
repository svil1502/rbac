<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use app\models\TestDateControl;


/* @var $this yii\web\View */
/* @var $model app\models\Bills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bills-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php //echo $form->field($model, 'id_contract')->textInput()
    ?>

    <div class="form-group field-bills-id_contract has-success">
        <label class="control-label" for="bills-id_contract">Номер договора</label>
        <select id="bills-id_contract" class="form-control" name="Bills[id_contract]" aria-required="true" onChange="Selected(this)">
            <?= \app\components\MenuWidgetContract::widget(['tpl' => 'select_contract', 'model' => $model])?>
        </select>
    </div>



    <?php
    //echo $form->field($model, 'id_act')->textInput()
    // ?>

    <div class="form-group field-bills-id_act has-success">
        <label class="control-label" for="bills-id_act">Номер акта</label>
        <select id="bills-id_act" class="form-control" name="Bills[id_act]">

            <?= \app\components\MenuWidgetAct::widget(['tpl' => 'select_act', 'model' => $model])?>
        </select>
    </div>





    <?= $form->field($model, 'number')->textInput() ?>

    <?=$form->field($model, 'date')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
    'ajaxConversion'=>false,
    'widgetOptions' => [
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]
]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile(Yii::getAlias('@web/main2.js'));

?>