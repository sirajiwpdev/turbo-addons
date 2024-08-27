<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Advanced_Tabs_Accordions
 *
 * Custom widget for displaying advanced tabs and accordions with options for nested tabs.
 */
class Advanced_Tabs_Accordions extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'advanced_tabs_accordions';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Advanced Tabs & Accordions', 'turbo-addons' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-tabs';
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
     * Register widget controls.
     *
     * Adds input fields to allow the user to change and customize the widget settings.
     */
    protected function _register_controls() {

        // Start Controls Section for Tabs & Accordions
        $this->start_controls_section(
            'section_tabs_accordions',
            [
                'label' => __( 'Tabs & Accordions', 'turbo-addons' ),
            ]
        );

        // Layout Control
        $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout', 'turbo-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => __( 'Horizontal', 'turbo-addons' ),
                    'vertical'   => __( 'Vertical', 'turbo-addons' ),
                ],
                'default' => 'horizontal',
            ]
        );

        // Repeater for Tab Items
        $repeater = new Repeater();

        // Tab Title Control
        $repeater->add_control(
            'tab_title',
            [
                'label'   => __( 'Title', 'turbo-addons' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'turbo-addons' ),
            ]
        );

        // Tab Content Control
        $repeater->add_control(
            'tab_content',
            [
                'label'   => __( 'Content', 'turbo-addons' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => __( 'Tab Content', 'turbo-addons' ),
            ]
        );

        // Nested Tabs Switcher Control
        $repeater->add_control(
            'nested_tabs',
            [
                'label'   => __( 'Nested Tabs', 'turbo-addons' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        // Nested Tabs Content Repeater
        $repeater->add_control(
            'nested_tabs_content',
            [
                'label'       => __( 'Nested Tabs Content', 'turbo-addons' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
                'condition'   => [
                    'nested_tabs' => 'yes',
                ],
            ]
        );

        // Add Tabs Control
        $this->add_control(
            'tabs',
            [
                'label'       => __( 'Tabs Items', 'turbo-addons' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title'   => __( 'Tab #1', 'turbo-addons' ),
                        'tab_content' => __( 'Tab Content #1', 'turbo-addons' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
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
        $settings = $this->get_settings_for_display(); // Get widget settings

        // Determine layout class based on settings
        $layout_class = $settings['layout'] === 'vertical' ? ' vertical' : ' horizontal';

        echo '<div class="tr-advanced-tabs-accordions' . esc_attr( $layout_class ) . '">';

        if ( $settings['tabs'] ) {
            echo '<div class="tr-tabs">';
            foreach ( $settings['tabs'] as $index => $item ) {
                $tab_title_key   = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                $tab_content_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                // Add attributes for tab title
                $this->add_render_attribute( $tab_title_key, 'class', [ 'tr-tab-title' ] );
                $this->add_render_attribute( $tab_title_key, 'data-tab', 'tab-' . $index );

                // Add attributes for tab content
                $this->add_render_attribute( $tab_content_key, 'class', 'tr-tab-content' );
                $this->add_render_attribute( $tab_content_key, 'data-tab', 'tab-' . $index ); // Match data-tab attribute

                // Render tab title
               echo '<div ' . esc_attr( $this->get_render_attribute_string( $tab_title_key ) ) . '>';
                echo '<h4>' . esc_html( $item['tab_title'] ) . '</h4>';
                echo '</div>';

                // Render tab content
                echo '<div ' . esc_attr($this->get_render_attribute_string( $tab_content_key ) ) . '>';
                echo '<div class="tr-content">' . wp_kses_post( $item['tab_content'] ) . '</div>';

                // Check for nested tabs and render if available
                if ( 'yes' === $item['nested_tabs'] ) {
                    echo '<div class="tr-nested-tabs">';
                    foreach ( $item['nested_tabs_content'] as $nested_index => $nested_item ) {
                        echo '<div class="tr-nested-tab">';
                        echo '<h5>' . esc_html( $nested_item['tab_title'] ) . '</h5>';
                        echo '<div class="tr-nested-content">' . wp_kses_post( $nested_item['tab_content'] ) . '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }

                echo '</div>';
            }
            echo '</div>';
        }

        echo '</div>';
    }
}

// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new Advanced_Tabs_Accordions() );
