<?php

namespace common\models;

/**
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
			'attachment_id' => array( $this, 'getAttachmentName' )
		];
	}
}