<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Logo_Carousel_Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     */
    public function get_name() {
        return 'myewpricing-logo-carousel-id';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     */
    public function get_title() {
        return esc_html__( 'Logo Carousel', 'turbo-addons' );
    }

    /**
     * Get script dependencies.
     *
     * @return array Script dependencies.
     * @since 1.0.0
     * @access public
     */
    public function get_script_depends() {
        return [ 'turbo-script' ];
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     */
    public function get_icon() {
        return 'eicon-slider-album';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     */
    public function get_categories() {
        return [ 'turbo-addons' ];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        // Content Settings Section
        $this->start_controls_section(
            'content_settings',
            [
                'label' => __( 'Content Settings', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Slider Repeater Control
        $repeater = new Repeater();
        $repeater->add_control(
            'slider_title',
            [
                'label'       => __( 'Title', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Slider Title #1', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_image',
            [
                'label'   => __( 'Image', 'turbo-addons' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'slider',
            [
                'label'       => __( 'Slider Items', 'turbo-addons' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'slider_title' => __( 'Slider title #1', 'turbo-addons' ),
                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
            ]
        );

        $this->end_controls_section();

        // Slider Settings Section
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __( 'Slider Settings', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'        => __( 'Loop', 'turbo-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'turbo-addons' ),
                'label_off'    => __( 'No', 'turbo-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'        => __( 'Dots', 'turbo-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'turbo-addons' ),
                'label_off'    => __( 'No', 'turbo-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'navs',
            [
                'label'        => __( 'Navs', 'turbo-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'turbo-addons' ),
                'label_off'    => __( 'No', 'turbo-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'margin',
            [
                'label'       => __( 'Margin', 'turbo-addons' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 10,
                'placeholder' => __( 'Enter the margin between slides', 'turbo-addons' ),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Generates the final HTML on the frontend using settings from the editor.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'logo_carousel_options',
            [
                'id'          => 'logo-carousel-' . $this->get_id(),
                'data-loop'   => $settings['loop'] ? 'true' : 'false',
                'data-dots'   => $settings['dots'] ? 'true' : 'false',
                'data-navs'   => $settings['navs'] ? 'true' : 'false',
                'data-margin' => $settings['margin'],
            ]
        );
        ?>
    <div class="owl-carousel owl-theme logo-carousel" <?php echo esc_attr( $this->get_render_attribute_string( 'logo_carousel_options' ) ); ?>>

    <?php foreach ( $settings['slider'] as $slide ) : ?>
        <div class="item">
            <img src="<?php echo esc_url( $slide['slider_image']['url'] ); ?>" alt="<?php echo esc_attr( $slide['slider_title'] ); ?>" />
        </div>
    <?php endforeach; ?>
</div>

        <?php
    }

    /**
     * Render widget output in the editor.
     *
     * Generates the live preview in the editor.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template() {
        ?>
        <#
            view.addRenderAttribute(
                'logo_carousel_options',
                {
                    'id': 'logo-carousel-id',
                    'data-loop': settings.loop ? 'true' : 'false',
                    'data-dots': settings.dots ? 'true' : 'false',
                    'data-navs': settings.navs ? 'true' : 'false',
                    'data-margin': settings.margin,
                }
            );
        #>
        <# if ( settings.slider.length ) { #>
        <div class="owl-carousel owl-theme logo-carousel" {{{ view.getRenderAttributeString( 'logo_carousel_options' ) }}}>
            <# _.each( settings.slider, function( slide ) { #>
                <div class="item">
                    <img src="{{ slide.slider_image.url }}" alt="{{ slide.slider_title }}" />
                </div>
            <# } ) #>
        </div>
        <# } #>
        <?php
    }

}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new Logo_Carousel_Widget() );
