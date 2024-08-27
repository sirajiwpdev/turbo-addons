<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MYEW_Pricing_Table_Widget extends Widget_Base {

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
		return 'myewpricing-table-widget-id';
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
		return esc_html__( 'Pricing Table', 'turbo-addons' );
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
		return 'eicon-price-table';
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
		$this->register_header_controls();
		$this->register_price_controls();
		$this->register_listing_controls();
		$this->register_button_controls();
		$this->register_style_controls();
	}

	/**
	 * Register header controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_header_controls() {
		$this->start_controls_section(
			'header_section',
			[
				'label' => __( 'Header', 'my-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'header_title',
			[
				'label' => __( 'Title', 'turbo-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Pricing Title', 'turbo-addons' ),
				'label_block' => true,
				'placeholder' => __( 'Type your title here', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'header_description',
			[
				'label' => __( 'Description', 'turbo-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( 'Default description', 'turbo-addons' ),
				'placeholder' => __( 'Type your description here', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'show_badge',
			[
				'label' => __( 'Show Badge', 'turbo-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'turbo-addons' ),
				'label_off' => __( 'Hide', 'turbo-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'header_badge_text',
			[
				'label' => __( 'Badge Text', 'turbo-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Popular', 'turbo-addons' ),
				'label_block' => true,
				'placeholder' => __( 'Badge text', 'turbo-addons' ),
				'condition' => [
					'show_badge' => 'yes'
				]
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register price controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_price_controls() {
		$this->start_controls_section(
			'price_section',
			[
				'label' => __( 'Pricing', 'my-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pricing_price',
			[
				'label' => __( 'Price', 'turbo-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$99', 'turbo-addons' ),
				'label_block' => true,
				'placeholder' => __( 'Type your price here', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'pricing_duration',
			[
				'label' => __( 'Duration', 'turbo-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'year', 'turbo-addons' ),
				'label_block' => true,
				'placeholder' => __( 'Type your duration here', 'turbo-addons' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register listing controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_listing_controls() {
		$this->start_controls_section(
			'listing_section',
			[
				'label' => __( 'Listing', 'my-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'feature_text',
			[
				'label' => __( 'Feature Text', 'turbo-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Feature', 'turbo-addons' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_icon',
			[
				'label' => __( 'Feature Icon', 'turbo-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'turbo-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'feature_text' => __( 'Up to 5 users', 'turbo-addons' ),
					],
					[
						'feature_text' => __( 'Max 100 items/month', 'turbo-addons' ),
					],
					[
						'feature_text' => __( '500 queries', 'turbo-addons' ),
					],
					[
						'feature_text' => __( 'Basic statistics', 'turbo-addons' ),
					],
				],
				'title_field' => '{{{ feature_text }}}',
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
				'label' => __( 'Button', 'my-elementor-widget' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'turbo-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Get This Plan', 'turbo-addons' ),
				'label_block' => true,
				'placeholder' => __( 'Type your button text here', 'turbo-addons' ),
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'turbo-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'turbo-addons' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'show_external' => true, // Show the 'open in new tab' option.
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
	private function register_style_controls() {
		// Implement style controls here...
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
		$button_url = $settings['button_link']['url'] ? esc_url( $settings['button_link']['url'] ) : '#';
		$button_target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$button_nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';

		?>
		<div class="pricing-table">
			<div class="pricing-table-header">
				<?php if ( 'yes' === $settings['show_badge'] ) : ?>
					<span class="popular"><?php echo esc_html( $settings['header_badge_text'] ); ?></span>
				<?php endif; ?>
				<h2 class="header-title"><?php echo esc_html( $settings['header_title'] ); ?></h2>
				<p class="header-subtitle"><?php echo esc_html( $settings['header_description'] ); ?></p>
			</div>
			<div class="pricing-table-price">
				<div class="price"><?php echo esc_html( $settings['pricing_price'] ); ?></div>
				<div class="price-divider">/</div>
				<div class="price-duration"><?php echo esc_html( $settings['pricing_duration'] ); ?></div>
			</div>
			<div class="pricing-table-feature">
				<?php foreach ( $settings['list'] as $item ) : ?>
					<div><?php Icons_Manager::render_icon( $item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?> <?php echo esc_html( $item['feature_text'] ); ?></div>
				<?php endforeach; ?>
			</div>
			<div class="pricing-table-action">
				<a href="<?php echo esc_url( $button_url ); ?>" <?php echo esc_attr( $button_target ); ?> <?php echo esc_attr( $button_nofollow ); ?> class="button button-pricing-action"><?php echo esc_html( $settings['button_text'] ); ?></a>

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
		view.addInlineEditingAttributes( 'header_title', 'none' );
		view.addInlineEditingAttributes( 'header_description', 'none' );
		view.addInlineEditingAttributes( 'header_badge_text', 'none' );
		view.addInlineEditingAttributes( 'pricing_price', 'none' );
		view.addInlineEditingAttributes( 'pricing_duration', 'none' );
		view.addInlineEditingAttributes( 'button_text', 'none' );

		var button_url = settings.button_link.url ? settings.button_link.url : '#';
		var button_target = settings.button_link.is_external ? ' target="_blank"' : '';
		var button_nofollow = settings.button_link.nofollow ? ' rel="nofollow"' : '';

		#>
		<div class="pricing-table">
			<div class="pricing-table-header">
				<# if ( 'yes' === settings.show_badge ) { #>
					<span class="popular">{{{ settings.header_badge_text }}}</span>
				<# } #>
				<h2 class="header-title">{{{ settings.header_title }}}</h2>
				<p class="header-subtitle">{{{ settings.header_description }}}</p>
			</div>
			<div class="pricing-table-price">
				<div class="price">{{{ settings.pricing_price }}}</div>
				<div class="price-divider">/</div>
				<div class="price-duration">{{{ settings.pricing_duration }}}</div>
			</div>
			<div class="pricing-table-feature">
				<# _.each( settings.list, function( item ) { #>
					<div>{{{ elementor.helpers.renderIcon( view, item.feature_icon, { 'aria-hidden': true }, 'i', 'object' ) }}} {{{ item.feature_text }}}</div>
				<# }); #>
			</div>
			<div class="pricing-table-action">
				<a href="{{ button_url }}"{{ button_target }}{{ button_nofollow }} class="button button-pricing-action">{{{ settings.button_text }}}</a>
			</div>
		</div>
		<?php
	}

}

// Register widget
Plugin::instance()->widgets_manager->register_widget_type( new MYEW_Pricing_Table_Widget() );
