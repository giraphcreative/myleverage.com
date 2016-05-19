




// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	// select some things we'll use to make things responsive
	var menu = $( 'header nav' ),
		menu_toggle = menu.find( 'button.menu-toggle' ),
		menu_ul = menu.find( '.nav-menu' ),
		fluid_images = $( '.content-area img, .site-content img' ),
		sidebar = $( '.sidebar' ),
		large_title = $( '.large-title' ),
		left_menu = $( '.sidebar .menu' ),
		twitter_widget = $( '.widget_multi_twitter' );


	// remove height and width from images inside
	fluid_images.removeAttr( 'width' ).removeAttr( 'height' );


	// show/hide menus when they click the toggler
	menu_toggle.click(function(){

		if ( menu_ul.is( ':visible' ) ) {
			menu_ul.hide();
		} else {
			menu_ul.show();
		}

		// when user clicks a link, open submenu if it exists.
		menu_ul.find( 'a' ).click(function(){
			var parent_li = $( this ).parent( 'li' );
			var submenu = $( this ).next( 'ul' );
			if ( !submenu.is( ':visible' ) && parent_li.hasClass( 'menu-item-has-children' ) ) {
				event.preventDefault();
				parent_li.addClass( 'open' );
				submenu.show();
			}
		});

	});


	// left menu toggling.
	left_menu.find( 'li.menu-item-has-children > a' ).click(function( event ){
		var menu_item = $( this ).parent( 'li' );
		event.preventDefault();
		if ( !menu_item.hasClass( 'open' ) ) {
			event.preventDefault();
			menu_item.addClass( 'open' );
		} else {
			location.href = $( this ).attr( 'href' );
		}
	});


	// accordion
	$( '.accordion-box-title' ).click(function(){
		$( this ).parent( '.accordion-box' ).children( '.accordion-box-content' ).slideToggle( 600 );
		$( this ).toggleClass( 'open' );
	});


	// fluid width videos that maintain aspect ratio
	$( '.content' ).fitVids();
	

	// sidebar title background colors.
	if ( sidebar && large_title ) {
		sidebar.find( '.widget:not(.leverage) .widget-title' ).css( 'background-color', large_title.css( 'background-color' ) );
	}


	// search and replace leverage so it's italicized.
	$(".content label, .tribe-events-event-categories, .breadcrumbs, .search-results article, .third.news").each(function(){
		$(this).html( $(this).html().replace(/LEVERAGE/g,'<em>LEVERAGE</em>') );
	});


	// remove annoying non-breaking spaces from twitter widget
	if ( twitter_widget ) {
		twitter_widget.find('.tweet-time').each(function(){
			$(this).html( $(this).html().replace("&nbsp;-&nbsp;",'') );
		});
	}


	// button links (using the data-url attribute)
	$( 'button[data-url]' ).click(function(){
		window.location.href = $( this ).attr( 'data-url' );
	});
	
	
	// creep on links
	$(".wrap a").creep();


	// resize linqto iframe
	var resize_iframe = function(){
		if ( matchMedia('only screen and ( min-width: 1152px )').matches ) {
			$('iframe.auto-height').height( '1950px' );
		} else if ( matchMedia('only screen and ( min-width: 892px )').matches ) {
			$('iframe.auto-height').height( '2430px' );
		} else if ( matchMedia('only screen and ( min-width: 823px )').matches ) {
			$('iframe.auto-height').height( '3630px' );
		} else if ( matchMedia('only screen and ( min-width: 768px )').matches ) {
			$('iframe.auto-height').height( '2930px' );
		} else if ( matchMedia('only screen and ( min-width: 655px )').matches ) {
			$('iframe.auto-height').height( '2430px' );
		} else if ( matchMedia('only screen and ( min-width: 600px )').matches ) {
			$('iframe.auto-height').height( '3630px' );
		} else if ( matchMedia('only screen and ( max-width: 599px )').matches ) {
			$('iframe.auto-height').height( '2930px' );
		} else {
			$('iframe.auto-height').height( '2350px' );
		}
	}


	// resize linqto iframe
	resize_iframe();
	$(window).resize( resize_iframe );

});

