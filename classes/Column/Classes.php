<?php
namespace ACA\Genesis\Column;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Classes extends Column
{
	/**
	 * @inheritdoc
	 * @see  AC_Column::get_value()
	 */
	public function get_value( $id ) {
		$value = $this->get_raw_value( $id );

		if ( ! $value ) {
			return false;
		}

		foreach ( $value as $key => $val ) {
			$value[ $key ] = '<code>' . $val . '</code>';
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
			return false;
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
			$values = array_filter( $values );
			$values = array_combine( $values, $values );

		} else {

			foreach ( $values as $key => $val ) {
				$val = explode( $this->get_separator(), $val );
				$val = array_filter( $val );
				$values[ $key ] = array_combine( $val, $val );
			}
		}

		return $values;
	}

	/**
	 * @return string
	 */
	public function get_separator() {
		return ' ';
	}

	/**
	 * @param  array  $values
	 * @return array
	 */
	public function parse_classes( $values ) {
		$new_values = array();

		foreach ( (array) $values as $key => $val ) {
			$val = explode( $this->get_separator(), $val );
			$new_values = array_merge( $new_values, array_combine( $val, $val ) );
		}

		//$new_values = array_unique( $new_values );
		ksort( $new_values );
		return $new_values;
	}

}
