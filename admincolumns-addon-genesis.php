<?php
/**
 * Plugin Name:  Admin Columns - Genesis Framework add-on
 * Plugin URI:   https://github.com/JoryHogeveen/admincolumns-addon-genesis
 * Version:      1.0
 * Description:  Show Genesis Framework fields in your admin post overviews and edit them inline! Genesis Framework integration Add-on for Admin Columns.
 * Author:       Jory Hogeveen
 * Author URI:   http://www.keraweb.nl
 * Text Domain:  admincolumns-addon-genesis
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

		// Scripts
		add_action( 'ac/table_scripts', array( $this, 'table_scripts' ) );
		add_action( 'ac/table_scripts/editing', array( $this, 'table_scripts_editing' ) );
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
			$link = $dependencies->get_html_link( 'https://my.studiopress.com/themes/genesis/', 'Genesis Framework', true );
			$dependencies->add_missing( $link );
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
	 * @return string
	 */
	public function get_plugin_url() {
		static $url = null;
		if ( $url ) {
			return $url;
		}
		$url = plugin_dir_url( __FILE__ );
		return $url;
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
	 * @param AC_ListScreen $list_screen
	 */
	public function table_scripts_editing( $list_screen ) {
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		$url = $this->get_plugin_url();

		wp_register_script(
			'aca-genesis-xeditable-input-genesis_layout',
			$url . 'assets/js/xeditable/input/genesis-layout' . $suffix . '.js',
			array(
				'jquery',
				'acp-editing-table',
			),
			$this->get_version()
		);

		wp_register_script(
			'aca-genesis-xeditable-input-select2_classes',
			$url . 'assets/js/xeditable/input/select2-classes' . $suffix . '.js',
			array(
				'jquery',
				'acp-editing-table',
			),
			$this->get_version()
		);

		// Translations
		//wp_localize_script( 'aca-genesis-xeditable-input-genesis_layout', 'acp_genesis_i18n', array() );
	}

	/**
	 * @since 1.3
	 *
	 * @param AC_ListScreen $list_screen
	 */
	public function table_scripts( $list_screen ) {
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		$url = $this->get_plugin_url();

		wp_register_style( 'aca-genesis-column', $url . 'assets/css/column' . $suffix . '.css', array(), $this->get_version() );
		//wp_enqueue_script( 'aca-genesis-table', $url . 'assets/js/table.js', array( 'jquery' ), $this->get_version() );
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
				}
				$list_screen->register_column_type( new ACA_Genesis_Pro_Column_User_Headline() );
				$list_screen->register_column_type( new ACA_Genesis_Pro_Column_User_IntroText() );
				break;

			case $list_screen instanceof ACP_ListScreen_Taxonomy:
				if ( current_theme_supports( 'genesis-archive-layouts' ) ) {
					if ( $has_multiple_layouts ) {
						$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Term_Layout() );
					}
				}
				$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Term_Headline() );
				$list_screen->register_column_type( new ACA_Genesis_Pro_Column_Term_IntroText() );
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
