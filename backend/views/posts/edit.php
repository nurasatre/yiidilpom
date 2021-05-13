<?php
/* @var $this yii\web\View */

$this->registerJsVar('currentPageConfig', $config);

$this->registerJsFile(
    '@web/js/dist/posts.bundle.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div id="postsEditor"></div>
