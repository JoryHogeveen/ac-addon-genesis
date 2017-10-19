<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class ACA_Genesis_Column_Layout extends ACA_Genesis_Column
{
	/**
	 * @inheritdoc
	 * @see  ACA_Genesis_Column::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->set_type( 'genesis-layout' );
		$this->set_label( __( 'Select Layout', 'genesis' ) );
	}

	/**
	 * @inheritdoc
	 * @see  AC_Column::get_value()
	 */
	public function get_value( $id ) {
		$value = $this->get_raw_value( $id );

		if ( ! $value ) {
			return false;
		}

		// Layouts based on type. Probably only do this for editing!
		$layouts = $this->get_genesis_layouts( $id );

		if ( isset( $layouts[ $value ] ) ) {
			$label = $layouts[ $value ]['label'];
			$img = $layouts[ $value ]['img'];
			$value = '<img src="' . $img . '" alt="' . $label . '" />';
		}

		return $value;
	}

	/**
	 * @param  int  $id  Object ID. Default is for a post type.
	 * @return array
	 */
	abstract public function get_genesis_layouts( $id = null );

}
