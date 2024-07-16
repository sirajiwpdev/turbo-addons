<?php
get_header();

// Get product info meta
//$meta = get_post_meta( get_the_ID(), 'product_options', true );
?>
    <div class="product-details-wrapper">
        <div class="product-details_content">
			<?php while ( have_posts() ) :
				the_post(); ?>
                <div class="akij-product-details-wrapper">
<!--					--><?php //if ( has_post_thumbnail() ) : ?>
<!--                        <div class="product-details-image">-->
<!--							--><?php //the_post_thumbnail( 'full' ); ?>
<!--                        </div>-->
<!--					--><?php //endif; ?>
					<?php the_content(); ?>
                </div>
			<?php endwhile; ?>
        </div>
    </div>
    <!-- /.product-details-wrapper -->
<?php
get_footer();