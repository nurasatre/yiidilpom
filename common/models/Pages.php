<?php 
namespace common\models;

use yii\db\ActiveRecord;

class Pages extends ActiveRecord
{
    /*
    public $title;
    public $content;
    */

    public function attributeLabels()
    {
        return [
            'title' => 'Pages Name',
            'content' => 'Pages Content'
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
        ];
    }
}