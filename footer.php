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
?>	
	
		</div>

	</section>
	
	<footer class="footer">
		<div class="wrap">
			<div class="column first">
				<h3>Connect With Us</h3>
				<p>22 Inverness Cntr Pky, #200<br>
					Birmingham, Alabama</p>
				<p>3692 Coolidge Court<br>
					Tallahassee, Florida 32311</p>
				<p><a href="tel:8662310545">866.231.0545</a></p>
				<div class="social">
					<a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-twitter.png"></a><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-facebook.png"></a><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-google.png"></a><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-linkedin.png"></a><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-youtube.png"></a><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-pinterest.png"></a>
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
				<form action="#" method="post">
					<input type="text" name="email" value="">
					<input type="submit" name="submit" value="Subscribe">
				</form>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>