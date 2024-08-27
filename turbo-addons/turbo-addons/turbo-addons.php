<?php
/**
 * Plugin Name: Turbo Addons
 * Plugin URI: https://turbo-addons.com/turbo-addons
 * Description: Turbo-Addons is towards limitless Elementor Addons with 15+ Elementor Free & Pro Widgets Coming for easy Customization.
 * Version: 1.0.0
 * Author: Turbo
 * Author URI: https://turbo-addons.com/
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Text Domain: turbo-addons
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Plugin Class
 * @since 1.0.0
 */
final class Turbo_Addons {

    const TURBO_ADDONS_PLUGIN_VERSION = '1.0.0';
    const TURBO_ADDONS_MIN_ELEMENTOR_VERSION = '3.0.0';
    const TURBO_ADDONS_MIN_PHP_VERSION = '7.4';
    
    private static $_instance = null;

    /**
     * Singleton Instance Method
     * @since 1.0.0
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     * @since 1.0.0
     */
    public function __construct() {
        $this->define_constants();
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts_styles' ] );
        add_action( 'init', [ $this, 'load_textdomain' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
     * Define Plugin Constants
     * @since 1.0.0
     */
    private function define_constants() {
        define( 'TURBO_ADDONS_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
        define( 'TURBO_ADDONS_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
    }

    /**
     * Enqueue Scripts & Styles
     * @since 1.0.0
     */
    public function enqueue_scripts_styles() {
        wp_enqueue_script( 'jquery-ui-sortable' );

        wp_register_style( 'turbo-style', TURBO_ADDONS_PLUGIN_URL . 'assets/css/style.css', [], filemtime( TURBO_ADDONS_PLUGIN_PATH . 'assets/css/style.css' ), 'all' );
        wp_register_script( 'turbo-script', TURBO_ADDONS_PLUGIN_URL . 'assets/js/script.js', [ 'jquery', 'jquery-ui-sortable' ], filemtime( TURBO_ADDONS_PLUGIN_PATH . 'assets/js/script.js' ), true );
        wp_enqueue_script( 'waypoints', TURBO_ADDONS_PLUGIN_URL . 'assets/js/waypoints.min.js', [ 'jquery' ], filemtime( TURBO_ADDONS_PLUGIN_PATH . 'assets/js/waypoints.min.js' ), true );
        wp_enqueue_script( 'advanced-timeline-script', TURBO_ADDONS_PLUGIN_URL . 'assets/js/advanced-timeline.js', [ 'jquery', 'waypoints' ], filemtime( TURBO_ADDONS_PLUGIN_PATH . 'assets/js/advanced-timeline.js' ), true );

        wp_enqueue_style( 'turbo-style' );
        wp_enqueue_script( 'turbo-script' );
    }

    /**
     * Load Text Domain for Translations
     * @since 1.0.0
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'turbo-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Initialize the plugin
     * @since 1.0.0
     */
    public function init() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        if ( ! version_compare( ELEMENTOR_VERSION, self::TURBO_ADDONS_MIN_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        if ( ! version_compare( PHP_VERSION, self::TURBO_ADDONS_MIN_PHP_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        add_action( 'elementor/init', [ $this, 'init_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    }

    /**
     * Initialize Widgets
     * @since 1.0.0
     */
    public function init_widgets() {
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/about-Image.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/Banner.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/contact-info.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/Heading.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/logo-carousel.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/logo-list.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/popular-post.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/preview-card.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/pricing-table.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/Team.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/Testimonial.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/advanced-timeline-widget.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/advanced-tabs-accordions.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/dynamic-content-silder.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/storytelling-slider.php';
        require_once TURBO_ADDONS_PLUGIN_PATH . 'widgets/animated_text_effects.php';    
    }

    /**
     * Initialize Category Section
     * @since 1.0.0
     */
    public function init_category() {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'turbo-addons',
            [
                'title' => esc_html__( 'Turbo Addons', 'turbo-addons' )
            ],
            1
        );
    }

    /**
     * Admin Notice for Missing Elementor
     * @since 1.0.0
     */
    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) && ! wp_verify_nonce( $_GET['_wpnonce'], 'turbo_addons_activate_nonce' ) ) {
            return; // Nonce verification failed
        }

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

      printf(
    '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
    wp_kses_post( sprintf(
        /* translators: 1: Plugin name (Turbo Addons), 2: Plugin dependency name (Elementor) */
        esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'turbo-addons' ),
        '<strong>' . esc_html__( 'Turbo Addons', 'turbo-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'turbo-addons' ) . '</strong>'
    ) )
);

    }

    /**
     * Admin Notice for Minimum Elementor Version
     * @since 1.0.0
     */
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) && ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'activate_plugin' ) ) ) {
            return; // Nonce verification failed
        }

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

      printf(
    '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
    wp_kses_post( sprintf(
        /* translators: 1: Plugin name (Turbo Addons), 2: Plugin dependency name (Elementor), 3: Minimum   required Elementor version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'turbo-addons' ),
        '<strong>' . esc_html__( 'Turbo Addons', 'turbo-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'turbo-addons' ) . '</strong>',
        esc_html( self::TURBO_ADDONS_MIN_ELEMENTOR_VERSION )
    ) )
);

    }

    /**
     * Admin Notice for Minimum PHP Version
     * @since 1.0.0
     */
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) && ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'activate_plugin' ) ) ) {
            return; // Nonce verification failed
        }

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

    printf(
    '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
    wp_kses_post( sprintf(
        /* translators: 1: Plugin name (Turbo Addons), 2: Software name (PHP), 3: Minimum required PHP version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'turbo-addons' ),
        '<strong>' . esc_html__( 'Turbo Addons', 'turbo-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'PHP', 'turbo-addons' ) . '</strong>',
        esc_html( self::TURBO_ADDONS_MIN_PHP_VERSION )
    ) )
);

    }
}

/**
 * Initializes the Plugin
 * @since 1.0.0
 */
function turbo_addons() {
    return Turbo_Addons::instance();
}

turbo_addons();
