<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class ACA_Genesis_Column_Classes extends ACA_Genesis_Column
{
	/**
	 * @inheritdoc
	 * @see  AC_Column::get_value()
	 */
	public function get_value( $id ) {
		$value = $this->get_raw_value( $id );

		if ( ! $value ) {
			$value = array();
		}

		return implode( $this->get_separator(), (array) $value );
	}

	/**
	 * @see   AC_Column_Meta::get_raw_value()
	 * @inheritdoc
	 */
	public function get_raw_value( $id ) {
		$value = $this->get_meta_value( $id, $this->get_meta_key(), true );

		if ( ! $value ) {
			return array();
		}

		return $value;
	}

	/**
	 * @see   AC_Column_Meta::get_meta_value()
	 * @inheritdoc
	 */
	public function get_meta_value( $id, $meta_key, $single = true ) {
		$values = parent::get_meta_value( $id, $meta_key, $single );
		if ( $single ) {
			$values = explode( $this->get_separator(), $values );
		} elseif ( ! $single ) {
			foreach ( $values as $key => $val ) {
				$val = explode( $this->get_separator(), $val );
				$values[ $key ] = array_combine( $val, $val );
			}
		}
		$values = array_combine( $values, $values );
		return $values;
	}

	/**
	 * @return string
	 */
	public function get_separator() {
		return ' ';
	}

}
