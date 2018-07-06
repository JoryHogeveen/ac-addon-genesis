<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Sorting extends ACP\Sorting\Model\Meta
{
	/**
	 * @inheritdoc
	 * @see  ACP\Sorting\Model\Meta::__construct()
	 */
	public function __construct( ACA_Genesis_Column $column ) {
		parent::__construct( $column );
	}

}
