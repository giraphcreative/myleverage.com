<?php

/*
Template Name: Page - Home
*/

get_header();

	the_showcase(); ?>

	<div class="wrap group">
		<?php the_thumb_showcase(); ?>
	</div>

	<div class="wrap">
		<div class="content-wide">
			<?php 
			if ( have_posts() ) {
				the_post();
				the_content(); 
			}
			?>
		</div>
	</div>
	<?php 

	the_parallax(); 

	the_partner_logos();

get_footer();

?>