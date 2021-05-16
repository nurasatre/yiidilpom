<?php


namespace common\models;


use yii\db\ActiveRecord;

abstract class BaseModel extends ActiveRecord {

	protected function formatAttributesMap(): array {
		return [];
	}

	/**
	 * @param $name string Name of attribute
	 * @param $source array Current source row
	 *
	 * @return mixed
	 */
	public function formatAttribute( string $name, array $source = array() ) {
		$map = $this->formatAttributesMap();

		if ( ! $source ) {
			$source = $this->attributes;
		}
		if ( ! $map ) {
			return $source[ $name ];
		}


		/**
		 * call_user_func( 'printf' );
		 *
		 */

		return ( isset( $map[ $name ] ) && is_callable( $map[ $name ] ) )
			? call_user_func( $map[ $name ], $source[ $name ], $source )
			: $source[ $name ];
	}

	public function allWithFormat( &$rows, callable $callableModify = null ): void {
		foreach ( $rows as $index => $row ) {
			if ( $callableModify ) {
				[ $prop, $value ] = call_user_func( $callableModify, $row );
				$rows[ $index ][ $prop ] = $value;
			}
			foreach ( $row as $attribute => $value ) {
				$rows[ $index ][ $attribute ] = $this->formatAttribute( $attribute, $row );
			}
		}
	}

	public function withFormat( callable $callableModify = null ): array {
		$currentValues = $this->attributes;
		if ( $callableModify ) {
			[ $prop, $value ] = call_user_func( $callableModify, $currentValues );
			$currentValues[ $prop ] = $value;
		}
		foreach ( $currentValues as $attribute => $value ) {
			$currentValues[ $attribute ] = $this->formatAttribute( $attribute, $currentValues );
		}

		return $currentValues;
	}
}