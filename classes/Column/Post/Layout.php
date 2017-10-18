<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Column_Post_Layout extends ACA_Genesis_Column_Layout
{
	/**
	 * @return  string
	 */
	public function get_meta_key() {
		return '_genesis_layout';
	}

	public function get_genesis_layouts( $id = null ) {
		$type = array( 'singular' );
		if ( $id ) {
			$type = array( 'singular', get_post_type( $id ), $id );
		}
		return genesis_get_layouts( $type );
	}

}
