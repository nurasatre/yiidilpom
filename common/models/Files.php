<?php 
namespace common\models;

use yii\db\ActiveRecord;

class Files extends ActiveRecord
{
  public $title;
  public $author;
  public $description;

    public function attributeLabels()
    {
        return [
            'title' => 'Files Name',
            'author' => 'Author of file',
            'description' => 'Description'
        ];
    }

    public function rules()
    {
        return [
          [['title', 'author', 'description'], 'required']
        ];
    }
}