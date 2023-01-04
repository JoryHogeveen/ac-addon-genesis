<?php
namespace ACA\Genesis\Pro;
use ACA\Genesis\Column;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Editing extends \ACP\Editing\Model\Meta
{
	/**
	 * @inheritdoc
	 * @see  \ACP\Editing\Model\Meta::__construct()
	 */
	public function __construct( Column $column ) {
		parent::__construct( $column );
	}

}
