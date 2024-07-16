<?php

if ( ! isset( $settings ) ) {
	$settings = array();
}

$ant = 0.5;

while ( $dm_query->have_posts() ) :
	$dm_query->the_post();
	$classes      = array( "dm-job grid-item" );
	$grid_classes = '';
	$jobs_info = get_post_meta( get_the_ID(), 'jobs_options', true );

	if ( ! empty( $settings['grid_animation'] ) ) {
		$classes[] .= $settings['grid_animation'] . ' wow ';
	}

	?>
	<div class="col-lg-6 col-xl-4 col-md-6">
		<figure <?php post_class( implode( ' ', $classes ) ); ?> data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
			<div class="dm-job__wrapper dm-job-box <?php echo $grid_classes; ?>">
				<div class="post-header">
					<h2 class="dm-job-box__title"><?php the_title(); ?></h2>
					<ul class="post-meta">
						<li>
							<?php AkijCement_Theme_Helper::akijcement_posted_on(); ?>
						</li>
						<li><?php echo $jobs_info['job_type'] ?></li>
						<li><?php echo get_the_term_list( get_the_ID(), 'jobs_category', '', ', ' ); ?></li>
					</ul>
				</div>

				<p class="job-post-content">
					<?php echo wp_trim_words( get_the_content(), 15, '...' ); ?>
				</p>

				<div class="dm-job-box__footer text-center">
					<a href="<?php the_permalink(); ?>" class="dm-btn btn-outline btn-dark"><?php echo esc_html__( 'View Job Details', 'akijcement-core' ); ?></a>
				</div>
			</div>
		</figure>
	</div>

	<?php
	$ant = $ant + 0.2;
endwhile;
?>