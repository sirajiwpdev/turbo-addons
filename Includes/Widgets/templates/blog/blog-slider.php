<div class="akijcement__post-slider">
	<?php if ( has_post_thumbnail() ): ?>
		<div class="akijcement__feature-image">
			<a href="<?php echo the_permalink(); ?>">
				<?php the_post_thumbnail( 'akijcement_blog_grid_370x250', array( 'class' => 'img-fluid' ) ) ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="akijcement__blog-content">
		<?php if ( 'yes' == $settings['meta_show'] ) : ?>
			<ul class="akijcement__post-meta">
				<li>
					<i class="icon-user icons"></i>
					<span>By </span><?php AkijCement_Theme_Helper::akijcement_posted_by(); ?>
				</li>
				<li><i class="icon-clock icons"></i><?php AkijCement_Theme_Helper::akijcement_posted_on(); ?></li>
			</ul>
		<?php endif; ?>

		<div class="akijcement__entry-header">
			<h3 class="akijcement__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<p class="akijcement__entry-content">
				<?php echo AkijCement_Theme_Helper::akijcement_excerpt( $settings['content_length'] ); ?>
			</p>

			<?php if ( ! empty( $settings['readmore'] ) ) : ?>
				<a href="<?php echo the_permalink(); ?>" class="read-more-btn"><?php echo $settings['readmore']; ?> <i class="feather-arrow-right"></i></a>
			<?php endif; ?>

		</div>
	</div>
</div>
