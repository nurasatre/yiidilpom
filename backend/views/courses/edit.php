<?php
/* @var $this yii\web\View */

$this->registerJsVar('currentPageConfig', $config);

$this->registerJsFile(
    '@web/js/dist/courses.bundle.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div id="coursesEditor"></div>
