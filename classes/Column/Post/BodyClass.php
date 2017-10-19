<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Column_Post_BodyClass extends ACA_Genesis_Column
{
	/**
	 * @inheritdoc
	 * @see  ACA_Genesis_Column::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->set_type( 'genesis-body-class' );
		$this->set_label( __( 'Custom Body Class', 'genesis' ) );
		$this->set_meta_key( '_genesis_custom_body_class' );
	}

}
