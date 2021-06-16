<?php


namespace common\models;


trait GetFilePath {

	public function getFilePath( $id ): array {
		$image = Files::findOne( $id );

		if ( ! $image ) {
			return [ false, false ];
		}

		return [ \Yii::getAlias( "@frontend/web/{$image->url}" ), $image ];
	}

}