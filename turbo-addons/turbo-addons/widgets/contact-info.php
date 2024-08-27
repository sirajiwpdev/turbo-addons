<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class ContactInfo
 *
 * Elementor widget for displaying contact information.
 *
 * @since 1.0.0
 */
class ContactInfo extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name for use in the editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'TurboContact-id';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title for use in the editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'TR Contact Info', 'turbo-addons' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon for use in the editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-headphones';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
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
     * Retrieve the list of keywords the widget belongs to for improved search.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'Contact', 'turbo', 'info' ];
    }

    /**
     * Register widget controls.
     *
     * Adds input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        // Start Contact Info Section
        $this->start_controls_section(
            'contact_content',
            [
                'label' => __( 'Contact Info', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_title',
            [
                'label'       => __( 'Title', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Title', 'turbo-addons' ),
                'default'     => __( 'Dhaka Office', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_address',
            [
                'label'       => __( 'Address', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'placeholder' => __( 'Enter Contact Address', 'turbo-addons' ),
                'default'     => __( 'Akij House, L-02, 198 Bir Uttam Mir Shawkat Sarak, Tejgoan, Dhaka -1208, Bangladesh.', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_email_one',
            [
                'label'       => __( 'Email ID', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'placeholder' => __( 'Enter Email ID', 'turbo-addons' ),
                'default'     => __( 'operation.dm@akij.net', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_email_two',
            [
                'label'       => __( 'Secondary Email ID', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'placeholder' => __( 'Enter Secondary Email ID', 'turbo-addons' ),
                'default'     => __( 'technical.dm@akij.net', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_phone_one',
            [
                'label'       => __( 'Phone Number', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'placeholder' => __( 'Enter Phone Number', 'turbo-addons' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        // End Contact Info Section

        // Start Title Style Section
        $this->start_controls_section(
            'name_style',
            [
                'label' => __( 'Title', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Text Color', 'turbo-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-contact-info__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'label'    => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-contact-info__title',
            ]
        );

        $this->end_controls_section();
        // End Title Style Section

        // Start Contact Info Style Section
        $this->start_controls_section(
            'position_style',
            [
                'label' => __( 'Contact Info', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contact_info_color',
            [
                'label'     => __( 'Color', 'turbo-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-contact-info__list li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'position_typography',
                'label'    => __( 'Typography', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-contact-info__list li',
            ]
        );

        $this->end_controls_section();
        // End Contact Info Style Section

        // Start Contact Container Style Section
        $this->start_controls_section(
            'contact_container_style',
            [
                'label' => __( 'Contact Container', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contact_bg_color',
            [
                'label'     => __( 'Background Color', 'turbo-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dm-contact-info' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'contact_border',
                'label'    => __( 'Border', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-contact-info',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'contact_box_shadow',
                'label'    => __( 'Box Shadow', 'turbo-addons' ),
                'selector' => '{{WRAPPER}} .dm-contact-info',
            ]
        );

        $this->add_control(
            'contact_padding',
            [
                'label'      => __( 'Padding', 'turbo-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dm-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'contact_border-radius',
            [
                'label'      => __( 'Border Radius', 'turbo-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dm-contact-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // End Contact Container Style Section
    }

    /**
     * Render the widget output on the frontend.
     *
     * Generate the final HTML for displaying the contact information on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Safely include the template file for rendering the contact info.
        include __DIR__ . '/templates/contact/contact-info.php';
    }
}

// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new ContactInfo() );
