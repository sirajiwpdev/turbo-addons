<?php

namespace DesignMonks\AkijCement\Traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

trait PostQuery {

	/**
	 * Post Query
	 *
	 * @param string $post_type
	 * @param int $posts_per_page
	 * @param string $order
	 * @param string $orderby
	 *
	 * @return \WP_Query
	 */

	public function postQuery( $post_type, $posts_per_page, $order = 'DESC', $orderby = 'date', $category = '', $taxonomy_name = '') {
		// WP_Query arguments
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_status '   => array( 'publish' ),
		);

		if ( ! empty( $taxonomy_name ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy_name,
					'field'    => 'slug',
					'terms'    => $category,
				),
			);
		}

		// Ids
		if ( ! empty( $ids ) ) {
			$args['post__in'] = $ids;
		}

		// Exclude Ids
		if ( ! empty( $exclude_ids ) ) {
			$args['post__not_in'] = $exclude_ids;
		}

		$query = new \WP_Query( $args );

		return $query;
	}

	/**
	 * Query Controls
	 *
	 * @param string $prefix
	 */

	public function queryControls( $prefix, $taxonomy_name = '' ) {
		// Section
		$this->start_controls_section(
			$prefix . '_query_section',
			[
				'label' => __( 'Query', 'akijcement-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Items Per Page
		$this->add_control(
			$prefix . '_posts_per_page',
			[
				'label'       => __( 'Items Per Page', 'akijcement-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min'         => - 1,
				'max'         => 100,
				'default'     => 1,
				'description' => __( 'Number of items to show per page. Set -1 to show all items. Leave blank to use global setting', 'akijcement-core' ),
			]
		);

		// Order
		$this->add_control(
			$prefix . '_post_order',
			[
				'label'   => __( 'Order', 'akijcement-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __( 'DESC', 'akijcement-core' ),
					'ASC'  => __( 'ASC', 'akijcement-core' ),
				],
			]
		);

		// Order By
		$this->add_control(
			$prefix . '_post_orderby',
			[
				'label'       => __( 'Order By', 'akijcement-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'date',
				'options'     => [
					'date'          => __( 'Date', 'akijcement-core' ),
					'title'         => __( 'Title', 'akijcement-core' ),
					'modified'      => __( 'Modified', 'akijcement-core' ),
					'rand'          => __( 'Random', 'akijcement-core' ),
					'comment_count' => __( 'Comment Count', 'akijcement-core' ),
					'menu_order'    => __( 'Menu Order', 'akijcement-core' ),
				],
				'description' => __( 'Select how to sort retrieved posts. More at <a href="https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress Codex</a>', 'akijcement-core' ),
			]
		);

		if( ! empty( $taxonomy_name ) ) {
			// Select Categories
			$this->add_control(
				$prefix . '_post_categories',
				[
					'label'       => __( 'Select Categories', 'akijcement-core' ),
					'type'        => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'options'     => \AkijCement_Helper::akijcement_category_list( $taxonomy_name ),
					'description' => __( 'Select categories to show. Select nothing to show posts from all categories', 'akijcement-core' ),
				]
			);
		}

		// Exclude Categories
//		$this->add_control(
//			$prefix . '_post_categories_exclude',
//			[
//				'label'       => __( 'Exclude Categories', 'akijcement-core' ),
//				'type'        => \Elementor\Controls_Manager::SELECT2,
//				'label_block' => true,
//				'multiple'    => true,
//				'options'     => $this->getCategories( $taxonomy_name ),
//				'description' => __( 'Select categories to exclude. Select nothing to show posts from all categories', 'akijcement-core' ),
//			]
//		);


		// Input IDs
//		$this->add_control(
//			$prefix . '_post_ids',
//			[
//				'label'       => __( 'Input IDs', 'akijcement-core' ),
//				'type'        => \Elementor\Controls_Manager::TEXT,
//				'label_block' => true,
//				'placeholder' => __( '1,2,3,4', 'akijcement-core' ),
//			]
//		);

		// Exclude IDs
//		$this->add_control(
//			$prefix . '_post_ids_exclude',
//			[
//				'label'       => __( 'Exclude IDs', 'akijcement-core' ),
//				'type'        => \Elementor\Controls_Manager::TEXT,
//				'label_block' => true,
//				'placeholder' => __( '1,2,3,4', 'akijcement-core' ),
//			]
//		);

		$this->end_controls_section();

	}
}