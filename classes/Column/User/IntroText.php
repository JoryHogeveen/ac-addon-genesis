<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Column_User_IntroText extends ACA_Genesis_Column
{
	/**
	 * @inheritdoc
	 * @see  ACA_Genesis_Column::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->set_type( 'genesis-intro-text' );
		$this->set_label( __( 'Archive Intro Text', 'codepress-admin-columns' ) );
		$this->set_meta_key( 'intro_text' );
	}

}
