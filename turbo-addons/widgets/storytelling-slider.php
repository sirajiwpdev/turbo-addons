<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Storytelling_Slider extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'tr_storytelling_slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return __('Storytelling Slider', 'turbo-addons');
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
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
        return ['turbo-addons'];
    }

    /**
     * Get script dependencies.
     *
     * Retrieve the list of scripts the widget requires.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['tr-storytelling-slider-js'];
    }

    /**
     * Get style dependencies.
     *
     * Retrieve the list of styles the widget requires.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget style dependencies.
     */
    public function get_style_depends() {
        return ['tr-storytelling-slider-css'];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'turbo-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label' => __('Content Type', 'turbo-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'posts',
                'options' => [
                    'posts' => __('Posts', 'turbo-addons'),
                    'pages' => __('Pages', 'turbo-addons'),
                    'custom' => __('Custom Content', 'turbo-addons'),
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Items', 'turbo-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'condition' => [
                    'content_type!' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'custom_content',
            [
                'label' => __('Custom Content', 'turbo-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'slide_content',
                        'label' => __('Content', 'turbo-addons'),
                        'type' => Controls_Manager::WYSIWYG,
                    ],
                    [
                        'name' => 'media_type',
                        'label' => __('Media Type', 'turbo-addons'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'image' => __('Image', 'turbo-addons'),
                            'video' => __('Video', 'turbo-addons'),
                            'audio' => __('Audio', 'turbo-addons'),
                        ],
                        'default' => 'image',
                    ],
                    [
                        'name' => 'media_url',
                        'label' => __('Media URL', 'turbo-addons'),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __('https://your-link.com', 'turbo-addons'),
                    ],
                ],
                'default' => [],
                'title_field' => '{{{ media_type }}}',
                'condition' => [
                    'content_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label' => __('Animation Type', 'turbo-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fade' => __('Fade', 'turbo-addons'),
                    'slide' => __('Slide', 'turbo-addons'),
                    'zoom' => __('Zoom', 'turbo-addons'),
                    'flip' => __('Flip', 'turbo-addons'),
                ],
                'default' => 'fade',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'parallax_section',
            [
                'label' => __('Parallax & Text Animations', 'turbo-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_parallax',
            [
                'label' => __('Enable Parallax Effect', 'turbo-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'turbo-addons'),
                'label_off' => __('No', 'turbo-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'text_animation',
            [
                'label' => __('Text Animation', 'turbo-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'turbo-addons'),
                    'fade_in' => __('Fade In', 'turbo-addons'),
                    'slide_in' => __('Slide In', 'turbo-addons'),
                    'zoom_in' => __('Zoom In', 'turbo-addons'),
                ],
                'default' => 'fade_in',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Generates the final HTML on the frontend using settings from the editor.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Initialize the slider
        echo '<div class="tr-storytelling-slider" data-animation="' . esc_attr($settings['animation_type']) . '">';
        
        if ($settings['content_type'] === 'custom') {
            foreach ($settings['custom_content'] as $item) {
                echo '<div class="tr-slide">';
                if ($item['media_type'] === 'image' && !empty($item['media_url']['url'])) {
                    echo '<img src="' . esc_url($item['media_url']['url']) . '" alt="">';
                } elseif ($item['media_type'] === 'video' && !empty($item['media_url']['url'])) {
                    echo '<video controls><source src="' . esc_url($item['media_url']['url']) . '" type="video/mp4"></video>';
                } elseif ($item['media_type'] === 'audio' && !empty($item['media_url']['url'])) {
                    echo '<audio controls><source src="' . esc_url($item['media_url']['url']) . '" type="audio/mpeg"></audio>';
                }
                echo '<div class="tr-slide-content">' . wp_kses_post($item['slide_content']) . '</div>';
                echo '</div>';
            }
        } else {
            // Query posts or pages based on settings
            $query_args = [
                'post_type' => $settings['content_type'],
                'posts_per_page' => $settings['posts_per_page'],
                'post_status' => 'publish',
            ];
            $query = new \WP_Query($query_args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<div class="tr-slide">';
                    echo '<h2>' . esc_html( get_the_title() ) . '</h2>';
                    echo '<div class="tr-slide-content">' . esc_html( get_the_excerpt() ) . '</div>';
                    echo '</div>';
                }
                wp_reset_postdata();
            }
        }

        echo '</div>';
    }

    /**
     * Render widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template() {
        ?>
        <#
        view.addInlineEditingAttributes( 'content', 'none' );
        var animationType = settings.animation_type ? settings.animation_type : 'fade';

        #>
        <div class="tr-storytelling-slider" data-animation="{{ animationType }}">
            <# if ( settings.content_type === 'custom' ) { #>
                <# _.each( settings.custom_content, function( item ) { #>
                    <div class="tr-slide">
                        <# if ( item.media_type === 'image' && item.media_url.url ) { #>
                            <img src="{{ item.media_url.url }}" alt="">
                        <# } else if ( item.media_type === 'video' && item.media_url.url ) { #>
                            <video controls><source src="{{ item.media_url.url }}" type="video/mp4"></video>
                        <# } else if ( item.media_type === 'audio' && item.media_url.url ) { #>
                            <audio controls><source src="{{ item.media_url.url }}" type="audio/mpeg"></audio>
                        <# } #>
                        <div class="tr-slide-content">{{{ item.slide_content }}}</div>
                    </div>
                <# }); #>
            <# } else { #>
                <# // Placeholder for posts/pages loop, since it cannot be previewed in the editor #>
                <div class="tr-slide">
                    <h2><?php esc_html_e( 'Sample Post Title', 'turbo-addons' ); ?></h2>
                    <div class="tr-slide-content"><?php esc_html_e( 'Sample excerpt or description for the slide.', 'turbo-addons' ); ?></div>
                </div>
            <# } #>
        </div>
        <?php
    }
}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new Storytelling_Slider() );
