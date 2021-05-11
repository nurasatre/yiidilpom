<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * @property UploadedFile $url
 * @property string $title
 * @property integer $author
 * @property string $description
 */
class Files extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'title' => 'Files Name',
            'author' => 'Author of file',
            'description' => 'Description',
            'url' => 'Image'
        ];
    }

    public function rules()
    {
        return [
            [['url'], 'file', 'extensions' => 'jpg, png'],
        ];
    }

    public function upload()
    {
        $name = $this->url->baseName . '.' . $this->url->extension;
        $path = 'uploads/' . $this->url->baseName . '.' . $this->url->extension;

        $this->url->saveAs('@backend/web/' . $path, false);
        $this->url->saveAs('@frontend/web/' . $path);

        return array(
            'url' => $path,
            'title' => $name
        );
    }


}