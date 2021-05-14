<?php


namespace backend\controllers;


use common\models\Comments;

class CommentsController extends AdminController {

	public function actionIndex(): string {
		$model = new Comments();
		$posts = $model::find()->asArray()->all();

		return $this->render( 'index', [
			'config' => [
				'posts'   => $posts,
				'model'   => $model,
				'request' => [
					'type' => 'POST',
					'url'  => $this->getRequestUrl( 'edit' )
				],
			]
		] );
	}


	public function actionDelete( $id ) {
		$model = Comments::findOne( $id );
		$url   = \Yii::$app->urlManager;

		try {
			$model->delete();
		} catch ( \Throwable $e ) {
			//
		} finally {
			$this->redirect( $url->createAbsoluteUrl( [ 'comments' ] ) );
		}
	}

	public function actionAjaxEdit(): array {
		$request = \Yii::$app->request->post();
		$model   = Comments::findOne( (int) $request['id'] );

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