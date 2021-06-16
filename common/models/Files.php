<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * @property UploadedFile|string $url
 * @property string $title
 * @property integer $author
 * @property string $description
 * @property string loaded_at
 * @property string mime_type
 */
class Files extends BaseModel {

	use AttributesFormats;

	public function attributeLabels(): array {
		return [
			'title'       => 'Files Name',
			'author'      => 'Author of file',
			'description' => 'Description',
			'url'         => 'Image'
		];
	}

	private function getMimeTypes(): array {
		return array(
			'image/jpeg',
			'image/gif',
			'image/png',
			'application/pdf',
			'application/msword',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		);
	}

	public function rules(): array {
		return [
			[ [ 'url' ], 'file', 'mimeTypes' => implode( ', ', $this->getMimeTypes() ) ],
		];
	}

	public function upload(): array {
		$name = $this->url->baseName . '.' . $this->url->extension;
		$path = 'uploads/' . $this->url->baseName . '.' . $this->url->extension;

		$this->url->saveAs( '@backend/web/' . $path, false );
		$this->url->saveAs( '@frontend/web/' . $path );

		return array(
			'url'   => $path,
			'title' => $name
		);
	}

	public static function findAllValid(): array {

		return self::find()
		           ->where( [ 'not', [ 'url' => null ] ] )
		           ->orderBy( [ 'loaded_at' => SORT_DESC ] )
		           ->asArray()
		           ->all();
	}

	protected function formatAttributesMap(): array {
		return [
			'loaded_at' => array( $this, 'getCreatedDate' )
		];
	}


}