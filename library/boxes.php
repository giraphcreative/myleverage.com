<?php


function the_boxes() {

	// get the slides
	$boxes = get_post_meta( get_the_ID(), CMB_PREFIX . "accordion", 1 );

	if ( !empty( $boxes ) ) {
		$count = 1;
		foreach ( $boxes as $key => $box ) {
			if ( !empty( $box["title"] ) && !empty( $box["content"] ) && empty( $box["hide"] ) ) {

				// store the title and subtitle
				$title = ( isset( $box["title"] ) ? $box["title"] : '' );
				$content = ( isset( $box["content"] ) ? $box["content"] : '' );
				$content = apply_filters( 'the_content', $content );

				?>
			<div class="box <?php print ( is_int( $count/2 ) ? 'even' : 'odd' ); ?>">
				<h4><?php print $title ?></h4>
				<?php print wpautop( $content ); ?>
			</div>
				<?php
				$count++;
			}
		}
	}
}



?>