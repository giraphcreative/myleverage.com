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