<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $useAppConfig array */

$this->title = "[$user->username] Settings";

$this->registerJsVar('userConfig', $user);
$this->registerJsVar('userAppConfig', $useAppConfig);
$this->registerJsFile(
    '@web/js/dist/user.bundle.js',
    ['position' => yii\web\View::POS_END]
);
?>

<div id="userApp"></div>