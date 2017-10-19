<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Column_Post_PostClass extends ACA_Genesis_Column
{
	/**
	 * @inheritdoc
	 * @see  ACA_Genesis_Column::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->set_type( 'genesis-post-class' );
		$this->set_label( __( 'Custom Post Class', 'genesis' ) );
		$this->set_meta_key( '_genesis_custom_post_class' );
	}

}
