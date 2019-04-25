<?php
use PhpOffice\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

//$zipname = 'file4.zip';
//$zip = new ZipArchive;
//$zip->open($zipname, ZipArchive::CREATE);
//debug($model);
//foreach ($model as $qi) {
    $templateWord = new PhpOffice\PhpWord\TemplateProcessor('actTemplate.docx');
    $templateWord->setValue('v1', $model->number);
   $templateWord->setValue('v2', Yii::$app->formatter->asDate($model->date));
   $templateWord->setValue('v3', $model->contracts->companies->name);
   $templateWord->setValue('v4', $model->contracts->number);
   $templateWord->setValue('v5', Yii::$app->formatter->asDate($model->contracts->date));

    $download_file = 'Акт'.$model->number.'.docx';
//echo  $download_file;
   // $zip->addFile($download_file);
//echo "<br/>";
  $templateWord->saveAs($download_file);


//}
//$zip->close();

header("Content-Disposition: attachment; filename= $download_file; charset=UTF-8");
echo file_get_contents($download_file);

?>

