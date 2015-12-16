<?php


function do_interstitial() {
	if ( has_cmb_value( 'interstitial' ) ) {
		print "<interstitial content=\"" . get_cmb_value( 'interstitial' ) . "\" href=\"" . get_cmb_value( 'interstitial-link' ) . "\" delay=\"" . get_cmb_value( 'interstitial-delay' ) . "\"></interstitial>";
	}
}


?>