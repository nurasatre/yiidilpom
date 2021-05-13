<?php


namespace common\models;


use yii\db\ActiveRecord;

class Posts extends ActiveRecord {

	public function attributeLabels(): array
	{
		return [
			'title' => 'Post Title',
			'content' => 'Post Content'
		];
	}

	public function rules(): array
	{
		return [
			[['title', 'content'], 'required'],
			[['attachment_id'], 'integer']
		];
	}

}