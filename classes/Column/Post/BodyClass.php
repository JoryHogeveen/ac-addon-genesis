<?php
namespace ACA\Genesis\Column\Post;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BodyClass extends Column
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
