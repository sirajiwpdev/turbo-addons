<div class="akijcement-icon-box style-five">
	<?php if ( $settings['icon_type'] == 'type_icon' ) : ?>
		<?php if ( $settings['icon_pack'] == 'fontawesome' ) : ?>
			<div class="icon-container">
				<?php if ( ! empty( $settings['box_icon'] ) ) : ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['box_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				<?php endif; ?>
			</div>
		<?php elseif ( $settings['icon_pack'] == 'flaticons' ) : ?>
			<div class="icon-container">
				<?php if ( ! empty( $settings['flaticon'] ) ) : ?>
					<i class="<?php echo esc_attr( $settings['flaticon'] ) ?>"></i>
				<?php endif; ?>
			</div>
		<?php elseif ( $settings['icon_pack'] == 'feather' ) : ?>
			<div class="icon-container">
				<?php if ( ! empty( $settings['feather_icon'] ) ) : ?>
					<i class="<?php echo esc_attr( $settings['feather_icon'] ) ?>"></i>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( $settings['icon_type'] == 'type_image' ) : ?>
		<div class="icon-container">
			<?php if ( ! empty( $settings['icon_image']['url'] ) ) : ?>
				<img src="<?php echo $settings['icon_image']['url'] ?>" alt="<?php echo $settings['box_title']; ?>">
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<!-- /.icon-container -->

    <div class="box-content">
        <?php if (!empty($settings['box_title'])) : ?>
            <h4 class="box-title">
                <?php if (!empty($settings['link']['url'])) : ?>
                <a href="<?php echo esc_url($settings['link']['url']); ?>" <?php echo $target . ' ' . $nofollow ?>>
                    <?php endif; ?>
                    <?php echo $settings['box_title']; ?>
                    <?php if (!empty($settings['link']['url'])) : ?>
                </a>
            <?php endif; ?>
            </h4>
        <?php endif; ?>

        <?php if (!empty($settings['description'])) : ?>
            <p class="description">
                <?php echo $settings['description']; ?>
            </p>
        <?php endif; ?>

    </div>
</div>
<!-- /.akijcement-icon-box -->