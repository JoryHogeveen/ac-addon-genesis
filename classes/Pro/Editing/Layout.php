<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis_Pro_Editing_Layout extends ACA_Genesis_Pro_Editing
{
	/**
	 * @inheritdoc
	 * @see  ACP_Editing_Model::get_view_settings()
	 */
	public function get_view_settings() {
		/**
		 * @see genesis_layout_selector()
		 * @see genesis_get_layouts()
		 * >> wp-content/themes/genesis/lib/views/meta-boxes/genesis-inpost-layout-box.php
		 * >> wp-content/themes/genesis/lib/views/meta-boxes/genesis-term-meta-layout.php
		 * >> wp-content/themes/genesis/lib/views/meta-boxes/genesis-user-layout.php
		 */

		// @todo Pass object ID.
		$layouts = $this->column->get_genesis_layouts();

		$layout_no_img = array();

		foreach ( $layouts as $key => $data ) {
			$label = ( ! empty( $data['label'] ) ) ? $data['label'] : $key;
			if ( ! empty( $data['img'] ) ) {
				$img = $data['img'];
				$layouts[ $key ] = '<img src="' . $img . '" alt="' . $label . '" title="' . $label . '" style="max-width: 100%; height: auto;" />';
			} else {
				$layout_no_img[ $key ] = $label;
				unset( $layouts[ $key ] );
			}
		}

		$layouts = array_merge(
			array(
				'' => sprintf(
					// translators: Theme settings admin screen link
					esc_html__( 'Default Layout set in %s', 'genesis' ),
					'<a href="' . esc_url( menu_page_url( 'genesis', 0 ) ) . '">' . esc_html__( 'Theme Settings', 'genesis' ) . '</a>'
				),
			),
			$layouts,
			$layout_no_img
		);

		return array(
			'type'        => 'genesis_layout',
			'placeholder' => __( 'Select Layout', 'genesis' ),
			'options'     => $layouts,
		);
	}
}
