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
	use GetAttachmentUrl;

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
			'title'         => array( $this, 'getAttachedLink' ),
			'content'       => array( $this, 'getTrimContent' ),
			'author'        => array( $this, 'getAuthorName' ),
			'attachment_id' => array( $this, 'getAttachmentName' ),
			'created_at'    => array( $this, 'getCreatedDate' )
		];
	}

	protected function visibleAttributes(): array {
		return [
			'id',
			'title',
			'content',
			'author',
			'attachment_id',
			'created_at'
		];
	}

}