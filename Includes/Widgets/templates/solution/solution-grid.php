<?php

if ( ! isset( $settings ) ) {
	$settings = array();
}

$ant = 0.5;

while ( $dm_query->have_posts() ) :
	$dm_query->the_post();
	$classes      = array( "dm-solution grid-item" );
	$grid_classes = '';
//	$solution = get_post_meta( get_the_ID(), 'solution_options', true );

	if ( ! empty( $settings['grid_animation'] ) ) {
		$grid_classes .= $settings['grid_animation'] . ' wow ';
	}

	?>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<figure class="dm-solution <?php echo $grid_classes; ?>" data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
			<div class="dm-solution__thumb">
				<?php the_post_thumbnail( 'akijcement_solution_200x200' ); ?>
			</div>

			<div class="dm-solution__content">
				<h2 class="dm-solution__title"><a href="<?php echo esc_url(the_permalink()) ?>"><?php the_title(); ?></a></h2>
			</div>
		</figure>

	</div>
	<?php
	$ant = $ant + 0.2;
endwhile;
?>



