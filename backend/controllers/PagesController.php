<?php

namespace backend\controllers;

use common\models\Files;
use Yii;
use common\models\Pages;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Site controller
 */
class PagesController extends AdminController {

	public $layout = 'admin-main';

	public function actionIndex(): string {
		$model = new Pages();
		$posts = $model::find()->asArray()->all();

		return $this->render( 'index', [
			'posts' => $posts,
			'model' => $model
		] );
	}

	public function actionCreate(): string {
		return $this->render( 'edit', $this->getEditorData( 'save' ) );
	}

	public function actionEdit( $id ): string {
		$model = Pages::findOne( $id );

		return $this->render( 'edit', $this->getEditorData( 'edit', $model ) );
	}

	/**
	 * @return array
	 */
	public function actionAjaxSave(): array {
		$model  = new Pages();
		$isLoad = $model->load( Yii::$app->request->post(), '' );
		if ( ! $isLoad ) {
			return [ "error" => "Failed loading data." ];
		}

		return $model->save()
			? [
				"success" => "Saved successfully!"
			]
			: [
				"error" => "Unsuccessful save."
			];
	}

	public function actionAjaxEdit(): array {
		$request = Yii::$app->request->post();
		$model   = Pages::findOne( (int) $request['id'] );

		$isLoad = $model->load( $request, '' );
		if ( ! $isLoad ) {
			return [ "error" => "Failed loading data." ];
		}

		return $model->save()
			? [
				"success" => "Saved successfully!"
			]
			: [
				"error" => "Unsuccessful save."
			];
	}
}