<?php 
namespace common\models;

use yii\db\ActiveRecord;

class Comments extends ActiveRecord
{
  public $comment_text;
  public $author;
  public $post_id;
  public $parent_id;

    public function attributeLabels()
    {
        return [
            'comment_text' => 'Comment',
            'author' => 'Author of comment',
            'post_id' => 'Post ID with this comment',
            'parent_id' => 'Parent ID'
        ];
    }

    public function rules()
    {
        return [
        [['comment_text', 'author', 'post_id', 'parent_id'], 'required']
        ];
    }
}