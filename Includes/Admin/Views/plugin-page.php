<div id=wrap class="wrap">

	<div id="akijcement-admin-wrap" class="akijcement-admin-wrap">

		<?php
		include __DIR__ . '/section/nav.php';
		$action   = isset( $_GET['action'] ) ? $_GET['action'] : 'default';
		$template = __DIR__ . '/section/banner.php';
		switch ( $action ) {
			case 'banner':
				$template = __DIR__ . '/section/banner.php';
				break;
			case 'features':
				$template = __DIR__ . '/section/feature-section.php';
				break;
			case 'section_title':
				$template = __DIR__ . '/section/section-title.php';
				break;
			case 'call_to_action':
				$template = __DIR__ . '/section/call-to-action.php';
				break;
			case 'img_content':
				$template = __DIR__ . '/section/img-content.php';
				break;
			default:
				$template = __DIR__ . '/section/default.php';
				break;
		}

		if ( file_exists( $template ) ) {
			include $template;
		}

		?>

	</div>
</div>