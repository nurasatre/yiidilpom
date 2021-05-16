<?php


namespace backend\controllers;

use common\models\User;
use Yii;
use yii\web\HttpException;

class UserController extends AdminController {

	public function actionIndex() {
		$url = \Yii::$app->urlManager;

		return $this->render( 'index', array(
			'config' => array(
				'model' => Yii::$app->user->identity,
				'save' => array(
					'method' => 'POST',
					'url'    => $url->createAbsoluteUrl( [ 'user/ajax-save' ] ),
				),
			),
		) );
	}

	/**
	 * @throws HttpException
	 */
	public function actionAjaxSave() {
		$currentUser = User::findOne( Yii::$app->user->getId() );

		$isLoad = $currentUser->load( Yii::$app->request->post(), '' );
		if ( ! $isLoad ) {
			return [ "error" => "Failed loading data." ];
		}

		return $currentUser->save()
			? [
				"success" => "Saved successfully!"
			]
			: [
				"error" => "Unsuccessful save."
			];
	}
}