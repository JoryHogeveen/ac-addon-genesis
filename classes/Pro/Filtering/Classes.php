<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Filtering_Classes extends ACP_Filtering_Model_Meta
{
	/**
	 * @inheritdoc
	 * @see  ACP_Filtering_Model_Meta::get_filtering_data()
	 */
	public function get_filtering_data() {
		$data = parent::get_filtering_data();

		if ( ! empty( $data['options'] ) ) {
			$data['options'] = $this->parse_classes( $data['options'] );
		}

		return $data;
	}

	/**
	 * @param array $vars
	 *
	 * @return array
	 */
	public function get_filtering_vars( $vars ) {

		if ( $this->is_ranged() ) {
			return $this->get_filtering_vars_ranged( $vars, $this->get_filter_value() );
		}

		$key = $this->column->get_meta_key();
		$value = $this->get_filter_value();
		$type = $this->get_data_type();

		if ( $this->column->is_serialized() ) {
			$value = serialize( $value );
		}

		$meta_query = array(
			'relation' => 'OR',
			// 100% equal.
			array(
				'key'     => $key,
				'value'   => $value,
				'type'    => $type,
				'compare' => '==',
			),

			/**
			 * Check for distinct classes.
			 *
			 * @link: https://stackoverflow.com/questions/38739216/special-chars-in-sql-regex-match-word-boundary-with-special-chars
			 * @example:
			 * `test-class`
			 *
			 * True:  `test-class foo`, `foo test-class`, `foo-test-class test-class`, `test-class foo-test-class`
			 * False: `test-class-foo`, `foo-test-class`
			 */
			array(
				'key'     => $key,
				'value'   => '(^| )' . $value . '( |$)',
				'type'    => $type,
				'compare' => 'RLIKE',
			),
		);

		$vars['meta_query'][] = $meta_query;

		return $this->get_filtering_vars_empty_nonempty( $vars );
	}

	/**
	 * @param  array  $values
	 * @return array
	 */
	public function parse_classes( $values ) {
		$new_values = array();

		foreach ( $values as $key => $val ) {
			$val = explode( ' ', $val );
			$new_values = array_merge( $new_values, array_combine( $val, $val ) );
		}

		//$new_values = array_unique( $new_values );
		ksort( $new_values );
		return $new_values;
	}

}
