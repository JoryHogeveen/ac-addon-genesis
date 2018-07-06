<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Editing extends ACP\Editing\Model\Meta
{
	/**
	 * @inheritdoc
	 * @see  ACP\Editing\Model\Meta::__construct()
	 */
	public function __construct( ACA_Genesis_Column $column ) {
		parent::__construct( $column );
	}

}
