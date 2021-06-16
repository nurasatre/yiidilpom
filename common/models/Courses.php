<?php


namespace common\models;


/**
 * @property integer id
 * @property string desc
 * @property string title
 * @property integer file_id
 *
 * Class Posts
 * @package common\models
 */
class Courses extends BaseModel {

	use AttributesFormats;
	use GetAttachmentUrl;

	public function attributeLabels(): array {
		return [
			'title'   => 'Course Title',
			'desc'    => 'Course Description',
			'file_id' => 'File Name'
		];
	}

	public function rules(): array {
		return [
			[ [ 'title', 'desc' ], 'required' ],
			[ [ 'file_id' ], 'integer' ]
		];
	}

	protected function formatAttributesMap(): array {
		return [
			'content'    => array( $this, 'getTrimContent' ),
			'file_id'    => array( $this, 'getAttachmentName' ),
			'created_at' => array( $this, 'getCreatedDate' )
		];
	}

	protected function visibleAttributes(): array {
		return [
			'title',
			'desc',
			'file_id',
			'created_at'
		];
	}

}