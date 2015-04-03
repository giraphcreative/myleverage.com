<?php
/**
 * Template for displaying a single product
 */

global $post;


// get some values for the partner template
$logo = get_cmb_value( 'partner_logo' );
$photo = get_cmb_value( 'partner_photo' );
$contact = get_cmb_value( 'partner_contact' );
$phone = get_cmb_value( 'partner_phone' );
$email = get_cmb_value( 'partner_email' );
$twitter = str_replace( "@", "", get_cmb_value( 'partner_twitter' ) );
$website = get_cmb_value( 'partner_website' );
$url = parse_url( $website );
if ( !empty( $url['host'] ) ) { 
	$website_cleaned = str_replace( "www.", "", $url['host'] );
}
$testimonials = get_cmb_value( 'partner_testimonials' );
$products = get_cmb_value( 'partner_products' );


// display header
get_header();


// output the showcase
the_showcase(); 

?>

	<div id="content" class="wrap group partner" role="main">

		<div class="sidebar quarter">
			<div class="logo">
				<img src="<?php print $logo ?>">
			</div>
			<div class="connect">
				<h4>Connect With Us</h4>
				<img src="<?php print $photo ?>" class="photo">
				<p><strong><?php print $contact ?></strong><br>
					Phone: <?php print $phone ?><br>
					<a href="mailto:<?php print strtolower( $email ) ?>"><?php print $email ?></a><br>
					<a href="<?php print $website ?>"><?php print $website_cleaned ?></a></p>
			</div>
			<?php if ( !empty( $twitter ) ) { ?>
			<div class="twitter-feed">
				<h4><a href="https://twitter.com/<?php print $twitter ?>">@<?php print $twitter ?></a></h4>
				<ul>
				<?php
				include( 'library/tweet-php/TweetPHP.php' );
				$upload_dir = wp_upload_dir();
				$twitter_feed = new TweetPHP(array(
					'consumer_key'              => 'rI2mcCD7tUMLKiSYdbea91bv3',
					'consumer_secret'           => 'w2bmylGVQ2BGGlQb9CFJoI9xqQ3gacjie4UbiCp8wqoP0e7y4V',
					'access_token'              => '29196496-zk653NF1sbj3mJR54Lkxcv4zmTSvm2GRTrJRf1mUA',
					'access_token_secret'       => 'QeXhPPB9xYMUAHwhnAsN2BiyIi88G3YR4UFe4aWuDJyyB',
					'cache_file'            	=> $upload_dir['basedir'] . '/cache/twitter-' . $twitter . '.txt', 
					'cache_file_raw'        	=> $upload_dir['basedir'] . '/cache/twitter-' . $twitter . '-array.txt', 
					'twitter_screen_name'       => $twitter,
					'tweets_to_retrieve'     	=> 3, // Number of tweets to display
					'tweets_to_display'     	=> 3, // Number of tweets to display
				));
				$feed = $twitter_feed->get_tweet_array();
				foreach ( $feed as $item ) {
					?>
					<li><?php print make_clickable( $item['text'] ) ?><br>
						<div class="date"><a href="https://twitter.com/<?php print $twitter ?>/status/<?php print $item['id'] ?>"><?php print date( "n/j/Y @ g:ia", strtotime( $item['created_at'] ) ); ?></a></div></li>
					<?php
				}
				?>
				</ul>
			</div>
			<?php } ?>
		</div>

		<div class="three-quarter">
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				the_content();
			endwhile;
		endif;
		?>
		</div>

	</div><!-- #content -->


	<div class="accordion no-icons">

		<div class="accordion-box open bg-teal">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>Products Offered</h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap">
					<div class="products">
						<div class="product-list">
							<?php the_product_list( get_cmb_value( 'partner_products' ) ); ?>
						</div>
						<button class="product-nav previous">Previous</button>
						<button class="product-nav next">Next</button>
					</div>
				</div>
			</div>
		</div>

		<?php if ( has_cmb_value( 'partner_testimonials' ) ) { ?>
		<div class="accordion-box bg-teal-light">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>Testimonials</h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap">
					<?php show_cmb_wysiwyg_value( 'partner_testimonials' ); ?>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if ( has_cmb_value( 'partner_articles' ) ) { ?>
		<div class="accordion-box bg-teal-lighter">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>Articles</h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap">
					<?php show_cmb_wysiwyg_value( 'partner_articles' ); ?>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if ( has_cmb_value( 'partner_videos' ) ) { ?>
		<div class="accordion-box bg-teal-lightest">
			<div class="accordion-box-title">
				<div class="wrap">
					<h4>Videos</h4>
				</div>
			</div>
			<div class="accordion-box-content">
				<div class="wrap">
					<?php show_cmb_wysiwyg_value( 'partner_videos' ); ?>
				</div>
			</div>
		</div>
		<?php } ?>

	</div>

<?php

get_footer();

?>