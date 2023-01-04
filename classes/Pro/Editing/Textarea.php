<?php
namespace ACA\Genesis\Pro\Editing;
use ACA\Genesis\Pro\Editing;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Textarea extends Editing
{
	/**
	 * @inheritdoc
	 * @see  \ACP\Editing\Model::get_view_settings()
	 */
	public function get_view_settings() {
		return array(
			'type' => 'textarea',
		);
	}

	/**
	 * @inheritdoc
	 * @see  \ACP\Editing\Model\Meta::save()
	 */
	public function save( $id, $value ) {
		// Same value validation as Genesis.
		if ( ! current_user_can( 'unfiltered_html' ) ) {
			$value = genesis_formatting_kses( $value );
		}
		parent::save( $id, $value );
	}
}
