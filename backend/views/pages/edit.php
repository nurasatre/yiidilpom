<?php
/* @var $this yii\web\View */

$this->registerJsVar('currentPageConfig', $config);

$this->registerJsFile(
    '@web/js/dist/pages.bundle.js',
    //['position' => \yii\web\View::POS_END]
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div id="pagesEditor"></div>
