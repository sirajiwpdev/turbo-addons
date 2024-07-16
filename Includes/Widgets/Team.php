<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Team
 *
 * @package DesignMonks\AkijCement\Widgets
 */

class Team extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akijcement-team';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Team widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'DM Team', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Team widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
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
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'Team', 'akijcement member' ];
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

		//============================================
		// START TEAME CONTENT
		//============================================
		$this->start_controls_section( 'team_content', [
			'label' => __( 'Team Member', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'enable_equal_height',
			[
				'label'        => esc_html__( 'Equal Height?', 'elementskit-lite' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'disable' => esc_html__( 'Disable', 'elementskit-lite' ),
					'enable'  => esc_html__( 'Enable', 'elementskit-lite' ),
				],
				'default'      => 'disable',
				'prefix_class' => 'akijcement-equal-height-',
				'selectors'    => [
					'{{WRAPPER}}.akijcement-equal-height-enable, {{WRAPPER}}.akijcement-equal-height-enable .elementor-widget-container, {{WRAPPER}}.akijcement-equal-height-enable .dm-team' => 'height: 100%;',
				],
			]
		);


		$this->add_control( 'name', [
			'label'       => __( 'Name', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Name', 'akijcement-core' ),
			'default'     => __( 'Mashil Nanchy', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'position', [
			'label'       => __( 'Position', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Position', 'akijcement-core' ),
			'default'     => __('Web Designer', 'akijcement-core'),
			'label_block' => true,
		] );

		$this->add_control( 'email_id', [
			'label'       => __( 'Email ID', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Email address', 'akijcement-core' ),
			'default'     => __('info@example.com', 'akijcement-core'),
			'label_block' => true,
		] );

		$this->add_control( 'phone', [
			'label'       => __( 'Phone Number', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Phone Number', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Choose Image', 'akijcement-core' ),
			'type'    => Controls_Manager::MEDIA,
		] );


		$this->end_controls_section();
		// End Team Content
		// =====================


		//============================================
		// START TEAME STYLE
		//============================================

		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Name', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'name_color', [
			'label'     => __( 'Text Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-team__name' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-team__name',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label' => __( 'Designation', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'position_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-team__designation' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-team__designation',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Description Style
		// =====================
		$this->start_controls_section( 'member_email_style', [
			'label' => __( 'Email', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'short_info_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-team__email a' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'short_info_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-team__email a',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Team Container Style Section
		// ================================

		$this->start_controls_section( 'team_container_style', [
			'label' => __( 'Team Container', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_wrapper_box_shadow',
				'label' => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .akijcement-team',
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_background',
				'label' => __( 'Background', 'akijcement-core' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .dm-team',
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_border',
				'label' => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-team',
			]
		);

		$this->add_control( 'team_padding', [
			'label'      => __( 'Padding', 'dm-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dm-team .dm-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'team_border-radius', [
			'label'      => __( 'Border Radius', 'dm-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dm-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_box_shadow',
				'label' => __( 'Box Shadow', 'dm-core' ),
				'selector' => '{{WRAPPER}} .dm-team',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'dm-team' );


		require __DIR__ . '/templates/team/style-one.php';
	}

}