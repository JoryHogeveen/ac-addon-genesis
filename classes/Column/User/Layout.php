<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Column_User_Layout extends ACA_Genesis_Column_Layout
{
	/**
	 * @return  string
	 */
	public function get_meta_key() {
		return 'layout';
	}

	public function get_genesis_layouts( $id = null ) {
		$type = array( 'archive', 'author' );
		if ( $id ) {
			$type = array( 'archive', 'author', $id );
		}
		return genesis_get_layouts( $type );
	}

}
