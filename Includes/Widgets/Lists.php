<?php

namespace DesignMonks\AkijCement\Widgets;

use Elementor\{Controls_Manager,
	Icons_Manager,
	Repeater,
	Widget_Base,
	Group_Control_Typography
};

class Lists extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'akijcement-list';
	}


	public function get_title() {
		return __( 'DM List', 'akijcement-core' );
	}

	public function get_icon() {
		return 'eicon-editor-list-ul';
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

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'List', 'akijcement-core' ),
		] );

		$this->add_control( 'list_view', [
			'label'   => __( 'View', 'akijcement-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'traditional',
			'options' => [
				'traditional' => [
					'title' => __( 'Default', 'akijcement-core' ),
					'icon'  => 'eicon-editor-list-ul',
				],
				'inline'      => [
					'title' => __( 'Inline', 'akijcement-core' ),
					'icon'  => 'eicon-ellipsis-h',
				],
			],
		] );

		$this->add_control( 'icon_show', [
			'label'        => __( 'Icon Show', 'akijcement-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'akijcement-core' ),
			'label_off'    => __( 'No', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'icon_shape', [
			'label'        => __( 'Icon Circle Shape', 'akijcement-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'akijcement-core' ),
			'label_off'    => __( 'No', 'akijcement-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'list_title', [
			'label'       => __( 'Title', 'akijcement-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'List Title', 'akijcement-core' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'icon_type', [
			'label'   => __( 'Icon Type', 'akijcement-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'elegant',
			'options' => [
				'elegant'     => __( 'Elegant', 'akijcement-core' ),
				'fontawesome' => __( 'Font Awesome', 'akijcement-core' ),
			],
		] );

		$repeater->add_control( 'icon_elegant', [
			'label'       => __( 'Icon', 'akijcement-core' ),
			'type'        => Controls_Manager::ICON,
			'options'     => akijcement_feather_icon(),
			'include'     => akijcement_include_feather_icons(),
			'default'     => 'ei ei-icon_check',
			'condition'   => [
				'icon_type' => 'elegant'
			],
			'label_block' => true,
		] );

		$repeater->add_control( 'icon', [
			'label'     => __( 'Icon', 'akijcement-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-star',
				'library' => 'solid',
			],
			'condition' => [
				'icon_type' => 'fontawesome'
			]
		] );

		$repeater->add_control( 'link', [
			'label'       => __( 'Link', 'akijcement-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'akijcement-core' ),
		] );


		$this->add_control( 'list', [
			'label'       => __( 'List Items', 'akijcement-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'list_title' => __( 'List One', 'akijcement-core' ),
					'icon'       => [
						'value' => 'fas fa-check-circle'
					]
				],
				[
					'list_title' => __( 'List Two', 'akijcement-core' ),
					'icon'       => [
						'value' => 'fas fa-check-circle'
					]
				],
				[
					'list_title' => __( 'List Three', 'akijcement-core' ),
					'icon'       => [
						'value' => 'fas fa-check-circle'
					]
				],
			],
			'title_field' => '{{{ list_title }}}',
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'list_style_section', [
			'label' => __( 'List', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'list_space_between', [
			'label'     => __( 'Space Between', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement__list:not(.inline-items) .list-item:not(:last-child)'  => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
				'{{WRAPPER}} .akijcement__list:not(.inline-items) .list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
				'{{WRAPPER}} .akijcement__list.inline-items .list-item'                         => 'margin-right: calc({{SIZE}}{{UNIT}}/2);',
				//                    '{{WRAPPER}} .akijcement__list.inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
			],
		] );

		$this->add_responsive_control( 'list_align', [
			'label'     => __( 'Alignment', 'akijcement-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'akijcement-core' ),
					'icon'  => 'eicon-h-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'akijcement-core' ),
					'icon'  => 'eicon-h-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'akijcement-core' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'toggle'    => false,
			'selectors' => [
				'{{WRAPPER}} .akijcement__list' => 'text-align: {{VALUE}};'
			]
		] );

		$this->end_controls_section();

		// Icon Style
		// ==============================
		$this->start_controls_section( 'list_icon_section', [
			'label' => __( 'Icon', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'icon_color', [
			'label'     => __( 'Color', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li .akijcement__list-icon i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .akijcement__list li svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_color_hover', [
			'label'     => __( 'Hover', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li:hover .akijcement__list-icon i'   => 'color: {{VALUE}};',
				'{{WRAPPER}} .akijcement__list li:hover svg' => 'fill: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_bg_color', [
			'label'     => __( 'BG Color', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li .akijcement__list-icon' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'icon_bg_hover_color', [
			'label'     => __( 'BG Color', 'elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li:hover .akijcement__list-icon' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'uld_icon_size', [
			'label'     => __( 'Size', 'elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 14,
			],
			'range'     => [
				'px' => [
					'min' => 6,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li i'   => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .akijcement__list li svg' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		// Space between icon and text
		$this->add_responsive_control( 'icon_space', [
			'label'     => __( 'Space', 'akijcement-core' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min' => 0,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li .akijcement__list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		// Icon Padding with slider control
		$this->add_responsive_control( 'icon_padding', [
			'label'      => __( 'Padding', 'akijcement-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .akijcement__list li .akijcement__list-icon' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );



		$this->end_controls_section();

		$this->start_controls_section( 'list_text_section', [
			'label' => __( 'Text', 'akijcement-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'list_typography',
			'label'    => __( 'Typography', 'akijcement-core' ),
			'selector' => '{{WRAPPER}} .akijcement__list li',
		] );

		$this->add_control( 'list_color', [
			'label'     => __( 'Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li,
                    {{WRAPPER}} .akijcement__list li a' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'list_hover_color', [
			'label'     => __( 'Hover Color', 'akijcement-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .akijcement__list li:hover,
                    {{WRAPPER}} .akijcement__list li a:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'text_indent', [
			'label'     => __( 'Text Indent', 'elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		$this->add_render_attribute( 'icon_list', 'class', 'akijcement__list' );
		$this->add_render_attribute( 'list_item', 'class', 'list-item' );

		if ( 'inline' === $settings['list_view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'inline-item' );
		}

		if ( 'yes' === $settings['icon_shape'] ) {
			$this->add_render_attribute( 'list_item', 'class', 'icon-shape' );
		}
		?>
		<ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
			<?php foreach ( $settings['list'] as $item ) {

				$target   = $item['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
				<li <?php echo $this->get_render_attribute_string( 'list_item' ); ?>>
					<?php if ( ! empty( $item['link']['url'] ) ) : ?>
					<a href="<?php echo esc_attr( $item['link']['url'] ); ?>" <?php echo $target, $nofollow ?>>
						<?php endif; ?>

						<?php if ( 'yes' === $settings['icon_show'] ) :
							if ( $item['icon_type'] == 'fontawesome' ) { ?>
								<span class="akijcement__list-icon">
                                    <?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
							<?php } else { ?>

								<span class="akijcement__list-icon">
                                    <i class="<?php echo esc_attr( $item['icon_elegant'] ) ?>"></i>
                                </span>

							<?php }

						endif; ?>

						<span class="list-text"><?php echo $item['list_title']; ?></span>

						<?php if ( ! empty( $item['link']['url'] ) ) : ?>
					</a>
				<?php endif; ?>
				</li>

			<?php } ?>
		</ul>
		<?php
	}

	/**
	 * Render icon list widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * @since 2.9.0
	 * @access protected
	 */
	//    protected function content_template() {
	//
	//        <#
	//        view.addRenderAttribute( 'icon_list', 'class', 'akijcement__list' );
	//        view.addRenderAttribute( 'list_item', 'class', 'list-item' );
	//
	//        if ( 'inline' == settings.list_view ) {
	//        view.addRenderAttribute( 'icon_list', 'class', 'inline-items' );
	//        view.addRenderAttribute( 'list_item', 'class', ''inline-item' );
	//        }
	//
	//        #>
	//
	//        <ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
	//
	//            <# _.each( settings.list, function( item, index ) { #>
	//                <li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
	//
	//                    <# if ( item.link.url ) { #>
	//                        <a href="{{ item.link.url }}">
	//                    <# } #>
	//
	//                        <# if ( settings.icon_show == 'yes' ) { #>
	//                            Icons_Manager::render_icon.item.icon
	//                        <# } #>
	//                        <span class="list-text">{{{ item.list_title }}}</span>
	//
	//                    <# if ( item.link.url ) { #>
	//                         </a>
	//                    <# } #>
	//                </li>
	//            <# } ); #>
	//        </ul>
	//
	//    }

}

