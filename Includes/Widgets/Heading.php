<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{
	Controls_Manager,
	Group_Control_Background,
	Group_Control_Typography,
	Utils,
	Widget_Base
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * Class Heading
 *
 * @package DesignMonks\AkijCement\Widgets
 */

class Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akijcement-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'DM Heading', 'akijcement-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heading';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Heading widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'akijcement-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Heading widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'sub-title' ];
	}

	/**
	 * Register Heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

		// Heading Content Section
		//==========================
		$this->start_controls_section( 'section_tab', [
			'label' => esc_html__( 'Heading', 'akijcement-core' ),
		] );

		// Style
		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one' => esc_html__( 'Style 1', 'akijcement-core' ),
				'two' => esc_html__( 'Style 2', 'akijcement-core' ),
			]
		] );


		$this->add_control( 'sub_title', [
			'label'       => esc_html__( 'Sub Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Sub Title', 'akijcement-core' ),
			'separator'   => 'none',
		] );

		$this->add_control( 'title_text', [
			'label'       => esc_html__( 'Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'rows'        => 2,
			'placeholder' => esc_html__( 'Title', 'akijcement-core' ),
			'default'     => esc_html__( 'Section Title', 'akijcement-core' ),
		] );


		// Secondary Title Enable
		$this->add_control( 'secondary_title_enable', [
			'label'        => __( 'Secondary Title Enable', 'akijcement-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'akijcement-core' ),
			'label_off'    => __( 'No', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		// Secondary Title
		$this->add_control( 'secondary_title', [
			'label'       => esc_html__( 'Secondary Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'rows'        => 2,
			'placeholder' => esc_html__( 'Secondary Title', 'akijcement-core' ),
			'default'     => esc_html__( 'Secondary Title', 'akijcement-core' ),
			'condition'   => [
				'secondary_title_enable' => 'yes'
			]
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
			'default' => 'h2',
		] );


		$this->add_control( 'description_text', [
			'label'       => __( 'Description', 'akijcement-core' ),
			'type'        => Controls_Manager::WYSIWYG,
			'placeholder' => __( 'Type your description here', 'akijcement-core' ),
			'separator'   => 'before'
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
					'icon'  => 'eicon-text-align-center',
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
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .section-heading' => 'text-align: {{VALUE}};'
			],
		] );

		$this->add_responsive_control( 'heading_spacing_div', [
			'label'     => __( 'Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 20,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		//Title Style Section
		//=========================
		$this->start_controls_section( 'section_title_style', [
			'label' => esc_html__( 'Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color_one', [
			'label'     => esc_html__( 'Title color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title' => 'color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .section-heading .section-title',
		] );

		$this->add_responsive_control( 'space_between_title', [
			'label'     => __( 'Spacing Title', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 20,
					'max' => 150,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Secondary Title Style Section
		//=========================
		$this->start_controls_section( 'section_secondary_title_style', [
			'label'     => esc_html__( 'Secondary Title', 'akijcement-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->add_control( 'title_color_two', [
			'label'     => esc_html__( 'Secondary Title color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title-secondary' => 'color: {{VALUE}};'
			],
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'secondary_title_typography',
			'selector'  => '{{WRAPPER}} .section-heading .section-title-secondary',
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		// Space Between
		$this->add_responsive_control( 'space_between_two', [
			'label'     => __( 'Spacing', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 20,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title-secondary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->end_controls_section();


		//Subtitle Style Section
		$this->start_controls_section( 'section_subtitle_style', [
			'label' => esc_html__( 'Sub Title', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control( 'heading_color_type', array(
			'label'        => __( 'Color Type', 'akijcement-core' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => array(
				'color'    => __( 'Color', 'akijcement-core' ),
				'gradient' => __( 'Background', 'akijcement-core' ),
			),
			'default'      => 'color',
			'prefix_class' => 'akijcement-heading-fill-',
		) );

		$this->add_control( 'subtitle_color', [
			'label'     => esc_html__( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'color: {{VALUE}};',
			],
			'condition' => array(
				'heading_color_type' => 'color',
			),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), array(
			'name'      => 'heading_color_gradient',
			'types'     => array(
				'gradient',
				'classic'
			),
			'selector'  => '{{WRAPPER}} .section-heading .subtitle',
			'condition' => array(
				'heading_color_type' => 'gradient',
			),
		) );

		$this->add_control( 'subtitle_bg_color', [
			'label'     => esc_html__( 'Sub Title BG color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'background-color: {{VALUE}};'
			],
		] );

		// Background

		$this->add_control( 'subtitle_bg', [
			'label'     => esc_html__( 'BG color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'background: {{VALUE}};'
			],
			'condition' => [
				'style'              => 'two',
			],
		] );

		// Border color
		$this->add_control( 'subtitle_border_color', [
			'label'     => esc_html__( 'Border color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'border-color: {{VALUE}};'
			],
			'condition' => [
				'style'              => 'two',
			],
		] );

		// Circle BG Color
		$this->add_control( 'circle_bg_color', [
			'label'     => esc_html__( 'Circle BG color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle:before, {{WRAPPER}} .section-heading .subtitle:after' => 'background: {{VALUE}};'
			],
			'condition' => [
				'style'              => 'two',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'subtitle_typography',
			'selector' => '{{WRAPPER}} .section-heading .subtitle',
		] );

		$this->add_responsive_control( 'space_between_subtitle', [
			'label'     => __( 'Spacing Sub Title', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 0,
					'max' => 100,
				],
			],
			'devices'   => [
				'desktop',
				'tablet',
				'mobile'
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle, {{WRAPPER}} .section-subhead .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'after'
		] );


		$this->end_controls_section();

		//Description Style Section
		$this->start_controls_section( 'section_des_style', [
			'label' => esc_html__( 'Description', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control( 'des_color', [
			'label'     => esc_html__( 'color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .description, {{WRAPPER}} .section-heading .description p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'des_typography',
			'selector' => '{{WRAPPER}} .section-heading .description',
		] );


		$this->end_controls_section();

	}

	/**
	 * Render section heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$title            = $settings['title_text'];
		$secondary_title  = $settings['secondary_title'];
		$sub_title        = $settings['sub_title'];
		$description_text = $settings['description_text'];

		// Wrapper Classes
		$this->add_render_attribute( 'wrapper', 'class', 'section-heading' );

		// Style
		if( !empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'heading-style--' . $settings['style'] );
		}

		$this->add_render_attribute( 'title_text', [
			'class' => 'section-title'
		] );


		if ( $settings['secondary_title_enable'] == 'yes' ) {
			$this->add_render_attribute( 'title_text', [
				'class' => 'has-secondary-title'
			] );
		}

		$this->add_render_attribute( 'secondary_title_text', [
			'class' => 'section-title-secondary'
		] );

		$this->add_render_attribute( 'sub_title', 'class', 'subtitle' );

		$this->add_inline_editing_attributes( 'title_text' );
		$this->add_inline_editing_attributes( 'secondary_title' );
		$this->add_inline_editing_attributes( 'sub_title' );


		$this->add_render_attribute( 'description_text', [
			'class' => 'description',
		] );
		$this->add_inline_editing_attributes( 'description_text' );


		?>

		<div <?php echo $this->get_render_attribute_string('wrapper')?>>
			<?php if ( ! empty( $sub_title ) ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'sub_title' ); ?>><?php echo $sub_title; ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $title ) ) {
				$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $title );
				echo $title_html;
			} ?>

			<?php if ( ! empty( $secondary_title ) && $settings['secondary_title_enable'] == 'yes' ) {
				$secondary_title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'secondary_title_text' ), $secondary_title );
				echo $secondary_title_html;
			} ?>

			<?php if ( ! empty( $description_text ) ): ?>
				<div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $description_text; ?></div>
			<?php endif; ?>
		</div>

		<?php
	}

	/**
	 * Render section heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'section-heading' );


		if( settings.style ){
			view.addRenderAttribute( 'wrapper', 'class', 'heading-style--' + settings.style );
		}

		view.addRenderAttribute( 'title_text', 'class', 'section-title' );
		view.addInlineEditingAttributes( 'title_text', 'none' );

		if( settings.secondary_title_enable == 'yes' ){
		view.addRenderAttribute( 'title_text', 'class', 'has-secondary-title' );
		}


		view.addRenderAttribute( 'secondary_title_text', 'class', 'section-title-secondary' );
		view.addInlineEditingAttributes( 'secondary_title_text', 'none' );

		view.addRenderAttribute( 'description_text', 'class', 'description' );
		view.addInlineEditingAttributes( 'description_text', 'none' );

		view.addRenderAttribute( 'sub_title', 'class', 'subtitle' );
		view.addInlineEditingAttributes( 'sub_title', 'none' );

		#>
		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<# if(settings.sub_title) { #>
			<h3 {{{ view.getRenderAttributeString( 'sub_title' ) }}}>{{{ settings.sub_title }}}</h3>
			<# } #>

			<#
			var title = settings.title_text;
			var headerSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );
			var title_html = '<' + headerSizeTag + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title + '</' + headerSizeTag + '>';

		var sec_title = settings.secondary_title;
		var headerSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );
		var sec_title_html = '<' + headerSizeTag  + ' ' + view.getRenderAttributeString( 'secondary_title_text' ) + '>' + sec_title + '</' + headerSizeTag + '>';

		print( title_html );
		if(settings.secondary_title_enable == 'yes'){
		print( sec_title_html );
		} #>

		<# if(settings.description_text) { #>
		<div {{{ view.getRenderAttributeString('description_text' ) }}}>{{{ settings.description_text }}}</div>
		<# } #>
		</div>
		<?php
	}
}

