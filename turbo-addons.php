<?php
/**
 * Plugin Name: Turbo Addons
 * Plugin URI: https://turbo-addons.com/
 * Description: This is a elementor addon plugin.
 * Version: 1.0.0
 * Author: Turbo
 * Author URI: https://turbo-addons.com/
 * Text domain: turbo-addons
 */

use DesignMonks\AkijCement\Admin\PostType\Product;


if (!defined('ABSPATH'))
	die('-1');

/**
 * Currently plugin version.
 * Start at version 2.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AKIJCEMENT_CORE_VERSION', '1.0.0');

/**
 * Constant for the plugins
 */


define('AKIJCEMENT_PLUGIN_URL', plugins_url() . '/akijcement-core/');
define('AKIJCEMENT_CORE_PATH', plugin_dir_path(__FILE__));
define('AKIJCEMENT_CORE_ASSETS_URL', plugins_url() . '/akijcement-core/assets/');
define('AKIJCEMENT_CORE_DIR', plugin_dir_path(__FILE__));
define('AKIJCEMENT_SCRIPTS', AKIJCEMENT_PLUGIN_URL . 'assets/js');

// Include comoposer autoload
require_once AKIJCEMENT_CORE_DIR . 'vendor/autoload.php';

// Make sure the same class is not loaded twice in free/premium versions.
if (!class_exists('Akijcement_Core')) {
	/**
	 * Main AkijCement Core Class
	 *
	 * The main class that initiates and runs the AkijCement Core plugin.
	 *
	 * @since 1.0.0
	 */
	final class Akijcement_Core
	{
		/**
		 * AkijCement Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0';

		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '3.3.0';

		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @since 2.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.6';

		/**
		 * Instance
		 *
		 * Holds a single instance of the `Akijcement_Core` class.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Akijcement_Core A single instance of the class.
		 */
		private static $_instance = null;

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      Akijcement_Core $loader Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @return Akijcement_Core An instance of the class.
		 * @since 1.0.0
		 *
		 * @access public
		 * @static
		 *
		 */
		public static function instance()
		{
			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @return void
		 * @since 1.0.0
		 *
		 * @access protected
		 *
		 */
		public function __clone()
		{
			// Cloning instances of the class is forbidden
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'akijcement-core'), '2.0.0');
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @return void
		 * @since 1.0.0
		 *
		 * @access protected
		 *
		 */
		public function __wakeup()
		{
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'akijcement-core'), '1.0.0');
		}

		/**
		 * Constructor
		 *
		 * Initialize the AkijCement Core plugins.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct()
		{
			$this->core_includes();
			$this->init_hooks();
			do_action('akijcement_core_loaded');

		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function core_includes()
		{
			// Extra
			require_once __DIR__ . '/Includes/mailchimp.php';

			// Elementor custom field icons
			require_once __DIR__ . '/Includes/Icons/icons.php';
			require_once __DIR__ . '/Includes/Helper.php';

			// Aq Resizer
			require_once __DIR__ . '/Includes/Aq_Resize.php';
			// Image Sizes
			require_once __DIR__ . '/Includes/ImageSize.php';
			require_once __DIR__ . '/Includes/widgets.php';

			// Admin
			new DesignMonks\AkijCement\Admin();
			new Product();

			// Elementor Widgets
			DesignMonks\AkijCement\ElementorWidgets::get_instance();

		}

		function dm_bunch_widget_init()
		{
			//footer Widget
			if( class_exists( 'DM_About_Company' ) )register_widget( 'DM_About_Company' );
			if( class_exists( 'DM_Contact_Us' ) )register_widget( 'DM_Contact_Us' );
			if( class_exists( 'DM_have_a_projects' ) )register_widget( 'DM_have_a_projects' );

			//footer Two Widget
			if( class_exists( 'DM_About_Company_V2' ) )register_widget( 'DM_About_Company_V2' );
			if( class_exists( 'DM_Contact_Us_V2' ) )register_widget( 'DM_Contact_Us_V2' );
			if( class_exists( 'DM_Newsletter' ) )register_widget( 'DM_Newsletter' );

			//footer Three Widget
			if( class_exists( 'DM_Follow_Us' ) )register_widget( 'DM_Follow_Us' );
			if( class_exists( 'DM_Newsletter_V2' ) )register_widget( 'DM_Newsletter_V2' );

			//Blog Widget
			if( class_exists( 'DM_Recent_Posts' ) )register_widget( 'DM_Recent_Posts' );

		}


		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 */
		private function init_hooks()
		{
			add_action('init', [$this, 'i18n']);
			add_action('plugins_loaded', [$this, 'init']);
			add_action('init', [$this, 'akijcement_gutenberg_block_init']);
			add_action( 'widgets_init', [$this, 'dm_bunch_widget_init'] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function i18n()
		{
			load_plugin_textdomain('akijcement-core', false, plugin_basename(dirname(__FILE__)) . '/languages');
		}

		/**
		 * Init AkijCement Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @since 1.0.0
		 * @since 2.0.0 The logic moved from a standalone function to this class method.
		 *
		 * @access public
		 */
		public function init()
		{

			if (!did_action('elementor/loaded')) {
				add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
				return;
			}

			// Check for required Elementor version
			if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
				return;
			}

			// Check for required PHP version
			if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
				return;
			}

			// Register Widget Scripts
			add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_widget_styles']);
			add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_widget_styles']);
			add_action('wp_enqueue_scripts', [$this, 'akijcement_enqueue_style']);
			add_action('wp_enqueue_scripts', [$this, 'akijcement_dequeue'], 100);
			add_action('enqueue_block_editor_assets', [$this, 'akijcement_block_editor_assets']);
			add_action('admin_enqueue_scripts', [$this, 'akijcement_admin_enqueue_scripts']);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.1.0
		 * @since 2.0.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin()
		{
			$message = sprintf(
			/* translators: 1: AkijCement Core: Elementor */
				esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'akijcement-core'),
				'<strong>' . esc_html__('AkijCement Core', 'akijcement-core') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'akijcement-core') . '</strong>'
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.1.0
		 * @since 2.0.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version()
		{
			$message = sprintf(
			/* translators: 1: AkijCement Core: Elementor 3: Required Elementor version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'akijcement-core'),
				'<strong>' . esc_html__('AkijCement Core', 'akijcement-core') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'akijcement-core') . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 2.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version()
		{
			$message = sprintf(
			/* translators: 1: AkijCement Core 2: PHP 3: Required PHP version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'akijcement-core'),
				'<strong>' . esc_html__('AkijCement Elements', 'akijcement-core') . '</strong>',
				'<strong>' . esc_html__('PHP', 'akijcement-core') . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		public function akijcement_enqueue_style()
		{
			wp_enqueue_style('simpleline', plugins_url('assets/vendors/simple-line-icons//css/simple-line-icons.css', __FILE__));
			wp_enqueue_style('akijcement-core-css', plugins_url('assets/css/app.css', __FILE__));
		}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run AkijCement Core.
		 *
		 * @since 2.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */

		public function enqueue_widget_styles()
		{
			wp_enqueue_style('themify-icons', plugins_url('assets/vendors/themify-icon/themify-icons.css', __FILE__));
			wp_enqueue_style('elegant-icons', plugins_url('assets/vendors/components-elegant-icons/css/elegant-icons.min.css', __FILE__));
			wp_enqueue_style('simpleline', plugins_url('assets/vendors/simple-line-icons//css/simple-line-icons.css', __FILE__));
			wp_enqueue_style('feather', plugins_url('assets/vendors/feather/css/feather.css', __FILE__));
		}

		public function akijcement_admin_enqueue_scripts()
		{
			wp_enqueue_style('akijcement-gutenberg-block-editor', plugins_url('assets/css/editor.css', __FILE__));
			wp_enqueue_style('feather', plugins_url('assets/vendors/feather/css/feather.css', __FILE__));
			wp_enqueue_style('admin', plugins_url('assets/css/admin.css', __FILE__));
		}


		/**
		 * Dequeue the Elementor Animation CSS.
		 *
		 * Hooked to the wp_print_scripts action, with a late priority (100),
		 * so that it is after the script was enqueued.
		 */

		function akijcement_dequeue()
		{
			add_action('wp_footer', [$this, 'remove_elementor_animations_css']);
		}

		function remove_elementor_animations_css()
		{
			wp_dequeue_style('e-animations');
			wp_deregister_style('e-animations');
		}

		public function akijcement_block_editor_assets()
		{
			wp_enqueue_script(
				'akijcement-gutenberg-editor-script',
				plugins_url('build/index.js', __FILE__),
				[
					'wp-block-editor', 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-polyfill', 'wp-server-side-render'
				]
			);
		}

		/*
		 * Gutenberg Block Register
		 */
		public function akijcement_gutenberg_block_init()
		{
			register_block_type(
				'akijcement-block/newsletter-widget',
				[
					'render_callback' => [$this, 'render_newsletter'],
					'attributes'      => [
						'btn_text'   => [
							'default' => __('Subscribe', 'akijcement-core'),
							'type'    => 'string',
						],
						'content'    => [
							'default' => __('Subscribe to our newsletter to receive early discount offers.', 'akijcement-core'),
							'type'    => 'string',
						],
						'iconSwitch' => [
							'default' => true,
							'type'    => 'boolean',
						],
					],
				]
			);
		}

		public function render_newsletter($attributes)
		{
			ob_start(); ?>
			<div class="wp-widget-block-newsletter">
				<p class="description"><?php echo $attributes['content'] ?></p>

				<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" class="footer-newsletter-form widget-newsletter"
					  data-akijcement-form="newsletter-subscribe">
					<input type="hidden" name="action" value="akijcement_mailchimp_subscribe">

					<div class="newsletter-inner d-flex">
						<input type="email" name="email" class="form-control" id="newsletter-form-email"
							   placeholder="<?php echo esc_attr__('Email', 'akijcement-core'); ?>" required>
						<button type="submit" name="submit" id="newsletter-submit" class="newsletter-submit dm-btn">
							<?php if ($attributes['iconSwitch']) : ?>
								<i class="fas fa-paper-plane"></i>
							<?php else : ?>
								<?php echo esc_html($attributes['btn_text']); ?>
							<?php endif; ?>
							<i class="fa fa-circle-o-notch fa-spin"></i>
						</button>
					</div>
					<div class="form-result alert">
						<div class="content"></div>
					</div><!-- /.form-result-->
				</form><!-- /.newsletter-form -->
			</div>
			<!-- /.wp-widget-block-newsletter -->
			<?php
			return ob_get_clean();
		}
	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if (!function_exists('akijcement_core_load')) {
	/**
	 * Load AkijCement Core
	 *
	 * Main instance of Akijcement_Core.
	 *
	 * @since 1.0.0
	 * @since 1.0.0 The logic moved from this function to a class method.
	 */
	function akijcement_core_load()
	{
		return Akijcement_Core::instance();
	}

	// Run AkijCement Core
	akijcement_core_load();
}
