<?php
/**
 * Template for displaying a single product
 */

global $post;


get_header();

the_large_title(); 

?>
	
	<?php if ( has_cmb_value( 'left_content' ) ) { ?>
	<div id="content" class="wrap group" role="main">
		<div class="quarter">
			<?php show_cmb_wysiwyg_value( 'left_content' ) ?>
		</div>
		<div class="three-quarter">
	<?php } else { ?>
	<div id="content" class="wrap group content-wide" role="main">
	<?php } ?>
	<?php 
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			the_content();
		endwhile;
	endif;
	?>
	<?php if ( has_cmb_value( 'left_content' ) ) { ?></div><?php } ?>
	</div><!-- #content -->


	<div class="accordion no-icons">

		<div class="accordion-box open bg-<?php print ( has_cmb_value( 'large-title-color' ) ? get_cmb_value( 'large-title-color' ) : 'teal' ) ?>">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>Partners Offering <?php print $post->post_title ?></h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap partner-logos group">
					<?php the_partner_list(); ?>
				</div>
			</div>
		</div>
		
		<div class="accordion-box open bg-<?php print ( has_cmb_value( 'large-title-color' ) ? get_cmb_value( 'large-title-color' ) : 'teal' ) ?>-light">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>You May Also Be Interested In..</h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap group">
					<div class="products">
						<div class="product-list">
							<?php the_product_list( '', true ); ?>
						</div>
						<button class="product-nav previous">Previous</button>
						<button class="product-nav next">Next</button>
					</div>
				</div>
			</div>
		</div>
		
	</div>

<?php

get_footer();

?>