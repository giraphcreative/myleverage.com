<?php


// set a custom field prefix
define( "CMB_PREFIX", "_p_" );


// include some theme-related things
include( "library/menus.php" );
include( "library/scripts.php" );


// an extra image manipulation function
include( "library/images.php" );


// include our metaboxes library
include( "library/metabox.php" );


// include widget library
include( "library/widgets.php" );
include( "library/login.php" );


// include quote metaboxes/functions
include( "library/title.php" );
include( "library/showcase.php" );
include( "library/accordion.php" );


// enable oembed and shortcodes in text widgets
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );


?>