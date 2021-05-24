<?php


namespace frontend\controllers;


use common\components\ControllerTrait;
use common\models\Comments;
use yii\web\Controller;

class CommentsController extends Controller {

	use ControllerTrait;

	public function actionAjaxAdd(): array {
		if ( \Yii::$app->user->isGuest || empty( $_POST ) ) {
			return [ 'error' => 'You are not allowed to perform this action.' ];
		}
		$comment = new Comments();
		$isLoad  = $comment->load( \Yii::$app->request->post(), '' );

		if ( ! $isLoad ) {
			return [ 'error' => 'Error loading request' ];
		}
		$comment->author = \Yii::$app->user->getId();

		if ( ! $comment->validate() || ! $comment->save() ) {
			return [ 'error' => 'Error while saving a comment' ];
		}
		$comments = Comments::find()
		                    ->where( [ 'post_id' => $comment->post_id ] )
		                    ->orderBy( [ 'created_at' => SORT_DESC ] )
		                    ->asArray()
		                    ->all();

		$comment->allWithFormat( $comments );

		return [
			'success'  => 'Your comment has been saved!',
			'comments' => $comments
		];
	}

}