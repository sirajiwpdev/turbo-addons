<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Animated_Text_Effects
 *
 * Custom widget for displaying animated text effects with customizable styles and dynamic content.
 */
class Animated_Text_Effects extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tr_animated_text_effects';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Animated Text Effects', 'turbo-addons' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-animated-headline';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'turbo-addons' ];
    }

    /**
     * Retrieve the list of scripts the widget depends on.
     *
     * @return array Widget scripts.
     */
    public function get_script_depends() {
        return [ 'tr-animated-text-effects-js' ];
    }

    /**
     * Retrieve the list of styles the widget depends on.
     *
     * @return array Widget styles.
     */
    public function get_style_depends() {
        return [ 'tr-animated-text-effects-css' ];
    }

    /**
     * Register widget controls.
     *
     * Adds input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls() {

        // Start Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Animation Style Control
        $this->add_control(
            'animation_style',
            [
                'label'   => __( 'Animation Style', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'typing'   => __( 'Typing', 'turbo-addons' ),
                    'flipping' => __( 'Flipping', 'turbo-addons' ),
                    'sliding'  => __( 'Sliding', 'turbo-addons' ),
                ],
                'default' => 'typing',
            ]
        );

        // Text Content Control
        $this->add_control(
            'text_content',
            [
                'label'       => __( 'Text Content', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'This is animated text', 'turbo-addons' ),
                'placeholder' => __( 'Enter your text here', 'turbo-addons' ),
            ]
        );

        // Highlighted Words Control
        $this->add_control(
            'highlighted_words',
            [
                'label'       => __( 'Highlighted Words', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __( 'animated', 'turbo-addons' ),
                'placeholder' => __( 'Enter words to highlight, separated by commas', 'turbo-addons' ),
            ]
        );

        // Animation Speed Control
        $this->add_control(
            'animation_speed',
            [
                'label'   => __( 'Animation Speed (ms)', 'turbo-addons' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        // Loop Animation Control
        $this->add_control(
            'loop_animation',
            [
                'label'        => __( 'Loop Animation', 'turbo-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'turbo-addons' ),
                'label_off'    => __( 'No', 'turbo-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // Start Dynamic Content Section
        $this->start_controls_section(
            'dynamic_content_section',
            [
                'label' => __( 'Dynamic Content', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Dynamic Content Source Control
        $this->add_control(
            'dynamic_content_source',
            [
                'label'   => __( 'Content Source', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none'                => __( 'None', 'turbo-addons' ),
                    'recent_posts'        => __( 'Recent Posts', 'turbo-addons' ),
                    'woocommerce_products'=> __( 'WooCommerce Products', 'turbo-addons' ),
                ],
                'default' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Generates the final HTML for the widget on the front-end.
     */
    protected function render() {
        $settings = $this->get_settings_for_display(); // Get widget settings

        // Split highlighted words by commas and trim spaces
        $highlighted_words = explode( ',', $settings['highlighted_words'] );
        $highlighted_words = array_map( 'trim', $highlighted_words );

        // Render widget HTML
        echo '<div class="tr-animated-text-effects" data-animation-style="' . esc_attr( $settings['animation_style'] ) . '" data-speed="' . esc_attr( $settings['animation_speed'] ) . '" data-loop="' . esc_attr( $settings['loop_animation'] ) . '">';
        echo '<span class="tr-animated-text">' . esc_html( $settings['text_content'] ) . '</span>';

        // Render highlighted words if available
        if ( ! empty( $highlighted_words ) ) {
            echo '<span class="tr-highlighted-words" data-words="' . esc_attr( wp_json_encode( $highlighted_words ) ) . '"></span>';
        }

        echo '</div>';
    }

    /**
     * Render the widget output in the editor.
     *
     * This function is empty as the widget doesn't support live preview in the editor.
     */
    protected function _content_template() {}
}

// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new Animated_Text_Effects() );
