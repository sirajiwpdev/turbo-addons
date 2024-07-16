<?php
namespace DesignMonks\AkijCement;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'AKIJCEMENT_ELEMENTOR_CORE_URL', plugins_url( '/', __FILE__ ) );
define( 'AKIJCEMENT_ELEMENTOR_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'AKIJCEMENT_ELEMENTOR_CORE_FILE', __FILE__ );


class ElementorWidgets {
	// Properties

	/**
	 * Instance
	 *
	 * @var ElementorWidgets
	 */
	private static $instance = null;

	/**
	 * Get instance
	 *
	 * @return ElementorWidgets
	 */

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * ElementorWidgets constructor.
	 */

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init_addons' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
	}

	/**
	 * Register Categories for Elementor
	 * @param $elements_manager
	 */

	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'akijcement-elements',
			[
				'title' => __( 'Turbo-Addons', 'akijcement-core' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register widgets
	 */

	public function register_widgets() {
		$widget_manager = Plugin::instance()->widgets_manager;

		foreach ( glob( AKIJCEMENT_CORE_PATH . 'Includes/Widgets/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\DesignMonks\AkijCement\Widgets\%s', $class );

			if ( class_exists( $class ) ) {
				$widget_manager->register( new $class );
			}
		}
	}


	/**
	 * Register addon by file name
	 */
	public function register_modules_addon( ) {
		foreach ( glob( AKIJCEMENT_CORE_PATH . 'Includes/Elementor/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\DesignMonks\AkijCement\Elementor\%s', $class );

			if ( class_exists( $class ) ) {
				new $class;
			}
		}
	}

	/**
	 * Init Addons
	 */

	public function init_addons() {
		/**
		 * Check if Elementor installed and activated
		 * @see https://developers.elementor.com/creating-an-extension-for-elementor/
		 */
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		$this->register_modules_addon();
	}


	/**
	 * Enqueue scripts
	 */
	public function after_register_scripts() {
		wp_register_script( 'countUp', AKIJCEMENT_SCRIPTS . '/countUp.min.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'appear-js', AKIJCEMENT_SCRIPTS . '/jquery.appear.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'countTo', AKIJCEMENT_SCRIPTS . '/jquery.countTo.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'parallax-scroll', AKIJCEMENT_SCRIPTS . '/jquery.parallax-scroll.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'gmap3', AKIJCEMENT_SCRIPTS . '/gmap.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'isotope', AKIJCEMENT_SCRIPTS . '/isotope.pkgd.min.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'parallax', AKIJCEMENT_SCRIPTS . '/parallax.min.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
		wp_enqueue_script( 'gsap', AKIJCEMENT_SCRIPTS . '/gsap.min.js', array(), AKIJCEMENT_CORE_VERSION, true );
		wp_enqueue_script( 'marquee', AKIJCEMENT_SCRIPTS . '/jquery.marquee.js', array('jquery'), AKIJCEMENT_CORE_VERSION, true );
		wp_enqueue_script( 'chartjs', AKIJCEMENT_SCRIPTS . '/chartjs.js', array('jquery'), AKIJCEMENT_CORE_VERSION, true );

		wp_register_script( 'fastdom', AKIJCEMENT_SCRIPTS . '/fastdom.js', array(), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'fastdom-strict', AKIJCEMENT_SCRIPTS . '/fastdom-strict.js', array(), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'fastdom-promised', AKIJCEMENT_SCRIPTS . '/fastdom-promised.min.js', array(), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'splittext', AKIJCEMENT_SCRIPTS . '/SplitText.min.js', array(), AKIJCEMENT_CORE_VERSION, true );
		wp_register_script( 'liquidSplitText', AKIJCEMENT_SCRIPTS . '/liquidSplitText.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
//		wp_register_script( 'liquidAnimatedBlob', AKIJCEMENT_SCRIPTS . '/liquidAnimatedBlob.min.js', array( 'jquery' ), AKIJCEMENT_CORE_VERSION, true );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @return void
	 */

	public function before_enqueue_scripts() {
		wp_enqueue_script( 'akijcement-elementor', AKIJCEMENT_SCRIPTS . '/elementor.js', array(
			'jquery',
			'elementor-frontend'
		), AKIJCEMENT_CORE_VERSION, true );
	}
}
