<?php
if ( $settings['image']['url'] ):
	?>
	<figure class="akijcement-team akijcement-team--two">
		<div class="akijcement-team__avater">
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>" alt="<?php echo $settings['name']; ?>">
		</div>
		<!-- /.member-avater -->

		<div class="akijcement-team__info">
			<?php if ( $settings['name'] ): ?>
				<h5 class="akijcement-team__name">
					<?php printf( '%s', $settings['name'] ); ?>
				</h5>
			<?php endif; ?>

			<?php if ( $settings['position'] ): ?>
				<h6 class="akijcement-team__designation">
					<?php printf( '%s', $settings['position'] ); ?>
				</h6>
			<?php endif; ?>

			<ul class="akijcement-team__social">
				<?php
				foreach ( $settings['social_icons'] as $index => $icon ) :
					$target = $icon['link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $icon['link']['nofollow'] ? ' rel="nofollow"' : '';
					?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $icon['_id'] ); ?>">
						<a href="<?php echo esc_url( $icon['link']['url'] ); ?>" <?php echo esc_attr( $target . ' ' . $nofollow ); ?> >
							<?php \Elementor\Icons_Manager::render_icon( $icon['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

	</figure><!-- .akijcement-team -->
<?php
endif;