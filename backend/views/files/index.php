<?php
/* @var $this yii\web\View */

$this->registerJsVar('filesConfig', $config);

$this->registerJsFile(
    '@web/js/dist/files.bundle.js',
    [
        'position' => yii\web\View::POS_END,
        'depends' => [\yii\web\JqueryAsset::class]
    ]
);
?>

<div id="filesEditor"></div>
