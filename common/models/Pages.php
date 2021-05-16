<?php

namespace common\models;

use yii\helpers\Url;

/**
 * @property $id
 * @property $content
 * @property $title
 * @property $attachment_id
 *
 * Class Pages
 * @package common\models
 */
class Pages extends BaseModel {

	use AttributesFormats;

	/**
	 * @return string[]
	 */
	public function attributeLabels(): array {
		return [
			'title'   => 'Pages Name',
			'content' => 'Pages Content'
		];
	}

	/**
	 * @return array[]
	 */
	public function rules(): array {
		return [
			[ [ 'title', 'content' ], 'required' ],
			[ [ 'attachment_id' ], 'integer' ]
		];
	}

	protected function formatAttributesMap(): array {
		return [
			'content'       => array( $this, 'getTrimContent' ),
			'attachment_id' => array( $this, 'getAttachmentName' ),
			'created_at'    => array( $this, 'getCreatedDate' )
		];
	}

	public function attachment_url(): ?array {
		$image = Files::findOne( $this->attachment_id );

		if ( ! $image ) {
			return null;
		}

		return [ Url::to( "@web/{$image->url}" ), $image ];
	}
}