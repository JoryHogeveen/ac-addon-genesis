<?php
namespace ACA\Genesis\Pro;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sorting extends \ACP\Sorting\Model\Meta
{
	/**
	 * @inheritdoc
	 * @see  \ACP\Sorting\Model\Meta::__construct()
	 */
	public function __construct( Column $column ) {
		parent::__construct( $column );
	}

}
