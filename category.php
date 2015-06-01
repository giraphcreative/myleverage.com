<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

$taxonomy = 'category';
$term_id = get_queried_object_id();
$term = get_queried_object();
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

	<div class="wrap group content-two-column" role="main">
		<div class="quarter sidebar">
			<?php print !empty( $term->description ) ? apply_filters( 'the_content', $term->description ) : " "; ?>
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