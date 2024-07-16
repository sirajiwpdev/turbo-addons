
<figure <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>

	<?php if( ! empty( $settings['image']['url'] )) : ?>
		<div class="dm-team__avater">
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>">
		</div>
		<!-- /.member-avater -->
	<?php endif; ?>

	<div class="dm-team__info">
		<?php if ( $settings['name'] ): ?>
			<h5 class="dm-team__name">
				<?php printf( '%s', $settings['name'] ); ?>
			</h5>
		<?php endif; ?>

		<?php if ( $settings['position'] ): ?>
			<div class="dm-team__designation">
				<?php printf( '%s', $settings['position'] ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $settings['email_id'] ): ?>
			<div class="dm-team__email">
				<a href="mailto:<?php echo esc_attr( $settings['email_id'] ); ?>">
					<?php printf( '%s', $settings['email_id'] ); ?>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( $settings['phone'] ): ?>
			<div class="dm-team__phone">
				<span><?php echo esc_html__('Number: ', 'akijcement-core') ?></span>
				<?php printf( '%s', $settings['phone'] ); ?>
			</div>
		<?php endif; ?>
	</div>

</figure><!-- .dm-team -->
