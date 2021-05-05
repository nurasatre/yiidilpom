<?php


namespace backend\controllers;

use yii\web\Controller;

class FilesController extends Controller
{
    public $layout = 'admin-main';

    public function actionIndex() {
        return $this->render( 'index' );
    }

}