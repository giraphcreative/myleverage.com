<?php


function the_large_title() {

	// get the slides
	if ( has_cmb_value( 'large-title' ) ) {
		?>
		<div class="large-title bg-<?php show_cmb_value( 'large-title-color' ) ?>">
			<div class="wrap">
				<?php if ( has_cmb_value( 'large-title-icon' ) ) { ?>
				<div class="large-title-icon bg-<?php show_cmb_value( 'large-title-color' ) ?>" style="background-image: url(<?php print p_image_resize( get_cmb_value( 'large-title-icon' ), 300, 300, true ) ?>);">
					<div class="hex1"></div>
					<div class="hex2"></div>
				</div>
				<?php } ?>
				<div class="large-title-text">
					<h1><?php show_cmb_value( 'large-title' ) ?></h1>
				</div>
			</div>
		</div>
		<?php
	}
	
}


?>