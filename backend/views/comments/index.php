<?php
/* @var $this yii\web\View */

$this->registerJsVar('currentPageConfig', $config);

$this->registerJsFile(
	'@web/js/dist/comments.bundle.js',
	['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div id="postsEditor"></div>