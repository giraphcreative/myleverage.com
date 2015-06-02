<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

?>
	<?php if ( is_search() ) { ?>
	<div class="large-title bg-forest">
		<div class="wrap">
			<div class="large-title-icon bg-forest" style="background-image: url(/wp-content/themes/leverage/img/hero-search.jpg);">
				<div class="hex1"></div>
				<div class="hex2"></div>
			</div>
			<div class="large-title-text">
				<h1>Search: <?php print $_REQUEST['s']; ?></h1>
			</div>
		</div>
	</div>
	<div class="showcase">
		<div class="slide visible">
			<img src="/wp-content/themes/leverage/img/hero-search.jpg">
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
		<div class="quarter sidebar">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-sidebar')) : ?>[blog-sidebar]<?php endif; ?>
		</div>
		<div class="three-quarter post-list">

			<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
			    <?php 
			    if ( function_exists( 'bcn_display' ) ) {
			        bcn_display();
			    }
			    ?>
			</div>
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
	</div><!-- #primary -->


<?php

get_footer();

?>