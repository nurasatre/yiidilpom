<?php


namespace frontend\controllers;


use common\models\GetFilePath;
use yii\web\Controller;

class FilesController extends Controller {

	use GetFilePath;

	public function actionDownload( $id ) {
		if ( \Yii::$app->user->isGuest ) {
			throw new \yii\web\HttpException( '403' );
		}
		[ $path, $file ] = $this->getFilePath( $id );

		if ( file_exists( $path ) ) {
			return \Yii::$app->response->sendFile( $path );
		}

		throw new \yii\web\NotFoundHttpException( "File: [{$file->title}] is not found!" );
	}

}