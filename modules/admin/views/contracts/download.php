<?php
use PhpOffice\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;


    $templateWord = new PhpOffice\PhpWord\TemplateProcessor('contractTemplate.docx');
    $templateWord->setValue('v1', $model->number);
    $templateWord->setValue('v2', Yii::$app->formatter->asDate($model->date));
    $templateWord->setValue('v3', $model->requisites->req);
    $download_file = 'Договор'.$model->number.'.docx';
    $templateWord->saveAs($download_file);
    header("Content-Disposition: attachment; filename= $download_file; charset=UTF-8");
    echo file_get_contents($download_file);

?>

