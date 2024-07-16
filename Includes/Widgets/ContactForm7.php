<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Group_Control_Typography,
	Widget_Base,
	Controls_Manager
};

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

class ContactForm7 extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve alert widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'akijcement-contact-form';
	}


	public function get_title() {
		return __( 'DM Contact Form 7', 'akijcement-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'form_title',
			[
				'label'       => __( 'Form Title', 'akijcement-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( '(Optional) Title to search if no ID selected or cannot find by ID.', 'akijcement-core' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'f_id',
			[
				'label'   => __( 'Select a form', 'akijcement-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => \AkijCement_Helper::akijcement_get_contact_form7_forms(),
				'default' => '1'

			]
		);

		$this->end_controls_section();

		// Title Style Section
		$this->start_controls_section(
			'form_title_style_section',
			[
				'label' => __( 'Title', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'      => __( 'Spacing (Margin Bottom)', 'akijcement-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .contact-form-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Field Section
		//======================

		$this->start_controls_section(
			'field_style_section',
			[
				'label' => __( 'Field', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'field_placeholder_color',
			[
				'label'     => __( 'Placeholder Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit])::placeholder,
					{{WRAPPER}} .contact-form textarea::placeholder, {{WRAPPER}} .contact-form select::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'field_typography',
				'label'    => __( 'Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit]), textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'field_spacing',
			[
				'label'      => __( 'Spacing (Margin Bottom)', 'akijcement-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} input:not([type=checkbox]):not([type=submit]), {{WRAPPER}} textarea' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_height',
			[
				'label'      => __( 'Input Height', 'akijcement-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} input:not([type=checkbox]):not([type=submit]), {{WRAPPER}} .contact-form select' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'textarea_height',
			[
				'label'      => __( 'Textarea Height', 'akijcement-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} textarea' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_field_style' );

		$this->start_controls_tab(
			'tab_field_normal',
			[
				'label' => __( 'Normal', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'field_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit]),
					{{WRAPPER}} .contact-form textarea,
					{{WRAPPER}} .contact-form select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'field_background_color',
			[
				'label'     => __( 'Background Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit]),
					{{WRAPPER}} .contact-form textarea, {{WRAPPER}} .contact-form select' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input:not([type=checkbox]), {{WRAPPER}} .contact-form textarea',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'field_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input:not([type=checkbox]), {{WRAPPER}} .contact-form textarea',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_hover',
			[
				'label' => __( 'Focus', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'field_color_focus',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit]),
					{{WRAPPER}} .contact-form textarea,
					{{WRAPPER}} .contact-form select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'field_background_color_focus',
			[
				'label'     => __( 'Background Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input:not([type=checkbox]):not([type=submit]):focus,
					{{WRAPPER}} .contact-form textarea:focus, {{WRAPPER}} .contact-form select:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border_focus',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input:not([type=checkbox]):focus, {{WRAPPER}} .contact-form textarea:focus',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'field_focus_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input:not([type=checkbox]):focus, {{WRAPPER}} .contact-form textarea:focus',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// Label Style Section
		//======================
		$this->start_controls_section(
			'label_style_section',
			[
				'label' => __( 'Label', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .contact-form label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'label_margin',
			[
				'label'      => __( 'Margin', 'akijcement-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-form .wpcf7-form-control-wrap' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();


		// Style Submit Button Section
		//======================

		$this->start_controls_section(
			'button_style_section',
			[
				'label' => __( 'Button', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typography',
				'label'    => __( 'Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input[type=submit]',
			]
		);

		// Space Top
		$this->add_control(
			'btn_space_top',
			[
				'label'      => __( 'Space Top', 'akijcement-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-form input[type=submit]' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-form input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border Radius
		$this->add_control(
			'btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-form input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_btn_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input[type=submit]' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label'     => __( 'Background Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input[type=submit]' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input[type=submit]',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'btn_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input[type=submit]',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input[type=submit]:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-form input[type=submit]:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input[type=submit]:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'btn_hover_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .contact-form input[type=submit]:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$title    = $settings['form_title'];
		$attrs    = '';
		if ( $settings['f_id'] ) {
			$attrs .= ' id="' . $settings['f_id'] . '"';
		} elseif ( $settings['f_title'] ) {
			$attrs .= ' title="' . $settings['f_title'] . '"';
		}

		$shortcode = do_shortcode( '[contact-form-7' . $attrs . ']' );
		?>
		<div class="contact-form contact-form-boxed">
			<?php if ( ! empty( $title ) ) : ?>
				<h3 class="contact-form-title"><?php echo $title; ?></h3>
			<?php endif;
			echo $shortcode;
			?>
		</div>
		<?php
	}
}


// q:
