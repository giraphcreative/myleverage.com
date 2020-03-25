<?php


function notification_bar() {
	$enabled = pure_get_option( 'notification-enabled' );
	$color = pure_get_option( 'notification-color' );
	$content = pure_get_option( 'notification-content' );

	if ( $enabled && !empty( $content ) ) {
		?>	
		<div class="notification-bar bg-<?php print $color ?>">
			<a href="#" class="close">x</a>
			<div class="notification-content">
				<?php print $content; ?>
			</div>
		</div>
		<?php
	}
}


?>