<?php

namespace DesignMonks\AkijCement\Widgets;

use DesignMonks\AkijCement\IconsPack;
use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Group_Control_Typography,
	Utils,
	Widget_Base
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class IconBox
 * @package DesignMonks\AkijCement\Widgets
 */
class IconBox extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Icon Box widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'akijcement-icon-box';
	}

	/**
	 * Get widget title.
	 * Retrieve Icon Box widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'DM Icon Box', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Icon Box widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Icon Box widget belongs to.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the Icon Box widget belongs to.
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return [ 'icon', 'box', 'icon box', 'iconbox', 'icon-box' ];
	}

	/**
	 * Register Icon Box widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section( 'general_section', [
			'label' => esc_html__( 'Preset', 'akijcement-core' ),
		] );

		$this->add_control(
			'enable_equal_height',
			[
				'label'        => esc_html__( 'Equal Height?', 'elementskit-lite' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'disable' => esc_html__( 'Disable', 'elementskit-lite' ),
					'enable'  => esc_html__( 'Enable', 'elementskit-lite' ),
				],
				'default'      => 'disable',
				'prefix_class' => 'akijcement-equal-height-',
				'selectors'    => [
					'{{WRAPPER}}.akijcement-equal-height-enable, {{WRAPPER}}.akijcement-equal-height-enable .elementor-widget-container, {{WRAPPER}}.akijcement-equal-height-enable .akijcement-icon-box' => 'height: 100%;',
				],
			]
		);

		$this->end_controls_section();


		// Icon and Image
		//==================
		$this->start_controls_section( 'section_tab', [
			'label' => esc_html__( 'Icon and Image', 'akijcement-core' ),
		] );

		$this->add_control( 'icon_type', [
			'label'       => esc_html__( 'Add Icon/Image', 'akijcement-core' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'none'       => [
					'title' => esc_html__( 'None', 'akijcement-core' ),
					'icon'  => 'eicon-ban',
				],
				'type_icon'  => [
					'title' => esc_html__( 'Icon', 'akijcement-core' ),
					'icon'  => 'eicon-paint-brush',
				],
				'type_image' => [
					'title' => esc_html__( 'Image', 'akijcement-core' ),
					'icon'  => 'eicon-image-bold',
				]
			],
			'default'     => 'type_icon',
		] );

		$this->add_control( 'icon_pack', [
			'label'     => esc_html__( 'Icon Pack', 'akijcement-core' ),
			'type'      => Controls_Manager::SELECT,
			'condition' => [
				'icon_type' => 'type_icon',
			],
			'options'   => [
				'fontawesome' => esc_html__( 'Fontawesome', 'akijcement-core' ),
				'feather'     => esc_html__( 'Feather', 'akijcement-core' ),
				'simpleline'  => esc_html__( 'Simple Line', 'akijcement-core' ),
			],
			'default'   => 'fontawesome',
		] );

		$this->add_control( 'box_icon', [
			'label'     => __( 'Icon', 'akijcement-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-star',
				'library' => 'solid',
			],
			'condition' => [
				'icon_pack' => 'fontawesome',
				'icon_type' => 'type_icon',
			]
		] );

		$this->add_control( 'feather_icon', [
			'label'       => __( 'Choose Icon', 'akijcement-core' ),
			'type'        => Controls_Manager::ICON,
			'options'     => IconsPack::akijcement_feather_icon(),
			'include'     => IconsPack::akijcement_include_feather_icons(),
			'default'     => 'feather-box',
			'condition'   => [
				'icon_pack' => 'feather',
				'icon_type' => 'type_icon',
			],
			'label_block' => true,
		] );

		$this->add_control( 'simpleline_icon', [
			'label'       => __( 'Choose Icon', 'akijcement-core' ),
			'type'        => Controls_Manager::ICON,
			'options'     => IconsPack::akijcement_simpleline_icons(),
			'include'     => IconsPack::akijcement_include_simpleline_icons(),
			'default'     => 'icon-user',
			'condition'   => [
				'icon_pack' => 'simpleline',
				'icon_type' => 'type_icon',
			],
			'label_block' => true,
		] );


		$this->add_control( 'icon_image', [
			'label'     => __( 'Choose Image', 'akijcement-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'icon_type' => 'type_image'
			]
		] );

		$this->add_control( 'icon_view', [
			'label'        => __( 'View', 'akijcement-core' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'stacked',
			'options'      => [
				'none'    => __( 'None', 'akijcement-core' ),
				'stacked' => __( 'Stacked', 'akijcement-core' ),
				'framed'  => __( 'Framed', 'akijcement-core' ),
			],
			'prefix_class' => 'akijcement-view-',
		] );

		$this->add_control( 'icon_shape', [
			'label'        => __( 'Shape', 'akijcement-core' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'rounded',
			'options'      => [
				'rounded' => __( 'Rounded', 'akijcement-core' ),
				'circle'  => __( 'Circle', 'akijcement-core' ),
				'square'  => __( 'Square', 'akijcement-core' ),

			],
			'condition'    => [
				'icon_view' => [ 'stacked', 'framed' ],
			],
			'prefix_class' => 'akijcement-shape-',
		] );

		$this->add_responsive_control( 'icon_position', [
			'label'   => __( 'Icon Position', 'akijcement-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'left'  => [
					'title' => __( 'Left', 'akijcement-core' ),
					'icon'  => 'eicon-h-align-left',
				],
				'top'   => [
					'title' => __( 'Center', 'akijcement-core' ),
					'icon'  => 'eicon-v-align-top',
				],
				'right' => [
					'title' => __( 'Right', 'akijcement-core' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'default' => 'top',
			'toggle'  => false,
		] );

		$this->add_responsive_control( 'icon_vertically_position', [
			'label'     => __( 'Icon Vertically Position', 'akijcement-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'start'  => [
					'top'  => __( 'Top', 'akijcement-core' ),
					'icon' => ' eicon-v-align-top',
				],
				'center' => [
					'title' => __( 'Center', 'akijcement-core' ),
					'icon'  => 'eicon-v-align-middle',
				],
				'end'    => [
					'title' => __( 'Bottom', 'akijcement-core' ),
					'icon'  => 'eicon-v-align-bottom',
				],
			],
			'default'   => 'top',
			'toggle'    => false,
			'condition' => [
				'icon_position!' => 'top'
			]
		] );

		$this->add_control( 'icon_bg_shape', [
			'label'        => __( 'Icon BG Shape?', 'akijcement-core' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'akijcement-core' ),
			'label_off'    => __( 'Hide', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'icon_shape_image', [
			'label'     => __( 'Choose Image', 'akijcement-core' ),
			'type'      => Controls_Manager::MEDIA,
			'condition' => [
				'icon_bg_shape' => 'yes'
			]
		] );

		$this->add_control( 'icon_fixed_height', [
			'label'        => __( 'Enable Icon Fixed Height?', 'akijcement-core' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'akijcement-core' ),
			'label_off'    => __( 'Hide', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'fixed_height', [
			'label'     => __( 'Icon Container Height', 'akijcement-core' ),
			'type'      => \Elementor\Controls_Manager::NUMBER,
			'min'       => 20,
			'max'       => 300,
			'step'      => 5,
			'default'   => 60,
			'condition' => [
				'icon_fixed_height' => 'yes',
				'icon_type'         => 'type_image'
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container img' => 'height: {{VALUE}}px;'
			],
		] );

		$this->end_controls_section();

		// Content Section
		//=================
		$this->start_controls_section( 'icon_box_content_section', [
			'label' => esc_html__( 'Content', 'akijcement-core' ),
		] );

		$this->add_control( 'box_title', [
			'label'       => esc_html__( 'Box Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Title', 'akijcement-core' ),
			'default'     => esc_html__( 'Feature Heading', 'akijcement-core' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		$this->add_control( 'title_link', [
			'label'       => __( 'Link', 'akijcement-core' ),
			'type'        => \Elementor\Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'akijcement-core' ),
			'dynamic'     => [
				'active' => true,
			],
		] );

		$this->add_control( 'title_size', [
			'label'   => __( 'Title HTML Tag', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h1'   => 'H1',
				'h2'   => 'H2',
				'h3'   => 'H3',
				'h4'   => 'H4',
				'h5'   => 'H5',
				'h6'   => 'H6',
				'div'  => 'div',
				'span' => 'span',
				'p'    => 'p',
			],
			'default' => 'h3',
		] );

		$this->add_control( 'description', [
			'label'       => esc_html__( 'Description', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'placeholder' => esc_html__( 'Description', 'akijcement-core' ),
			'default'     => __( 'There are many variations of the passages of Lorem Ipsum is an available the done.', 'akijcement-core' ),
			'separator'   => 'before',
			'dynamic'     => [
				'active' => true,
			],
		] );

		$this->add_responsive_control( 'title_align', [
			'label'     => esc_html__( 'Alignment', 'akijcement-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [

				'left'    => [
					'title' => esc_html__( 'Left', 'akijcement-core' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center'  => [
					'title' => esc_html__( 'Center', 'akijcement-core' ),
					'icon'  => 'eicon-text-align-centee',
				],
				'right'   => [
					'title' => esc_html__( 'Right', 'akijcement-core' ),
					'icon'  => 'eicon-text-align-right',
				],
				'justify' => [
					'title' => esc_html__( 'Justified', 'akijcement-core' ),
					'icon'  => 'eicon-text-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box' => 'text-align: {{VALUE}};'
			],
		] );

		$this->end_controls_section();


		// Button Section
		//==========================
		$this->start_controls_section( 'section_button', [
			'label' => __( 'Button', 'akijcement-core' ),
		] );

		$this->add_control( 'show_button', [
			'label'        => __( 'Show Button', 'akijcement-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'akijcement-core' ),
			'label_off'    => __( 'Hide', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'button_type', [
			'label'     => __( 'Button Type', 'akijcement-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'de-icon-box__link',
			'options'   => [
				'de-icon-box__link' => __( 'Link', 'akijcement-core' ),
				'dm-btn'  => __( 'Button', 'akijcement-core' ),
			],
			'condition' => [
				'show_button' => 'yes'
			]
		] );

		$this->add_control( 'button_shape', [
			'label'     => __( 'Button Shape', 'akijcement-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'btn-outline',
			'options'   => [
				'btn-outline' => __( 'Outline', 'akijcement-core' ),
				'btn-fill'    => __( 'Fill', 'akijcement-core' ),
			],
			'condition' => [
				'show_button' => 'yes'
			]
		] );

		$this->add_control( 'btn_text', [
			'label'       => __( 'Button Text', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => __( 'Button Text', 'akijcement-core' ),
			'default'     => __( 'Learn here', 'akijcement-core' ),
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'show_button' => 'yes'
			],
		] );

		$this->add_control( 'button_link', [
			'label'       => __( 'Link', 'akijcement-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'akijcement-core' ),
			'dynamic'     => [
				'active' => true,
			],
			'default'     => [
				'url' => '#',
			],
			'condition'   => [
				'show_button' => 'yes'
			]
		] );

		$this->add_control( 'show_button_icon', [
			'label'        => __( 'Show Button Icon', 'akijcement-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'akijcement-core' ),
			'label_off'    => __( 'Hide', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'button_icon', [
			'label'     => __( 'Icon', 'akijcement-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-arrow-right',
				'library' => 'solid',
			],
			'condition' => [ 'show_button_icon' => 'yes' ]
		] );

		$this->add_control( 'icon_align', [
			'label'     => esc_html__( 'Icon Position', 'akijcement-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'right',
			'options'   => [
				'left'  => esc_html__( 'Before', 'akijcement-core' ),
				'right' => esc_html__( 'After', 'akijcement-core' ),
			],
			'condition' => [ 'show_button_icon' => 'yes' ]
		] );

		$this->add_control( 'icon_indent', [
			'label'     => esc_html__( 'Icon Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__button .akijcement-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .akijcement-icon-box__button .akijcement-align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'condition'                                                                 => [ 'show_button_icon' => 'yes' ]
			],

		] );

		$this->add_responsive_control( 'button_space', [
			'label'     => esc_html__( 'Button Spacing Margin Top', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__button' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Badge
		//===================
		$this->start_controls_section( 'badge_section', [
			'label' => esc_html__( 'Badge', 'akijcement-core' ),
		] );

		$this->add_control( 'badge_enable', [
			'label'        => __( 'Enable Badge?', 'akijcement-core' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'akijcement-core' ),
			'label_off'    => __( 'Hide', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'badge_text', [
			'label'       => esc_html__( 'Badge Text', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Badge Text', 'akijcement-core' ),
			'default'     => __( 'Badge', 'akijcement-core' ),
			'condition'   => [
				'badge_enable' => 'yes'
			]
		] );


		$this->add_control( 'border_popover_toggle', [
			'label'        => __( 'Position', 'akijcement-core' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'Default', 'akijcement-core' ),
			'label_on'     => __( 'Custom', 'akijcement-core' ),
			'return_value' => 'yes',
			'condition'    => [
				'badge_enable' => 'yes'
			]
		] );

		$this->start_popover();

		$this->add_responsive_control( 'de_bg_text_horizontal_position', [
			'label'      => __( 'Horizontal Position', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'default'    => [
				'unit' => '%',
			],
			'range'      => [
				'%' => [
					'min' => - 20,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box__badge' => 'left: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'de_bg_text_vertical_position', [
			'label'      => __( 'Vertical Position', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'default'    => [
				'unit' => '%',
			],
			'range'      => [
				'%' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box__badge' => 'top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_popover();

		$this->end_controls_section();

		/**
		 * Style Sections
		 */

		$this->start_controls_section( 'section_icon_style', [
			'label' => esc_html__( 'Icon and Image', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab( 'tab_icon_normal', [
			'label' => __( 'Normal', 'akijcement-core' ),
		] );

		$this->add_control( 'icon_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'color: {{VALUE}};'
			],
		] );

//		$this->add_control('icon_border_color', [
//			'label'     => esc_html__('Border Color', 'akijcement-core'),
//			'type'      => Controls_Manager::COLOR,
//			'selectors' => [
//				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'border-color: {{VALUE}};'
//			],
//		]);

		$this->add_control( 'icon_bg_color_type', array(
			'label'        => __( 'BG Color Type', 'akijcement-core' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => array(
				'color'    => __( 'Color', 'akijcement-core' ),
				'gradient' => __( 'Background', 'akijcement-core' ),
			),
			'default'      => 'color',
			'prefix_class' => 'akijcement-heading-fill-',
		) );

		$this->add_control( 'icon_color_bg', [
			'label'     => esc_html__( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'background-color: {{VALUE}}; border-color: {{VALUE}};'
			],
			'condition' => [
				'icon_bg_color_type' => 'color'
			]
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_color_bg_gradient',
				'label'     => __( 'Background', 'akijcement-core' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .akijcement-icon-box__icon-container',
				'condition' => [
					'icon_bg_color_type' => 'gradient'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'selector' => '{{WRAPPER}} .akijcement-icon-box__icon-container',
			]
		);

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_shadow',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box__icon-container',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_icon_hover', [
			'label' => __( 'Hover', 'akijcement-core' ),
		] );

		$this->add_control( 'icon_color_hover', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__icon-container:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_hover_border_color', [
			'label'     => esc_html__( 'Border Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__icon-container:hover' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_bg_color_type_hover', array(
			'label'        => __( 'Color Type', 'akijcement-core' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => array(
				'color'    => __( 'Color', 'akijcement-core' ),
				'gradient' => __( 'Background', 'akijcement-core' ),
			),
			'default'      => 'color',
			'prefix_class' => 'akijcement-heading-fill-',
		) );

		$this->add_control( 'icon_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__icon-container:hover' => 'background-color: {{VALUE}}'
			],
			'condition' => [
				'icon_bg_color_type_hover' => 'color'
			]
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_hover_bg_color_gradient',
				'label'     => __( 'Background', 'akijcement-core' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__icon-container:hover',
				'condition' => [
					'icon_bg_color_type_hover' => 'gradient'
				]
			]
		);

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_box_shadow_hover',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box__icon-container:hover',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();


		/**
		 * Spacing
		 */
		$this->add_responsive_control( 'icon_space', [
			'label'     => esc_html__( 'Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon--right .akijcement-icon-box__icon-container' => 'margin-left: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .icon--left .akijcement-icon-box__icon-container'  => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .icon--top .akijcement-icon-box__icon-container'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
				'(mobile){{WRAPPER}} .akijcement-icon-box__icon-container'      => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_size', [
			'label'     => esc_html__( 'Size', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'icon_padding', [
			'label'     => esc_html__( 'Padding', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'padding: {{SIZE}}{{UNIT}};',
			],
			'range'     => [
				'em' => [
					'min' => 0,
					'max' => 5,
				],
			],
			'condition' => [
				'icon_view!' => 'default',
			],
		] );

		$this->add_control( 'rotate', [
			'label'     => esc_html__( 'Rotate', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 0,
				'unit' => 'deg',
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container i' => 'transform: rotate({{SIZE}}{{UNIT}});',
			],
		] );

		$this->add_control( 'icon_border_width_one', [
			'label'     => esc_html__( 'Border Width', 'akijcement-core' ),
			'type'      => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
//			'condition' => [
//				'icon_view' => 'framed',
//			],
		] );

		$this->add_control( 'border_radius', [
			'label'      => esc_html__( 'Border Radius', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box__icon-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
//			'condition'  => [
//				'icon_view!' => 'none',
//			],
		] );

		$this->end_controls_section();

		//Title Style Section
		//======================
		$this->start_controls_section( 'section_title_style', [
			'label' => esc_html__( 'Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__title,
				{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__title a' => 'color: {{VALUE}};'
			],
		] );

		$this->add_control( 'title_color_hover', [
			'label'     => esc_html__( 'Hover Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__title:hover,
				{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__title a:hover' => 'color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__title',
		] );

		$this->add_responsive_control( 'title_space', [
			'label'     => esc_html__( 'Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Description Style Section
		//=============================
		$this->start_controls_section( 'section_description_style', [
			'label' => esc_html__( 'Description', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__description' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'selector' => '{{WRAPPER}} .akijcement-icon-box .akijcement-icon-box__description',
		] );

		$this->add_responsive_control( 'description_space', [
			'label'     => esc_html__( 'Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Badge style section
		//======================
		$this->start_controls_section( 'section_badge_style', [
			'label' => esc_html__( 'Badge', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'badge_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__badge' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_bg_color', [
			'label'     => esc_html__( 'BG Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__badge' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'badge_hover_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__badge:hover' => 'color: {{VALUE}};',
			],
			'separator' => 'before'
		] );

		$this->add_control( 'badge_hover_bg_color', [
			'label'     => esc_html__( 'Hover BG Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__badge:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();


		// Button Style
		// =====================
		$this->start_controls_section( 'style_button', [
			'label' => __( 'Button', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab( 'tab_button_normal', [
			'label' => __( 'Normal', 'akijcement-core' ),
		] );

		$this->add_control( 'button_text_color', [
			'label'     => __( 'Text Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__button' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__button' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'button_border',
			'label'    => __( 'Border', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box__button',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box__button',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_button_hover', [
			'label' => __( 'Hover', 'akijcement-core' ),
		] );

		$this->add_control( 'hover_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__button:hover' => 'color: {{VALUE}};',
			],

		] );

		$this->add_control( 'button_hover_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box__button:hover' => 'background-color: {{VALUE}};',
			]
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'button_hover_border',
			'label'    => __( 'Border', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box__button:hover',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow_hover',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box__button',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'label'     => __( 'Typography', 'akijcement-core' ),
			'selector'  => '{{WRAPPER}} .akijcement-icon-box__button',
			'separator' => 'before'
		] );

		$this->add_control( 'padding', [
			'label'      => __( 'Padding', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'border-radius', [
			'label'      => __( 'Border Radius', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		//Box Style Section
		$this->start_controls_section( 'section_box_style', [
			'label' => esc_html__( 'Box Container', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => __( 'Padding', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_margin', [
			'label'      => __( 'Margin', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'box_border_radius', [
			'label'      => __( 'Border Radius', 'akijcement-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'tabs_box_style' );

		$this->start_controls_tab( 'tab_box_normal', [
			'label' => __( 'Normal', 'akijcement-core' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box_background',
			'label'    => __( 'Background', 'akijcement-core' ),
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .akijcement-icon-box',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'box_border',
			'label'    => __( 'Border', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box',
		] );

		$this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_box_shadow',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box',
		] );

		$this->add_control( 'box_translate_x', [
			'label'      => __( 'Translate (X)', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => 'px',
			'range'      => [
				'px' => [
					'min'  => - 50,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box' => 'transform: translateX({{SIZE}}{{UNIT}});',
			],
		] );

		$this->add_control( 'box_translate', [
			'label'      => __( 'Translate (Y)', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => 'px',
			'range'      => [
				'px' => [
					'min'  => - 50,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box' => 'transform: translateY({{SIZE}}{{UNIT}});',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_box_hover', [
			'label' => __( 'Hover', 'akijcement-core' ),
		] );

		// Background Hover Type
		$this->add_control( 'box_background_hover_type', [
			'label'   => __( 'Background Type', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'default'  => __( 'Default', 'akijcement-core' ),
				'creative' => __( 'Slide', 'akijcement-core' ),
			],
			'default' => 'default',
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'box_background_hover',
			'label'     => __( 'Background', 'akijcement-core' ),
			'types'     => [ 'classic', 'gradient' ],
			'selector'  => '{{WRAPPER}} .akijcement-icon-box:hover',
			'condition' => [
				'box_background_hover_type' => 'default'
			],
		] );

		$this->add_control( 'box_background_hover_direction', [
			'label'     => __( 'BG Direction', 'akijcement-core' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'left'   => __( 'Left', 'akijcement-core' ),
				'right'  => __( 'Right', 'akijcement-core' ),
				'top'    => __( 'Top', 'akijcement-core' ),
				'bottom' => __( 'Bottom', 'akijcement-core' ),
			],
			'default'   => 'left',
			'condition' => [
				'box_background_hover_type' => 'creative'
			],
		] );

		// BG Hover Color
		$this->add_control( 'box_background_hover_bg_color', [
			'label'     => __( 'Background Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f5f5f5',
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box.bg-hover-type--creative:before' => 'background-color: {{VALUE}}',
			],
			'condition' => [
				'box_background_hover_type' => 'creative'
			],
			'separator' => 'after',
		] );

		// Icon Color
		$this->add_control( 'box_hover_icon_color_hover', [
			'label'     => __( 'Icon Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f5f5f5',
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__icon-container i' => 'color: {{VALUE}}',
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__icon-container svg path' => 'fill: {{VALUE}}',
			],
		] );

		// Title Color
		$this->add_control( 'box_hover_title_color', [
			'label'     => __( 'Title Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f5f5f5',
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__title' => 'color: {{VALUE}}',
			],
		] );

		// Description Color
		$this->add_control( 'box_hover_description_color', [
			'label'     => __( 'Description Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f5f5f5',
			'selectors' => [
				'{{WRAPPER}} .akijcement-icon-box:hover .akijcement-icon-box__description' => 'color: {{VALUE}}',
			],
			'separator' => 'after',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'box_border_hover',
			'label'    => __( 'Border', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box:hover',
		] );

		$this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_box_shadow_box_hover',
			'label'    => __( 'Box Shadow', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement-icon-box:hover',
		] );


		$this->add_control( 'box_translate_x_hover', [
			'label'      => __( 'Translate (X)', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => 'px',
			'range'      => [
				'px' => [
					'min'  => - 50,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box:hover' => 'transform: translateX({{SIZE}}{{UNIT}});',
			],
		] );

		$this->add_control( 'box_translate_hover', [
			'label'      => __( 'Translate (Y)', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => 'px',
			'range'      => [
				'px' => [
					'min'  => - 50,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement-icon-box:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
			],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Icon Box widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$target   = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';

		$this->add_render_attribute( 'button', 'class', 'akijcement-icon-box__button' );

		$this->add_render_attribute( 'button', 'class', $settings['button_type'] );
		$this->add_render_attribute( 'button', 'class', $settings['button_shape'] );

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['button_link'] );
		}


		$this->add_render_attribute( 'box_wrapper', 'class', 'akijcement-icon-box' );
		if ( $settings['icon_bg_shape'] == 'yes' ) {
			$this->add_render_attribute( 'box_wrapper', 'class', 'akijcement-icon-box--icon-shape' );
		}

		// Bg Type
		if( $settings['box_background_hover_type']) {
			$this->add_render_attribute( 'box_wrapper', 'class', 'bg-hover-type--' . $settings['box_background_hover_type'] );
		}

		// Bg Direction
		if( $settings['box_background_hover_direction']) {
			$this->add_render_attribute( 'box_wrapper', 'class', 'bg-hover-direction--' . $settings['box_background_hover_direction'] );
		}

		if ( ! empty( $settings['icon_vertically_position'] ) ) {
			$this->add_render_attribute( 'box_wrapper', 'class', 'align-items-' . $settings['icon_vertically_position'] );
		}

		if ( ! empty( $settings['preset'] ) ) {
			$this->add_render_attribute( 'box_wrapper', 'class', 'style--' . $settings['preset'] );
		}

		if ( ! empty( $settings['icon_position'] ) ) {
			$this->add_render_attribute( 'box_wrapper', 'class', 'icon--' . $settings['icon_position'] );
		}


		$this->add_render_attribute( [
			'icon_align' => [
				'class' => [
					'akijcement-button-icon',
					'akijcement-align-icon-' . $settings['icon_align'],
				],
			],
			'btn_text'   => [
				'class' => 'de-button-text',
			],
		] );


		$this->add_render_attribute( 'box_title', 'class', 'akijcement-icon-box__title' );

		?>

		<div <?php $this->print_render_attribute_string( 'box_wrapper' ); ?>>

			<?php if ( $settings['icon_type'] == 'type_icon' ) : ?>
				<?php if ( $settings['icon_pack'] == 'fontawesome' ) : ?>
					<div class="akijcement-icon-box__icon-container">
						<?php if ( ! empty( $settings['box_icon'] ) ) : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['box_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>

						<?php if ( ! empty( $settings['icon_shape_image']['url'] ) && $settings['icon_bg_shape'] == 'yes' ) : ?>
							<img class="shape-image" src="<?php echo $settings['icon_shape_image']['url'] ?>"
								 alt="<?php echo $settings['box_title']; ?>">
						<?php endif; ?>
					</div>
				<?php elseif ( $settings['icon_pack'] == 'feather' ) : ?>
					<div class="akijcement-icon-box__icon-container">
						<?php if ( ! empty( $settings['feather_icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $settings['feather_icon'] ) ?>"></i>
						<?php endif; ?>

						<?php if ( ! empty( $settings['icon_shape_image']['url'] ) && $settings['icon_bg_shape'] == 'yes' ) : ?>
							<img class="shape-image" src="<?php echo $settings['icon_shape_image']['url'] ?>"
								 alt="<?php echo $settings['box_title']; ?>">
						<?php endif; ?>
					</div>

				<?php elseif ( $settings['icon_pack'] == 'simpleline' ) : ?>
					<div class="akijcement-icon-box__icon-container">
						<?php if ( ! empty( $settings['simpleline_icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $settings['simpleline_icon'] ) ?>"></i>
						<?php endif; ?>

						<?php if ( ! empty( $settings['icon_shape_image']['url'] ) && $settings['icon_bg_shape'] == 'yes' ) : ?>
							<img class="shape-image" src="<?php echo $settings['icon_shape_image']['url'] ?>"
								 alt="<?php echo $settings['box_title']; ?>">
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $settings['icon_type'] == 'type_image' ) : ?>
				<div class="akijcement-icon-box__icon-container">
					<?php if ( ! empty( $settings['icon_shape_image']['url'] ) && $settings['icon_bg_shape'] == 'yes' ) : ?>
						<img class="shape-image" src="<?php echo $settings['icon_shape_image']['url'] ?>"
							 alt="<?php echo $settings['box_title']; ?>">
					<?php endif; ?>
					<?php if ( ! empty( $settings['icon_image']['url'] ) && $settings['icon_bg_shape'] ) : ?>
						<img src="<?php echo $settings['icon_image']['url'] ?>"
							 alt="<?php echo $settings['box_title']; ?>">
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<!-- /.icon-container -->

			<div class="akijcement-icon-box__content">

				<?php
				$title = $settings['box_title'];

				if ( ! empty( $settings['title_link']['url'] ) && ! empty( $title ) ) {
					$this->add_link_attributes( 'url', $settings['title_link'] );
					$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
				}

				if ( ! empty( $title ) ) {
					$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ),
						$this->get_render_attribute_string( 'box_title' ), $title );
					echo $title_html;
				}
				?>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="akijcement-icon-box__description">
						<?php echo $settings['description']; ?>
					</p>
				<?php endif; ?>


				<?php if ( 'yes' === $settings['show_button'] ) : ?>
					<a <?php $this->print_render_attribute_string( 'button' ); ?>>
						<span class="button-text-wrapper">
							<span <?php $this->print_render_attribute_string( 'icon_align' ); ?>>
								<?php if ( ! empty( $settings['button_icon'] ) ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php endif; ?>
							</span>
							<span <?php $this->print_render_attribute_string( 'btn_text' ); ?>><?php $this->print_unescaped_setting( 'btn_text' ); ?></span>
						</span>
						<!-- /.button-text-wrapper -->
					</a>
				<?php endif; ?>

			</div>

			<?php if ( ! empty( $settings['badge_text'] ) ) : ?>
				<div class="akijcement-icon-box__badge">
					<?php echo esc_html( $settings['badge_text'] ); ?>
				</div>
				<!-- /.akijcement-icon-box__badge -->
			<?php endif; ?>
		</div>
		<!-- /.akijcement-icon-box -->

		<?php
	}

}
