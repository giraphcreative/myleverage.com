<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

?>
	<?php if ( is_search() ) { ?>
	<div class="large-title bg-lime">
		<div class="wrap">
			<div class="large-title-text">
				<h1>Search: <?php print strip_tags( $_REQUEST['s'] ); ?></h1>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class="large-title bg-forest">
		<div class="wrap">
			<div class="large-title-text">
				<h1>LSCU Blog</h1>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="wrap group content-two-column" role="main">
		<div class="two-third post-list">
			<?php 

			if ( have_posts() ) : 
			
				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					?>
			<article>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php the_excerpt(); ?>
			</article>
					<?php
				endwhile;

				?>
			<div class="pagination">
				<?php pagination(); ?>
			</div>
				<?php

			else :
				// If no content, include the "No posts found" template.
				?>
			<article>
			<p>No search results were found matching your criteria. Please try again or <a href="/about/contact">get in touch with us</a> if you feel you reached this page in error.</p>
			</article>
				<?php
			endif;
			?>

		</div>	
		<div class="third sidebar">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('search-sidebar')) : ?>[blog-sidebar]<?php endif; ?>
		</div>
	</div><!-- #primary -->


<?php

get_footer();

?>