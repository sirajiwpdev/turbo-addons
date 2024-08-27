<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Team widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'Team-id';
    }

    /**
     * Get widget title.
     *
     * Retrieve Team widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'TR Team', 'turbo-addons' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Team widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-person';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Team widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'turbo-addons' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'Team', 'turbo-addons' ];
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
        // Start Team Content Section
        $this->start_controls_section(
            'team_content',
            [
                'label' => __( 'Team Member', 'turbo-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_equal_height',
            [
                'label' => esc_html__( 'Equal Height?', 'turbo-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'disable' => esc_html__( 'Disable', 'turbo-addons' ),
                    'enable' => esc_html__( 'Enable', 'turbo-addons' ),
                ],
                'default' => 'disable',
                'prefix_class' => 'akijcement-equal-height-',
                'selectors' => [
                    '{{WRAPPER}}.akijcement-equal-height-enable, {{WRAPPER}}.akijcement-equal-height-enable .elementor-widget-container, {{WRAPPER}}.akijcement-equal-height-enable .dm-team' => 'height: 100%;',
                ],
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __( 'Name', 'turbo-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Name', 'turbo-addons' ),
                'default' => __( 'Mashil Nanchy', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => __( 'Position', 'turbo-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Position', 'turbo-addons' ),
                'default' => __('Web Designer', 'turbo-addons'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'email_id',
            [
                'label' => __( 'Email ID', 'turbo-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Email address', 'turbo-addons' ),
                'default' => __('info@example.com', 'turbo-addons'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => __( 'Phone Number', 'turbo-addons' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Phone Number', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'turbo-addons' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
        // End Team Content Section

        // Start Name Style Section
        $this->start_controls_section(
            'name_style',
            [
                'label' => __( 'Name', 'turbo-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __( 'Text Color', 'turbo-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-team__name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-team__name',
            ]
        );

        $this->end_controls_section();
        // End Name Style Section

        // Start Position Style Section
        $this->start_controls_section(
            'position_style',
            [
                'label' => __( 'Designation', 'turbo-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'position_color',
            [
                'label' => __( 'Color', 'turbo-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-team__designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'label' => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-team__designation',
            ]
        );

        $this->end_controls_section();
        // End Position Style Section

        // Start Email Style Section
        $this->start_controls_section(
            'member_email_style',
            [
                'label' => __( 'Email', 'turbo-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'short_info_color',
            [
                'label' => __( 'Color', 'turbo-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-team__email a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_info_typography',
                'label' => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-team__email a',
            ]
        );

        $this->end_controls_section();
        // End Email Style Section

        // Start Team Container Style Section
        $this->start_controls_section(
            'team_container_style',
            [
                'label' => __( 'Team Container', 'turbo-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'team_wrapper_box_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .akijcement-team',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'team_background',
                'label' => __( 'Background', 'turbo-addons' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .dm-team',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'team_border',
                'label' => __( 'Border', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-team',
            ]
        );

        $this->add_control(
            'team_padding',
            [
                'label' => __( 'Padding', 'turbo-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dm-team .dm-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'team_border_radius',
            [
                'label' => __( 'Border Radius', 'turbo-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dm-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'team_box_shadow',
                'label' => __( 'Box Shadow', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-team',
            ]
        );

        $this->end_controls_section();
        // End Team Container Style Section
    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Add render attributes for the wrapper
        $this->add_render_attribute( 'wrapper', 'class', 'dm-team' );

        // Include the team template
        if ( file_exists( __DIR__ . '/templates/team/style-one.php' ) ) {
            include __DIR__ . '/templates/team/style-one.php';
        }
    }

}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type(new Team());
