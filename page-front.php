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
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home-events')) : ?>[events widget]<?php endif; ?>
				</div>
				<button class="home-third-button link-events" data-url="/events/month"><span>All Events</span></button>
				<div class="clearfix"></div>
			</div>

			<div class="third news">
				<h2><span>News</span></h2>
				<div class="third-content">
					<?php
					query_posts( 'posts_per_page=3' );
					if ( have_posts() ) {
						$num = 1;
						while ( have_posts() ) {
							the_post();
							?>
					<article<?php print ( $num == 1 ? ' class="first"' : '' ); ?>>
						<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
						<?php the_excerpt() ?>
					</article>
							<?php
							$num++;
						} // end while
					} // end if
					wp_reset_query();
					?>
				</div>
				<button class="home-third-button link-news" data-url="/press"><span>All News</span></button>
				<div class="clearfix"></div>
			</div>

			<div class="third tweets">
				<h2><span>Tweets</span></h2>
				<div class="third-content">
				<?php
				include( 'library/tweet-php/TweetPHP.php' );
				$upload_dir = wp_upload_dir();
				$twitter_feed = new TweetPHP(array(
					'consumer_key'              => 'rI2mcCD7tUMLKiSYdbea91bv3',
					'consumer_secret'           => 'w2bmylGVQ2BGGlQb9CFJoI9xqQ3gacjie4UbiCp8wqoP0e7y4V',
					'access_token'              => '29196496-zk653NF1sbj3mJR54Lkxcv4zmTSvm2GRTrJRf1mUA',
					'access_token_secret'       => 'QeXhPPB9xYMUAHwhnAsN2BiyIi88G3YR4UFe4aWuDJyyB',
					'cache_file'            	=> $upload_dir['basedir'] . '/cache/twitter-home.txt', 
					'cache_file_raw'        	=> $upload_dir['basedir'] . '/cache/twitter-home-array.txt', 
					'twitter_screen_name'       => 'MY_LEVERAGE',
					'tweets_to_retrieve'     	=> 5, // Number of tweets to display
					'tweets_to_display'     	=> 5, // Number of tweets to display
				));
				$feed = $twitter_feed->get_tweet_array();
				foreach ( $feed as $item ) {
					?>
					<article>
						<p><?php print make_clickable( $item['text'] ) ?>
						<div class="date"><a href="https://twitter.com/<?php print $twitter ?>/status/<?php print $item['id'] ?>"><?php print date( "n/j/Y @ g:ia", strtotime( $item['created_at'] ) ); ?></a></div></p>
					</article>
					<?php
				}
				?>
				</div>
				<button class="home-third-button twitter" data-url="https://twitter.com/leagueofsecus"><span>Read More Tweets</span></button>
				<div class="clearfix"></div>
			</div>

		</div>

	</div>
		
	<?php the_footer_showcase(); ?>

<?php 

get_footer();

?>