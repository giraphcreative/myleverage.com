<?php

/*
Template Name: Linqto Widget
*/

get_header();

$color = get_cmb_value( 'large-title-color' );
if ( empty( $color ) ) $color = 'forest';

?>

	<?php the_large_title(); ?>

	<?php the_showcase(); ?>

	<?php the_thumb_showcase(); ?>

	<div id="content" class="wrap group content-two-column <?php print $color ?>" role="main">
		<div class="quarter sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
		<div class="three-quarter">
			<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
			    <?php 
			    if ( function_exists( 'bcn_display' ) ) {
			        bcn_display();
			    }
			    ?>
			</div>
			<?php 
			// do post loop
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); 
					the_content();
				endwhile;
			endif;
			
			if ( is_user_logged_in() ) {
				?>
			<iframe src='http://leverage.linqto.com/?user=<?php print get_current_user_id(); ?>' style="width: 100%; height: 1200px;"  allowtransparency="true"></iframe>
				<?php
			}

			the_accordion();
			?>
		</div>
	</div><!-- #content -->
<?php

get_footer();

?>