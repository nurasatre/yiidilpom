<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models\Pages;

/**
 * Site controller
 */
class PagesController extends Controller {

    public $layout = 'admin-main';

    public function actionIndex() {
        $model = new Pages();
        $posts = $model::find()->asArray()->all();

        return $this->render('index', [
            'posts' => $posts,
            'model' => $model
        ]);
    }
}