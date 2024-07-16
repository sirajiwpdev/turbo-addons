<div class="dm-contact-info">
	<?php if ( ! empty( $settings['contact_title'] ) ) : ?>
		<h3 class="dm-contact-info__title">
			<?php echo $settings['contact_title']; ?>
		</h3>
	<?php endif; ?>

	<ul class="dm-contact-info__list">
		<?php if ( ! empty( $settings['contact_address'] ) ) : ?>
			<li class="dm-contact-info__address">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 14C14.206 14 16 12.206 16 10C16 7.794 14.206 6 12 6C9.794 6 8 7.794 8 10C8 12.206 9.794 14 12 14ZM12 8C13.103 8 14 8.897 14 10C14 11.103 13.103 12 12 12C10.897 12 10 11.103 10 10C10 8.897 10.897 8 12 8Z" fill="#66717C"/>
					<path d="M11.4201 21.814C11.5941 21.938 11.7971 22 12.0001 22C12.2031 22 12.4061 21.938 12.5801 21.814C12.8841 21.599 20.0291 16.44 20.0001 10C20.0001 5.589 16.4111 2 12.0001 2C7.58909 2 4.00009 5.589 4.00009 9.995C3.97109 16.44 11.1161 21.599 11.4201 21.814ZM12.0001 4C15.3091 4 18.0001 6.691 18.0001 10.005C18.0211 14.443 13.6121 18.428 12.0001 19.735C10.3891 18.427 5.97909 14.441 6.00009 10C6.00009 6.691 8.69109 4 12.0001 4Z" fill="#66717C"/>
				</svg>

				<?php echo $settings['contact_address']; ?>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $settings['contact_email_one'] ) ) : ?>
			<li class="dm-contact-info__email">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20 4H6C4.897 4 4 4.897 4 6V11H6V8L12.4 12.8C12.578 12.933 12.789 13 13 13C13.211 13 13.422 12.933 13.6 12.8L20 8V17H12V19H20C21.103 19 22 18.103 22 17V6C22 4.897 21.103 4 20 4ZM13 10.75L6.666 6H19.334L13 10.75Z" fill="#66717C"/>
					<path d="M2 12H9V14H2V12ZM4 15H10V17H4V15ZM7 18H11V20H7V18Z" fill="#66717C"/>
				</svg>

				<a href="mailto:<?php echo $settings['contact_email_one']; ?>">
					<?php echo $settings['contact_email_one']; ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $settings['contact_email_two'] ) ) : ?>
			<li class="dm-contact-info__email">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20 4H6C4.897 4 4 4.897 4 6V11H6V8L12.4 12.8C12.578 12.933 12.789 13 13 13C13.211 13 13.422 12.933 13.6 12.8L20 8V17H12V19H20C21.103 19 22 18.103 22 17V6C22 4.897 21.103 4 20 4ZM13 10.75L6.666 6H19.334L13 10.75Z" fill="#66717C"/>
					<path d="M2 12H9V14H2V12ZM4 15H10V17H4V15ZM7 18H11V20H7V18Z" fill="#66717C"/>
				</svg>

				<a href="mailto:<?php echo $settings['contact_email_two']; ?>">
					<?php echo $settings['contact_email_two']; ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $settings['contact_phone'] ) ) : ?>
			<li class="dm-contact-info__phone">
				<a href="tel:<?php echo $settings['contact_phone']; ?>">
					<?php echo $settings['contact_phone']; ?>
				</a>
			</li>
		<?php endif; ?>
	</ul>


</div>
