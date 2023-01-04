<?php
namespace ACA\Genesis\Column\Post;
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
