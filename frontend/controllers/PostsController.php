<?php


namespace frontend\controllers;


use common\helpers\PostsView;
use common\models\Files;
use common\models\Posts;
use yii\web\Controller;

class PostsController extends Controller {

	public function actionIndex() {
		$model = new Posts();
		$posts = $model::find()->asArray()->all();
		$url   = \Yii::$app->urlManager;

		$model->attrsMap(
			array( 'content' => false )
		)->allWithFormat( $posts, function ( $row ) use ( $url, $model ) {

			/** @var Files $image */
			[ $urlImage, $image ] = $model->attachment_url( $row );

			$imageTitle = false;
			if ( $image ) {
				$imageTitle = $image->formatAttribute( 'title' );
			}

			return array(
				'__image_url'   => $urlImage,
				'__image_title' => $imageTitle,
				'__view_url'    => $url->createAbsoluteUrl( [ "posts/view/{$row['id']}" ] )
			);
		} )->clearAttrsMap();

		$mainPost        = $posts[0];
		$firstRightPosts = array_slice( $posts, 1, 3 );
		$otherPosts      = array_slice( $posts, 4 );
		$leftCount       = (int) ( count( $otherPosts ) / 2 );
		$otherLeft       = array_slice( $otherPosts, 0, $leftCount + 1 );
		$otherRight      = array_slice( $otherPosts, $leftCount + 1 );

		$result = [
			'model'           => $model,
			'mainPost'        => $mainPost,
			'firstRightPosts' => $firstRightPosts,
			'otherLeft'       => $otherLeft,
			'otherRight'      => $otherRight
		];

		$this->setView( new PostsView() );

		return $this->render( 'index', $result );
	}

	public function actionView( $id ) {
		$model = Posts::findOne( $id );

		return $this->render( 'view', [
			'model' => $model
		] );
	}
}