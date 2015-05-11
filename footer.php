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

<footer class="footer bg-<?php print $color ?>">
	<div class="wrap">
		<div class="column first">
			<h3>Connect With Us</h3>
			<p class="address">22 Inverness Cntr Pky, #200<br>
				Birmingham, Alabama 35242</p>
			<p class="address">3692 Coolidge Court<br>
				Tallahassee, Florida 32311</p>
			<p><a href="tel:8662310545">866.231.0545</a></p>
			<div class="social">
				<a href="https://twitter.com/My_LEVERAGE" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-twitter.png"></a><a href="https://www.facebook.com/LeagueofSoutheasternCreditUnions?ref=hl" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-facebook.png"></a><a href="https://www.linkedin.com/company/1007350?trk=tyah&trkInfo=clickedVertical%3Acompany%2Cidx%3A1-1-1%2CtarId%3A1428961608364%2Ctas%3Amy+leverage" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-linkedin.png"></a><a href="https://www.youtube.com/user/LeagueofSECUs" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-youtube.png"></a>
			</div>
		</div>
		<div class="column">
			<h3>Links</h3>
			<nav role="navigation">
				<?php wp_nav_menu( array( 
					'theme_location' => 'footer', 
					'menu_class' => 'nav-menu' ) 
				); ?>
			</nav>
		</div>
		<div class="column">
			<h3>Sign Up For News</h3>
			<?php print do_shortcode( '[snippet slug="subscribe" /]' ); ?>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>