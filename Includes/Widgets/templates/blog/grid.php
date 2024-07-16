<div class="col-md-6 col-sm-6 col-lg-<?php echo esc_attr($settings['column']); ?>">
	<div class="akijcement-post__item <?php echo has_post_thumbnail() ? 'show-thumbnail' : 'hide-thumbnail' ?>">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="akijcement-post__feature-image">
				<a href="<?php echo the_permalink(); ?>">
					<?php the_post_thumbnail( 'akijcement__post_grid_410X308', array( 'class' => 'img-fluid' ) ) ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="akijcement-post__blog-content">
			<div class="akijcement-post__entry-header">
				<?php //DM_Theme_Helper::akijcement_posted_on(); ?>
				<h3 class="akijcement-post__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<p class="akijcement-post__entry-content">
					<?php echo DM_Theme_Helper::akijcement_excerpt( $settings['content_length'] ); ?>
				</p>
			</div>
		</div>
	</div>
</div>