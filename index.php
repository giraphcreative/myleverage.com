<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

?>
	<div class="large-title bg-forest">
		<div class="wrap">
			<?php if ( !empty( $category_info['icon'] ) ) { ?>
			<div class="large-title-icon bg-teal">
				<img src="<?php print $category_info['icon'] ?>">
			</div>
			<?php } ?>
			<div class="large-title-text">
			<?php if ( is_search() ) { ?>
				<h1>LSCU Blog</h1>
			<?php } else { ?>
				<h1>LSCU Blog</h1>
			<?php } ?>
			</div>
		</div>
	</div>

	<div class="wrap group content-two-column" role="main">
		<div class="quarter sidebar">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-sidebar')) : ?>[blog-sidebar]<?php endif; ?>
		</div>
		<div class="three-quarter post-list">

			<?php if ( have_posts() ) : 
			
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
				get_template_part( 'content', 'none' );

			endif;
			?>

		</div>	
	</div><!-- #primary -->


<?php

get_footer();

?>