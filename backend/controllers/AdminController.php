<?php


namespace backend\controllers;

use common\components\ControllerTrait;
use common\models\Files;
use yii\db\ActiveRecord;
use yii\web\Controller;

abstract class AdminController extends Controller {

	use ControllerTrait;

	public $layout = 'admin-main';

	public function getEditorData( $action, ActiveRecord $model = null ): array {
		$url    = \Yii::$app->urlManager;
		$images = Files::find()
		               ->where( [ 'not', [ 'url' => null ] ] )
		               ->asArray()
		               ->all();

		$data = [
			'images'    => $images,
			'publicUrl' => $url->createAbsoluteUrl( [ '' ] )
		];

		if ( $model ) {
			$data['model'] = $model->attributes;
		}

		return [
			'config' => [
				'data'    => $data,
				'request' => [
					'url' => $this->getRequestUrl( $action ),
					'type' => 'POST'
				],
			],
		];
	}

}