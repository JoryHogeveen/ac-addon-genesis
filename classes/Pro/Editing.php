<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Editing extends ACP_Editing_Model_Meta
{
	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model_Meta::__construct()
	 */
	public function __construct( ACA_Genesis_Column $column ) {
		parent::__construct( $column );
	}

}
