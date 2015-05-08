<?php

/*
Template Name: Page - Home
*/

get_header();

?>
		
	<?php the_showcase(); ?>

	<div class="wrap group">

		<?php if ( has_cmb_value( 'thumb_showcase' ) ) { ?>
		<div class="thumb-showcase">
			<div class="thumbs">
				<div class="thumb-list">
					<?php the_thumb_showcase(); ?>
				</div>
				<button class="thumb-nav previous">Previous</button>
				<button class="thumb-nav next">Next</button>
			</div>
		</div>
		<?php } ?>

		<div class="home-thirds">

			<div class="third events">
				<h2><span>Events</span></h2>
				<div class="third-content">
				<!-- 
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-events')) : ?>[events widget]<?php endif; ?>
				-->
				<?php
				global $wpdb;

				$events = $wpdb->get_results( "SELECT * FROM `lscu_posts` `posts` LEFT JOIN `lscu_term_relationships` `termrel` ON posts.ID = termrel.object_id LEFT JOIN `lscu_term_taxonomy` `termtax` ON termtax.taxonomy_term_id = termrel.term_taxonomy_id WHERE posts.post_type='tribe_events' AND posts.post_status='publish' AND termtax.term_id = 115;" );

				print_r( $events );

				print $wpdb->print_error();

				?>
				</div>
				<button class="home-third-button link-events" data-url="/events/month"><span>All Events</span></button>
				<div class="clearfix"></div>
			</div>

			<div class="third news">
				<h2><span>News</span></h2>
				<div class="third-content">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-news')) : ?>[news widget]<?php endif; ?>
				</div>
				<button class="home-third-button link-news" data-url="/press"><span>All News</span></button>
				<div class="clearfix"></div>
			</div>

			<div class="third tweets">
				<h2><span>Tweets</span></h2>
				<div class="third-content">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-twitter')) : ?>[twitter widget]<?php endif; ?>
				</div>
				<button class="home-third-button twitter" data-url="https://twitter.com/leagueofsecus"><span>Read More Tweets</span></button>
				<div class="clearfix"></div>
			</div>

		</div>

	</div>
		
	<?php the_footer_showcase(); ?>

	<div class="partner-showcase">
		<div class="partner-list">
			<a href="#"><img src="/wp-content/themes/leverage/img/partner-complysight.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-cuna.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-cuscal.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-cuss.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-cuvm.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-hrx.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-landrum.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-leverage-cs.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-office-max.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-omnia.png"></a><a href="#"><img src="/wp-content/themes/leverage/img/partner-sscu.png"></a>
		</div>
		<button class="partner-nav previous">Previous</button>
		<button class="partner-nav next">Next</button>
	</div>

<?php 

get_footer();

?>