<?php


// register a couple nav menus
register_nav_menus( array(
	'main-menu' => 'Main Menu',
	'footer' => 'Footer',
) );


if ( function_exists('register_sidebar') ) {
 	register_sidebar(array(
		'name'=> 'General Sidebar',
		'id' => 'sidebar-generic',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}


?>