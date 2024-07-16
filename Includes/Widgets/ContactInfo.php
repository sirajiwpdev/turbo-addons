<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography, Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class ContactInfo
 * @package DesignMonks\AkijCement\Widgets
 */
class ContactInfo extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Team widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'akijcement-contact-info';
	}

	/**
	 * Get widget title.
	 * Retrieve Team widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'DM Contact Info', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Team widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'icon-icon-box';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Team widget belongs to.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'Team', 'akijcement member' ];
	}

	/**
	 * Register widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START Contact Info
		//============================================
		$this->start_controls_section( 'contact_content', [
			'label' => __( 'Contact Info', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'contact_title', [
			'label'       => __( 'Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'akijcement-core' ),
			'default'     => __( 'Dhaka Office', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'contact_address', [
			'label'       => __( 'Address', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 3,
			'placeholder' => __( 'Enter Contact Address', 'akijcement-core' ),
			'default'     => __( 'Akij House, L-02, 198 Bir Uttam Mir Shawkat Sarak, Tejgoan, Dhaka -1208, Bangladesh.', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'contact_email_one', [
			'label'       => __( 'Email ID', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 3,
			'placeholder' => __( 'Enter Email Id', 'akijcement-core' ),
			'default'     => __( 'operation.dm@akij.net', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'contact_email_two', [
			'label'       => __( 'Secondary Email ID', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 3,
			'placeholder' => __( 'Enter Secondary Email Id', 'akijcement-core' ),
			'default'     => __( 'technical.dm@akij.net', 'akijcement-core' ),
			'label_block' => true,
		] );

		// Phone
		$this->add_control( 'contact_phone_one', [
			'label'       => __( 'Phone Number', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 3,
			'placeholder' => __( 'Enter Phone Number', 'akijcement-core' ),
			'label_block' => true,
		] );


		$this->end_controls_section();
		// End Contact Information
		// =====================


		//============================================
		// Start Contact Style
		//============================================

		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Text Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-contact-info__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-contact-info__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label' => __( 'Contact Info', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'contact_info_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-contact-info__list li' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-contact-info__list li',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Contact Container Style Section
		// ================================

		$this->start_controls_section( 'contact_container_style', [
			'label' => __( 'Contact Container', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'contact_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-contact-info' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'contact_border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-contact-info',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'contact_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-contact-info',
			]
		);

		$this->add_control( 'contact_padding', [
			'label'      => __( 'Padding', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dm-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'contact_border-radius', [
			'label'      => __( 'Border Radius', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dm-contact-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		require __DIR__ . '/templates/contact/contact-info.php';
	}

}