<?php
namespace ACA\Genesis\Column\User;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class IntroText extends Column
{
	/**
	 * @inheritdoc
	 * @see  ACA_Genesis_Column::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->set_type( 'genesis-intro-text' );
		$this->set_label( __( 'Archive Intro Text', 'genesis' ) );
		$this->set_meta_key( 'intro_text' );
	}

}
