<?php

get_header();

$color = get_cmb_value( 'large-title-color' );
if ( empty( $color ) ) $color = 'forest';

?>

	<?php the_large_title(); ?>

	<?php the_showcase(); ?>

	<?php the_thumb_showcase(); ?>

	<div id="content" class="wrap group content-two-column <?php print $color ?>" role="main">
		<div class="two-third">
			<?php 
			// do post loop
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); 
					the_content();
				endwhile;
			endif;
			
			the_accordion();
			?>
		</div>
		<div class="third sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
	</div><!-- #content -->
<?php

get_footer();

?>