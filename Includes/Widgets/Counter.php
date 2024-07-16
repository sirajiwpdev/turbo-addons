<?php

namespace DesignMonks\AkijCement\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use DesignMonks\AkijCement\IconsPack;
use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
};


/**
 * Class Counter
 *
 * @package DesignMonks\AkijCement\Widgets
 */
class Counter extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Counter widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'akijcement-counter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Counter widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'DM Counter', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Counter widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-counter';
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
	 * Get widget keywords.
	 *
	 * Retrieve the widget keywords.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'counter', 'count', 'number' ];
	}

	/**
	 * Get widget script dependences.
	 *
	 * Retrieve the widget script dependences.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	public function get_script_depends() {
		return [
			'countUp',
			'appear-js'
		];
	}

	/**
	 * Register Counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Counter Content', 'akijcement-core' ),
		] );

		$this->add_control( 'icon_type', [
			'label'       => esc_html__( 'Add Icon/Image', 'akijcement-core' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'none'  => [
					'title' => esc_html__( 'None', 'akijcement-core' ),
					'icon'  => 'eicon-ban',
				],
				'icon'  => [
					'title' => esc_html__( 'Icon', 'akijcement-core' ),
					'icon'  => 'eicon-paint-brush',
				],
				'image' => [
					'title' => esc_html__( 'Image', 'akijcement-core' ),
					'icon'  => 'eicon-image-bold',
				]
			],
			'default'     => 'icon',
		] );

		$this->add_control( 'icon_pack', [
			'label'     => esc_html__( 'Icon Pack', 'akijcement-core' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'fontawesome' => esc_html__( 'Fontawesome', 'akijcement-core' ),
				'feather'     => esc_html__( 'Feather', 'akijcement-core' ),
				'simpleline'  => esc_html__( 'Simple Line', 'akijcement-core' ),
			],
			'default'   => 'simpleline',
			'condition' => [
				'icon_type' => 'icon',
			],
		] );

		$this->add_control( 'feather_icon', [
			'label'       => __( 'Choose Icon', 'akijcement-core' ),
			'type'        => Controls_Manager::ICON,
			'options'     => IconsPack::akijcement_feather_icon(),
			'include'     => IconsPack::akijcement_include_feather_icons(),
			'default'     => 'feather-box',
			'condition'   => [
				'icon_pack' => 'feather',
				'icon_type' => 'icon',
			],
			'label_block' => true,
		] );

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Icon', 'akijcement-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => 'icon',
					'icon_pack' => 'fontawesome',
				]
			]
		);

		$this->add_control( 'simpleline_icon', [
			'label'       => __( 'Choose Icon', 'akijcement-core' ),
			'type'        => Controls_Manager::ICON,
			'options'     => IconsPack::akijcement_simpleline_icons(),
			'include'     => IconsPack::akijcement_include_simpleline_icons(),
			'default'     => 'icon-people',
			'condition'   => [
				'icon_pack' => 'simpleline',
				'icon_type' => 'icon',
			],
			'label_block' => true,
		] );

		$this->add_control(
			'icon_image',
			[
				'label'     => esc_html__( 'Choose Image', 'akijcement-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_control( 'count_number', [
			'label'       => __( 'Counting Number', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( '754', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'suffix_before', [
			'label' => __( 'Suffix Before', 'akijcement-core' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$this->add_control( 'suffix_after', [
			'label'   => __( 'Suffix After', 'akijcement-core' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '+',
		] );

		$this->add_control( 'count_title', [
			'label'       => __( 'Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Completed Projects', 'akijcement-core' ),
			'label_block' => true,
		] );

		$this->add_control( 'count_description', [
			'label'       => __( 'Description', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
		] );

		$this->add_responsive_control( 'align', [
			'label'     => __( 'Alignment', 'akijcement-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'akijcement-core' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'akijcement-core' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'akijcement-core' ),
					'icon'  => 'fa fa-align-right',
				]
			],
			'default'   => 'left',
			'selectors' => [
				'{{WRAPPER}} .dm-counter-wrapper .dm-counter' => 'text-align: {{VALUE}};',
			],

		] );

		$this->end_controls_section();


		/**
		 * Style Sections
		 */

		$this->start_controls_section( 'section_icon_style', [
			'label'     => esc_html__( 'Icon and Image', 'akijcement-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'icon_type!' => 'none'
			]
		] );


		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab( 'tab_icon_normal', [
			'label' => __( 'Normal', 'akijcement-core' ),
		] );

		$this->add_control( 'icon_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container' => 'color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_border_color', [
			'label'     => esc_html__( 'Border Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_color_bg', [
			'label'     => esc_html__( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container' => 'background-color: {{VALUE}}; border-color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_shadow',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .icon-container',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_icon_hover', [
			'label' => __( 'Hover', 'akijcement-core' ),
		] );

		$this->add_control( 'icon_color_hover', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_hover_border_color', [
			'label'     => esc_html__( 'Border Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container:hover' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container:hover' => 'background-color: {{VALUE}}'
			],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_responsive_control( 'icon_space', [
			'label'     => esc_html__( 'Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon-container'         => 'margin-right: {{SIZE}}{{UNIT}};',
				'(mobile){{WRAPPER}} .icon-container' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_size', [
			'label'     => esc_html__( 'Size', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon-container'     => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .icon-container img' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Countdown Style
		//============================
		$this->start_controls_section( 'countdown_section', [
			'label' => __( 'Countdown Number', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'counter_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-counter__number' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'counter_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-counter__number',
		] );

		$this->end_controls_section();

		// Title Style
		//============================

		$this->start_controls_section( 'title_section', [
			'label' => __( 'Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'counter_title_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dm-counter__title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'counter_title_typography',
			'label'    => __( 'Title Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .dm-counter__title',
		] );

		$this->add_control(
			'title_bottom_spacing',
			[
				'label' => __( 'Width', 'plugin-domain' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],

				'selectors' => [
					'{{WRAPPER}} .dm-counter__number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Counter Container style
		// ============================
		$this->start_controls_section( 'section_style_box', [
			'label' => __( 'Box Container', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => __( 'Background', 'akijcement-core' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .dm-counter',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-counter',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .dm-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-counter',
			]
		);

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .dm-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 'box_translate_hover', [
			'label'      => __( 'Hover Translate (Y)', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => 'px',
			'range'      => [
				'px' => [
					'min'  => - 50,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .dm-counter:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
			],
		] );

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="dm-counter">
			<?php if ( ! empty( $settings['icon_type'] == 'icon' ) ) : ?>
				<?php if ( $settings['icon_pack'] == 'fontawesome' ) : ?>
					<div class="dm-counter__icon-container">
						<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<!-- /.icon-container -->
				<?php elseif ( $settings['icon_pack'] == 'feather' ) : ?>
					<div class="dm-counter__icon-container">
						<?php if ( ! empty( $settings['feather_icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $settings['feather_icon'] ) ?>"></i>
						<?php endif; ?>
					</div>
				<?php elseif ( $settings['icon_pack'] == 'simpleline' ) : ?>
					<div class="dm-counter__icon-container">
						<?php if ( ! empty( $settings['simpleline_icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $settings['simpleline_icon'] ) ?>"></i>
						<?php endif; ?>
					</div>
					<!-- /.icon-container -->
				<?php endif; ?>

			<?php elseif ( ! empty( $settings['icon_type'] == 'image' ) ) : ?>
				<div class="dm-counter__icon-container">
					<img src="<?php echo esc_url( $settings['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['count_title'] ); ?>">
				</div>
				<!-- /.icon-container -->
			<?php endif; ?>

			<div class="dm-counter__content">
				<?php if ( ! empty( $settings['count_number'] ) ) : ?>
					<div class="dm-counter__number">
						<?php if ( ! empty( $settings['suffix_before'] ) ): ?>
							<span class="suffix"><?php echo $settings['suffix_before']; ?></span>
						<?php endif; ?>
						<span class="counter" data-counter="<?php echo esc_attr( $settings['count_number'] ) ?>">
							<?php echo $settings['count_number']; ?>
						</span>
						<?php if ( ! empty( $settings['suffix_after'] ) ) : ?>
							<span class="suffix"><?php echo $settings['suffix_after']; ?></span>
						<?php endif; ?>
					</div>
					<!-- /.counter-wrap -->
				<?php endif; ?>

				<?php if ( ! empty( $settings['count_title'] ) ) : ?>
					<p class="dm-counter__title"><?php echo $settings['count_title']; ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php

	}
}

