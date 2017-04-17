<?php


function the_showcase() {

	// get the slides
	$slides = get_post_meta( get_the_ID(), CMB_PREFIX . "showcase", 1 );

	if ( !empty( $slides ) ) {
		?>
		<div class="showcase">
		<?php
		$count = 0;
		foreach ( $slides as $key => $slide ) {
			if ( !empty( $slide["image-small"] ) && !empty( $slide["image-large"] ) ) {

				// store the title and subtitle
				$title = ( isset( $slide["title"] ) ? $slide["title"] : '' );
				$subtitle = ( isset( $slide["subtitle"] ) ? $slide["subtitle"] : '' );
				$link = ( isset( $slide["link"] ) ? $slide["link"] : '' );

				?>
			<div class="slide<?php print ( $key == 0 ? ' visible' : '' ); ?>" data-slide-number="<?php print $count+1; ?>">
				<?php if ( !empty( $link ) ) { ?><a href="<?php print $link ?>" class="<?php print ( stristr( $link, 'vimeo' ) || stristr( $link, 'youtube' ) || stristr( $link, 'google.com/maps' ) ? 'lightbox-iframe' : '' ) ?>"><?php } ?>
				<img src="<?php print $slide["image-small"]; ?>" class="small">
				<img src="<?php print $slide["image-large"]; ?>" class="large">
				<?php if ( !empty( $title ) || !empty( $subtitle ) ) { ?>
				<div class="slide-content">
					<?php if ( !empty( $title ) ) { ?><h3><?php print $title ?></h3><?php } ?>
					<?php if ( !empty( $subtitle ) ) { ?><p><?php print $subtitle ?></p><?php } ?>
				</div>
				<?php } ?>
				<?php if ( !empty( $link ) ) { ?></a><?php } ?>
			</div>
				<?php
				$count++;
			}
		}

		if ( $count > 1 ) {
			?>
			<div class="showcase-nav">
				<!--
				<a class="previous">Previous</a>
				<a class="next">Next</a>
				-->
				<?php 
				$n = 1;
				while ( $n <= $count ) {
					print "<a data-slide-number='$n'" . ( $n == 1 ? ' class="current"' : '' ) . ">$n</a>";
					$n++;
				}
				?>
			</div>
			<?php
		}
		?>
		</div>
		<?php
	}
}



// Product listing
function the_thumb_showcase() {

	$thumbs = get_cmb_value( 'thumb_showcase' );
	if ( !empty( $thumbs[0]['title'] ) ) {
		?>
		<div class="thumbs">
		<?php
		foreach ( $thumbs as $thumb ) {
		    ?>
	<div class="thumb-container">
		<div class="thumb">
	    	<div class="thumb-inner">
				<div class="thumb-icon">
					<img src="<?php print $thumb['image']; ?>">
				</div>
				<div class="thumb-text <?php print $thumb['color'] ?>">
					<h5><?php print $thumb['title'] ?></h5>
					<p><?php print $thumb['subtitle'] ?></p>
				</div>
				<div class="thumb-buttons">
					<?php if ( isset( $thumb['button-1-text'] ) && isset( $thumb['button-1-link'] ) ) { ?><a href="<?php print $thumb['button-1-link'] ?>" class="button1"><?php print $thumb['button-1-text'] ?></a><?php } ?>
					<?php if ( isset( $thumb['button-2-text'] ) && isset( $thumb['button-2-link'] ) ) { ?><a href="<?php print $thumb['button-2-link'] ?>" class="button2"><?php print $thumb['button-2-text'] ?></a><?php } ?>
				</div>
			</div>
		</div>
	</div>
			<?php
		}
		?>
		</div>
		<?php
	}
}



function the_footer_showcase() {

	// get the slides
	$slides = get_cmb_value( "showcase_footer" );

	if ( !empty( $slides ) ) {
		?>
		<div class="showcase footer">
		<?php
		$count = 0;
		foreach ( $slides as $key => $slide ) {
			if ( !empty( $slide["image"] ) ) {

				// store the title and subtitle
				$title = ( isset( $slide["title"] ) ? $slide["title"] : '' );
				$link = ( isset( $slide["link"] ) ? $slide["link"] : '' );
				$icon = ( isset( $slide["icon"] ) ? $slide["icon"] : '' );

				print $icon;
				// check if it's an image or video
				if ( p_is_image( $slide["image"] ) ) {
					// it's an image, so resize it and generate an img tag.
					$image = '<img src="' . $slide["image"] . '">';
				} else {
					// it's a video, so oEmbed that stuffs, yo
					$image = apply_filter( 'the_content', $slide["image"] );
				}

				?>
			<div class="slide<?php print ( $key == 0 ? ' visible' : '' ); ?>">
				<?php if ( !empty( $link ) ) { ?><a href="<?php print $link ?>" class="<?php print ( stristr( $link, 'vimeo' ) || stristr( $link, 'youtube' ) || stristr( $link, 'google.com/maps' ) ? 'lightbox-iframe' : '' ) ?>"><?php } ?>
				<?php print $image; ?>
				<?php if ( !empty( $link ) ) { ?></a><?php } ?>
				
				<?php if ( !empty( $title ) ) { ?>
				<div class="slide-hexagon">
					<?php if ( !empty( $icon ) ) { ?><img src="<?php print $icon; ?>"><?php } ?>					
					<?php if ( !empty( $title ) ) { ?><h1><?php print $title; ?></h1><?php } ?>
				</div>
				<?php } ?>
			</div>
				<?php
				$count++;
			}
		}

		if ( $count > 1 ) { 
			?>
			<div class="showcase-nav">
				<a class="previous">Previous</a>
				<a class="next">Next</a>
			</div>
			<?php
		}
		?>
		</div>
		<?php
	}

}



?>