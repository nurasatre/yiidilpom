<?php
namespace common\models;

use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public $title;
    public $content;
    public $author;
    public $category;
    public $tags;

    public function attributeLabels()
    {
        return [
            'title' => 'Post Name',
            'content' => 'Post Content',
            'author' => 'Author of post',
            'category' => 'Category',
            'tags' => 'Tags'
        ];
    }

    public function rules() {
        return [
            [['title', 'content', 'author'], 'required']
        ];
    }
}