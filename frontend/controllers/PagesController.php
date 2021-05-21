<?php


namespace frontend\controllers;


use common\models\Pages;
use yii\web\Controller;

class PagesController extends Controller {

	public function actionIndex() {
		$pages = Pages::find()->asArray()->all();
	}

	public function actionView( $id ) {
		$model = Pages::findOne( $id );

		return $this->render( 'view', [
			'model' => $model
		] );
	}
}