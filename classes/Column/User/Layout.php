<?php
namespace ACA\Genesis\Column\User;
use ACA\Genesis\Column\Layout as Column_Layout;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Layout extends Column_Layout
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
