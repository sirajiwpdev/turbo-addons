<?php

if ( ! isset( $settings ) ) {
	$settings = array();
}

$ant = 0.5;

while ( $dm_query->have_posts() ) :
	$dm_query->the_post();
	$classes      = array( "dm-product grid-item" );
	$grid_classes = '';
	$solution     = get_post_meta( get_the_ID(), 'solution_options', true );


	if ( ! empty( $settings['grid_animation'] ) ) {
		$grid_classes .= $settings['grid_animation'] . ' wow ';
	}
	?>
    <div class="col-lg-4 col-md-6">
        <figure class="dm-product dm-product-box <?php echo $grid_classes; ?>"
                data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
            <div class="dm-product__thumb">
                <a href="<?php echo the_permalink() ?>">
					<?php the_post_thumbnail( 'full' ); ?>
                </a>
            </div>

            <div class="dm-product__content">
                <h2 class="dm-product__title"><a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a></h2>
            </div>
        </figure>
    </div>
	<?php
	$ant = $ant + 0.2;
endwhile;
?>



