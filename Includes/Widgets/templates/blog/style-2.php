<div class="col-md-6 col-lg-<?php echo esc_attr($count_col); ?> recent-post">

	<article class="blog-post-one">

		<div class="feature-image">
			<?php if (has_post_thumbnail()): ?>
				<a href="<?php echo the_permalink(); ?>">
					<?php the_post_thumbnail('akijcement_blog_grid_370x400', array('class' => 'img-fluid')) ?>
				</a>
			<?php endif; ?>


			<div class="entry-content">
				<div class="author vcard">
					<a class="post-author" href="blog-single.html">
						<?php echo AkijCement_Theme_Helper::akijcement_posted_author_avatar(); ?>
					</a>
				</div>

				<?php if ('yes' == $settings['meta_show']) : ?>
					<ul class="post-meta">
						<li class="post-category">
							<?php $category_list = get_the_category_list();

							$terms = get_the_terms(get_the_ID(), 'category');
							$cat_temp = '';

							if ($terms && !is_wp_error($terms)) :
								foreach ($terms as $term) {
									$cat_temp .= '<a href="' . get_category_link($term->term_id) . '" class="at-blog-meta-category" rel="category tag">' . esc_html($term->name) . '</a>';
								}
							endif;

							echo $cat_temp; ?>
						</li>
						<li class="meta-date">
							<i class="fas fa-calendar-alt"></i>
							<?php AkijCement_Theme_Helper::akijcement_posted_on(); ?>
						</li>
					</ul>
				<?php endif; ?>

				<h3 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<p>
					The full monty so I said have it what load of rubbish cheeky.
				</p>
			</div><!-- /.blog-content -->

			<a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e('Read More ', 'akijcement-core') ?>
				<i class="ei ei-arrow_right"></i>
			</a>
		</div><!-- /.feature-image -->
	</article>
</div>






