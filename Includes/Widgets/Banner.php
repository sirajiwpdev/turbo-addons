<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Banner extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'akijcement-banner-slider';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'DM Banner Slider', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'banner', 'slider', 'akijcement' ];
	}


	protected function register_controls() {

		// Slider Items
		// =====================

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Slider Content', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();


		$repeater->add_control(
			'banner_title', [
				'label'       => __( 'Banner Title', 'akijcement-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'banner_description', [
				'label'      => __( 'Description', 'akijcement-core' ),
				'type'       => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'btn_text_one', [
				'label'       => __( 'Button Title', 'akijcement-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'btn_link_one',
			[
				'label'         => __( 'Link', 'akijcement-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'akijcement-core' ),
				'show_external' => true,
				'separator'     => 'after'
			]
		);

		$repeater->add_control(
			'banner_image',
			[
				'label'   => __( 'Choose Image', 'akijcement-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

//		$repeater->add_control(
//			'overlay_color',
//			[
//				'label'     => __( 'Overlay Color', 'akijcement-core' ),
//				'type'      => Controls_Manager::COLOR,
//				'selectors' => [
//					'{{WRAPPER}} .banner:before' => 'color: {{VALUE}}',
//				],
//			]
//		);

        // Style Title Color
        $repeater->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'akijcement-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .banner__title' => 'color: {{VALUE}}',
                ],
            ]
        );


		$this->add_control(
			'sliders',
			[
				'label'       => __( 'Repeater List', 'akijcement-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'banner_title'       => __( 'Dedicated to Cultivating Nations with Goodness.', 'akijcement-core' ),
						'banner_image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'banner_title'       => __( 'Dedicated to Cultivating Nations with Goodness.', 'akijcement-core' ),
						'banner_image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'banner_title'       => __( 'Dedicated to Cultivating Nations with Goodness.', 'akijcement-core' ),
						'banner_image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'title_field' => '{{{ banner_title }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section( 'sittings_control', [
			'label' => esc_html__( 'Slider Control', 'akijcement-core' ),
		] );


		$this->add_control(
			'navigation',
			[
				'label'        => esc_html__( 'Navigation', 'akijcement-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'akijcement-core' ),
				'label_off'    => esc_html__( 'Hide', 'akijcement-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'        => esc_html__( 'Pagination', 'akijcement-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'akijcement-core' ),
				'label_off'    => esc_html__( 'Hide', 'akijcement-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'akijcement-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'akijcement-core' ),
				'label_off'    => esc_html__( 'Off', 'akijcement-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'akijcement-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'akijcement-core' ),
				'label_off'    => esc_html__( 'Off', 'akijcement-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'loop' => 'yes'
				]
			]
		);

		$this->add_control(
			'autoplay_time',
			[
				'label'     => __( 'Autoplay Time', 'akijcement-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'loop'     => 'yes',
					'autoplay' => 'yes',
				]
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'akijcement-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 700,
			]
		);

		$this->end_controls_section();

		// Title
		// ==================
		$this->start_controls_section(
			'title_section',
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
					'{{WRAPPER}} .banner__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .banner__title',
			]
		);


		$this->end_controls_section();

		// Description
		// ==================
		$this->start_controls_section(
			'description_section',
			[
				'label' => __( 'Description', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .banner__description',
			]
		);

		$this->end_controls_section();


		// Button
		//======================

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.dm-btn, {{WRAPPER}} .dm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.dm-btn, {{WRAPPER}} .dm-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.dm-btn, {{WRAPPER}} .dm-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'akijcement-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label'     => __( 'Background Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dm-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border_hover',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .dm-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'control_section', [
			'label' => __( 'Slider  Control', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'nav_width',
			[
				'label'      => esc_html__( 'Nav Height/Width', 'akijcement-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_font_size',
			[
				'label'      => esc_html__( 'Nav Font Size', 'akijcement-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]

		);

		$this->add_control(
			'nav_border_radius',
			[
				'label'      => esc_html__( 'Nav Border Radius', 'akijcement-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_nav_style' );
		$this->start_controls_tab(
			'tab_nav_normal',
			[
				'label' => __( 'Normal', 'akijcement-core' ),
			]
		);

		$this->add_control( 'slider_nav_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'slider_control_border',
				'selector' => '{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next',
			]
		);

		$this->add_control( 'pagination_bg_color', [
			'label'     => __( 'Pagination BG Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_nav_hover',
			[
				'label' => __( 'Hover', 'akijcement-core' ),
			]
		);

		$this->add_control( 'nav_color_hover', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_color_bg_hover', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_control_hover', [
			'label'     => __( 'Border Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'border-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover',
			]
		);

		$this->add_control( 'slider_pagination_active_color', [
			'label'     => __( 'Pagination Active BG Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		// Overlay BG
		// =======================

		$this->start_controls_section(
			'overlay_section',
			[
				'label' => esc_html__( 'Overlay Background', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'overlay_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .banner__slider .banner__slide:before',
			]
		);


		$this->add_control(
			'overlay_opacity',
			[
				'label'     => esc_html__( 'Opacity', 'elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 0.7,
				],
				'selectors' => [
					'{{WRAPPER}} .banner__slider .banner__slide:before' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

		//Social Links
		$this->start_controls_section(
			'social_banner_style',
			[
				'label' => __( 'Social Style', 'akijcement-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'link_size',
			[
				'label'     => __( 'Font Size', 'akijcement-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 10,
				'max'       => 50,
				'step'      => 1,
				'default'   => 14,
				'selectors' => [
					'{{WRAPPER}} .banner-share-link li a' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_control(
			'i_color',
			[
				'label'     => __( 'Icon Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-share-link li a i' => 'text-shadow: 0 0 {{VALUE}}, 0 30px {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'i_color_hover',
			[
				'label'     => __( 'Icon Hover Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-share-link li a:hover i' => 'text-shadow: 0 -30px {{VALUE}}, 0 0 {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$sliders  = $settings['sliders'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'banner__slider'
		] );


		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-banner', wp_json_encode( $slider_options ) );

		?>

        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $settings['navigation'] == 'yes' ): ?>
                <div class="banner__slider-prev"><i class="feather-chevron-left"></i></div>
			<?php endif; ?>

            <div class="swiper-wrapper">
				<?php foreach ( $sliders as $item ) : ?>
                    <div class="swiper-slide elementor-repeater-item-<?php echo esc_attr($item['_id']) ?>">
                        <div class="banner__slide">
                            <div class="banner__image">
                                <img src="<?php echo esc_url( $item['banner_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['banner_title'] ); ?>">
                            </div>

                            <div class="container">
                                <div class="banner__content">
									<?php if ( ! empty( $item['banner_title'] ) ) : ?>
                                        <h1 class="banner__title"><?php echo $item['banner_title']; ?></h1>
									<?php endif; ?>

									<?php if ( ! empty( $item['banner_description'] ) ) : ?>
                                        <div class="banner__description"><?php echo $item['banner_description']; ?></div>
									<?php endif; ?>

                                    <div class="banner__button-container">

										<?php
										// Button One
										$target   = $item['btn_link_one']['is_external'] ? ' target="_blank"' : '';
										$nofollow = $item['btn_link_one']['nofollow'] ? ' rel="nofollow"' : '';
										?>

										<?php if ( ! empty( $item['btn_text_one'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['btn_link_one']['url'] ) ?>" <?php echo esc_attr( $target . ' ' . $nofollow ) ?>
                                               class="dm-btn btn-round banner-btn"><?php echo esc_html( $item['btn_text_one'] ); ?></a>
										<?php endif; ?>
                                    </div>
                                    <!-- /.banner__button-container -->
                                </div>
                                <!-- /.banner__content -->
                            </div>
                        </div>
                        <!-- /.banner__slide -->
                    </div>
				<?php endforeach; ?>
            </div>

			<?php if ( $settings['navigation'] == 'yes' ): ?>
                <div class="banner__slider-next"><i class="feather-chevron-right"></i></div>
			<?php endif; ?>

			<?php if ( $settings['pagination'] == 'yes' ): ?>
                <div class="banner-pagination"></div>
			<?php endif; ?>
        </div>
		<?php

	}

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}

		// Auto Play
		if ( $settings['autoplay'] == 'yes' ) {
			$slider_options['autoplay'] = [
				'delay'                => $settings['autoplay_time'],
				'disableOnInteraction' => false
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => '99999999999',
			];
		}

		if ( $settings['navigation'] == 'yes' ) {
			$slider_options['navigation'] = [
				'nextEl' => '.banner__slider-next',
				'prevEl' => '.banner__slider-prev'
			];
		}

        // Slider Effect
//        $slider_options['effect'] = 'fade';
//        // Cross Fade
//        $slider_options['fadeEffect'] = [
//            'crossFade' => true
//        ];

		if ( $settings['pagination'] == 'yes' ) {
			$slider_options['pagination'] = [
				'el'        => '.banner-pagination',
				'clickable' => true
			];
		}

		return $slider_options;
	}
}