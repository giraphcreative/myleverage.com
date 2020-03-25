


// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	if ( $( '.partner-showcase' ) ) {

		// store the parts container and its list div.
		var parts = $( '.partner-showcase' );
		var part_list = parts.find( '.partner-list' );

		// we start on page one
		var page = 1;
		
		if ( part_list.length && part_list.find( '.partner' ).length ) {

			// store product nav buttons
			var part_nav = parts.find( 'button.partner-nav' );
			var part_nav_next = parts.find( 'button.partner-nav.next' );
			var part_nav_previous = parts.find( 'button.partner-nav.previous' );

			// count total parts
			var total_parts = part_list.find( '.partner' ).length;

			var set_buttons = function() {

				// get the width of the product list
				var part_list_width = part_list.width();

				// grab a product and get it's width, including padding and margin.
				var a_part = parts.find('.partner');
				var part_width = a_part.width();
				
				// count parts per page
				var parts_per_page = Math.round( part_list_width / part_width );

				// count total pages
				var total_pages = Math.ceil( total_parts / parts_per_page );

				// if not page one, enable the previous button
				if ( page > 1 ) {
					part_nav_previous.prop( "disabled", false );
				}

				// if on last page, disable next button
				if ( page == total_pages ) {
					part_nav_next.prop( "disabled", true );
				}

				// if we're at the beginning, disable the previous button
				if ( page == 1 ) {
					part_nav_previous.prop( "disabled", true );
				}

				// if we aren't at the end, enable the next button
				if ( page < total_pages ) {
					part_nav_next.prop( "disabled", false );
				}

				// in the case that the number of parts only calls for one page,
				// deem the product nav buttons unnecessary.
				if ( page == 1 && page == total_pages ) {
					part_nav.addClass( 'unnecessary' );
					part_list.addClass( 'no-nav' );
				}
			};

			// set buttons based on status
			set_buttons();

			// handle product-nav clicks
			part_nav.click(function(){

				// parse the next/previous class from the button
				var nav_class = $( this ).attr( 'class' ).replace( 'partner-nav ', '' );

				// get the width of the product list
				var part_list_width = part_list.width();

				// grab a product and get it's width, including padding and margin.
				var a_part = parts.find('.partner');
				var part_width = a_part.width();
				
				// count parts per page
				var parts_per_page = Math.round( part_list_width / part_width );

				// count total pages
				var total_pages = Math.ceil( total_parts / parts_per_page );


				// NEXT clicked
				if ( nav_class == 'next' ) {

					// subtract from the text indentation
					part_list.css( 'text-indent', parseInt( part_list.css( 'text-indent' ) ) - part_list_width );

					// increase page
					page = page + 1;

					// set buttons based on status
					set_buttons();

				}

				// PREVIOUS clicked
				if ( nav_class == 'previous' ) {

					// set the text indentation to slide to the 'right'
					part_list.css( 'text-indent', parseInt( part_list.css( 'text-indent' ) ) + part_list_width );
					
					// decrease page
					page = page - 1;

					// set buttons based on status
					set_buttons();

					// in case we changed screen sizes.
					if ( parseInt( part_list.css( 'text-indent' ) ) > 0 ) {
						part_list.css( 'text-indent', 0 );
					}

				}
			});
			

			// reset product slider when window is resized.
			$( window ).resize(function(){
				part_list.css( 'text-indent', 0 );
				page = 1;
				set_buttons();
			});

		}

	}

});

