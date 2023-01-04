<?php
namespace ACA\Genesis\Pro\Column\Post;
use ACA\Genesis\Column\Post\PostClass as Column_Post_PostClass;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PostClass extends Column_Post_PostClass
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Filtering\Filterable, \ACP\Search\Searchable
{
	// Pro

	public function editing() {
		return new \ACA\Genesis\Pro\Editing\Classes( $this );
	}

	public function sorting() {
		return new \ACA\Genesis\Pro\Sorting( $this );
	}

	public function filtering() {
		return new \ACA\Genesis\Pro\Filtering\Classes( $this );
	}

	public function search() {
		return new \ACP\Search\Comparison\Meta\Text( $this->get_meta_key(), 'post' );
	}

	public function scripts() {
		parent::scripts();
		wp_enqueue_script( 'aca-genesis-xeditable-input-select2_classes' );
	}

}
