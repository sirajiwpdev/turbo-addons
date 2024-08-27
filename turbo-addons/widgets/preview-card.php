<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MYEW_Preview_Card_Widget extends Widget_Base {

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
		return 'myew-preview-card-widget-id';
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
		return esc_html__( 'Preview Card Widget', 'turbo-addons' );
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
		return 'eicon-lightbox';
	}

	/**
	 * Get script dependencies.
	 *
	 * Retrieve the scripts the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget scripts.
	 */
	public function get_script_depends() {
		return [
			'turbo-script'
		];
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
		$this->register_image_controls();
		$this->register_content_controls();
		$this->register_badge_controls();
		$this->register_button_controls();
		$this->style_tab();
	}

	/**
	 * Register image controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_image_controls() {
		$this->start_controls_section(
			'image_section',
			[
				'label' => __( 'Image', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'turbo-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'show_image_link',
			[
				'label'        => __( 'Show Image Link', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'turbo-addons' ),
				'label_off'    => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'image_link',
			[
				'label'       => __( 'Image Link', 'turbo-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'turbo-addons' ),
				'show_external' => true,
				'default'     => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition'   => [
					'show_image_link' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register content controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_title',
			[
				'label'       => __( 'Title', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Default title', 'turbo-addons' ),
				'label_block' => true,
				'placeholder' => __( 'Type your title here', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'show_divider',
			[
				'label'        => __( 'Show Divider', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'turbo-addons' ),
				'label_off'    => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'item_description',
			[
				'label'       => __( 'Description', 'turbo-addons' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'Default description', 'turbo-addons' ),
				'placeholder' => __( 'Type your description here', 'turbo-addons' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register badge controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_badge_controls() {
		$this->start_controls_section(
			'badge_section',
			[
				'label' => __( 'Badge', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_top_badge',
			[
				'label'        => __( 'Show Top Badge', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'turbo-addons' ),
				'label_off'    => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'top_badge_text',
			[
				'label'       => __( 'Top Badge Text', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'On Sale!', 'turbo-addons' ),
				'placeholder' => __( 'Type your text here', 'turbo-addons' ),
				'condition'   => [
					'show_top_badge' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_middle_badge',
			[
				'label'        => __( 'Show Middle Badge', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'turbo-addons' ),
				'label_off'    => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'middle_badge_text',
			[
				'label'       => __( 'Middle Badge Text', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$19.99', 'turbo-addons' ),
				'placeholder' => __( 'Type your text here', 'turbo-addons' ),
				'condition'   => [
					'show_middle_badge' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_bottom_badge',
			[
				'label'        => __( 'Show Bottom Badge', 'turbo-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'turbo-addons' ),
				'label_off'    => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'bottom_badge_text',
			[
				'label'       => __( 'Bottom Badge Text', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$19.99', 'turbo-addons' ),
				'placeholder' => __( 'Type your text here', 'turbo-addons' ),
				'condition'   => [
					'show_bottom_badge' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register button controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_button_controls() {
		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button', 'turbo-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Link', 'turbo-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'turbo-addons' ),
				'show_external' => true,
				'default'     => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Text', 'turbo-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Buy Now', 'turbo-addons' ),
				'placeholder' => __( 'Type your text here', 'turbo-addons' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function style_tab() {
		// Code for registering style controls...
		// This is where you define the controls related to styles, like padding, margin, colors, etc.
		// You can separate it into different sections, like for image styles, content styles, etc.
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
		$image_target = $settings['image_link']['is_external'] ? ' target="_blank"' : '';
		$image_nofollow = $settings['image_link']['nofollow'] ? ' rel="nofollow"' : '';
		$button_target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$button_nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';

		$this->add_inline_editing_attributes( 'card_title', 'none' );
		$this->add_inline_editing_attributes( 'item_description', 'advanced' );
		?>
		<div class="image-card">
			<div class="image-wrapper">
				<div class="image" style="background-image: url(<?php echo esc_url( $settings['image']['url'] ); ?>);">
					<?php if ( 'yes' === $settings['show_image_link'] ) : ?>
						<a href="<?php echo esc_url( $settings['image_link']['url'] ); ?>" <?php echo esc_attr( $image_target ); ?> <?php echo esc_attr( $image_nofollow ); ?>></a>
					<?php endif; ?>
					<?php if ( 'yes' === $settings['show_top_badge'] ) : ?>
						<span class="top-price-badge badge-blue"><?php echo esc_html( $settings['top_badge_text'] ); ?></span>
					<?php endif; ?>
					<?php if ( 'yes' === $settings['show_middle_badge'] ) : ?>
						<span class="middle-price-badge badge-blue"><?php echo esc_html( $settings['middle_badge_text'] ); ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="content">
				<div class="title">
					<h2 <?php echo esc_attr( $this->get_render_attribute_string( 'card_title' ) ); ?>><?php echo esc_html( $settings['card_title'] ); ?></h2>
				</div>
				<?php if ( 'yes' === $settings['show_divider'] ) : ?>
					<div class="divider"></div>
				<?php endif; ?>
				<div class="excerpt">
					<div <?php echo esc_attr( $this->get_render_attribute_string( 'item_description' ) ); ?>>
    <?php echo wp_kses_post( $settings['item_description'] ); ?>
</div>
				</div>
				<div class="readmore">
					<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" <?php echo esc_attr( $button_target ); ?> <?php echo esc_attr( $button_nofollow ); ?> class="button button-readmore"><?php echo esc_html( $settings['button_text'] ); ?></a>
					<?php if ( 'yes' === $settings['show_bottom_badge'] ) : ?>
						<span class="bottom-price-badge badge-blue"><?php echo esc_html( $settings['bottom_badge_text'] ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
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
		var image_target = settings.image_link.is_external ? ' target="_blank"' : '';
		var image_nofollow = settings.image_link.nofollow ? ' rel="nofollow"' : '';

		var link_target = settings.button_link.is_external ? ' target="_blank"' : '';
		var link_nofollow = settings.button_link.nofollow ? ' rel="nofollow"' : '';

		view.addInlineEditingAttributes( 'card_title', 'none' );
		view.addInlineEditingAttributes( 'item_description', 'none' );
		#>
		<div class="image-card">
			<div class="image-wrapper">
				<div class="image" style="background-image: url({{ settings.image.url }});">
					<# if ( 'yes' === settings.show_image_link ) { #>
						<a href="{{ settings.image_link.url }}" {{ image_target }} {{ image_nofollow }}></a>
					<# } #>
					<# if ( 'yes' === settings.show_top_badge ) { #>
						<span class="top-price-badge badge-blue">{{{ settings.top_badge_text }}}</span>
					<# } #>
					<# if ( 'yes' === settings.show_middle_badge ) { #>
					<span class="middle-price-badge badge-blue">{{{ settings.middle_badge_text }}}</span>
					<# } #>
				</div>
			</div>
			<div class="content">
				<div class="title">
					<h2 {{{ view.getRenderAttributeString( 'card_title' ) }}}>{{{ settings.card_title }}}</h2>
				</div>
				<# if ( 'yes' === settings.show_divider ) { #>
				<div class="divider"></div>
				<# } #>
				<div class="excerpt">
					<div {{{ view.getRenderAttributeString( 'item_description' ) }}}>
						{{{ settings.item_description }}}
					</div>
				</div>
				<div class="readmore">
					<a href="{{ settings.button_link.url }}" {{ link_target }} {{ link_nofollow }} class="button button-readmore">{{{ settings.button_text }}}</a>
					<# if ( 'yes' === settings.show_bottom_badge ) { #>
					<span class="bottom-price-badge badge-blue">{{{ settings.bottom_badge_text }}}</span>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}

}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new MYEW_Preview_Card_Widget() );
