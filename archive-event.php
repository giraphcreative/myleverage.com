<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

if ( isset( $_REQUEST['event_category'] ) && $_REQUEST['event_category']!=0 ) {
	$category_info = get_term_by( 'id', $_REQUEST['event_category'], 'event_cat' );
	$page_title = $category_info->name;
} else {
	$page_title = "News + Events";
}

?>
	<div class="large-title bg-lime">
		<div class="wrap">
			<div class="large-title-icon bg-lime" style="background-image: url(<?php print get_bloginfo('template_url') . '/img/event-image.png' ?>);">
				<div class="hex1"></div>
				<div class="hex2"></div>
			</div>
			<div class="large-title-text">
				<h1><?php print $page_title; ?></h1>
			</div>
		</div>
	</div>
	
	<div id="content" class="wrap content-two-column" role="main">
		<div class="three-quarter">
			<h2>Events</h2>
			<p><strong>Filter by Event Type:</strong> <?php filter_by_event_type(); ?></p>
			<br>
			<?php 

			// get URL parameters and default to current month.
			$month = ( isset( $_REQUEST['mo'] ) ? $_REQUEST['mo'] : date( "n" ) );
			$year = ( isset( $_REQUEST['yr'] ) ? $_REQUEST['yr'] : date( "Y" ) );

			// output month
			show_month_events( $month, $year );

			?>
		</div>
		<div class="quarter">
			<h2>Recent News</h2>
			<div class="post-list">
			<?php

			$blog_query = new WP_Query( array(
				'post_type' => 'post',
				'posts_per_page' => 3
			) );

			if ( $blog_query->have_posts() ) {
				while ( $blog_query->have_posts() ) {
					$blog_query->the_post();
					?>
			<div class="entry">
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php the_excerpt(); ?>
				<p class="quiet">Posted by <?php print get_the_author_link() ?> in <?php print get_the_category_list( ', ' ) ?>.</p>
			</div>
					<?php
				}
			} else {
				print "No posts found.";
			}

			?>
			</div>
		</div>
		<hr />
		<div class="group third">
			<div class="fb-page" data-href="https://www.facebook.com/LeagueofSoutheasternCreditUnions" data-tabs="timeline" data-width="300px" data-height="500px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/LeagueofSoutheasternCreditUnions" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/LeagueofSoutheasternCreditUnions">League of Southeastern Credit Unions (LSCU)</a></blockquote></div>
		</div>
		<div class="two-third twitter-feed">
			<a class="twitter-timeline" data-width="100%" data-height="500" href="https://twitter.com/LeagueofSECUs">Tweets by LeagueofSECUs</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
	</div><!-- #content -->

<?php

get_footer();

?>