<?php

get_header();

?>

	<?php the_large_title(); ?>

	<?php the_showcase(); ?>

	<?php the_thumb_showcase(); ?>

	<div id="content" class="wrap group content-two-column" role="main">
		<div class="quarter sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
		<div class="three-quarter">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); 
					the_content();
				endwhile;
			endif;
			
			the_accordion();
			?>
		</div>
	</div><!-- #content -->
<?php

get_footer();

?>