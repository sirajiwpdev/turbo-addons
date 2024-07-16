<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Group_Control_Image_Size,
	Plugin,
	Controls_Manager,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Product extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'akijcement-product';
	}


	public function get_title() {
		return __( 'DM Product', 'akijcement-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

//	public function get_script_depends() {
//		return [
//			'isotope',
//			'imagesloaded',
//			'packery',
//		];
//	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Vessels', 'akijcement-core' ),
			]
		);

		$this->add_control( 'grid_animation', [
			'label'   => esc_html__( 'Grid Animation', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''           => esc_html__( 'None', 'akijcement-core' ),
				'dtZoom'     => esc_html__( 'Zoom', 'akijcement-core' ),
				'fadeInUp'   => esc_html__( 'Fade In Up', 'akijcement-core' ),
				'fadeInDown' => esc_html__( 'Fade In Down', 'akijcement-core' ),
			],
			'default' => '',
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'akijcement-core' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
		] );


		$this->end_controls_section();

		// Pagination Settings
		// =====================
		$this->start_controls_section( 'pagination_section', [
			'label' => esc_html__( 'Pagination', 'akijcement-core' ),
		] );

		$this->add_control( 'pagination_type', [
			'label'   => esc_html__( 'Pagination', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				''          => esc_html__( 'None', 'akijcement-core' ),
				'numbers'   => esc_html__( 'Numbers', 'akijcement-core' ),
				'load-more' => esc_html__( 'Button', 'akijcement-core' ),

			),
			'default' => '',
		] );

		$this->add_control( 'load_more_text', [
			'label'       => esc_html__( 'Load More Button Text', 'akijcement-core' ),
			'description' => esc_html__( 'Input custom text to load more button', 'akijcement-core' ),
			'default'     => __( 'Load More', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'condition'   => [
				'pagination_type' => 'load-more',
			],
		] );

		$this->add_responsive_control(
			'load_btn_margin',
			[
				'label'      => __( 'Margin', 'akijcement-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .jobs-pagination-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_section();


		// Query Settings
		// =====================
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'akijcement-core' ),
		] );

		$this->add_control(
			'posts_per_page',
			[
				'label'       => esc_html__( 'Items per page', 'akijcement-core' ),
				'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.',
					'akijcement-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
				'min'         => -1,
				'max'         => 100,
				'step'        => 1,
			]
		);


		$this->add_control(
			'order_by',
			[
				'label'       => __( 'Order by', 'akijcement-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'date'           => esc_html__( 'Date', 'akijcement-core' ),
					'ID'             => esc_html__( 'Post ID', 'akijcement-core' ),
					'author'         => esc_html__( 'Author', 'akijcement-core' ),
					'title'          => esc_html__( 'Title', 'akijcement-core' ),
					'modified'       => esc_html__( 'Last modified date', 'akijcement-core' ),
					'parent'         => esc_html__( 'Post/page parent ID', 'akijcement-core' ),
					'comment_count'  => esc_html__( 'Number of comments', 'akijcement-core' ),
					'menu_order'     => esc_html__( 'Menu order/Page Order', 'akijcement-core' ),
					'meta_value'     => esc_html__( 'Meta value', 'akijcement-core' ),
					'meta_value_num' => esc_html__( 'Meta value number', 'akijcement-core' ),
					'rand'           => esc_html__( 'Random order', 'akijcement-core' ),
				],
				'default'     => 'date',
				'separator'   => 'before',
				'description' => esc_html__( "Select how to sort retrieved posts. More at ",
						'akijcement-core' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => __( 'Sort Order', 'akijcement-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'ASC'  => esc_html__( 'Ascending', 'akijcement-core' ),
					'DESC' => esc_html__( 'Descending', 'akijcement-core' ),
				],
				'default'     => 'DESC',
				'separator'   => 'before',
				'description' => esc_html__( "Select Ascending or Descending order. More at",
						'akijcement-core' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		// Pagination Switcher
		// ====================
		$this->add_control(
			'pagination',
			[
				'label'        => esc_html__( 'Pagination', 'akijcement-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'akijcement-core' ),
				'label_off'    => esc_html__( 'Hide', 'akijcement-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();


		// Style Settings
		// =====================

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Portfolio Style', 'akijcement-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .akijcement-jobs-item .post-wrapper .jobs-info .jobs-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'akijcement-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .akijcement-jobs-item .post-wrapper .jobs-info .jobs-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typography',
				'label'    => __( 'Category Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .akijcement-jobs-item .post-wrapper .jobs-info .jobs-cat .cat',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label'     => __( 'Category Color', 'akijcement-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .akijcement-jobs-item .post-wrapper .jobs-info .jobs-cat .cat' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'overlay_background',
			[
				'label'     => __( 'Overlay Background', 'akijcement-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .akijcement-jobs-item .post-wrapper .post-thumbnail-wrapper a:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Style Settings
		// =====================

		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => __( 'Filter', 'akijcement-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'filter_typography',
				'label'    => __( 'Title Typography', 'akijcement-core' ),
				'selector' => '{{WRAPPER}} .akijcement-filter-buttons li a',
			]
		);

		$this->add_control(
			'filter_color',
			[
				'label'     => __( 'Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .akijcement-filter-buttons li:not(.current) a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_active_color',
			[
				'label'     => __( 'Active Color', 'akijcement-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .akijcement-filter-buttons li.current a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$_tax_query = array();


		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type'   => 'akij-product',
			'paged'       => $paged,
			'order'       => $settings['order'],
			'orderby'     => $settings['order_by'],
			'posts_per_page' => $settings['posts_per_page'],
			'post_status' => 'publish',
		);

		$dm_query = new \WP_Query( $args );

		$this->add_render_attribute( 'wrapper', 'class', [
			'dm-vessels__wrapper'
		] );

		?>


		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="row">
				<?php if ( $dm_query->have_posts() ) : ?>
                    <?php require __DIR__ . '/templates/product/product-grid.php';  ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'akijcement-core' ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( $settings['pagination'] == 'yes' ) : ?>
				<?php $this->pagination( $dm_query ); ?>
			<?php endif; ?>
		</div>
		<?php
	}

	// Pagination
	public function pagination( $dm_query ) {
		$big = 999999999; // need an unlikely integer
		$pages = paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $dm_query->max_num_pages,
			'type'      => 'array',
			'prev_text' => '<i class="ti-angle-left"></i>',
			'next_text' => '<i class="ti-angle-right"></i>',
		) );
		if ( is_array( $pages ) ) {
			$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
			echo '<div class="akijcement-pagination"><ul class="akijcement-pagination-list">';
			foreach ( $pages as $page ) {
				echo "<li>$page</li>";
			}
			echo '</ul></div>';
		}
	}
}