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
			'type' => 'select2_classes',
			'options' => $this->get_options(),
		);
	}

	/**
	 * Get all available options.
	 * Searches the post meta table for pre-existing classes.
	 * @return array
	 */
	public function get_options() {
		static $options;
		if ( ! $options ) {
			global $wpdb;
			$query = "SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = '%s'";
			$results = (array) $wpdb->get_results( $wpdb->prepare( $query, $this->column->get_meta_key() ), ARRAY_A );
			if ( isset( $results[0]['meta_value'] ) ) {
				$results = wp_list_pluck( $results, 'meta_value' );
			}
			$options = $this->parse_classes( $results );
		}
		return (array) $options;
	}

	/**
	 * Get editing options when using an ajax callback
	 *
	 * @inheritdoc
	 * @see  ACP_Editing_Model::get_ajax_options()
	 */
	public function get_ajax_options( $request ) {
		return $this->get_options();
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

	/**
	 * @param  array  $values
	 * @return array
	 */
	public function parse_classes( $values ) {
		$new_values = array();

		foreach ( (array) $values as $key => $val ) {
			$val = explode( $this->column->get_separator(), $val );
			$new_values = array_merge( $new_values, array_combine( $val, $val ) );
		}

		//$new_values = array_unique( $new_values );
		ksort( $new_values );
		return $new_values;
	}

}
