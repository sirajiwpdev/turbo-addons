<?php
get_header();

// Get jobs info meta
$jobs_info = get_post_meta( get_the_ID(), 'jobs_options', true );


?>
	<div class="jobs-details-wrapper">
		<div class="container">
			<div class="jobs-details_content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

						<div class="row">
							<div class="col-md-9">
								<div class="jobs-details_content-inner">
								<div class="post-header">
									<?php echo AkijCement_Theme_Helper::akijcement_breadcrumb(); ?>
									<h2 class="jobs-details_title"><?php the_title(); ?></h2>
									<ul class="post-meta">
										<li>
											<?php AkijCement_Theme_Helper::akijcement_posted_on(); ?>
										</li>
										<li><?php echo $jobs_info['job_type'] ?></li>
										<li><?php echo get_the_term_list( get_the_ID(), 'jobs_category', '', ', ' ); ?></li>
									</ul>
								</div>

								<?php if ( has_post_thumbnail() ) { ?>
									<div class="jobs-details_thumb">
										<?php the_post_thumbnail( 'dm-jobs_details_1300x600' ); ?>
									</div>
								<?php } ?>
								<?php the_content(); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="job-sidebar">
									<?php if( ! empty( $jobs_info['job_cv_download'] )) : ?>
										<a href="<?php echo esc_url( $jobs_info['job_cv_download_link'] ); ?>" class="dm-btn"><?php echo esc_html($jobs_info['job_cv_download']); ?></a>
									<?php endif; ?>

									<h3 class="job-share-title"><?php echo esc_html__('Share This Job', 'akijcement-core') ?></h3>


									<?php echo AkijCement_Theme_Helper::render_post_list_share();; ?>
								</div>
							</div>
						</div>



				<?php endwhile; ?>
			</div>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.jobs-details-wpapper -->

<?php
get_footer();