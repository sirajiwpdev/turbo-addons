<?php
get_header();

// Get akij-solution info meta
//$meta = get_post_meta( get_the_ID(), 'akij-solution_options', true );
?>
    <div class="akij-solution-details-wrapper">
	    <?php
	    // Featured image to background image
	    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	    $featured_image = $featured_image[0];

	    // Background image style
	    $bg_image_style = '';
	    if ( ! empty( $featured_image ) ) {
		    $bg_image_style = 'style="background-image: url(' . esc_url( $featured_image ) . ');"';
	    }
	    ?>
        <section class="page-header solution-page-header" <?php echo $bg_image_style; ?>>
            <div class="container">
                <div class="page-header_wrapper">
                    <h1 class="page-header_title"><?php echo wp_kses_post( the_title() ); ?></h1>
                    <div class="breadcrumb-wrapper">
                        <div class="breadcrumb-inner">
						    <?php echo Dm_Theme_Helper::akijcement_breadcrumb(); ?>
                        </div><!-- /.breadcrumb-wrapper -->
                    </div>
                </div>
                <!-- /.page-title-wrapper -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.page-banner -->

        <div class="container">
            <div class="akij-solution-details_content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
	                    <?php while ( have_posts() ) :
		                    the_post();
		                    ?>
                            <div class="akij-solution-details-inner">
			                    <?php the_content(); ?>

                                <div class="solution-share-link-wrapper">
                                   <?php DM_Theme_Helper::render_post_list_share(); ?>
                                </div>
                            </div>
	                    <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.akij-solution-details-wrapper -->
<?php
get_footer();