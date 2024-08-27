<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class About_Image
 *
 * Custom widget for displaying an about image with customizable experience text and years.
 */
class About_Image extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'about-image-id';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'About Image', 'turbo-addons' );
    }

    /**
     * Retrieve the list of scripts the widget depends on.
     *
     * @return array Widget scripts.
     */
    public function get_script_depends() {
        return [ 'turbo-script' ];
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-person';
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
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        // Start Content Section for Image and Experience
        $this->start_controls_section(
            'about_image_content',
            [
                'label' => __( 'Team Member', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add Image Control
        $this->add_control(
            'image',
            [
                'label'   => __( 'Choose Image', 'turbo-addons' ),
                'type'    => Controls_Manager::MEDIA,
            ]
        );

        // Add Experience Text Control
        $this->add_control(
            'experience',
            [
                'label'       => __( 'Experience Text', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter experience text', 'turbo-addons' ),
                'default'     => __( 'Years Experienced', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        // Add Years Control
        $this->add_control(
            'years',
            [
                'label'       => __( 'Years', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter experience year', 'turbo-addons' ),
                'default'     => __( '20+', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Start Style Section for Experience Text
        $this->start_controls_section(
            'name_style',
            [
                'label' => __( 'Experience Text', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add Color Control for Experience Text
        $this->add_control(
            'experience_color',
            [
                'label'     => __( 'Color', 'turbo-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-about-image__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add Typography Control for Experience Text
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'experience_typography',
                'label'    => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-about-image__title',
            ]
        );

        $this->end_controls_section();

        // Start Style Section for Years
        $this->start_controls_section(
            'years_style',
            [
                'label' => __( 'Years', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add Color Control for Years
        $this->add_control(
            'years_color',
            [
                'label'     => __( 'Color', 'turbo-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-about-image__years' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add Typography Control for Years
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'years_typography',
                'label'    => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-about-image__years',
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

        ?>
        <div class="dm-about-image">
            <!-- Image Section -->
            <div class="dm-about-image__image">
                <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="">
            </div>
            <!-- Content Section -->
            <div class="dm-about-image__content">
                <h3 class="dm-about-image__title"><?php echo esc_html( $settings['experience'] ); ?></h3>
                <h2 class="dm-about-image__years"><?php echo esc_html( $settings['years'] ); ?></h2>
            </div>
        </div>
        <?php
    }
}

// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new About_Image() );
