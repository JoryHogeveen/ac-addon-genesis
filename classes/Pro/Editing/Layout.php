<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Editing_Layout extends ACA_Genesis_Pro_Editing
{
	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model::get_edit_value()
	 */
	/*public function get_edit_value( $id ) {
		return members_get_post_access_message( $id );
	}*/

	/**
	 * Get editing options when using an ajax callback
	 *
	 * @inheritdoc
	 * @see  ACP_Editing_Model::get_ajax_options()
	 */
	/*public function get_ajax_options( $request ) {
		return array_keys( wp_roles()->roles );
	}*/

	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model::get_view_settings()
	 */
	public function get_view_settings() {
		/**
		 * @see genesis_layout_selector()
		 */
		//   >> wp-content/themes/genesis/lib/views/meta-boxes/genesis-inpost-layout-box.php
		//   >> wp-content/themes/genesis/lib/views/meta-boxes/genesis-term-meta-layout.php
		//   >> wp-content/themes/genesis/lib/views/meta-boxes/genesis-user-layout.php
		// genesis_get_layouts()

		$layouts = $this->column->get_genesis_layouts();

		foreach ( $layouts as $key => $data ) {
			/*$label = $data['label'];
			$img = $data['img'];
			$layouts[ $key ] = '<img src="' . $img . '" alt="' . $label . '" style="max-width: 100%; height: auto;" />';*/
			$layouts[ $key ] = $data['label'];
		}

		$layouts = array_merge(
			array( '' => __( 'Default Layout', 'genesis' ) ),
			$layouts
		);

		return array(
			'type'        => 'select2_dropdown',
			'placeholder' => __( 'Select Layout', 'codepress-admin-columns' ),
			'options'     => $layouts,
		);
	}

	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model::save()
	 */
	/*public function save( $id, $value ) {
		members_set_post_access_message( $id, $value );

		return $value;
	}*/

}
