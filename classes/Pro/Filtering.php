<?php
namespace ACA\Genesis\Pro;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Filtering extends \ACP\Filtering\Model\Meta
{
	/**
	 * @inheritdoc
	 * @see  \ACP\Filtering\Model\Meta::__construct()
	 */
	public function __construct( Column $column ) {
		parent::__construct( $column );
	}

}
