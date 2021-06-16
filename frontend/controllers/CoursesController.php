<?php


namespace frontend\controllers;


use common\models\Courses;
use yii\web\Controller;

class CoursesController extends Controller {

	public function actionIndex(): string {
		$model   = new Courses();
		$courses = $model::find()
		                 ->orderBy( [ 'created_at' => SORT_DESC ] )
		                 ->asArray()
		                 ->all();

		$url = \Yii::$app->urlManager;

		$model->allWithFormat( $courses, function ( $row ) use ( $url, $model ) {
			if ( empty( $row['file_id'] ) ) {
				return array();
			}

			return array(
				'__download_link' => $url->createAbsoluteUrl( [ "files/download/{$row['file_id']}" ] )
			);
		} );

		return $this->render( 'index', array(
			'courses' => $courses
		) );
	}
}