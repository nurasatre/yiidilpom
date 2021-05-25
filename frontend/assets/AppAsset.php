<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	'https://fonts.googleapis.com/css?family=Muli:300,400,700,900',
	    'css/bootstrap.min.css',
	    'css/theme-style.css',
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public $cssOptions = [
	    'position' => \yii\web\View::POS_END
    ];
}
