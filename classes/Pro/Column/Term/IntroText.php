<?php
namespace ACA\Genesis\Pro\Column\Term;
use ACA\Genesis\Column\Term\IntroText as Column_Term_IntroText;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class IntroText extends Column_Term_IntroText
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable, \ACP\Search\Searchable
	//, \ACP\Filtering\Filterable
{
	// Pro

	public function editing() {
		return new \ACA\Genesis\Pro\Editing\Textarea( $this );
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
