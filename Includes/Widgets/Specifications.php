<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Repeater,
	Group_Control_Box_Shadow,
	Utils,
	Group_Control_Border,

};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class LogoList
 * @package DesignMonks\AkijCement\Widgets
 */
class Specifications extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'akijcement-specifications';
	}


	/**
	 * Get widget title.
	 * Retrieve alert widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'DM Specifications', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve alert widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {

		return 'eicon-logo';
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

	/**
	 * Register alert widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section( 'logo_content', [
			'label' => __( 'Logo List', 'akijcement-core' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => __( 'Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'value', [
			'label'       => __( 'Value', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
            'rows'        => 3,
			'label_block' => true,
		] );

		$this->add_control( 'specifications', [
			'label'       => __( 'Logo List', 'akijcement-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title' => __( 'Strength class', 'akijcement-core' ),
					'value' => __( '52.5 N', 'akijcement-core' ),
				],
				[
					'title' => __( 'Ingredients', 'akijcement-core' ),
					'value' => __( 'Clinker 95-97% and Gypsum 3-5%', 'akijcement-core' ),
				],
				[
					'title' => __( 'Standard comply to', 'akijcement-core' ),
					'value' => __( 'BDS EN 197-1:2010; Comply to ASTM C 150-94/BS- 12:96/IS.2269', 'akijcement-core' ),
				],
				[
					'title' => __( 'Chemical compositions', 'akijcement-core' ),
					'value' => __( '60 +_ 2% (C3S), > 17% (C2S),< 9% (C3A), < 10% (C4AF), < 5 % (MgO), < 3.5 % (SO3), < 5%  Ignition loss, and <1.5% free CaO', 'akijcement-core' ),
				]
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['specifications'] ) { ?>
            <ul class="specifications">
                <?php foreach ( $settings['specifications'] as $item ) { ?>
                    <li class="specifications-list__item" data-bs-original-title="<?php echo esc_attr( $item['title'] ) ?>">
                        <div class="specifications-list">
                            <h3 class="specifications-title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <?php if( !empty( $item['value'] ) ) { ?>
                                <p class="specifications-value"><?php echo $item['value']; ?></p>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php }
	}
}