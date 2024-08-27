<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class LogoList extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve alert widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'Logolist-id';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve alert widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'TR LogoList', 'turbo-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve alert widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-logo';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'turbo-addons' ];
	}

	/**
	 * Register alert widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'logo_content',
			[
				'label' => __( 'Logo List', 'turbo-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'logo_image',
			[
				'label'   => __( 'Choose Logo Image', 'turbo-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'brand_name',
			[
				'label'       => __( 'Brand Name', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'turbo-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'turbo-addons' ),
				'show_external' => true,
				'default'       => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'logo_lists',
			[
				'label'       => __( 'Logo List', 'turbo-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'brand_name' => __( 'Brand Name', 'turbo-addons' ),
						'logo_image' => [
							'url' => plugin_dir_url( __DIR__ ) . 'widgets/images/client/logo1.png',
						],
					],
					[
						'brand_name' => __( 'Brand Name', 'turbo-addons' ),
						'logo_image' => [
							'url' => plugin_dir_url( __DIR__ ) . 'widgets/images/client/logo2.png',
						],
					],
					[
						'brand_name' => __( 'Brand Name', 'turbo-addons' ),
						'logo_image' => [
							'url' => plugin_dir_url( __DIR__ ) . 'widgets/images/client/logo3.png',
						],
					],
					[
						'brand_name' => __( 'Brand Name', 'turbo-addons' ),
						'logo_image' => [
							'url' => plugin_dir_url( __DIR__ ) . 'widgets/images/client/logo4.png',
						],
					],
					[
						'brand_name' => __( 'Brand Name', 'turbo-addons' ),
						'logo_image' => [
							'url' => plugin_dir_url( __DIR__ ) . 'widgets/images/client/logo5.png',
						],
					],
				],
				'title_field' => '{{{ brand_name }}}',
			]
		);

		$this->end_controls_section();

		// Style: Box Container
		$this->start_controls_section(
			'brand_container_section',
			[
				'label' => __( 'Box Container', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'info_box_shadow',
				'label'    => __( 'Box Shadow', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .dm-logo-list__item',
			]
		);

		$this->add_responsive_control(
			'brand_container_padding',
			[
				'label'      => __( 'Padding', 'turbo-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .dm-logo-list__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'turbo-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .dm-logo-list__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'brand_gap',
			[
				'label'      => __( 'Gap Between Brands', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dm-logo-list' => 'column-gap: {{SIZE}}{{UNIT}}; gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'brand_min_height',
			[
				'label'      => __( 'Min Height', 'turbo-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dm-logo-list__item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'style_tabs' );

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'brand_container_bg_color',
			[
				'label'     => __( 'Background Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-logo-list__item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'brand_container_border',
				'label'    => __( 'Border', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .dm-logo-list__item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'brand_container_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-logo-list__item:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'brand_container_border_hover',
				'label'    => __( 'Border', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .dm-logo-list__item:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		if ( $settings['logo_lists'] ) { ?>
			<div class="client-logo-wrapper">
				<ul class="dm-logo-list">
					<?php foreach ( $settings['logo_lists'] as $item ) : ?>
						<li class="dm-logo-list__item" data-bs-original-title="<?php echo esc_attr( $item['brand_name'] ); ?>">
							<a href="<?php echo esc_url( $item['link']['url'] ); ?>" <?php echo $item['link']['is_external'] ? 'target="_blank"' : ''; ?> <?php echo $item['link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
								<img src="<?php echo esc_url( $item['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['brand_name'] ); ?>">
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
		}
	}
}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new LogoList() );
