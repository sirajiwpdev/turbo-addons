<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Popular_Posts extends Widget_Base {

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
		return 'popular-posts';
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
		return __( 'Popular Posts', 'turbo-addons' );
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
		return 'eicon-post-list';
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
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Basic', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'heading_text',
			[
				'label'       => __( 'Heading Text', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'title'       => __( 'Enter some text', 'turbo-addons' ),
				'placeholder' => __( 'Popular Posts', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Number of Posts', 'turbo-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1  => __( 'One', 'turbo-addons' ),
					2  => __( 'Two', 'turbo-addons' ),
					5  => __( 'Five', 'turbo-addons' ),
					10 => __( 'Ten', 'turbo-addons' ),
					-1 => __( 'All', 'turbo-addons' ),
				],
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
		$custom_text = ! empty( $settings['heading_text'] ) ? $settings['heading_text'] : esc_html__( 'Popular Posts', 'turbo-addons' );
		$post_count = ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 5;

		echo '<h3>' . esc_html( $custom_text ) . '</h3>';

		// Query arguments to get popular posts
		$args = [
			'numberposts' => $post_count,
		];

		$recent_posts = wp_get_recent_posts( $args );
		if ( ! empty( $recent_posts ) ) {
			echo '<ul class="popular-posts">';
			foreach ( $recent_posts as $recent ) {
				echo '<li><a href="' . esc_url( get_permalink( $recent["ID"] ) ) . '">' . esc_html( $recent["post_title"] ) . '</a></li>';
			}
			echo '</ul>';
		} else {
			echo '<p>' . esc_html__( 'No popular posts found.', 'turbo-addons' ) . '</p>';
		}

		wp_reset_postdata();
	}

	/**
	 * Render widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		var custom_text = settings.heading_text ? settings.heading_text : 'Popular Posts';
		#>
		<h3>{{{ custom_text }}}</h3>
		<ul class="popular-posts">
			<#
			for ( var i = 0; i < settings.posts_per_page; i++ ) {
				var post_title = 'Post Title ' + ( i + 1 );
				#>
				<li><a href="#">{{{ post_title }}}</a></li>
				<#
			}
			#>
		</ul>
		<?php
	}

	/**
	 * Render plain content for the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param array $instance Widget settings.
	 */
	public function render_plain_content( $instance = [] ) {
		// In case needed to provide plain content.
	}
}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new Popular_Posts() );
