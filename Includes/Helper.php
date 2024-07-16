<?php

/**
 * Elementor Helper.
 *
 * @package AkijCement
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


/**
 * Class AkijCement_Helper.
 */

if ( ! class_exists( 'AkijCement_Helper' ) ) {
	class AkijCement_Helper {

		protected static $instance  = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_filter('upload_mimes', [ $this, 'akijcement_svg_mime_types' ]);
			add_action( 'show_user_profile', [$this, 'akijcement_extra_user_profile_fields'] );
			add_action( 'edit_user_profile', [$this, 'akijcement_extra_user_profile_fields'] );
			add_action( 'personal_options_update', [$this, 'akijcement_save_extra_user_profile_fields'] );
			add_action( 'edit_user_profile_update', [$this, 'akijcement_save_extra_user_profile_fields'] );
		}

		/**
		 * @return array
		 *
		 * Get Contact form 7
		 */
		public static function akijcement_get_contact_form7_forms(){
			$forms = get_posts( 'post_type=wpcf7_contact_form&posts_per_page=-1' );

			$results = array();
			if ( $forms ) {
				$results[] = __( 'Select A Form', 'akijcement-core' );
				foreach ( $forms as $form ) {
					$results[ $form->ID ] = $form->post_title;
				}
			} else {
				$results[] =  __( 'No contact forms found', 'akijcement-core' ) ;
			}

			return $results;
		}

		/**
		 * @param $user
		 * User Social Field
		 *
		 * @return void
		 */
		public function akijcement_extra_user_profile_fields( $user ) { ?>
			<h3><?php esc_html_e( "Extra profile information", 'akijcement-core' ); ?></h3>

			<table class="form-table">
				<tr>
					<th><label for="facebook"><?php esc_html_e( "Facebook", 'akijcement-core' ); ?></label></th>
					<td>
						<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text"/><br/>
						<span class="description"><?php esc_html_e( "Please enter your facebook url.", 'akijcement-core' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="twitter"><?php esc_html_e( "Twitter", 'akijcement-core' ); ?></label></th>
					<td>
						<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text"/><br/>
						<span class="description"><?php esc_html_e( "Please enter your twitter url.", 'akijcement-core' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="linkedin"><?php esc_html_e( "Linkedin", 'akijcement-core' ); ?></label></th>
					<td>
						<input type="text" name="linkedin" id="linkedin"  value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>"  class="regular-text"/><br/>
						<span class="description"><?php esc_html_e( "Please enter your linkedin url.", 'akijcement-core' ); ?></span>
					</td>
				</tr>

				<tr>
					<th><label for="instagram"><?php esc_html_e( "Instagram", 'akijcement-core' ); ?></label></th>
					<td>
						<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>"  class="regular-text"/><br/>
						<span class="description"><?php esc_html_e( "Please enter your instagram url.", 'akijcement-core' ); ?></span>
					</td>
				</tr>
			</table>
		<?php }

		/**
		 * @param $user_id
		 *
		 * Save Social Field in Database
		 *
		 * @return false|void
		 */
		public function akijcement_save_extra_user_profile_fields( $user_id ) {
			if ( ! current_user_can( 'edit_user', $user_id ) ) {
				return false;
			}
			update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
			update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
			update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
			update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
		}



		protected function build_extra_terms_query( $query_args, $taxonomies ) {
			if ( empty( $taxonomies ) ) {
				return $query_args;
			}

			$terms       = explode( ', ', $taxonomies );
			$tax_queries = array(); // List of taxonomies.

			if ( ! isset( $query_args['tax_query'] ) ) {
				$query_args['tax_query'] = array();

				foreach ( $terms as $term ) {
					$tmp       = explode( ':', $term );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];
					if ( ! isset( $tax_queries[ $taxonomy ] ) ) {
						$tax_queries[ $taxonomy ] = array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => array( $term_slug ),
						);
					} else {
						$tax_queries[ $taxonomy ]['terms'][] = $term_slug;
					}
				}
				$query_args['tax_query'] = array_values( $tax_queries );
				$query_args['tax_query']['relation'] = 'AND';
			} else {
				foreach ( $terms as $term ) {
					$tmp       = explode( ':', $term );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];

					foreach ( $query_args['tax_query'] as $key => $query ) {
						if ( is_array( $query ) ) {
							if ( $query['taxonomy'] == $taxonomy ) {
								$query_args['tax_query'][ $key ]['terms'][] = $term_slug;
								break;
							} else {
								$query_args['tax_query'][] = array(
									'taxonomy' => $taxonomy,
									'field'    => 'slug',
									'terms'    => array( $term_slug ),
								);
							}
						}
					}
				}
			}

			return $query_args;
		}

		static public function akijcement_category_list( $cat ) {
			$query_args = array(
				'orderby'    => 'ID',
				'order'      => 'DESC',
				'hide_empty' => 1,
				'taxonomy'   => $cat
			);

			$categories  = get_categories( $query_args );
//			$options     = array( esc_html__( '0', 'akijcement-core' ) => 'All Category' );
			$options = [];

			if ( is_array( $categories ) && count( $categories ) > 0 ) {
				foreach ( $categories as $cat ) {
					$options[ $cat->slug   ] = $cat->name;
				}
				return $options;
			}
		}

		/**
		 * @param $taxonomy
		 * @param $helper
		 *
		 * @since 1.0
		 */
		public static function get_term_parents_list($term_id, $taxonomy, $args = []) {
			$list = '';
			$term = get_term( $term_id, $taxonomy );

			if (is_wp_error($term)) {
				return $term;
			}

			if (! $term) {
				return $list;
			}

			$term_id = $term->term_id;

			$defaults = [
				'format' => 'name',
				'separator' => '/',
				'inclusive' => true,
			];

			$args = wp_parse_args( $args, $defaults );

			foreach (['inclusive'] as $bool) {
				$args[ $bool ] = wp_validate_boolean( $args[ $bool ] );
			}

			$parents = get_ancestors( $term_id, $taxonomy, 'taxonomy' );

			if ($args['inclusive']) {
				array_unshift( $parents, $term_id );
			}

			$a = count($parents) - 1;
			foreach (array_reverse( $parents ) as $index => $term_id) {
				$parent = get_term( $term_id, $taxonomy );
				$temp_sep = $args['separator'];
				$lastElement = reset($parents);
				$first = end($parents);

				if ($index == $a - 1) {
					$temp_sep = '';
				}

				if ($term_id != $lastElement) {
					$name = $parent->name;
					$list .= $name . $temp_sep;
				}
			}

			return $list;
		}

		/**
		 * @param $categories
		 * @param $helper
		 *
		 * @since 1.0
		 */
		public static function categories_suggester() {
			$content = [];

			foreach (get_categories() as $cat) {
				$args = [
				  'separator' => ' > ',
				  'format' => 'name',
				];
				$parent = self::get_term_parents_list( $cat->cat_ID, 'category', [] );

				$content[(string) $cat->slug] = $cat->cat_name.(! empty($parent) ? esc_html__( ' (Parent categories: (', 'akijcement-core') .$parent.'))' : "");
			}

			return $content;
		}


		/**
		 * Check if the Elementor is updated.
		 *
		 * @return boolean if Elementor updated.
		 * @since 1.16.1
		 *
		 */
		static public function is_elementor_updated() {
			if (class_exists('Elementor\Icons_Manager')) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Return the new icon name.
		 *
		 * @param string $control_name name of the control.
		 * @return string of the updated control name.
		 * @since 1.16.1
		 *
		 */
		static public function get_new_icon_name($control_name)	{
			if (class_exists('Elementor\Icons_Manager')) {
				return 'new_' . $control_name . '[value]';
			} else {
				return $control_name;
			}
		}

		public static function get_grid_metro_size() {
			return [
				'1:1'   => esc_html__( 'Width 1 - Height 1', 'akijcement-core' ),
				'1:2'   => esc_html__( 'Width 1 - Height 2', 'akijcement-core' ),
				'1:0.7' => esc_html__( 'Width 1 - Height 70%', 'akijcement-core' ),
				'1:1.3' => esc_html__( 'Width 1 - Height 130%', 'akijcement-core' ),
				'2:1'   => esc_html__( 'Width 2 - Height 1', 'akijcement-core' ),
				'2:2'   => esc_html__( 'Width 2 - Height 2', 'akijcement-core' ),
			];
		}

		public static function paging_nav( $query = false ) {
			global $wp_query, $wp_rewrite;

			if ( $query === false ) {
				$query = $wp_query;
			}

			// Don't print empty markup if there's only one page.
			if ( $query->max_num_pages < 2 ) {
				return;
			}

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}

			$page_num_link = html_entity_decode( get_pagenum_link() );
			$query_args    = array();
			$url_parts     = explode( '?', $page_num_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$page_num_link = esc_url( remove_query_arg( array_keys( $query_args ), $page_num_link ) );
			$page_num_link = trailingslashit( $page_num_link ) . '%_%';

			$format = '';
			if ( $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ) {
				$format = 'index.php/';
			}
			if ( $wp_rewrite->using_permalinks() ) {
				$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
			} else {
				$format .= '?paged=%#%';
			}

			// Set up paginated links.

			$args  = array(
				'base'      => $page_num_link,
				'format'    => $format,
				'total'     => $query->max_num_pages,
				'current'   => max( 1, $paged ),
				'mid_size'  => 1,
				'add_args'  => array_map( 'urlencode', $query_args ),
				'prev_text' => '<span class="fas fa-chevron-left">',
				'next_text' => '<span class="fas fa-chevron-right"></span>',
				'type'      => 'array',
			);
			$pages = paginate_links( $args );

			if ( is_array( $pages ) ) {
				echo '<ul class="page-pagination">';
				foreach ( $pages as $page ) {
					printf( '<li>%s</li>', $page );
				}
				echo '</ul>';
			}
		}

		/**
		 * Enqueue svg to the media.
		 * @return void
		 */
		function akijcement_svg_mime_types($mimes) {
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		}


		public static function image_placeholder( $width, $height ) {
			echo '<img src="http://via.placeholder.com/' . $width . 'x' . $height . '?text=' . esc_attr__( 'No+Image', 'akijcement-core' ) . '" alt="' . esc_attr__( 'Thumbnail', 'akijcement-core' ) . '"/>';
		}

		public static function akijcement_hex_to_rgb($hex, $alpha = false) {
			$hex      = str_replace('#', '', $hex);
			$length   = strlen($hex);
			$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
			$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
			$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
			if ( $alpha ) {
				$rgb['a'] = $alpha;
			}
			return $rgb;
		}

		/**
		 * [html_attributes description]
		 *
		 * @method html_attributes
		 * @param  array           $attributes [description]
		 *
		 * @return [type]                [description]
		 */
		public static function html_attributes( $attributes = array(), $prefix = '' ) {

			// If empty return false
			if ( empty( $attributes ) ) {
				return false;
			}

			$options = false;
			if( isset( $attributes['data-plugin-options'] ) ) {
				$options = $attributes['data-plugin-options'];
				unset( $attributes['data-plugin-options'] );
			}

			$out = '';
			foreach ( $attributes as $key => $value ) {

				if( ! $value ) {
					continue;
				}

				$key = $prefix . $key;

				if( true === $value ) {
					$value = 'true';
				}

				$out .= sprintf( ' %s="%s"', esc_html( $key ), esc_attr( $value ) );
			}

			if( $options ) {
				$out .= sprintf( ' data-plugin-options=\'%s\'', $options );
			}

			return $out;
		}

		/**
		 * [sanitize_html_classes description]
		 * @method sanitize_html_classes
		 * @return (mixed: string / $fallback ) [description]
		 */
		public static function sanitize_html_classes( $class, $fallback = null ) {

			// Make it a string
			if( is_array( $class ) ) {
				$class = join( ' ', $class );
			}

			// Explode it, if it's a string
			if ( is_string( $class ) ) {
				$class = explode( ' ', $class );
			}

			$class = array_filter( $class );

			if ( is_array( $class ) && !empty( $class ) ) {
				$class = array_map( 'sanitize_html_class', $class );
				return implode( ' ', $class );
			}
			else {
				return sanitize_html_class( $class, $fallback );
			}
		}


	}

	AkijCement_Helper::instance()->initialize();
}