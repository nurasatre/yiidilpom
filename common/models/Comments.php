<?php

namespace common\models;

/**
 * @property integer $id
 * @property string $comment_text
 * @property integer $author
 * @property integer $post_id
 * @property integer $parent_id
 *
 * Class Comments
 * @package common\models
 */
class Comments extends BaseModel {

	use AttributesFormats;

	public function attributeLabels() {
		return [
			'comment_text' => 'Comment',
			'author'       => 'Author of comment',
			'post_id'      => 'Post ID with this comment',
			'parent_id'    => 'Parent ID'
		];
	}

	public function rules() {
		return [
			[ [ 'comment_text', 'author', 'post_id' ], 'required' ]
		];
	}

	protected function formatAttributesMap(): array {
		return [
			'author'     => array( $this, 'getAuthorName' ),
			'created_at' => array( $this, 'getCreatedDate' )
		];
	}

	public function withExcerpt( array $row ): array {
		return [ '_excerpt', ( mb_substr( $row['comment_text'], 0, 70 ) . '...' ) ];
	}
}