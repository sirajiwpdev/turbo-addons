<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{
	Controls_Manager,
	Widget_Base
};

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class PopupVideo
 *
 * @package DesignMonks\AkijCement\Widgets
 */
class PopupVideo extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akijcement-popup-video';
	}


	public function get_title() {
		return __( 'DM Popup Video', 'hexafy-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-play';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Popup Video Button', 'hexafy-core' ),
			]
		);

		$this->add_control(
			'video_link',
			[
				'label'       => __( 'Video Link', 'hexafy-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'hexafy-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'hexafy-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'hexafy-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'hexafy-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'text-align: {{VALUE}};'
				],
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		// Style Section
		//======================
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => __( 'Button', 'hexafy-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'hexafy-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-btn' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Background', 'hexafy-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-btn' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .popup-btn:before, {{WRAPPER}} .popup-btn:after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_options',
			[
				'label' => __( 'Hover', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Color', 'hexafy-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'icon_bg_hover',
			[
				'label' => __( 'Background', 'hexafy-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-btn:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .popup-btn:hover:before, {{WRAPPER}} .popup-btn:hover:after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render( ) {
		$settings = $this->get_settings_for_display();
		$link_video = $settings['video_link'];
		?>

		<div class="play-button">
			<a class="popup-btn popup-video" href="<?php echo esc_url( $link_video ) ?>"><i class="fas fa-play"></i></a>
		</div>

		<?php
	}
}
