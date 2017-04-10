<?php

/*
Template Name: Page - Home
*/

get_header();

?>
		
	<?php the_showcase(); ?>

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

	<?php the_parallax(); ?>

	<div class="partner-showcase">
		<div class="partner-list">
			<?php the_partner_logos(); ?>
		</div>
		<button class="partner-nav previous">Previous</button>
		<button class="partner-nav next">Next</button>
	</div>

<?php 

get_footer();

?>