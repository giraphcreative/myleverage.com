

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	if ( $( '.thumb-showcase' ) ) {

		// store the thumbs container and its list div.
		var thumbs = $( '.thumb-showcase' );
		var thumb_list = thumbs.find( '.thumb-list' );

		// we start on page one
		var page = 1;
		
		if ( thumb_list.length && thumb_list.find( '.thumb' ).length ) {

			// store product nav buttons
			var thumb_nav = thumbs.find( 'button.thumb-nav' );
			var thumb_nav_next = thumbs.find( 'button.thumb-nav.next' );
			var thumb_nav_previous = thumbs.find( 'button.thumb-nav.previous' );

			// count total thumbs
			var total_thumbs = thumb_list.find( '.thumb' ).length;

			var set_buttons = function() {

				// get the width of the product list
				var thumb_list_width = thumb_list.width();

				// grab a product and get it's width, including padding and margin.
				var a_thumb = thumbs.find('.thumb');
				var thumb_width = a_thumb.width() + 
					( parseFloat( a_thumb.css('margin-right').replace('px','') ) * 2 ) + 
					( parseFloat( a_thumb.css('padding-right').replace('px','') ) * 2 );
				
				// count thumbs per page
				var thumbs_per_page = Math.round( thumb_list_width / thumb_width );

				// count total pages
				var total_pages = Math.ceil( total_thumbs / thumbs_per_page );

				// if not page one, enable the previous button
				if ( page > 1 ) {
					thumb_nav_previous.prop( "disabled", false );
				}

				// if on last page, disable next button
				if ( page == total_pages ) {
					thumb_nav_next.prop( "disabled", true );
				}

				// if we're at the beginning, disable the previous button
				if ( page == 1 ) {
					thumb_nav_previous.prop( "disabled", true );
				}

				// if we aren't at the end, enable the next button
				if ( page < total_pages ) {
					thumb_nav_next.prop( "disabled", false );
				}

				// in the case that the number of thumbs only calls for one page,
				// deem the product nav buttons unnecessary.
				if ( page == 1 && page == total_pages ) {
					thumb_nav.addClass( 'unnecessary' );
					thumb_list.addClass( 'no-nav' );
				}
			};

			// set buttons based on status
			set_buttons();

			// handle product-nav clicks
			thumb_nav.click(function(){

				// parse the next/previous class from the button
				var nav_class = $( this ).attr( 'class' ).replace( 'thumb-nav ', '' );

				// get the width of the product list
				var thumb_list_width = thumb_list.width();

				// grab a product and get it's width, including padding and margin.
				var a_thumb = thumbs.find('.thumb');
				var thumb_width = a_thumb.width() + ( parseFloat( a_thumb.css('margin-right').replace('px','') ) * 2 ) + ( parseFloat( a_thumb.css('padding-right').replace('px','') ) * 2 );
				
				// count thumbs per page
				var thumbs_per_page = Math.round( thumb_list_width / thumb_width );

				// count total pages
				var total_pages = Math.ceil( total_thumbs / thumbs_per_page );


				// NEXT clicked
				if ( nav_class == 'next' ) {

					// subtract from the text indentation
					thumb_list.css( 'text-indent', parseInt( thumb_list.css( 'text-indent' ) ) - thumb_list_width );

					// increase page
					page = page + 1;

					// set buttons based on status
					set_buttons();

				}

				// PREVIOUS clicked
				if ( nav_class == 'previous' ) {

					// set the text indentation to slide to the 'right'
					thumb_list.css( 'text-indent', parseInt( thumb_list.css( 'text-indent' ) ) + thumb_list_width );
					
					// decrease page
					page = page - 1;

					// set buttons based on status
					set_buttons();

					// in case we changed screen sizes.
					if ( parseInt( thumb_list.css( 'text-indent' ) ) > 0 ) {
						thumb_list.css( 'text-indent', 0 );
					}

				}
			});
			

			// reset product slider when window is resized.
			$( window ).resize(function(){
				thumb_list.css( 'text-indent', 0 );
				page = 1;
				set_buttons();
			});

		}

	}

});

