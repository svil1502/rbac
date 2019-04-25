<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Locations;


use oleyur\autocompleteAjax\AutocompleteAjax;

// Normal select with ActiveForm & model




/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    //    echo $form->field($model, 'id_company')->widget(Select2::classname(), [
    //        'data' => $data_c,
    //        'language' => 'ru',
    //        'options' => ['placeholder' => 'Выбор компании ...'],
    //        'pluginOptions' => [
    //            'allowClear' => true
    //        ],
    //    ]);

    ?>

    <?php
    echo $form->field($model, 'id_company')->widget(Select2::classname(), [
        'data' => $data_c,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбор компании','id'=>'zipCode', 'data-url'=>Url::to(['requisites/prov'])],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>


    <?= $form->field($model, 'id_requisites')->widget(Select2::classname(), [
        //  'data' => $data_r,
        'data' => ArrayHelper::map(\app\models\Requisites::find()->all(), 'id','req'),
        'language' => 'ru',
        'disabled' => true,
        'options' => ['placeholder' => 'Выбор компании ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'id_requisites')->textInput(['id' => 'my_id'])->label(false); ?>
    <?php
    //echo $form->field($model, 'id_requisites')->hiddenInput()->label(false);
    ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$script= <<< JS

$('#zipCode').change(function(){
    var id = $(this).val();
  $.ajax({
url: $(this).data("url"),
dataType: 'json',
method: 'GET',
data: {id: id},
success: function (data, textStatus, jqXHR) {
    document.getElementById("select2-contracts-id_requisites-container").innerText=data.req;
$('#my_id').val(data.id);

},
beforeSend: function (xhr) {

},
error: function (jqXHR, textStatus, errorThrown) {

}
});
});
JS;
$this->registerJs($script);

?>
