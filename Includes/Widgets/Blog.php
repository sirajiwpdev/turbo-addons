<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager, Group_Control_Background, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Blog extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'akijcement-blogs';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'DM Blog', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-blog';
	}

	/**
	 * Get widget categories.
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Get widget keywords.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'blog', 'slider', 'akijcement' ];
	}

	/**
	 * Register widget controls.
	 * @since 1.0.0
	 */
	protected function register_controls() {
		// Testimonial
		//=========================
		$this->start_controls_section( 'section_tab_style', [
			'label' => esc_html__( 'Blog', 'akijcement-core' ),
		] );

		// Layout
		//=========================
		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'grid',
			'options' => [
				'list' => esc_html__( 'List', 'akijcement-core' ),
				'grid' => esc_html__( 'Grid', 'akijcement-core' ),
			],
		] );

		// Column
		$this->add_control( 'column', [
			'label'   => esc_html__( 'Column', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '4',
			'options' => [
				'6'  => esc_html__( '2 Column', 'akijcement-core' ),
				'4'  => esc_html__( '3 Column', 'akijcement-core' ),
				'3'  => esc_html__( '4 Column', 'akijcement-core' ),
			],
			'condition' => [
				'layout' => 'grid'
			]
		] );

		$this->add_control( 'post_count', [
			'label'   => esc_html__( 'Post count', 'akijcement-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => esc_html__( '3', 'akijcement-core' ),

		] );

		$this->add_control( 'post_cat', [
			'label'       => esc_html__( 'Select category', 'akijcement-core' ),
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'label_block' => true,
			'options'     => \AkijCement_Helper::categories_suggester(),
			'default'     => '0'
		] );

		$this->add_control( 'content_length', [
			'label'   => __( 'Word Limit', 'akijcement-core' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'min'     => 5,
			'max'     => 30,
			'step'    => 1,
			'default' => 15,
		] );

		$this->add_control( 'read_more_text', [
			'label'       => __( 'Read More Button text' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter button text here' ),
			'default'     => __( 'Read More', 'akijcement-core' ),
			'label_block' => true
		] );

		$this->end_controls_section();

		// Blog Meta Style
		//====================
		$this->start_controls_section( 'background_shape', [
			'label' => __( 'Meta', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'meta_show', [
			'label'        => __( 'Show Post meta', 'akijcement-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'akijcement-core' ),
			'label_off'    => __( 'No', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'meta_text_typography',
			'label'    => __( 'Date Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-post__item .akijcement-post__date-meta .posted-on a, {{WRAPPER}} .akijcement-post__date-meta a',
		] );

		$this->add_control( 'meta_text_color', [
			'label'     => __( 'Date Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__item .akijcement-post__date-meta .posted-on a, {{WRAPPER}} .akijcement-post__date-meta a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'meta_icon_color', [
			'label'     => __( 'Icon Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__date-meta svg path' => 'stroke: {{VALUE}}',
			],
		] );


		$this->add_control( 'date_title_color_hover', [
			'label'     => __( 'Hover Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__post-post-meta li a:hover, {{WRAPPER}} .akijcement-post__date-meta a:hover' => 'color: {{VALUE}}',
			],
		] );

		// Author name
		$this->add_control(
			'author_options',
			[
				'label' => esc_html__( 'Author Style', 'akijcement-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'author_text_typography',
			'label'    => __( 'Author Typography', 'akijcement-core' ),
			'selectors' => ['{{WRAPPER}} .akijcement-post__author-avatar a', '{{WRAPPER}} .akijcement-post__author-meta a'],
			'separator' => 'before'
		] );

		$this->add_control( 'author_text_color', [
			'label'     => __( 'Author Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__author-avatar a, {{WRAPPER}} .akijcement-post__author-meta a' => 'color: {{VALUE}}',
			],

		] );

		$this->add_control( 'author_color_hover', [
			'label'     => __( 'Hover Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__author-avatar a:hover, {{WRAPPER}} .akijcement-post__author-meta a:hover' => 'color: {{VALUE}}',
			],
		] );

		// Icon color
		$this->add_control( 'author_icon_color', [
			'label'     => __( 'Icon Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__author-meta svg path' => 'stroke: {{VALUE}}',
			],
			'condition' => [
				'layout' => 'list'
			]
		] );

		$this->add_control(
			'comments_and_view_options',
			[
				'label' => esc_html__( 'Comments and View', 'akijcement-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Icon color
		$this->add_control( 'icon_color', [
			'label'     => __( 'Icon Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__comments svg path, {{WRAPPER}} .akijcement-post__views svg path' => 'stroke: {{VALUE}}',
			],
		] );

		$this->add_control( 'comments_text_color', [
			'label'     => __( 'Comments Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__comments, {{WRAPPER}} .post_view_count' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Title Style
		//=====================
		$this->start_controls_section( 'name_section', [
			'label' => __( 'Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-post__entry-title',
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__entry-title a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => __( 'Hover Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__entry-title a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Content Style
		//=====================
		$this->start_controls_section( 'designation_section', [
			'label' => __( 'Content', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-post__entry-content',
		] );

		$this->add_control( 'content_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__entry-content' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Category Style
		//=====================
		$this->start_controls_section( 'category_section', [
			'label' => __( 'Category', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'list'
			]
		] );

		// Show Category
		$this->add_control(
			'category_show',
			[
				'label' => __( 'Show Category', 'akijcement-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'akijcement-core' ),
				'label_off' => __( 'Hide', 'akijcement-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'category_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement__blog-meta-category',
		] );

		// Padding

		$this->add_responsive_control(
			'category_padding',
			[
				'label' => __( 'Padding', 'akijcement-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .akijcement__blog-meta-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'category_margin',
			[
				'label' => __( 'Margin', 'akijcement-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .akijcement__blog-meta-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border radius
		$this->add_responsive_control(
			'category_border_radius',
			[
				'label' => __( 'Border Radius', 'akijcement-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .akijcement__blog-meta-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Normal and Hover Color
		$this->start_controls_tabs( 'category_tabs' );

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control( 'category_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__blog-meta-category' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'category_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__blog-meta-category' => 'background-color: {{VALUE}}',
			],
		] );

		$this->end_controls_tab();


		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);

		$this->add_control( 'category_hover_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__blog-meta-category:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'category_hover_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__blog-meta-category:hover' => 'background-color: {{VALUE}}',
			],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'blog_section', [
			'label' => __( 'Blog Container', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'blog_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__item, {{WRAPPER}} .akijcement__post-list' => 'background: {{VALUE}}',
			],
		] );

		// Overlay Color
		$this->add_control(
			'blog_overlay_color',
			[
				'label'     => __( 'Overlay Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .akijcement__post-list .akijcement__feature-image:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'list'
				]
			]
		);

		$this->add_responsive_control(
			'blog_padding',
			[
				'label'      => __( 'Padding', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .akijcement-post__blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'blog_margin',
			[
				'label'      => __( 'Margin', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .akijcement-post__item, {{WRAPPER}} .akijcement__post-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'blog_border',
				'label'    => __( 'Border', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .akijcement-post__item',
			]
		);

		$this->add_control(
			'blog_border_radius',
			[
				'label'      => __( 'Border Radius', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}  .akijcement-post__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'blog_shadow_hover',
				'label'    => __( 'Hover Box Shadow', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .akijcement-post__item, {{WRAPPER}} .akijcement__post-list',
			]
		);

		// Blog Footer Border Color
		$this->add_control( 'blog_footer_border_color', [
			'label'     => __( 'Footer Border Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-post__footer' => 'border-top-color: {{VALUE}}',
			],
			'condition' => [
				'layout' => 'grid',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$post_cat = $settings['post_cat'];
		$layout  = $settings['layout'];

		$post_count = $settings['post_count'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'akijcement-post-items',
		] );


		$paged = 1;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		}
		if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		}

		$_tax_query = array();

		if ( $post_cat ) {
			$_tax_query = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $post_cat,
				)
			);
		}

		$query = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $post_count,
			'tax_query'      => $_tax_query,
			'paged'          => $paged,
		);

		$akijcement_query = new \WP_Query( $query );

		if ( $akijcement_query->have_posts() ):

			$ant = 0.3;
			$color_list = array(
				'#4D3B8E',
				'#EC6400',
				'#06A48C'
			);

			$colors_count = count( $color_list );
			$color_item_count   = 0;
			$count              = $akijcement_query->post_count;

			?>


			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<div class="row">
					<?php
					while ( $akijcement_query->have_posts() ) :
						$akijcement_query->the_post();
							require __DIR__ . '/templates/blog/'. $layout .'.php';
						$ant = $ant + 0.2;
						$color_item_count++;
						if ( $color_item_count == $count || $colors_count == $color_item_count ) {
							$color_item_count = 0;
						}
					endwhile;
					?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();

	}
}
