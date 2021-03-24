<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Posts;

/**
 * Site controller
 */
class PostController extends Controller {

    public $layout = 'admin-main';

    public function actionIndex() {
        $model = new Posts();
        $posts = $model::find()->asArray()->all();

        return $this->render('index', [
            'posts' => $posts,
            'model' => $model
        ]);
    }
}