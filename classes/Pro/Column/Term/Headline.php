<?php
namespace ACA\Genesis\Pro\Column\Term;
use ACA\Genesis\Column\Term\Headline as Column_Term_Headline;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Headline extends Column_Term_Headline
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Search\Searchable
	//, \ACP\Filtering\Filterable
{
	// Pro

	public function editing() {
		return new \ACA\Genesis\Pro\Editing( $this );
	}

	public function sorting() {
		return new \ACA\Genesis\Pro\Sorting( $this );
	}

	public function filtering() {
		return new \ACA\Genesis\Pro\Filtering( $this );
	}

	public function search() {
		return new \ACP\Search\Comparison\Meta\Text( $this->get_meta_key(), 'post' );
	}

}
