<?php

namespace common\models;

use yii\db\ActiveRecord;

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
class Comments extends ActiveRecord {

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
			[ [ 'comment_text', 'author', 'post_id', 'parent_id' ], 'required' ]
		];
	}
}