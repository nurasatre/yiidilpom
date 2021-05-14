<?php


namespace common\models;


use yii\db\ActiveRecord;

abstract class BaseModel extends ActiveRecord {

	protected function formatAttributesMap(): array {
		return [];
	}

	/**
	 * @param $name
	 * @param $source
	 *
	 * @return mixed
	 */
	public function formatAttribute( $name, $source ) {
		$map = $this->formatAttributesMap();

		if ( ! $map ) {
			return $source[ $name ];
		}

		return ( isset( $map[ $name ] ) && is_callable( $map[ $name ] ) )
			? call_user_func( $map[ $name ], $source[ $name ], $source )
			: $source[ $name ];
	}
}