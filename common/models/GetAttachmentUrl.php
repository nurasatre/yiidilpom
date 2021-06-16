<?php


namespace common\models;


use yii\helpers\Url;

/**
 * @property integer attachment_id
 *
 * Trait GetAttachmentUrl
 * @package common\models
 */
trait GetAttachmentUrl {

	public function attachment_url( $source = false, $file_attr_name = 'attachment_id' ): ?array {
		if ( ! $source ) {
			$source = $this;
		}
		if ( is_array( $source ) ) {
			$source = (object) $source;
		}
		$image = Files::findOne( $source->$file_attr_name );

		if ( ! $image ) {
			return [ false, false ];
		}

		return [ Url::to( "@web/{$image->url}" ), $image ];
	}
}