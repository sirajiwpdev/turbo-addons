<?php

namespace DesignMonks\AkijCement\Widgets;

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use Elementor\{Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Repeater
};

/**
 * Class Accordion
 *
 * @package DesignMonks\AkijCement\Widgets
 */
class Accordion extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Accordion widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'akijcement-accordion';
	}


	/**
	 * Get widget title.
	 *
	 * Retrieve Accordion widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'DM Accordion', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Accordion widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-accordion';
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

	/**
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 *
	 */

	public function get_keywords() {
		return [ 'accordion', 'akijcement', 'akijcement' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Content', 'akijcement-core' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'accordion_title', [
			'label'       => __( 'Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'List Title', 'akijcement-core' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'accordion_content', [
			'label'      => __( 'Content', 'akijcement-core' ),
			'type'       => Controls_Manager::WYSIWYG,
			'default'    => __( 'List Content', 'akijcement-core' ),
			'show_label' => false,
		] );

		$repeater->add_control(
			'show_icon',
			[
				'label'        => __( 'Show Icon', 'akijcement-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'your-plugin' ),
				'label_off'    => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$repeater->add_control( 'accordion_icon', [
			'label'     => __( 'Icon', 'akijcement-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-star',
				'library' => 'solid',
			],
			'condition' => [ 'show_icon' => 'yes' ]
		] );


		$this->add_control( 'tt-accordion', [
			'label'       => __( 'Accordion List', 'akijcement-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'accordion_title'   => __( 'Is SEO a risky and time consuming proposition?', 'akijcement-core' ),
					'accordion_content' => __( 'There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that  words which don\'t look even slightly believable. If you are Lorem Ipsum you need to be sure there isn\'t anything ready too much embarrassing.', 'akijcement-core' ),
				],
				[
					'accordion_title'   => __( 'How to choose a perfect digital marketing plan?', 'akijcement-core' ),
					'accordion_content' => __( 'There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that  words which don\'t look even slightly believable. If you are Lorem Ipsum you need to be sure there isn\'t anything ready too much embarrassing.', 'akijcement-core' ),
				],
				[
					'accordion_title'   => __( 'Is it feasible to go for a complete website audit?', 'akijcement-core' ),
					'accordion_content' => __( 'There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that  words which don\'t look even slightly believable. If you are Lorem Ipsum you need to be sure there isn\'t anything ready too much embarrassing.', 'akijcement-core' ),
				],
				[
					'accordion_title'   => __( 'How to go about with a bespoke SMO strategy?', 'akijcement-core' ),
					'accordion_content' => __( 'There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that  words which don\'t look even slightly believable. If you are Lorem Ipsum you need to be sure there isn\'t anything ready too much embarrassing.', 'akijcement-core' ),
				],
				[
					'accordion_title'   => __( 'Is internet marketing expensive?', 'akijcement-core' ),
					'accordion_content' => __( 'There are many variations of passages of Lorem Ipsum available but the majority suffered is alteration in that  words which don\'t look even slightly believable. If you are Lorem Ipsum you need to be sure there isn\'t anything ready too much embarrassing.', 'akijcement-core' ),
				],
			],
			'title_field' => '{{{ accordion_title }}}',
		] );

		$this->end_controls_section();


		/**
		 *  Accordian Style Controls
		 */

		$this->start_controls_section( 'title_style__section', [
			'label' => __( 'Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-accordion .accordion-button',
		] );

		$this->add_control( 'faq_title_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-accordion .accordion-button.collapsed'       => 'color: {{VALUE}}',
				'{{WRAPPER}} .akijcement-accordion .accordion-button.collapsed:after' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'faq_title_active_color', [
			'label'     => __( 'Active Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-accordion .accordion-button:not(.collapsed)'       => 'color: {{VALUE}}',
				'{{WRAPPER}} .akijcement-accordion .accordion-button:not(.collapsed):after' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'akijcement-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .akijcement-accordion .accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section( 'content_style_section', [
			'label' => __( 'Content', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'faq_ontent_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .accordion-body',
		] );

		$this->add_control( 'faq_content_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .accordion-body' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'box_style_section', [
			'label' => __( 'Box Wrapper', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'faq_margin_bottom',
			[
				'label'      => esc_html__( 'Space Between', 'akijcement-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .akijcement-accordion .accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);


		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'akijcement-core' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acc_background',
				'label'    => __( 'Background', 'akijcement-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .accordion-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acc_border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .accordion-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .accordion-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'akijcement-core' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acc_background_active',
				'label'    => __( 'Background', 'akijcement-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .accordion-item.active',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acc_border_active',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .accordion-item.active',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow_active',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .accordion-item.active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings  = $this->get_settings_for_display();
		$accordion = $settings['tt-accordion'];

		$faq_id = 'akijcement-accordion-' . substr( $this->get_id_int(), 0, 3 );
		$faq    = 'akijcement-acc-' . substr( $this->get_id_int(), 0, 3 );
		$faq_o  = 'akijcement-acco-' . substr( $this->get_id_int(), 0, 3 );
		?>


		<div class="akijcement-accordion" id="<?php echo esc_attr( $faq_id ); ?>">
			<?php foreach ( $accordion as $index => $item ) :
				$tab_btn_setting_key = $this->get_repeater_setting_key( 'accordion_title', '', $index );

				$this->add_render_attribute( $tab_btn_setting_key, [
					'class'          => [ $index == 0 ? 'accordion-button' : 'accordion-button collapsed' ],
					'data-bs-toggle' => 'collapse',
					'data-bs-target' => '#' . 'faq-collapse-' . $faq_o . '-' . $index,
					'aria-expanded'  => $index == 0 ? 'true' : 'false',
					'type'           => 'button',
					'aria-controls'  => $faq_o . '-' . $index
				] );

				$tab_body_setting_key = $this->get_repeater_setting_key( 'accordion_content', '', $index );

				$this->add_render_attribute( $tab_body_setting_key, [
					'id'             => 'faq-collapse-' . $faq_o . '-' . $index,
					'class'          => [ $index == 0 ? 'accordion-collapse collapse show' : 'accordion-collapse collapse' ],
					'data-bs-parent' => "#" . $faq_id
				] );
				?>

				<div class="accordion-item mb-3 <?php echo $index == 0 ? 'active' : ''; ?>">
					<h2 class="accordion-header" id="<?php echo $faq_o . '-' . $index; ?>">
						<button <?php echo $this->get_render_attribute_string( $tab_btn_setting_key ); ?>>
							<?php if ( ! empty( $item['accordion_icon'] ) ) : ?>
								<div class="accordion__icon-container">
									<?php \Elementor\Icons_Manager::render_icon( $item['accordion_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php endif; ?>
							<?php echo $item['accordion_title']; ?>
						</button>
					</h2>
					<div <?php echo $this->get_render_attribute_string( $tab_body_setting_key ); ?>>
						<div class="accordion-body">
							<?php echo $item['accordion_content']; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
