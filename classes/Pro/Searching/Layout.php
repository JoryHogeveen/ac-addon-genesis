<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \ACP\Search\Operators;
use \ACP\Helper\Select\Options;

class ACA_Genesis_Pro_Searching_Layout extends ACP\Search\Comparison\Meta
	implements ACP\Search\Comparison\Values
{
	public $genesis_layouts;

	/**
	 * ACA_Genesis_Pro_Searching_Layout constructor.
	 * @param string $meta_key
	 * @param array $genesis_layouts
	 */
	public function __construct( $meta_key, $genesis_layouts ) {
		$operators = new Operators( array(
            Operators::EQ,
            Operators::NEQ,
            Operators::IS_EMPTY,
            Operators::NOT_IS_EMPTY,
		) );

		$this->genesis_layouts = $genesis_layouts;

		parent::__construct( $operators, $meta_key, 'post' );
	}

	/**
	 * @inheritdoc
	 */
	public function get_values() {
		$layouts = $this->genesis_layouts;

		foreach ( $layouts as $key => $data ) {
			$layouts[ $key ] = ( ! empty( $data['label'] ) ) ? $data['label'] : $key;
		}

		return Options::create_from_array( $layouts );
	}
}
