<?php
namespace ACA\Genesis\Pro\Column\Term;
use ACA\Genesis\Column\Term\Layout as Column_Term_Layout;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Layout extends Column_Term_Layout
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Filtering\Filterable
{
	// Pro

	public function editing() {
		return new \ACA\Genesis\Pro\Editing\Layout( $this );
	}

	public function sorting() {
		return new \ACA\Genesis\Pro\Sorting( $this );
	}

	public function filtering() {
		return new \ACA\Genesis\Pro\Filtering( $this );
	}

	public function search() {
		return new \ACA\Genesis\Pro\Searching\Layout( $this->get_meta_key(), $this->get_genesis_layouts() );
	}

	public function scripts() {
		parent::scripts();
		wp_enqueue_script( 'aca-genesis-xeditable-input-genesis_layout' );
	}

}
