<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Editing_Textarea extends ACA_Genesis_Pro_Editing
{
	/**
	 * @inheritdoc
	 * @see  ACP\Editing\Model::get_view_settings()
	 */
	public function get_view_settings() {
		return array(
			'type' => 'textarea',
		);
	}
}
