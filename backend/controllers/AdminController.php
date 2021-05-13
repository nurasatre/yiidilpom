<?php


namespace backend\controllers;

use common\models\Files;
use yii\base\Action;
use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

abstract class AdminController extends Controller {

	public $layout = 'admin-main';

	/**
	 * @param Action $action
	 *
	 * @return bool
	 * @throws HttpException
	 * @throws BadRequestHttpException
	 */
	public function beforeAction( $action ): bool {
		if ( false === stripos( $action->id, 'ajax' ) ) {
			return parent::beforeAction( $action );
		}

		\Yii::$app->response->format = Response::FORMAT_JSON;
		if ( ! \Yii::$app->request->isAjax ) {
			throw new HttpException( 403, \Yii::t( 'app', 'You are not allowed to perform this action.' ) );
		}

		return parent::beforeAction( $action );
	}


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
					'url'  => $url->createAbsoluteUrl( [ "{$this->action->controller->id}/ajax-{$action}" ] ),
					'type' => 'POST'
				],
			],
		];
	}

}