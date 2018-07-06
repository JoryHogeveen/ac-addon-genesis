<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Column_Term_Layout extends ACA_Genesis_Column_Term_Layout
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Filtering\Filterable
{
	// Pro

	public function editing() {
		return new ACA_Genesis_Pro_Editing_Layout( $this );
	}

	public function sorting() {
		return new ACA_Genesis_Pro_Sorting( $this );
	}

	public function filtering() {
		return new ACA_Genesis_Pro_Filtering( $this );
	}

	public function scripts() {
		parent::scripts();
		wp_enqueue_script( 'aca-genesis-xeditable-input-genesis_layout' );
	}

}
