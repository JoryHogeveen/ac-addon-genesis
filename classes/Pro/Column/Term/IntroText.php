<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Column_Term_IntroText extends ACA_Genesis_Column_Term_IntroText
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Search\Searchable
	//, \ACP\Filtering\Filterable
{
	// Pro

	public function editing() {
		return new ACA_Genesis_Pro_Editing_Textarea( $this );
	}

	public function sorting() {
		return new ACA_Genesis_Pro_Sorting( $this );
	}

	public function filtering() {
		return new ACA_Genesis_Pro_Filtering( $this );
	}

	public function search() {
		return new ACP\Search\Comparison\Meta\Text( $this->get_meta_key(), 'post' );
	}

}
