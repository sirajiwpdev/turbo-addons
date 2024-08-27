<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Testimonial widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'Testimonial-id';
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve Testimonial widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TR Testimonial', 'turbo-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Testimonial widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Testimonial widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
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
		// Testimonial Controls
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__( 'Testimonial', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'turbo-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'one' => esc_html__( 'Layout 1', 'turbo-addons' ),
					'two' => esc_html__( 'Layout 2', 'turbo-addons' ),
				],
				'default' => 'one',
			]
		);

		$this->add_control(
			'enable_separator',
			[
				'label'        => esc_html__( 'Show Separator', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_responsive_control(
			'separator_space',
			[
				'label'      => esc_html__( 'Separator Space', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-separator' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__( 'Separator Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-separator' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'enable_separator' => 'yes',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Author Image', 'turbo-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Mominul', 'turbo-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Full-Stack Developer', 'turbo-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'rating',
			[
				'label'   => __( 'Rating Number', 'turbo-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '50',
				'options' => [
					'10' => __( '1 Star', 'turbo-addons' ),
					'20' => __( '2 Star', 'turbo-addons' ),
					'30' => __( '3 Star', 'turbo-addons' ),
					'40' => __( '4 Star', 'turbo-addons' ),
					'50' => __( '5 Star', 'turbo-addons' ),
				],
			]
		);

		$repeater->add_control(
			'review_content',
			[
				'label'      => __( 'Review Content', 'turbo-addons' ),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => __( '“If you need any help or assistance we\'d be happy to help. Just reply to this email. Trusted by Agency proud to work many well known brands”', 'turbo-addons' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'       => __( 'Testimonial Items', 'turbo-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'image'          => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'           => __( 'Alexa Loverty', 'turbo-addons' ),
						'designation'    => __( 'Product Designer', 'turbo-addons' ),
						'review_content' => __( 'Pellentesque nec nam aliquam sem. Ultricies lacus sed turpis tincidunt id aliquet risus. Consequat nisl vel pretium lectus quam id. Velit scelerisque in dictum non consectetur.', 'turbo-addons' ),
					],
					[
						'image'          => [
							'url' => Utils::get_placeholder_image_src( 'hexa_testimonial_three' ),
						],
						'name'           => __( 'Maxine Butler', 'turbo-addons' ),
						'designation'    => __( 'Product Designer', 'turbo-addons' ),
						'review_content' => __( 'Pellentesque nec nam aliquam sem. Ultricies lacus sed turpis tincidunt id aliquet risus. Consequat nisl vel pretium lectus quam id. Velit scelerisque in dictum non consectetur.', 'turbo-addons' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		// Slider Control Section
		$this->start_controls_section(
			'settingd_section',
			[
				'label' => esc_html__( 'Slider Control', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'slides_per_view',
			[
				'label'   => esc_html__( 'Slider Per View', 'turbo-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => esc_html__( '1', 'turbo-addons' ),
					'2' => esc_html__( '2', 'turbo-addons' ),
					'3' => esc_html__( '3', 'turbo-addons' ),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'        => esc_html__( 'Navigation', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'        => esc_html__( 'Pagination', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'centered_slides',
			[
				'label'        => esc_html__( 'Center Slide', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'turbo-addons' ),
				'label_off'    => esc_html__( 'No', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Off', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'turbo-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 700,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Off', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay_time',
			[
				'label'     => __( 'Autoplay Time', 'turbo-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 9000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'space_between',
			[
				'label'   => esc_html__( 'Space Between', 'turbo-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 30,
			]
		);

		$this->end_controls_section();

		// Style Sections
		// Avatar Style
		$this->start_controls_section(
			'avatar_section',
			[
				'label'     => __( 'Avatar', 'turbo-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'two',
				],
			]
		);

		$this->add_control(
			'avatar_spacing',
			[
				'label'      => esc_html__( 'Spacing (Margin Bottom)', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-fade .avatar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'avatar_padding',
			[
				'label'      => esc_html__( 'Padding', 'turbo-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-fade .avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'avatar_border',
				'selector' => '{{WRAPPER}} .turbo-testimonial-wrapper-two .swiper-slide.swiper-slide-active .testimonial-fade .avatar',
			]
		);

		$this->end_controls_section();

		// Name Style
		$this->start_controls_section(
			'name_section',
			[
				'label' => __( 'Name', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => __( 'Typography', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Designation Style
		$this->start_controls_section(
			'designation_section',
			[
				'label' => __( 'Designation', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desi_typography',
				'label'    => __( 'Typography', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .designation',
			]
		);

		$this->add_control(
			'desi_color',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Separator Style
		$this->start_controls_section(
			'separator_style_section',
			[
				'label' => __( 'Separator', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sep_color',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-separator' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Review Content Style
		$this->start_controls_section(
			'review_section',
			[
				'label' => __( 'Review Content', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'review_typography',
				'label'    => __( 'Typography', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .testimonial p',
			]
		);

		$this->add_control(
			'review_color',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Slider Control Style Section
		$this->start_controls_section(
			 'control_section',
			 [
				 'label' => __( 'Slider Control', 'turbo-addons' ),
				 'tab'   => Controls_Manager::TAB_STYLE,
			 ]
		);

		$this->add_control(
			'nav_width',
			[
				'label'      => esc_html__( 'Nav Height/Width', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_font_size',
			[
				'label'      => esc_html__( 'Nav Font Size', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_border_radius',
			[
				'label'      => esc_html__( 'Nav Border Radius', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_nav_style' );

		$this->start_controls_tab(
			'tab_nav_normal',
			[
				'label' => __( 'Normal', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'slider_nav_color',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_bg_color',
			[
				'label'     => __( 'Background Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'slider_control_border',
				'selector' => '{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow',
				'label'    => __( 'Box Shadow', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next',
			]
		);

		$this->add_control(
			'pagination_bg_color',
			[
				'label'     => __( 'Pagination BG Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_nav_hover',
			[
				'label' => __( 'Hover', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'nav_color_hover',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_color_bg_hover',
			[
				'label'     => __( 'Background Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_control_hover',
			[
				'label'     => __( 'Border Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover',
			]
		);

		$this->add_control(
			'slider_pagination_active_color',
			[
				'label'     => __( 'Pagination Active BG Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Testimonial Container Style
		$this->start_controls_section(
			'testimonial_section',
			[
				'label' => __( 'Testimonial Container', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testimonial_background',
				'label'    => __( 'Background', 'turbo-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .testimonial',
			]
		);

		$this->add_control(
			'testimonial_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'testimonial_border_radius',
			[
				'label'      => __( 'Border Radius', 'turbo-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'testimonial_shadow_hover',
				'label'    => __( 'Box Shadow', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .testimonial',
			]
		);

		$this->add_control(
			'testimonial_overflow',
			[
				'label'        => __( 'Overflow', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'turbo-addons' ),
				'label_off'    => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
				'selectors'    => [
					'{{WRAPPER}} .turbo-testimonial' => 'overflow: visible !important;',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$testimonials = $settings['testimonials'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'turbo-testimonial',
		] );

		// Testimonial Style
		$this->add_render_attribute( 'testimonial', 'class', 'testimonial' );

		if ( ! empty( $settings['layout'] ) ) {
			// Layout
			$this->add_render_attribute( 'wrapper', 'class', 'turbo-testimonial--' . $settings['layout'] );
			$this->add_render_attribute( 'testimonial', 'class', 'testimonial--' . $settings['layout'] );
		}

		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-testi', wp_json_encode( $slider_options ) );

		require __DIR__ . '/templates/testimonial/layout-' . $settings['layout'] . '.php';
	}

	/**
	 * Get slider options based on the widget settings.
	 *
	 * @since 1.0.0
	 * @param array $settings Widget settings.
	 * @return array Slider options.
	 */
	protected function get_slider_options( array $settings ) {
		$slider_options = [];

		// Loop
		if ( 'yes' === $settings['loop'] ) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}

		// Centered Slides
		if ( 'yes' === $settings['centered_slides'] ) {
			$slider_options['centeredSlides'] = true;
		}

		// Breakpoints
		$slider_options['breakpoints'] = [
			'1024' => [
				'slidesPerView' => $settings['slides_per_view'],
				'spaceBetween'  => $settings['space_between'],
			],
			'991'  => [
				'slidesPerView' => 1,
				'spaceBetween'  => $settings['space_between'],
			],
			'320'  => [
				'slidesPerView' => 1,
			],
		];

		// Auto Play
		if ( 'yes' === $settings['autoplay'] ) {
			$slider_options['autoplay'] = [
				'delay'                => $settings['autoplay_time'],
				'disableOnInteraction' => false,
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => 99999999999,
			];
		}

		if ( 'yes' === $settings['navigation'] ) {
			$slider_options['navigation'] = [
				'nextEl' => '.testimonial-next',
				'prevEl' => '.testimonial-prev',
			];
		}

		if ( 'yes' === $settings['pagination'] ) {
			$slider_options['pagination'] = [
				'el'        => '.testimonial-pagination',
				'clickable' => true,
			];
		}

		return $slider_options;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Testimonial() );
