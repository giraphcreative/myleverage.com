<?php


function the_large_title() {

	// get the slides
	if ( has_cmb_value( 'large-title' ) ) {
		?>
		<div class="large-title bg-lime">
			<div class="wrap">
				<div class="large-title-icon">
					<img src="<?php show_cmb_value( 'large-title-icon' ) ?>">
				</div>
				<div class="large-title-text">
					<h1><?php show_cmb_value( 'large-title' ) ?></h1>
				</div>
			</div>
		</div>
		<?php
	}
	
}


?>