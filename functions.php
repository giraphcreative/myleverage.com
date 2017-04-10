<?php


// set a custom field prefix
define( "CMB_PREFIX", "_p_" );


// include some theme-related things
include( "library/menus.php" );
include( "library/scripts.php" );


// post types
include( "library/post-type/partner.php" );
include( "library/post-type/event.php" );


// an extra image manipulation function
include( "library/images.php" );


// include our metaboxes library
include( "library/metabox.php" );
include( "library/metabox-theme.php" );


// include widget library
include( "library/widgets.php" );
include( "library/login.php" );


// include quote metaboxes/functions
include( "library/title.php" );
include( "library/showcase.php" );
include( "library/boxes.php" );
include( "library/parallax.php" );


// widgets
include( "library/twitter-aggregator/widget.php" );


// interstitial
include( "library/interstitial.php" );



// [anchor] shortcode
function p_anchor( $atts, $content = null, $code = "" ) {
    return '<a name="'.$content.'"></a>';
}
add_shortcode('anchor' , 'p_anchor' );


// enable oembed and shortcodes in text widgets
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );



// pagination
function pagination($prev = '&laquo;', $next = '&raquo;') {
    global $wp_query, $wp_rewrite;

    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
	);

    if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    echo paginate_links( $pagination );
}


function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


function remove_user_menu(){
	remove_menu_page( 'users.php' );
}
add_action( 'admin_menu', 'remove_user_menu' );


?>