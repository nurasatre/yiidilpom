<?php


namespace frontend\controllers;


use common\models\Comments;
use yii\web\Controller;

class CommentsController extends Controller {

	public function actionAddNew() {
		if ( \Yii::$app->user->isGuest || empty( $_POST ) ) {
			\Yii::$app->session->setFlash( 'error', 'You cannot perform this action.' );
			$this->redirect( '/posts' );
		}
		$comment = new Comments();
		$isLoad  = $comment->load( \Yii::$app->request->post(), 'comment' );

		if ( ! $isLoad ) {
			\Yii::$app->session->setFlash( 'error', 'Error loading request' );
			$this->redirect( '/posts' );

			return;
		}

		if ( ! $comment->validate() || ! $comment->save() ) {
			\Yii::$app->session->setFlash( 'error', 'Error while saving a comment' );
			$this->redirect( '/posts' );

			return;
		}

		\Yii::$app->session->setFlash( 'success', 'Your comment has been saved!' );
		$this->redirect( "/posts/view/{$comment->post_id}" );
	}

}