<?php


namespace frontend\controllers;


use common\helpers\PostsView;
use common\models\Comments;
use common\models\Files;
use common\models\Posts;
use yii\web\Controller;

class PostsController extends Controller {

	public function actionIndex() {
		$model = new Posts();
		$posts = $model::find()
		               ->orderBy( [ 'created_at' => SORT_DESC ] )
		               ->asArray()
		               ->all();

		$url = \Yii::$app->urlManager;

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

		$leftCount       = (int) ( count( $posts ) / 2 );
		$otherLeft       = array_slice( $posts, 0, $leftCount + 1 );
		$otherRight      = array_slice( $posts, $leftCount + 1 );

		$result = [
			'model'           => $model,
			'otherLeft'       => $otherLeft,
			'otherRight'      => $otherRight
		];

		$this->setView( new PostsView() );

		return $this->render( 'index', $result );
	}

	public function actionView( $id ) {
		$model   = Posts::findOne( $id );
		$url     = \Yii::$app->urlManager;
		$comment = new Comments();

		$comments = $comment::find()
		                    ->where( [ 'post_id' => $id ] )
		                    ->orderBy( [ 'created_at' => SORT_DESC ] )
		                    ->asArray()
		                    ->all();

		$comment->allWithFormat( $comments );


		return $this->render( 'view', [
			'model'    => $model,
			'comments' => [
				'activeUser' => \Yii::$app->user->getId(),
				'post'       => $model->attributes,
				'items'      => $comments,
				'ajaxAdd'    => [
					'url'    => $url->createAbsoluteUrl( [ 'comments/ajax-add' ] ),
					'method' => 'POST',
				],
				'csrf'       => [
					'name'  => \Yii::$app->request->csrfParam,
					'value' => \Yii::$app->request->getCsrfToken()
				],
			]
		] );
	}
}