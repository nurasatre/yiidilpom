<?php


namespace backend\controllers;


use common\models\Courses;

class CoursesController extends AdminController {

	public function actionIndex(): string {
		$model = new Courses();
		$posts = $model::find()->asArray()->all();

		$model->allWithFormat( $posts, function ( $attrs ) {
			return [
				'__view_url' => \Yii::$app->urlFrontEnd->createAbsoluteUrl( [ "/courses/view/{$attrs['id']}" ] )
			];
		} );

		return $this->render( 'index', [
			'posts' => $posts,
			'model' => $model
		] );
	}

	public function actionCreate(): string {
		return $this->render( 'edit', $this->getEditorData( 'save' ) );
	}

	public function actionEdit( $id ): string {
		$model = Courses::findOne( $id );

		return $this->render( 'edit', $this->getEditorData( 'edit', $model ) );
	}

	public function actionAjaxSave(): array {
		$model  = new Courses();
		$isLoad = $model->load( \Yii::$app->request->post(), '' );

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
		$request = \Yii::$app->request->post();
		$model   = Courses::findOne( (int) $request['id'] );
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