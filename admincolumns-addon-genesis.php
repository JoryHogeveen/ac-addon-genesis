<?php
/**
 * Plugin Name:  Admin Columns - Genesis add-on
 * Plugin URI:   https://github.com/JoryHogeveen/admincolumns-addon-genesis
 * Version:      1.0
 * Description:  Show Genesis fields in your admin post overviews and edit them inline! Genesis integration Add-on for Admin Columns.
 * Author:       Jory Hogeveen
 * Author URI:   http://www.keraweb.nl
 * Text Domain:  codepress-admin-columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_Genesis {

	const CLASS_PREFIX = 'ACA_Genesis_';

	/**
	 * @var ACA_Genesis
	 */
	protected static $_instance = null;

	/**
	 * @return ACA_Genesis
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * ACA_Genesis constructor.
	 */
	private function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init' ) );
	}

	/**
	 * Check dependencies and register actions.
	 */
	public function init() {
		if ( ! is_admin() ) {
			return;
		}

		if ( $this->has_missing_dependencies() ) {
			return;
		}

		AC()->autoloader()->register_prefix( self::CLASS_PREFIX, $this->get_plugin_dir() . 'classes/' );

		add_action( 'ac/column_groups', array( $this, 'register_column_groups' ) );
		// Prio 9 to make sure PRO is loaded after FREE.
		add_action( 'ac/column_types', array( $this, 'add_columns' ), 9 );
		add_action( 'acp/column_types', array( $this, 'add_pro_columns' ) );
	}

	/**
	 * @param AC_Groups $groups
	 */
	public function register_column_groups( $groups ) {
		$groups->register_group( 'genesis', __( 'Genesis', 'genesis' ), 11 );
	}

	/**
	 * @return bool True when there are missing dependencies
	 */
	private function has_missing_dependencies() {
		require_once plugin_dir_path( __FILE__ ) . 'classes/Dependencies.php';

		$dependencies = new ACA_Genesis_Dependencies( __FILE__ );

		// Pro not required.
		//$dependencies->is_acp_active( '4.0.3' );

		if ( ! $this->is_genesis_active() ) {
			$dependencies->add_missing( $dependencies->get_search_link( 'Genesis', 'Genesis' ) );
		}

		return $dependencies->has_missing();
	}

	/**
	 * @return string
	 */
	public function get_plugin_basename() {
		static $basename = null;
		if ( $basename ) {
			return $basename;
		}
		$basename = plugin_basename( __FILE__ );
		return $basename;
	}

	/**
	 * @return string
	 */
	public function get_plugin_dir() {
		static $dir = null;
		if ( $dir ) {
			return $dir;
		}
		$dir = plugin_dir_path( __FILE__ );
		return $dir;
	}

	/**
	 * @return int|float|string
	 */
	public function get_version() {
		static $version = null;
		if ( $version ) {
			return $version;
		}
		$plugins = get_plugins();
		$version = $plugins[ $this->get_plugin_basename() ]['Version'];
		return $version;
	}

	/**
	 * Whether Admin Columns Pro is active
	 *
	 * @return bool
	 */
	private function is_pro_active() {
		return function_exists( 'ac_is_pro_active' ) && ac_is_pro_active();
	}

	/**
	 * Whether Genesis is active
	 *
	 * @return bool Returns true if Genesis is active, false otherwise
	 */
	public function is_genesis_active() {
		return 'genesis' === get_template();
	}

	/**
	 * Add custom columns
	 *
	 * @param AC_ListScreen $list_screen
	 *
	 */
	public function add_columns( $list_screen ) {
		$has_multiple_layouts = genesis_has_multiple_layouts();

		switch ( true ) {

			case $list_screen instanceof AC_ListScreen_Post:
				if ( current_theme_supports( 'genesis-inpost-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Column_Post_Layout() );
					}
					$list_screen->register_column_type( new ACA_Genesis_Column_Post_BodyClass() );
					$list_screen->register_column_type( new ACA_Genesis_Column_Post_PostClass() );
				}
				break;

			case $list_screen instanceof AC_ListScreen_User:
				// Users also use archives.
				if ( current_theme_supports( 'genesis-archive-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Column_User_Layout() );
					}
					$list_screen->register_column_type( new ACA_Genesis_Column_User_Headline() );
					$list_screen->register_column_type( new ACA_Genesis_Column_User_IntroText() );
				}
				break;

			case $list_screen instanceof ACP_ListScreen_Taxonomy:
				if ( current_theme_supports( 'genesis-archive-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Column_Term_Layout() );
					}
					$list_screen->register_column_type( new ACA_Genesis_Column_Term_Headline() );
					$list_screen->register_column_type( new ACA_Genesis_Column_Term_IntroText() );
				}
				break;
		}
	}

	/**
	 * Add custom columns
	 *
	 * @param AC_ListScreen $list_screen
	 */
	public function add_pro_columns( $list_screen ) {

		$has_multiple_layouts = genesis_has_multiple_layouts();

		switch ( true ) {

			case $list_screen instanceof AC_ListScreen_Post:
				if ( current_theme_supports( 'genesis-inpost-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Post_Layout() );
					}
					$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Post_BodyClass() );
					$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Post_PostClass() );
				}
				break;

			case $list_screen instanceof AC_ListScreen_User:
				// Users also use archives.
				if ( current_theme_supports( 'genesis-archive-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Pro_Column_User_Layout() );
					}
					$list_screen->register_column_type( new ACA_Genesis_Pro_Column_User_Headline() );
					$list_screen->register_column_type( new ACA_Genesis_Pro_Column_User_IntroText() );
				}
				break;

			case $list_screen instanceof ACP_ListScreen_Taxonomy:
				if ( current_theme_supports( 'genesis-archive-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Term_Layout() );
					}
					$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Term_Headline() );
					$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Term_IntroText() );
				}
				break;
		}
	}

}

/**
 * @return ACA_Genesis
 */
function ac_addon_genesis() {
	return ACA_Genesis::instance();
}

ac_addon_genesis();
