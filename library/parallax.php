<?php


function the_parallax() {

	// get the slides
	if ( has_cmb_value( 'parallax-text' ) && has_cmb_value( 'parallax-image' ) ) {
		?>
		<?php if ( has_cmb_value( 'parallax-link' ) ) { ?><a href="<?php show_cmb_value( 'parallax-link' ); ?>" class="parallax-link"><?php } ?>
		<div class="parallax" style="background-image: url(<?php show_cmb_value( 'parallax-image' ) ?>);">
			<div class="wrap">
				<?php print apply_filters( 'the_content', get_cmb_value( 'parallax-text' ) ) ?>
				<?php if ( has_cmb_value( 'parallax-button' ) ) { ?><p><button><?php show_cmb_value( 'parallax-button' ); ?></button></p><?php } ?>
			</div>
		</div>
		<?php if ( has_cmb_value( 'parallax-link' ) ) { ?></a><?php } ?>
		<?php
	}
	
}


?>