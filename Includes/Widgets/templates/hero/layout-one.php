<div <?php echo $this->get_render_attribute_string('wrapper')?>>

	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-10">
				<div class="banner__content">
					<?php
					if ( ! empty( $settings['title'] ) ) : ?>
						<h1 class="banner__title wow fadeInUp">
							<?php echo $settings['title']; ?>
						</h1>
					<?php endif ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="wow fadeInUp banner__description" data-wow-delay=".5s">
							<?php echo $settings['description']; ?>
						</p>
					<?php endif ?>

                    <?php if ( 'yes' == $settings['show_button'] ) : ?>
                        <div class="banner__btns wow fadeInUp" data-wow-delay=".7s">
                            <?php if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
                                <a <?php $this->print_render_attribute_string( 'button' ); ?>>
                                    <?php echo $settings['btn_text'] ?>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $settings['sec_btn_link']['url'] ) ) : ?>
                                <a <?php $this->print_render_attribute_string( 'secondary_button' ); ?>>
                                    <?php echo esc_html( $settings['sec_btn_text'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
