<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Advanced_Timeline_Widget
 *
 * Custom widget for displaying an advanced timeline with options for dynamic content.
 */
class Advanced_Timeline_Widget extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'advanced_timeline';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Advanced Timeline', 'turbo-addons' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-time-line';
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
     * Retrieve the list of scripts the widget depends on.
     *
     * @return array Widget scripts.
     */
    public function get_script_depends() {
        return [ 'advanced-timeline-script' ];
    }

    /**
     * Retrieve the list of styles the widget depends on.
     *
     * @return array Widget styles.
     */
    public function get_style_depends() {
        return [ 'advanced-timeline-style' ];
    }

    /**
     * Register widget controls.
     *
     * Adds input fields to allow the user to change and customize the widget settings.
     */
    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'turbo-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Layout Control
        $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => __( 'Horizontal', 'turbo-addons' ),
                    'vertical'   => __( 'Vertical', 'turbo-addons' ),
                ],
            ]
        );

        // Post Type Control
        $this->add_control(
            'post_type',
            [
                'label'       => __( 'Post Type', 'turbo-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'post',
                'description' => __( 'Enter the custom post type slug to load content dynamically.', 'turbo-addons' ),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Generates the final HTML for the widget on the front-end.
     */
    protected function render() {
        $settings  = $this->get_settings_for_display();
        $layout    = $settings['layout'];
        $post_type = $settings['post_type'];

        // Query arguments to fetch posts
        $query_args = [
            'post_type'      => $post_type,
            'posts_per_page' => -1,
        ];

        // Query for fetching posts
        $query = new \WP_Query( $query_args );

        if ( $query->have_posts() ) {
            echo '<div class="advanced-timeline ' . esc_attr( $layout ) . '">';

            while ( $query->have_posts() ) {
                $query->the_post();
                $icon  = get_post_meta( get_the_ID(), '_timeline_icon', true );
                $image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );

                echo '<div class="timeline-item">';
                echo '<div class="timeline-content">';

                // Display icon if available
                if ( $icon ) {
                    echo '<div class="timeline-icon"><i class="' . esc_attr( $icon ) . '"></i></div>';
                }

                // Display image if available
                if ( $image ) {
                    echo '<div class="timeline-image"><img src="' . esc_url( $image ) . '" alt="' . esc_attr( get_the_title() ) . '"></div>';
                }

                // Display post title
                echo '<h3>' . esc_html( get_the_title() ) . '</h3>';

                // Display post excerpt
                echo '<p>' . esc_html( get_the_excerpt() ) . '</p>';

                echo '</div>'; // Close timeline-content
                echo '</div>'; // Close timeline-item
            }

            echo '</div>'; // Close advanced-timeline
        }

        wp_reset_postdata(); // Restore original Post Data
    }
}

// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new Advanced_Timeline_Widget() );
