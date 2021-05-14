<?php


namespace common\models;


/**
 * @property integer $id
 * @property string $content
 * @property string title
 * @property integer $author
 * @property integer $category
 * @property string $tags
 * @property integer $attachment_id
 *
 * Class Posts
 * @package common\models
 */
class Posts extends BaseModel {

	use AttributesFormats;

	public function attributeLabels(): array {
		return [
			'title'   => 'Post Title',
			'content' => 'Post Content'
		];
	}

	public function rules(): array {
		return [
			[ [ 'title', 'content' ], 'required' ],
			[ [ 'attachment_id' ], 'integer' ]
		];
	}

	protected function formatAttributesMap(): array {
		return [
			'content'       => array( $this, 'getTrimContent' ),
			'author'        => array( $this, 'getAuthorName' ),
			'attachment_id' => array( $this, 'getAttachmentName' )
		];
	}

}