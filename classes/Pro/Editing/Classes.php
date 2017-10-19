<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Editing_Classes extends ACP_Editing_Model_Meta
{
	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model::get_view_settings()
	 */
	public function get_view_settings() {
		return array(
			'type' => 'select2_tags',
		);
	}

	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model_Meta::get_view_settings()
	 */
	public function save( $id, $value ) {
		if ( is_string( $value ) ) {
			$value = str_replace( ';', ',', $value );
			$value = explode( ',', $value );
		}
		$value = implode( $this->column->get_separator(), (array) $value );
		parent::save( $id, $value );
	}

}
