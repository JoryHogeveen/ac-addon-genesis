<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Column_User_Headline extends ACA_Genesis_Column_User_Headline
	implements \ACP\Editing\Editable, \ACP\Sorting\Sortable
	//, \ACP\Filtering\Filterable
{
	// Pro

	public function editing() {
		return new ACA_Genesis_Pro_Editing( $this );
	}

	public function sorting() {
		return new ACA_Genesis_Pro_Sorting( $this );
	}

	public function filtering() {
		return new ACA_Genesis_Pro_Filtering( $this );
	}

}
