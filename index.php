<?php
/*
Home/catch-all template
*/

get_header(); ?>

	<?php the_large_title(); ?>

	<?php the_showcase(); ?>
	
	<div id="content" class="wrap groupcontent-two-column" role="main">
		<div class="quarter">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
		<div class="three-quarter">
			<?php
			if ( is_search() ) {
				?><h1>Search Results for <span>'<?php print $_REQUEST["s"]; ?>'</span></h1><?php
			}

			while ( have_posts() ) : the_post();
				?>
				<div class="entry-content">
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<?php the_excerpt(); ?>
				</div>
				<?php
			endwhile;

			if ( !has_partner_or_product_accordion() ) {
				the_accordion();
			}
			?>
		<?php if ( has_cmb_value( 'left_content' ) ) { ?></div><?php } ?>
	</div><!-- #content -->

<?php get_footer(); ?>