<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Column_Post_BodyClass extends ACA_Genesis_Column_Post_BodyClass
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Filtering\Filterable, \ACP\Search\Searchable
{
	// Pro

	public function editing() {
		return new ACA_Genesis_Pro_Editing_Classes( $this );
	}

	public function sorting() {
		return new ACA_Genesis_Pro_Sorting( $this );
	}

	public function filtering() {
		return new ACA_Genesis_Pro_Filtering_Classes( $this );
	}

	public function search() {
		return new ACP\Search\Comparison\Meta\Text( $this->get_meta_key(), 'post' );
	}

	public function scripts() {
		parent::scripts();
		wp_enqueue_script( 'aca-genesis-xeditable-input-select2_classes' );
	}

}
