<?php
/* @var $this yii\web\View */

//$this->registerJsVar('filesConfig', $config);

$this->registerJsFile(
    '@web/js/dist/files.bundle.js',
    ['position' => yii\web\View::POS_END]
);
?>

<div id="filesEditor"></div>
