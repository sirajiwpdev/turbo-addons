<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Banner
 *
 * Custom widget for displaying banners with images, titles, descriptions, and buttons.
 */
class Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Banner-id';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Banner', 'turbo-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-photo-library';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'turbo-addons' ];
	}

	/**
	 * Retrieve the widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'banner', 'slider', 'turbo' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls() {

		// Slider Items Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Slider Content', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		// Banner Title Control
		$repeater->add_control(
			'banner_title', [
				'label'       => __( 'Banner Title', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		// Banner Description Control
		$repeater->add_control(
			'banner_description', [
				'label'      => __( 'Description', 'turbo-addons' ),
				'type'       => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		// Button Text Control
		$repeater->add_control(
			'btn_text_one', [
				'label'       => __( 'Button Title', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		// Button Link Control
		$repeater->add_control(
			'btn_link_one',
			[
				'label'         => __( 'Link', 'turbo-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'turbo-addons' ),
				'show_external' => true,
				'separator'     => 'after',
			]
		);

		// Banner Image Control
		$repeater->add_control(
			'banner_image',
			[
				'label'   => __( 'Choose Image', 'turbo-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		// Title Color Control
		$repeater->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .banner__title' => 'color: {{VALUE}}',
				],
			]
		);

		// Add Repeater Control for Sliders
		$this->add_control(
			'sliders',
			[
				'label'       => __( 'Repeater List', 'turbo-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'banner_title' => __( 'Dedicated to Cultivating Nations with Goodness.', 'turbo-addons' ),
						'banner_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'title_field' => '{{{ banner_title }}}',
			]
		);

		$this->end_controls_section();

		// Slider Control Section
		$this->start_controls_section(
			'sittings_control',
			[
				'label' => esc_html__( 'Slider Control', 'turbo-addons' ),
			]
		);

		// Navigation Control
		$this->add_control(
			'navigation',
			[
				'label'        => esc_html__( 'Navigation', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		// Pagination Control
		$this->add_control(
			'pagination',
			[
				'label'        => esc_html__( 'Pagination', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		// Loop Control
		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Off', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		// Autoplay Control
		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'turbo-addons' ),
				'label_off'    => esc_html__( 'Off', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'loop' => 'yes',
				],
			]
		);

		// Autoplay Time Control
		$this->add_control(
			'autoplay_time',
			[
				'label'     => __( 'Autoplay Time', 'turbo-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'loop'     => 'yes',
					'autoplay' => 'yes',
				],
			]
		);

		// Speed Control
		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'turbo-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 700,
			]
		);

		$this->end_controls_section();

		// Title Style Section
		$this->start_controls_section(
			'title_section',
			[
				'label' => __( 'Title', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'turbo-addons' ),
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
				'label'    => __( 'Typography', 'turbo-addons' ),
				'selector' => '{{WRAPPER}} .banner__title',
			]
		);

		$this->end_controls_section();

		// Description Style Section
		$this->start_controls_section(
			'description_section',
			[
				'label' => __( 'Description', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
				'description_color',
				[
					'label'     => __( 'Color', 'turbo-addons' ),
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
					'label'    => __( 'Typography', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .banner__description',
				]
			);
	
			$this->end_controls_section();
	
			// Button Style Section
			$this->start_controls_section(
				'section_style',
				[
					'label' => __( 'Button', 'turbo-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
	
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'typography',
					'label'    => __( 'Typography', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .dm-btn',
				]
			);
	
			$this->add_control(
				'border_radius',
				[
					'label'      => __( 'Border Radius', 'turbo-addons' ),
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
					'label'      => __( 'Padding', 'turbo-addons' ),
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
					'label' => __( 'Normal', 'turbo-addons' ),
				]
			);
	
			$this->add_control(
				'button_text_color',
				[
					'label'     => __( 'Color', 'turbo-addons' ),
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
					'label'     => __( 'Background Color', 'turbo-addons' ),
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
					'label'    => __( 'Border', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .dm-btn',
				]
			);
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .dm-btn',
				]
			);
	
			$this->end_controls_tab();
	
			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' => __( 'Hover', 'turbo-addons' ),
				]
			);
	
			$this->add_control(
				'hover_color',
				[
					'label'     => __( 'Color', 'turbo-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .dm-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_control(
				'background_color_hover',
				[
					'label'     => __( 'Background Color', 'turbo-addons' ),
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
					'label'    => __( 'Border', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .dm-btn:hover',
				]
			);
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .dm-btn:hover',
				]
			);
	
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
	
			// Slider Control Style Section
			$this->start_controls_section(
				'control_section',
				[
					'label' => __( 'Slider Control', 'turbo-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
	
			$this->add_control(
				'nav_width',
				[
					'label'      => esc_html__( 'Nav Height/Width', 'turbo-addons' ),
					'type'       => Controls_Manager::SLIDER,
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
					'label'      => esc_html__( 'Nav Font Size', 'turbo-addons' ),
					'type'       => Controls_Manager::SLIDER,
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
					'label'      => esc_html__( 'Nav Border Radius', 'turbo-addons' ),
					'type'       => Controls_Manager::SLIDER,
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
					'label' => __( 'Normal', 'turbo-addons' ),
				]
			);
	
			$this->add_control( 'slider_nav_color', [
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'color: {{VALUE}}',
				],
			] );
	
			$this->add_control( 'nav_bg_color', [
				'label'     => __( 'Background Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'background-color: {{VALUE}}',
				],
			] );
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'slider_control_border',
					'selector' => '{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next',
				]
			);
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'nav_box_shadow',
					'label'    => __( 'Box Shadow', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next',
				]
			);
	
			$this->add_control( 'pagination_bg_color', [
				'label'     => __( 'Pagination BG Color', 'turbo-addons' ),
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
					'label' => __( 'Hover', 'turbo-addons' ),
				]
			);
	
			$this->add_control( 'nav_color_hover', [
				'label'     => __( 'Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'color: {{VALUE}}',
				],
			] );
	
			$this->add_control( 'nav_color_bg_hover', [
				'label'     => __( 'Background Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'background-color: {{VALUE}}',
				],
			] );
	
			$this->add_control( 'nav_control_hover', [
				'label'     => __( 'Border Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'border-color: {{VALUE}}',
				],
			] );
	
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'nav_box_shadow_hover',
					'label'    => __( 'Box Shadow', 'turbo-addons' ),
					'selector' => '{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover',
				]
			);
	
			$this->add_control( 'slider_pagination_active_color', [
				'label'     => __( 'Pagination Active BG Color', 'turbo-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}}',
				],
				'separator' => 'before',
			] );
	
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
	
			// Overlay Background Section
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
	
			// Social Links Style Section
			$this->start_controls_section(
				'social_banner_style',
				[
					'label' => __( 'Social Style', 'turbo-addons' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
	
			$this->add_control(
				'link_size',
				[
					'label'     => __( 'Font Size', 'turbo-addons' ),
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
					'label'     => __( 'Icon Color', 'turbo-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .banner-share-link li a i' => 'text-shadow: 0 0 {{VALUE}}, 0 30px {{VALUE}}',
					],
				]
			);
	
			$this->add_control(
				'i_color_hover',
				[
					'label'     => __( 'Icon Hover Color', 'turbo-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .banner-share-link li a:hover i' => 'text-shadow: 0 -30px {{VALUE}}, 0 0 {{VALUE}}',
					],
				]
			);
	
			$this->end_controls_section();
		}
	
		/**
		 * Render the widget output on the frontend.
		 */
		protected function render() {
			$settings = $this->get_settings_for_display();
			$sliders  = $settings['sliders'];
	
			$this->add_render_attribute( 'wrapper', 'class', [
				'swiper-container',
				'banner__slider',
			] );
	
			$slider_options = $this->get_slider_options( $settings );
			$this->add_render_attribute( 'wrapper', 'data-banner', wp_json_encode( $slider_options ) );
	
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
	
				<?php if ( $settings['navigation'] === 'yes' ) : ?>
					<div class="banner__slider-prev"><i class="feather-chevron-left"></i></div>
				<?php endif; ?>
	
				<div class="swiper-wrapper">
					<?php foreach ( $sliders as $item ) : ?>
						<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
							<div class="banner__slide">
								<div class="banner__image">
									<img src="<?php echo esc_url( $item['banner_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['banner_title'] ); ?>">
								</div>
	
								<div class="container">
									<div class="banner__content">
										<?php if ( ! empty( $item['banner_title'] ) ) : ?>
											<h1 class="banner__title"><?php echo esc_html( $item['banner_title'] ); ?></h1>
										<?php endif; ?>
	
										<?php if ( ! empty( $item['banner_description'] ) ) : ?>
											<div class="banner__description"><?php echo wp_kses_post( $item['banner_description'] ); ?></div>
										<?php endif; ?>
	
										<div class="banner__button-container">
	
											<?php
											// Button One
											$target   = $item['btn_link_one']['is_external'] ? ' target="_blank"' : '';
											$nofollow = $item['btn_link_one']['nofollow'] ? ' rel="nofollow"' : '';
											?>
	
											<?php if ( ! empty( $item['btn_text_one'] ) ) : ?>
												<a href="<?php echo esc_url( $item['btn_link_one']['url'] ); ?>" <?php echo esc_attr( $target . ' ' . $nofollow ); ?>
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
	
				<?php if ( $settings['navigation'] === 'yes' ) : ?>
					<div class="banner__slider-next"><i class="feather-chevron-right"></i></div>
				<?php endif; ?>
	
				<?php if ( $settings['pagination'] === 'yes' ) : ?>
					<div class="banner-pagination"></div>
				<?php endif; ?>
			</div>
			<?php
		}
	
		/**
		 * Get slider options based on widget settings.
		 *
		 * @param array $settings Widget settings.
		 * @return array Slider options.
		 */
		protected function get_slider_options( array $settings ) {
	
			$slider_options = [];
	
			// Loop option
			$slider_options['loop'] = ( 'yes' === $settings['loop'] );
	
			// Speed option
			if ( ! empty( $settings['speed'] ) ) {
				$slider_options['speed'] = $settings['speed'];
			}
	
			// Autoplay option
			if ( 'yes' === $settings['autoplay'] ) {
				$slider_options['autoplay'] = [
					'delay'                => $settings['autoplay_time'],
					'disableOnInteraction' => false,
				];
			} else {
				$slider_options['autoplay'] = [
					'delay' => '99999999999',
				];
			}
	
			// Navigation option
			if ( 'yes' === $settings['navigation'] ) {
				$slider_options['navigation'] = [
					'nextEl' => '.banner__slider-next',
					'prevEl' => '.banner__slider-prev',
				];
			}
	
			// Pagination option
			if ( 'yes' === $settings['pagination'] ) {
				$slider_options['pagination'] = [
					'el'        => '.banner-pagination',
					'clickable' => true,
				];
			}
	
			return $slider_options;
		}
}

Plugin::instance()->widgets_manager->register_widget_type( new Banner() );
