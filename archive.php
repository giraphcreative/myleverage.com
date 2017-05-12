<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

?>
	<div class="large-title bg-lime">
		<div class="wrap">
			<div class="large-title-text">
				<h1><?php single_cat_title(); ?></h1>
			</div>
		</div>
	</div>

	<section id="primary" class="content-area wrap group" role="main">

		<?php 
		if ( have_posts() ) :
		
			// Start the Loop.
			while ( have_posts() ) : the_post(); 
				?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<?php
			endwhile;

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

		endif;
		?>

	</section><!-- #primary -->

<?php

get_footer();

?>