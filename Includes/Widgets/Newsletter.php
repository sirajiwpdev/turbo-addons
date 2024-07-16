<?php

namespace DesignMonks\AkijCement\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\{Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Border,
	Group_Control_Background};


class Newsletter extends Widget_Base {

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
		return 'akijcement-newsletter';
	}


	public function get_title() {
		return __( 'DM Newsletter', 'akijcement-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'icon-mailchimp';
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

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Newsletter', 'akijcement-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one' => __( 'Layout One', 'akijcement-core' ),
				'two'  => __( 'Layout Two', 'akijcement-core' ),
			],
		] );

		$this->add_control( 'button_view', [
			'label'   => __( 'Button View', 'akijcement-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'traditional',
			'options' => [
				'traditional' => [
					'title' => __( 'Default', 'akijcement-core' ),
					'icon'  => 'eicon-ellipsis-h',
				],
				'block'      => [
					'title' => __( 'Block', 'akijcement-core' ),
					'icon'  => 'eicon-editor-list-ul'
				],
			],
		] );

		$this->add_control( 'name_placeholder', [
			'label'       => esc_html__( 'Name Placeholder', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Enter your name', 'akijcement-core' ),
			'label_block' => true,
			'condition' => [
				'layout' => 'two',
			],
		] );

		$this->add_control( 'input_placeholder', [
			'label'       => esc_html__( 'Email Placeholder', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Enter your email', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Spacing', 'unialulmni-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner.btn-inline .input-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .newsletter-form .newsletter-inner.btn-block .input-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 'button_type', [
			'label'   => esc_html__( 'Button Type', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'text',
			'options' => [
				'icon'  => esc_html__( 'Icon', 'akijcement-core' ),
				'text'  => esc_html__( 'Text', 'akijcement-core' ),
			],
		] );

		$this->add_control( 'subscribe_text', [
			'label'       => esc_html__( 'Button Text', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( 'Subscribe', 'akijcement-core' ),
			'condition'   => [
				'button_type' => 'text',
			],
		] );

		$this->add_control( 'subscribe_icon', [
			'label'     => esc_html__( 'Button Icon', 'akijcement-core' ),
			'type' => \Elementor\Controls_Manager::ICONS,
			'default' => [
				'value' => 'far fa-paper-plane',
				'library' => 'fa-regular',
			],
			'condition' => [
				'button_type' => 'icon',
			],
		] );

		$this->add_control(
			'button_switch',
			[
				'label' => esc_html__( 'Button Icon Show/Hide', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'button_type' => 'text'
				],
			]
		);

		$this->add_control( 'selected_icon', [
			'label'     => __( 'Icon', 'akijcement-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-arrow-right',
				'library' => 'solid',
			],
			'condition' => [
				'button_type' => 'text',
				'button_switch' => 'yes'
			],
		] );

		$this->add_control(
			'icon_align',
			[
				'label' => __('Icon Position', 'akijcement-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => __('Before', 'akijcement-core'),
					'right' => __('After', 'akijcement-core'),
				],
				'condition' => [
					'selected_icon!' => '',
					'button_type' => 'text',
					'button_switch' => 'yes'
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => __('Icon Spacing', 'akijcement-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'selected_icon!' => '',
					'button_type' => 'text',
					'button_switch' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .dm-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dm-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Newsletter Form alignment
		$this->add_responsive_control(
			'newsletter_position',
			[
				'label' => esc_html__( 'Alignment', 'akijcement-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'akijcement-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'akijcement-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'akijcement-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
//				'selectors' => [
//					'{{WRAPPER}} .newsletter-form' => 'margin: 0 {{VALUE}};',
//				],
			]
		);

		$this->end_controls_section();


		// Style Section
		//======================

		$this->start_controls_section( 'section_style_field', [
			'label' => __( 'Email Field', 'akijcement-core' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'field_color',
			[
				'label' => __('Color', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_bg_color',
			[
				'label' => __('Background', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => __('Typography', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_field',
				'label' => __('Border', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_field_shadow',
				'label' => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_control(
			'field_bg_color_focus',
			[
				'label' => __('Focus Background', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_field_focus',
				'label' => __('Focus Border', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_field_shadow_focus',
				'label' => __( 'Focus Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Button', 'akijcement-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __('Typography', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .dm-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __('Border Radius', 'akijcement-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} a.dm-btn, {{WRAPPER}} .dm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'text_padding',
			[
				'label' => __('Padding', 'akijcement-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} a.dm-btn, {{WRAPPER}} .dm-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'akijcement-core'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Color', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.dm-btn, {{WRAPPER}} .dm-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __('Border', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .dm-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'akijcement-core'),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __('Color', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label' => __('Background Color', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'label' => __('Border', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .dm-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper_style',
			[
				'label' => __('Wrapper', 'akijcement-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'wrapper_bg_color',
			[
				'label' => __('Background Color', 'akijcement-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'label' => __('Border', 'akijcement-core'),
				'selector' => '{{WRAPPER}} .newsletter-form .newsletter-inner',
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_box_shadow',
				'label' => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form .newsletter-inner',
			]
		);

		// Border Radius
		$this->add_control(
			'wrapper_border_radius',
			[
				'label' => __('Border Radius', 'akijcement-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_control(
			'wrapper_padding',
			[
				'label' => __('Padding', 'akijcement-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$this->add_render_attribute('icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align']);
		$this->add_render_attribute('icon-align', 'class', 'dm-btn-icon');

		// Add Inner form wrapper class
		if( $settings['button_view'] == 'traditional'  ) {
			$this->add_render_attribute('form-inner', 'class', 'newsletter-inner btn-inline justify-content-center');
		} else {
			$this->add_render_attribute('form-inner', 'class', 'newsletter-inner btn-block');
		}

		$this->add_render_attribute('form-inner', 'method', 'post');
		$this->add_render_attribute('form-inner', 'action', admin_url( 'admin-ajax.php' ));
		$this->add_render_attribute('form-inner', 'class', 'newsletter-form');

		// Add Inner form wrapper class
		if( $settings['layout'] == 'two'  ) {
			$this->add_render_attribute('form-inner', 'class', 'style-two');
		} else {
			$this->add_render_attribute('form-inner', 'class', 'style-one');
		}

		// Newsletter position
		if ( $settings['newsletter_position'] == 'right' ) {
			$this->add_render_attribute( 'form-inner', 'class', 'position-right' );
		} elseif ( $settings['newsletter_position'] == 'center' ) {
			$this->add_render_attribute( 'form-inner', 'class', 'position-center' );
		} else {
			$this->add_render_attribute( 'form-inner', 'class', 'position-left' );
		}

//		if($settings['show_input_icon'] == 'yes' ) {
//			$this->add_render_attribute('form-inner', 'class', 'show_before_icon');
//		}

		// Form action
		$this->add_render_attribute('form-inner', 'data-akijcement-form', 'newsletter-subscribe');
		?>

		<div class="newsletter">
			<form <?php echo $this->get_render_attribute_string('form-inner') ?>>
				<?php
					$nonce = wp_create_nonce( 'akijcement_mailchimp_subscribe' );
				?>

				<input type="hidden" name="action" value="akijcement_mailchimp_subscribe" class="akijcement-newsletter-security" data-security="<?php echo esc_attr($nonce); ?>">
				<div <?php echo $this->get_render_attribute_string('form-inner'); ?> >
					<div class="input-inner">
						<?php if( $settings['layout'] == 'two' ) : ?>
							<input type="text" name="fname" class="form-control" id="elementor-newsletter-form-name" placeholder="<?php echo esc_attr( $settings['name_placeholder'] ); ?>" required>
						<?php endif; ?>
						<input type="email" name="email" class="form-control" id="elementor-newsletter-form-email" placeholder="<?php echo esc_attr( $settings['input_placeholder'] ); ?>" required>
					</div>
					<button type="submit" name="submit" id="elementor-newsletter-submit"	class="newsletter-submit dm-btn">
						<?php if( $settings['button_type'] == 'text' ) : ?>
							<?php echo esc_html( $settings['subscribe_text'] ); ?>
							<?php if (!empty($settings['selected_icon']) && $settings['button_switch'] == 'yes' ) : ?>
								<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>
                                    <?php if ( ! empty( $settings['selected_icon'] ) ) : ?>
	                                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php endif; ?>
                                </span>
							<?php endif; ?>
						<?php else : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['subscribe_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>
						<i class="fa fa-circle-o-notch fa-spin"></i>
					</button>
				</div>
				<div class="form-result alert">
					<div class="content"></div>
				</div><!-- /.form-result-->
			</form><!-- /.newsletter-form -->
		</div>
		<!-- /.newsletter -->
		<?php
	}
}
