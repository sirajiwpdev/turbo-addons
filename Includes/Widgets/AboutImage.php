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

class AboutImage extends Widget_Base {

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
		return 'dm-about-image';
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
		return __( 'DM About Image', 'akijcement-core' );
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
		return [ 'About', 'image' ];
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
		$this->start_controls_section( 'about-image_content', [
			'label' => __( 'Team Member', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Choose Image', 'akijcement-core' ),
			'type'    => Controls_Manager::MEDIA,
		] );

		$this->add_control( 'experience', [
			'label'       => __( 'Name', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter experience text', 'akijcement-core' ),
			'default'     => __( 'Years Experienced', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'years', [
			'label'       => __( 'Years', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter experience year', 'akijcement-core' ),
			'default'     => __('20+', 'akijcement-core'),
			'label_block' => true,
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
			'label' => __( 'Experience Text', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'experience_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-about-image__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'experience_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-about-image__title',
		] );

		$this->end_controls_section();

		// Start Years Style
		$this->start_controls_section( 'years_style', [
			'label' => __( 'Years', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'years_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-about-image__years' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'years_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-about-image__years',
		] );

		$this->end_controls_section();


	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
			<div class="dm-about-image">
				<div class="dm-about-image__image">
					<img src="<?php echo $settings['image']['url']; ?>" alt="">
				</div>
				<div class="dm-about-image__content">
					<h3 class="dm-about-image__title"><?php echo $settings['experience']; ?></h3>
					<h2 class="dm-about-image__years"><?php echo $settings['years']; ?></h2>
				</div>
			</div>
			<!-- /.dm-about-image -->
		<?php
	}

}