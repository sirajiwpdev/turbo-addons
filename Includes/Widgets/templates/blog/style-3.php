<div class="col-md-6 col-lg-<?php echo esc_attr( $count_col ); ?> recent-post">
    <div class="post-grid style-four">
		<?php if ( has_post_thumbnail() ): ?>
            <div class="feature-image">
                <a href="<?php echo the_permalink(); ?>">
					<?php the_post_thumbnail( 'akijcement_blog_grid_520x446', array( 'class' => 'img-fluid' ) ) ?>
                </a>

                <?php if ('yes' == $settings['meta_show']) : ?>
                    <div class="meta-category-wrapper">
                        <?php $category_list = get_the_category_list();

                        $terms = get_the_terms(get_the_ID(), 'category');
                        $cat_temp = '';

                        if ($terms && !is_wp_error($terms)) :
                            foreach ($terms as $term) {
                                $cat_temp .= '<a href="' . get_category_link($term->term_id) . '" class="at-blog-meta-category" rel="category tag">' . esc_html($term->name) . '</a>';
                            }
                        endif;

                        echo $cat_temp; ?>
                    </div>
                <?php endif; ?>
            </div>

		<?php endif; ?>
        <div class="blog-content">
			<?php if ( 'yes' == $settings['meta_show'] ) : ?>
                <ul class="post-meta">
                    <li class="author-simple">
                        <i class="far fa-user"></i>
						<?php echo AkijCement_Theme_Helper::akijcement_posted_by(); ?>
                    </li>
                    <li class="meta-date">
                        <i class="fas fa-calendar-alt"></i>
						<?php AkijCement_Theme_Helper::akijcement_posted_on(); ?>
                    </li>
                </ul>
			<?php endif; ?>

            <div class="entry-header">
                <h3 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <a href="<?php the_permalink(); ?>" class="read_more_btn"><?php esc_html_e( 'Read More ', 'akijcement-core' ) ?></a>
            </div>
        </div>
    </div>
</div>
