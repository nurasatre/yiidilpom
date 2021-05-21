<?php


namespace common\models;


use yii\db\ActiveRecord;

abstract class BaseModel extends ActiveRecord {

	private $_dynamicAttrsMap = array();

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
		if ( ! empty( $this->_dynamicAttrsMap ) ) {
			$map = $this->_dynamicAttrsMap;
		} else {
			$map = $this->formatAttributesMap();
		}


		if ( ! $source ) {
			$source = $this->attributes;
		}
		if ( ! $map ) {
			return $source[ $name ];
		}

		return ( isset( $map[ $name ] ) && is_callable( $map[ $name ] ) )
			? call_user_func( $map[ $name ], $source[ $name ], $source )
			: $source[ $name ];
	}

	public function allWithFormat( &$rows, callable $callableModify = null ): BaseModel {
		foreach ( $rows as $index => $row ) {
			if ( $callableModify ) {
				$props = call_user_func( $callableModify, $row );

				foreach ( $props as $prop => $value ) {
					$rows[ $index ][ $prop ] = $value;
				}
			}
			foreach ( $row as $attribute => $value ) {
				$rows[ $index ][ $attribute ] = $this->formatAttribute( $attribute, $row );
			}
		}

		return $this;
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

	public function attrsMap( $map ): BaseModel {
		$this->_dynamicAttrsMap = array_merge( $this->formatAttributesMap(), $map );

		return $this;
	}

	public function clearAttrsMap(): BaseModel {
		$this->_dynamicAttrsMap = array();

		return $this;
	}
}