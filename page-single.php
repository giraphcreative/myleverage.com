<?php

/*
Template Name: Single Column
*/

get_header();

$color = get_cmb_value( 'large-title-color' );
if ( empty( $color ) ) $color = 'forest';

?>

	<?php the_large_title(); ?>

	<?php the_showcase(); ?>

	<div class="wrap group">
		<?php the_thumb_showcase(); ?>
	</div>

	<div id="content" class="wrap group content-wide <?php print $color ?>" role="main">
		<?php 
		// do post loop
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				the_content();
			endwhile;
		endif;
		?>
		</div>
		<?php the_boxes(); ?>
	</div><!-- #content -->

	<?php the_parallax(); ?>

<?php

get_footer();

?>