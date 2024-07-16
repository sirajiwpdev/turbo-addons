<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Group_Control_Box_Shadow,
	Utils,
	Group_Control_Background,
	Group_Control_Border,

};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class LogoList
 * @package DesignMonks\AkijCement\Widgets
 */
class LogoList extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'akijcement-logo-lists';
	}


	/**
	 * Get widget title.
	 * Retrieve alert widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'DM Logo List', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve alert widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {

		return 'eicon-logo';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Register alert widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section( 'logo_content', [
			'label' => __( 'Logo List', 'akijcement-core' ),
		] );


		$repeater = new Repeater();

		$repeater->add_control( 'logo_image', [
			'label'   => __( 'Choose Logo Image', 'akijcement-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$repeater->add_control( 'brand_name', [
			'label'       => __( 'Brand Name', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'akijcement-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'akijcement-core' ),
				'show_external' => true,
				'default'       => [
					'url' => '#',
				],
			]
		);

		$this->add_control( 'logo_lists', [
			'label'       => __( 'Logo List', 'akijcement-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'brand_name' => __( 'Brand Name', 'akijcement-core' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo1.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'akijcement-core' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo2.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'akijcement-core' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo3.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'akijcement-core' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo4.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'akijcement-core' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo5.png'
					]
				],
			],
			'title_field' => '{{{ brand_name }}}',
		] );


		$this->end_controls_section();

		// Style Box  Container
		//==========================
		$this->start_controls_section( 'brand_container_section', [
			'label' => __( 'Box Container', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'info_box_shadow',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-logo-list__item',
		] );


		// Padding
		$this->add_responsive_control( 'brand_container_padding', [
			'label'      => __( 'Padding', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dm-logo-list__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'border-radius', [
			'label'      => __( 'Border Radius', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dm-logo-list__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Gap Between Brand with display grid
		$this->add_responsive_control( 'brand_gap', [
			'label'      => __( 'Gap Between Brand', 'akijcement-core' ),
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
		] );

		// Min Height
		$this->add_responsive_control( 'brand_min_height', [
			'label'      => __( 'Min Height', 'akijcement-core' ),
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
		] );

		// Tab Normal
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control( 'brand_container_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-logo-list__item' => 'background-color: {{VALUE}};',
			],
		] );

		// Border
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'brand_container_border',
			'label'    => __( 'Border', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-logo-list__item',
		] );


		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);


		$this->add_control( 'brand_container_hover_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-logo-list__item:hover' => 'background-color: {{VALUE}};',
			],
		] );

		// Border
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'brand_container_border_hover',
			'label'    => __( 'Border', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-logo-list__item:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['logo_lists'] ) { ?>
			<div class="client-logo-wrapper">
				<ul class="dm-logo-list">
					<?php foreach ( $settings['logo_lists'] as $item ) { ?>
						<li class="dm-logo-list__item" data-bs-original-title="<?php echo esc_attr( $item['brand_name'] ) ?>">
							<a href="#">
								<img src="<?php echo esc_url( $item['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['brand_name'] ) ?>">
							</a>

						</li>
					<?php } ?>
				</ul>
			</div>
			<!-- /.client-logo-wrapper -->
			<?php
		}
	}
}