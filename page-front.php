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

				$wpdb->show_errors();

				$events = $wpdb->get_results( "SELECT * FROM `lscu_posts` `posts` LEFT JOIN `lscu_term_relationships` `termrel` ON posts.ID = termrel.object_id LEFT JOIN `lscu_term_taxonomy` `termtax` ON termtax.term_taxonomy_id = termrel.term_taxonomy_id LEFT JOIN `lscu_postmeta` `pm` ON posts.ID = pm.post_id WHERE posts.post_type='tribe_events' AND posts.post_status='publish' AND termtax.term_id = 115 AND pm.meta_key = '_EventStartDate' ORDER BY `meta_value` ASC;" );

				foreach ( $events as $event ) {
					?>
					<article>
						<h4><a href="<?php print $event->guid ?>"><?php print $event->post_title ?></a></h4>
						<?php print date( 'n/j/Y', strtotime( $event->meta_value ) ); ?>
					</article>
					<?php
				}

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
			<a href="http://www.co-opfs.org/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-coop.png"></a><a href="http://www.criflendingsolutions.com/crif-select/Pages/CRIF-select.aspx" target="_blank"><img src="/wp-content/themes/leverage/img/partner-crif.png"></a><a href="/cu-audit-compliance-group/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-cuacg.png"></a><a href="http://www.lovemycreditunion.org/credit-union-auto-club-discount" target="_blank"><img src="/wp-content/themes/leverage/img/partner-cuac.png"></a><a href="https://www.cunamutual.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-cuna-mutual.png"></a><a href="http://cu.homeloancu.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-cumm.png"></a><a href="http://www.cusc-al.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-cuscal.png"></a><a href="http://www.cusolutionsgroup.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-cusg.png"></a><a href="http://www.diebold.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-diebold.png"></a><a href="https://dingguard.firstclose.com/User/UserLogin" target="_blank"><img src="/wp-content/themes/leverage/img/partner-ding.png"></a><a href="http://www.geassetmanager.com/fleetadvantage/people.asp" target="_blank"><img src="/wp-content/themes/leverage/img/partner-ge.png"></a><a href="http://lscu.coop/compliance/infosight/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-infosight.png"></a><a href="http://www.jmfa.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-jmfa.png"></a><a href="http://www.landrumprofessional.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-landrum.png"></a><a href="http://www.lovemycreditunion.org/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-lmcur.png"></a><a href="http://www.nada.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-nada.png"></a><a href="https://business.officedepot.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-office-max.png"></a><a href="http://www.lovemycreditunion.org/sprint-credit-union-member-discount" target="_blank"><img src="/wp-content/themes/leverage/img/partner-sprint.png"></a><a href="http://verafin.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-verafin.png"></a><a href="http://www.veri-tax.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-veritax.png"></a><a href="http://www.viningsparks.com/" target="_blank"><img src="/wp-content/themes/leverage/img/partner-vining.png"></a><a href="http://us.dealertrack.com/content/dealertrack/en/vehicle-title-management.html" target="_blank"><img src="/wp-content/themes/leverage/img/partner-vintek.png"></a>
		</div>
		<button class="partner-nav previous">Previous</button>
		<button class="partner-nav next">Next</button>
	</div>

<?php 

get_footer();

?>