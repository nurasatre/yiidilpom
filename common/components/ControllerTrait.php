<?php


namespace common\components;


use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;

/**
 * @property Action action
 *
 * Trait ControllerTrait
 * @package common\components
 */
trait ControllerTrait {

	public function getRequestUrl( $action ): string {
		$url = \Yii::$app->urlManager;

		return $url->createAbsoluteUrl( [ "{$this->action->controller->id}/ajax-{$action}" ] );
	}

	public function getAbsoluteUrl( $action = '' ): string {
		$url = \Yii::$app->urlManager;

		return $url->createAbsoluteUrl( [ "{$this->action->controller->id}/{$action}" ] );
	}

	/**
	 * @param $action
	 *
	 * @return bool
	 * @throws HttpException
	 */
	public function beforeAction( $action ): bool {
		if ( false === stripos( $action->id, 'ajax' ) ) {
			return parent::beforeAction( $action );
		}

		if ( ! \Yii::$app->request->isAjax ) {
			throw new HttpException( 403, \Yii::t( 'app', 'You are not allowed to perform this action.' ) );
		}
		\Yii::$app->response->format = Response::FORMAT_JSON;

		return parent::beforeAction( $action );
	}

}