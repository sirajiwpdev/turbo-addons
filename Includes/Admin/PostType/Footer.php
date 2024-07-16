<?php

namespace DesignMonks\AkijCement\Admin\PostType;

class Footer {

	public function __construct() {
		add_action( 'init', [ $this, 'akijcement_create_type_footer' ], 2 );
		add_action( 'wp_insert_post_data', [$this, 'set_default_footer_template'], 10, 2 );
	}

	public function akijcement_create_type_footer() {
		register_post_type( 'akijcement_footer',
			array(
				$labels = [
					'name'          => __( 'Footer', 'akijcement-core' ),
					'singular_name' => __( 'Footer', 'akijcement-core' ),
				],
				'labels'              => $labels,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_icon'           => 'dashicons-editor-kitchensink',
				'supports'            => [ 'title', 'elementor' ],
			)
		);

		if ( $tt_js_content_types = get_option( 'akijcement_js_content_types' ) ) {
			if ( ! in_array( 'akijcement_footer', $tt_js_content_types ) ) {
				$tt_js_content_types[] = 'akijcement_footer';
			}
			$options[] = 'akijcement_footer';
			update_option( 'akijcement_js_content_types', $tt_js_content_types );
		} else {
			$options = array( 'page', 'akijcement_footer' );
		}

		update_post_meta( get_the_ID(), '_wp_page_template', 'elementor_canvas' );
	}


	public function set_default_footer_template( $data, $postarr ) {
		if ( 'footer' === $data['post_type'] && empty( $postarr['ID'] ) ) {
			$footer_template_id = get_page_by_title( 'Elementor Canvas', OBJECT, 'elementor_library' )->ID;
			update_post_meta( $postarr['ID'], '_elementor_template_id', $footer_template_id );
		}

		return $data;
	}
}

