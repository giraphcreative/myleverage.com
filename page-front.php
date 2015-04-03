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
					<article class="first">
						<h4><a href="#">An Event Title</a></h4>
						<p>January 3, 2015  3:00P - 4:00PM</p>
					</article>
					<article>
						<h4><a href="#">An Event Title</a></h4>
						<p>January 3, 2015  3:00P - 4:00PM</p>
					</article>
				</div>
				<button class="home-third-button link-events"><span>All Link Events</span></button>
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
				<button class="home-third-button link-news"><span>All Link News</span></button>
				<div class="clearfix"></div>
			</div>

			<div class="third tweets">
				<h2><span>Tweets</span></h2>
				<div class="third-content">
					<article>
						<h4><a href="#">Looking for new ideas? Need a new income source?</a></h4>
						<p>Use our CU Match Up Tool to find the best partners to help you increase non-interest income, help with collections, save on operating expenses and more!</p>
					</article>
				</div>
				<button class="home-third-button cu-match"><span>Find Your Match</span></button>
				<div class="clearfix"></div>
			</div>

		</div>

	</div>
		
	<?php the_footer_showcase(); ?>

<?php 

get_footer();

?>