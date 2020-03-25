<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

$taxonomy = 'product_cat';
$term_id = get_queried_object_id();
$category_info = Taxonomy_MetaData::get( $taxonomy, $term_id );

?>
	<div class="large-title bg-<?php print !empty( $category_info['color'] ) ? $category_info['color'] : 'teal'; ?>">
		<div class="wrap">
			<?php if ( !empty( $category_info['icon'] ) ) { ?>
			<div class="large-title-icon bg-<?php print !empty( $category_info['color'] ) ? $category_info['color'] : 'teal'; ?>">
				<img src="<?php print $category_info['icon'] ?>">
			</div>
			<?php } ?>
			<div class="large-title-text">
				<h1><?php single_cat_title(); ?></h1>
			</div>
		</div>
	</div>

	<div class="wrap group" role="main">
		<?php if ( !empty( $category_info['left'] ) || !empty( $category_info['right'] ) ) { ?>
		<div class="third">
		<?php print !empty( $category_info['left'] ) ? apply_filters( 'the_content', $category_info['left'] ) : " "; ?>
		</div>	
		<div class="two-third">
		<?php print !empty( $category_info['right'] ) ? apply_filters( 'the_content', $category_info['right'] ) : " "; ?>
		</div>	
		<?php } ?>
	</div><!-- #primary -->

	<div class="accordion no-icons">

		<div class="accordion-box open bg-<?php print !empty( $category_info['color'] ) ? $category_info['color'] : 'teal'; ?>">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>Products</h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap group">
					<div class="products">
						<div class="product-list">
						<?php 
						if ( have_posts() ) :
							while ( have_posts() ) : the_post(); 
?><a href="/product/<?php print $post->post_name ?>"><div class="product bg-<?php print get_cmb_value( 'large-title-color' ) ?>">
	<div class="product-icon">
		<img src="<?php print get_cmb_value( 'large-title-icon' ) ?>">
	</div>
	<h3><?php print get_the_title() ?></h3>
</div></a><?php
							endwhile;
						endif;
						?>
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