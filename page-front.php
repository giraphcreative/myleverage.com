<?php

/*
Template Name: Page - Home
*/

get_header();

?>
		
	<?php the_showcase(); ?>

	<div class="wrap group">

		<?php the_thumb_showcase(); ?>

		<div class="home-thirds">

			<div class="third events">
				<h2><span>Events</span></h2>
				<div class="third-content">
				<!-- 
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-events')) : ?>[events widget]<?php endif; ?>
				-->
				<?php
				global $wpdb;

				$wpdb->show_errors();

				$events = $wpdb->get_results( "SELECT * FROM `lscu_posts` `posts` LEFT JOIN `lscu_term_relationships` `termrel` ON posts.ID = termrel.object_id LEFT JOIN `lscu_term_taxonomy` `termtax` ON termtax.term_taxonomy_id = termrel.term_taxonomy_id LEFT JOIN `lscu_postmeta` `pm` ON posts.ID = pm.post_id WHERE posts.post_type='event' AND posts.post_status='publish' AND termtax.term_id = 144 AND pm.meta_key = '_p_event_start' AND pm.meta_value>" . mktime() . " ORDER BY `meta_value` ASC;" );

				foreach ( $events as $event ) {
					?>
					<article>
						<h4><a href="<?php print $event->guid ?>" target="_blank"><?php print $event->post_title ?></a></h4>
						<?php print date( 'n/j/Y', $event->meta_value ); ?>
					</article>
					<?php
				}

				?>
				</div>
				<button class="home-third-button link-events" data-url="/events"><span>All Events</span></button>
				<div class="clearfix"></div>
			</div>

			<div class="third news">
				<h2><span>News</span></h2>
				<div class="third-content">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-news')) : ?>[news widget]<?php endif; ?>
				</div>
				<button class="home-third-button link-news" data-url="http://www.lscu.coop/category/leverage/"><span>All News</span></button>
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
			<?php the_partner_logos(); ?>
		</div>
		<button class="partner-nav previous">Previous</button>
		<button class="partner-nav next">Next</button>
	</div>

<?php 

get_footer();

?>