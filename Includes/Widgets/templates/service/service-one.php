<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="akijcement-service__icon">
		<?php if( $settings['icon_type'] == 'icon' ) : ?>
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
		<?php endif; ?>
	</div>

	<div class="akijcement-service__content">
		<?php if ( $settings['title'] ): ?>
			<h4 class="akijcement-service__title">
				<?php printf( '%s', $settings['title'] ); ?>
			</h4>
		<?php endif; ?>

		<?php if ( !empty($settings['button_text']) && 'one' == $settings['layout'] ): ?>
			<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="akijcement-service__btn">
				<?php printf( '%s', $settings['button_text'] ); ?>
			</a>
		<?php endif; ?>

		<?php if ( !empty( $settings['button_link']['url'] ) && 'two' == $settings['layout'] ): ?>
			<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="akijcement-service__arrow">
				<svg width="50" height="23" viewBox="0 0 50 23" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M49.0134 12.9191C49.5991 12.3333 49.5991 11.3835 49.0134 10.7977L39.4674 1.2518C38.8816 0.66601 37.9319 0.66601 37.3461 1.2518C36.7603 1.83758 36.7603 2.78733 37.3461 3.37312L45.8314 11.8584L37.3461 20.3437C36.7603 20.9295 36.7603 21.8792 37.3461 22.465C37.9319 23.0508 38.8816 23.0508 39.4674 22.465L49.0134 12.9191ZM0.637939 13.3584H47.9527V10.3584H0.637939V13.3584Z" fill="#141416"/>
				</svg>

			</a>
		<?php endif; ?>
	</div>
</div>
<!-- /.akijcement-service -->