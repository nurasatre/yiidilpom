<?php


namespace backend\controllers;


use common\models\Comments;

class CommentsController extends AdminController {

	public function actionIndex(): string {
		$model = new Comments();
		$posts = $model::find()->asArray()->all();

		$model->allWithFormat( $posts, [ $model, 'withExcerpt' ] );

		return $this->render( 'index', [
			'config' => [
				'posts'     => $posts,
				'model'     => $model,
				'edit'      => [
					'type' => 'POST',
					'url'  => $this->getRequestUrl( 'edit' )
				],
				'delete'    => [
					'type' => 'POST',
					'url'  => $this->getRequestUrl( 'delete' )
				],
				'publicUrl' => $this->getAbsoluteUrl()
			]
		] );
	}


	public function actionAjaxDelete() {
		$request = \Yii::$app->request->post();
		$model   = Comments::findOne( (int) $request['id'] );

		try {
			return $model->delete()
				? [ "success" => "Deleted successfully!" ]
				: [ "error" => "Unsuccessful delete." ];

		} catch ( \Throwable $e ) {
			return [ "error" => "Error catching." ];
		}
	}

	public function actionAjaxEdit(): array {
		$request = \Yii::$app->request->post();
		$model   = Comments::findOne( (int) $request['id'] );

		$isLoad = $model->load( $request, '' );
		if ( ! $isLoad ) {
			return [ "error" => "Failed loading data." ];
		}

		if ( $model->save() ) {
			$attributes = $model->withFormat( [ $model, 'withExcerpt' ] );

			return [
				"success" => "Saved successfully!",
				"model"   => $attributes
			];
		}

		return [
			"error" => "Unsuccessful save."
		];
	}

}