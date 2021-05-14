<?php


namespace backend\controllers;


use common\models\Posts;

class PostsController extends AdminController {

	public function actionIndex(): string {

		$model = new Posts();
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
		$model = Posts::findOne( $id );

		return $this->render( 'edit', $this->getEditorData( 'edit', $model ) );
	}

	public function actionDelete( $id ) {
		$model = Posts::findOne( $id );
		$url   = \Yii::$app->urlManager;

		try {
			$model->delete();
		} catch ( \Throwable $e ) {
			//
		} finally {
			$this->redirect( $url->createAbsoluteUrl( [ 'posts' ] ) );
		}
	}

	public function actionAjaxSave(): array {
		$model  = new Posts();
		$isLoad = $model->load( \Yii::$app->request->post(), '' );
		if ( ! $isLoad ) {
			return [ "error" => "Failed loading data." ];
		}
		$model->author = \Yii::$app->user->getId();

		return $model->save()
			? [
				"success" => "Saved successfully!"
			]
			: [
				"error" => "Unsuccessful save."
			];
	}

	public function actionAjaxEdit(): array {
		$request = \Yii::$app->request->post();
		$model   = Posts::findOne( (int) $request['id'] );

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