<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Dynamic_Content_Slider
 *
 * Elementor widget for displaying a dynamic content slider.
 *
 * @since 1.0.0
 */
class Dynamic_Content_Slider extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name for use in the editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'dynamic_content_slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title for use in the editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Dynamic Content Slider', 'turbo-addons' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon for use in the editor.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-post-slider';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'turbo-addons' ];
    }

    /**
     * Register widget controls.
     *
     * Adds input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        // Start Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'turbo-addons' ),
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'   => esc_html__( 'Content Type', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'post'        => esc_html__( 'Posts', 'turbo-addons' ),
                    'testimonial' => esc_html__( 'Testimonials', 'turbo-addons' ),
                    'product'     => esc_html__( 'WooCommerce Products', 'turbo-addons' ),
                ],
                'default' => 'post',
            ]
        );

        $this->add_control(
            'taxonomy_filter',
            [
                'label'     => esc_html__( 'Filter by Taxonomy', 'turbo-addons' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->get_taxonomies(),
                'multiple'  => true,
                'condition' => [
                    'content_type!' => 'product',
                ],
            ]
        );

        $this->add_control(
            'term_filter',
            [
                'label'     => esc_html__( 'Filter by Terms', 'turbo-addons' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->get_terms(),
                'multiple'  => true,
                'condition' => [
                    'content_type!' => 'product',
                ],
            ]
        );

        $this->add_control(
            'product_category_filter',
            [
                'label'     => esc_html__( 'Filter by Product Category', 'turbo-addons' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->get_product_categories(),
                'multiple'  => true,
                'condition' => [
                    'content_type' => 'product',
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__( 'Posts Per Page', 'turbo-addons' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'date'       => esc_html__( 'Date', 'turbo-addons' ),
                    'title'      => esc_html__( 'Title', 'turbo-addons' ),
                    'menu_order' => esc_html__( 'Menu Order', 'turbo-addons' ),
                    'rand'       => esc_html__( 'Random', 'turbo-addons' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'Ascending', 'turbo-addons' ),
                    'DESC' => esc_html__( 'Descending', 'turbo-addons' ),
                ],
                'default' => 'DESC',
            ]
        );

        $this->end_controls_section();
        // End Content Section
    }

    /**
     * Get taxonomies.
     *
     * Retrieve a list of public taxonomies for the filter options.
     *
     * @since 1.0.0
     * @access protected
     * @return array Taxonomy options.
     */
    protected function get_taxonomies() {
        $taxonomies = get_taxonomies( [ 'public' => true ], 'objects' );
        $options = [];
        foreach ( $taxonomies as $taxonomy ) {
            $options[ $taxonomy->name ] = $taxonomy->label;
        }
        return $options;
    }

    /**
     * Get terms.
     *
     * Retrieve a list of terms for the selected taxonomies for the filter options.
     *
     * @since 1.0.0
     * @access protected
     * @return array Terms options.
     */
    protected function get_terms() {
        $terms = get_terms( [ 'taxonomy' => array_keys( $this->get_taxonomies() ), 'hide_empty' => false ] );
        $options = [];
        foreach ( $terms as $term ) {
            $options[ $term->term_id ] = $term->name;
        }
        return $options;
    }

    /**
     * Get product categories.
     *
     * Retrieve a list of WooCommerce product categories for the filter options.
     *
     * @since 1.0.0
     * @access protected
     * @return array Product category options.
     */
    protected function get_product_categories() {
        if ( ! class_exists( 'WooCommerce' ) ) return [];
        $terms = get_terms( [ 'taxonomy' => 'product_cat', 'hide_empty' => false ] );
        $options = [];
        foreach ( $terms as $term ) {
            $options[ $term->term_id ] = $term->name;
        }
        return $options;
    }

    /**
     * Render the widget output on the frontend.
     *
     * Generate the final HTML for displaying the dynamic content slider on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Setup query args
        $query_args = [
            'post_type'      => $settings['content_type'],
            'posts_per_page' => $settings['posts_per_page'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
        ];

        // Apply taxonomy filters if applicable
        if ( 'product' === $settings['content_type'] && ! empty( $settings['product_category_filter'] ) ) {
            // Generate a unique transient key based on the product category filter
            $transient_key = 'tr_product_query_' . md5( serialize( $settings['product_category_filter'] ) );
            $query_results = get_transient( $transient_key );

            if ( false === $query_results ) {
                $query_args['tax_query'] = [
                    [
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => array_map( 'intval', $settings['product_category_filter'] ),
                    ],
                ];

                // Run the query
                $query_results = new WP_Query( $query_args );

                // Store the results in a transient, expire in 12 hours
                set_transient( $transient_key, $query_results, 12 * HOUR_IN_SECONDS );
            }

            // Use $query_results from transient or query
            $query = $query_results;
        } else {
            // General taxonomy filter
            if ( ! empty( $settings['taxonomy_filter'] ) && ! empty( $settings['term_filter'] ) ) {
                $query_args['tax_query'] = [
                    [
                        'taxonomy' => sanitize_text_field( $settings['taxonomy_filter'] ),
                        'field'    => 'term_id',
                        'terms'    => array_map( 'intval', $settings['term_filter'] ),
                    ],
                ];
            }

            // Execute query if not cached
            $query = new WP_Query( $query_args );
        }

        // Check if query has posts
        if ( $query->have_posts() ) {
            echo '<div class="tr-dynamic-content-slider">';

            // Loop through posts
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<div class="tr-slide">';
                echo '<h3>' . esc_html( get_the_title() ) . '</h3>';
                echo '<div class="tr-slide-content">' . wp_kses_post( get_the_excerpt() ) . '</div>';
                echo '<a href="' . esc_url( get_permalink() ) . '" class="tr-read-more">' . esc_html__( 'Read More', 'turbo-addons' ) . '</a>';
                echo '</div>';
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            // No posts found message
            printf( '<p>%s</p>', esc_html__( 'No posts found', 'turbo-addons' ) );
        }
    }
}

// Register the widget with Elementor.
Plugin::instance()->widgets_manager->register_widget_type( new Dynamic_Content_Slider() );
