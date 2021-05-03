<?php
/* @var $this yii\web\View */

$this->registerJsVar('pageAppConfig', $config);
$this->registerJsVar('pageRequest', isset( $request ) ? $request : array() );

$this->registerJsFile(
    '@web/js/dist/pages.bundle.js',
    //['position' => \yii\web\View::POS_END]
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div id="pagesEditor"></div>
