<?php
namespace ACA\Genesis\Column\Term;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Headline extends Column
{
	/**
	 * @inheritdoc
	 * @see  ACA_Genesis_Column::__construct()
	 */
	public function __construct() {
		parent::__construct();
		$this->set_type( 'genesis-headline' );
		$this->set_label( __( 'Archive Headline', 'genesis' ) );
		$this->set_meta_key( 'headline' );
	}

}
