<?php
/**
 * @var $this View
 * @var $model Pages
 */

use common\models\Pages;
use yii\web\View;

$this->title = $model->title;

echo $model->content;

