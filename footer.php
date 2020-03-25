<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$color = get_cmb_value( 'large-title-color' );
if ( empty( $color ) ) $color = 'forest';

?>	
	
	</div>

</section>

<div class="subscribe">
	<form name="subscribe" action="/about/contact/subscribe/" method="get">
		<label>Subscribe for Updates: <input type="text" name="email" placeholder="johnsmith@mycu.com" /></label>
		<input type="submit" class="btn-arrow" value="Submit" />
	</form>
</div>

<footer class="footer">
		<div class="two-third first">
			<h3>Connect With Us</h3>
			<div class="column third text-right first">
				3692 Coolidge Court<br />
				Tallahassee, Florida 32311<br>
			</div>
			<div class="third text-center">
				22 Inverness Cntr Pky, #200<br />
				Birmingham, Alabama<br />
				866.231.0545</p>
			</div>
			<div class="third text-left">
				6705 Sugarloaf Pky, #200<br>
				Duluth, Georgia
			</div>
			<div class="social group">
				<a href="https://twitter.com/LeagueofSECUs" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-twitter.png"></a><a href="https://www.facebook.com/LeagueofSoutheasternCreditUnions?ref=hl" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-facebook.png"></a><a href="https://www.linkedin.com/company/1007350?trk=tyah&trkInfo=clickedVertical%3Acompany%2Cidx%3A1-1-1%2CtarId%3A1428961608364%2Ctas%3Amy+leverage" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-linkedin.png"></a><a href="https://www.youtube.com/user/LeagueofSECUs" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-youtube.png"></a>
			</div>
		</div>
		<div class="third links">
			<h3>Links</h3>
			<div class="half first text-right">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-one' ) ); ?>	
			</div>
			<div class="half">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-two' ) ); ?>
			</div>
		</div>
</footer><!-- #colophon -->

<?php 

do_interstitial();

wp_footer();

?>
</body>
</html>