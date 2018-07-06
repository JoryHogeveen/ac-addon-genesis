<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Filtering extends ACP\Filtering\Model\Meta
{
	/**
	 * @inheritdoc
	 * @see  ACP\Filtering\Model\Meta::__construct()
	 */
	public function __construct( ACA_Genesis_Column $column ) {
		parent::__construct( $column );
	}

}
