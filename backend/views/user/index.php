<?php

/* @var $this yii\web\View */
/* @var $config array */

$this->title = "[{$config['model']->username}] Settings";

$this->registerJsVar('currentPageConfig', $config);
$this->registerJsFile(
    '@web/js/dist/user.bundle.js',
    ['position' => yii\web\View::POS_END]
);
?>

<div id="userApp"></div>