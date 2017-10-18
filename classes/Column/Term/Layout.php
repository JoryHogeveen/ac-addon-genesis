<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Column_Term_Layout extends ACA_Genesis_Column_Layout
{
	/**
	 * @return  string
	 */
	public function get_meta_key() {
		return 'layout';
	}

	public function get_genesis_layouts( $id = null ) {
		$type = array( 'archive' );
		if ( $id ) {
			$object = get_term( $id );
			$type = array( 'archive', $object->taxonomy, $id );
		}
		return genesis_get_layouts( $type );
	}

}
