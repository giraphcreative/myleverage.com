<?php



// Product listing
function the_shade_showcase() {

	$shades = get_cmb_value( 'shade_showcase' );
	if ( !empty( $shades[0]['title'] ) ) {
		?>
		<div class="shades">
		<?php
		foreach ( $shades as $shade ) {
		    ?>
	<div class="shade-container">
		<?php if ( isset( $shade['link'] ) ) { ?><a href="<?php print $thumb['link'] ?>"><?php } ?>
		<div class="shade">
			<h5><?php print $shade['title'] ?></h5>
	    	<div class="shade-inner">
				<img src="<?php print $shade['image']; ?>">
				<p><?php print $shade['subtitle'] ?></p>
			</div>
		</div>
		<?php if ( isset( $shade['link'] ) ) { ?></a><?php } ?>
	</div>
			<?php
		}
		?>
		</div>
		<?php
	}
}


?>