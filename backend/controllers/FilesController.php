<?php


namespace backend\controllers;

use common\models\Files;
use yii\db\IntegrityException;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class FilesController extends Controller {

	public $layout = 'admin-main';

	public function actionIndex(): string {
		$url        = \Yii::$app->urlManager;
		$csrf_param = \Yii::$app->request->csrfParam;
		$csrf_token = \Yii::$app->request->csrfToken;
		$images     = Files::findAllValid();

		return $this->render( 'index', array(
			'config' => array(
				'save'      => array(
					// $url->createAbsoluteUrl( [ '' ] ) --> http://yii.diplom/admin/
					// $url->createAbsoluteUrl( [ 'files/ajax-save' ] ) --> http://yii.diplom/admin/files/ajax-save
					'url'    => $url->createAbsoluteUrl( [ 'files/ajax-save' ] ),
					'method' => 'POST',
				),
				'delete'    => array(
					'url'    => $url->createAbsoluteUrl( [ 'files/ajax-delete' ] ),
					'method' => 'POST'
				),
				'update'    => array(
					'url'    => $url->createAbsoluteUrl( [ 'files/ajax-update' ] ),
					'method' => 'POST'
				),
				'csrf'      => array(
					'param' => $csrf_param,
					'token' => $csrf_token,
				),
				'images'    => $images,
				'publicUrl' => $url->createAbsoluteUrl( [ '' ] )
			),

		) );
	}

	/**
	 * @return array
	 */
	public function actionAjaxSave(): array {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$files                       = array();

		$duplicates = array();

		foreach ( $_FILES as $param => $file ) {
			$model      = new Files();
			$model->url = UploadedFile::getInstanceByName( $param );

			if ( ! $model->validate() ) {
				return [ 'error' => 'Failed validating...' ];
			}
			$file             = $model->upload();
			$model->url       = $file['url'];
			$model->title     = $file['title'];
			$model->author    = \Yii::$app->user->getId();
			$model->loaded_at = date( 'Y-m-d H:i:s' );

			$file['url'] = Url::to( "@web/{$file['url']}" );

			try {
				if ( ! $model->save() ) {
					return [ 'error' => 'Failed saving...' ];
				}
				/**
				 * $model->attributes --> array(
				 *    'id' => 12,
				 *  'title' => 'Title',
				 *  'url' => '/uploads/image.jpg',
				 * ...
				 * );
				 */
				$files[] = $model->attributes;

			} catch ( IntegrityException $exception ) {
				if ( '23000' === $exception->getCode() ) {
					$duplicates[] = $file['title'];
				}
			}
		}

		if ( count( $files ) ) {
			$message = 'Saved successfully!';
		} else {
			$message = 'Failed saving...';
		}

		if ( $duplicates ) {
			$message .= ' (Duplicates: ' . implode( ', ', $duplicates ) . ')';
		}

		return [
			'success' => $message,
			'images'  => $files
		];
	}

	public function actionAjaxDelete() {
		\Yii::$app->response->format = Response::FORMAT_JSON;

		$item = \Yii::$app->request->post();

		try {
			Files::findOne( $item['id'] )->delete();
		} catch ( StaleObjectException $e ) {
			return [
				'error' => 'Failed deleting...',
			];
		}

		return [
			'success' => 'Deleted successfully!'
		];
	}

	public function actionAjaxUpdate(): array {
		\Yii::$app->response->format = Response::FORMAT_JSON;

		$item = \Yii::$app->request->post();

		try {
			$file        = Files::findOne( $item['id'] );
			$file->title = $item['title'];
			$file->update();

		} catch ( \Throwable $e ) {
			return [
				'error' => 'Failed updating...',
			];
		}

		return [
			'success' => 'Updated successfully!'
		];
	}

}