<?php

get_header();

$color = get_cmb_value( 'large-title-color' );
if ( empty( $color ) ) $color = 'forest';

?>

	<?php the_large_title(); ?>

	<?php the_showcase(); ?>

	<div class="wrap group">
		<?php the_thumb_showcase(); ?>
	</div>

	<div id="content" class="wrap group content-two-column" role="main">
		<div class="two-third page">
			<div class="box even">
			<?php 
			// do post loop
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); 
					the_content();
				endwhile;
			endif;
			?>
			</div>
			<?php the_boxes(); ?>
		</div>
		<div class="third sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
		
		<div class="group">
			<?php the_shade_showcase() ?>
		</div>
	</div><!-- #content -->

	<?php the_parallax(); ?>

<?php

get_footer();

?>