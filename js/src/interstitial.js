

// matchMedia polyfill
window.matchMedia || (window.matchMedia = function() {
    "use strict";

    // For browsers that support matchMedium api such as IE 9 and webkit
    var styleMedia = (window.styleMedia || window.media);

    // For those that don't support matchMedium
    if (!styleMedia) {
        var style       = document.createElement('style'),
            script      = document.getElementsByTagName('script')[0],
            info        = null;

        style.type  = 'text/css';
        style.id    = 'matchmediajs-test';

        script.parentNode.insertBefore(style, script);

        // 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
        info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

        styleMedia = {
            matchMedium: function(media) {
                var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

                // 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
                if (style.styleSheet) {
                    style.styleSheet.cssText = text;
                } else {
                    style.textContent = text;
                }

                // Test if media query is true or false
                return info.width === '1px';
            }
        };
    }

    return function(media) {
        return {
            matches: styleMedia.matchMedium(media || 'all'),
            media: media || 'all'
        };
    };
}());


function is_image( filename ) {
	return (/\.(gif|jpg|jpeg|tiff|png)$/i).test( filename );
}


// do the interstitial.
jQuery(document).ready(function($){

	var interstitial = $( 'interstitial' );

	// if the interstitial exists and the size of the screen is right.
	if ( interstitial.length && matchMedia('only screen and (min-width: 768px)').matches ) {

		// store the interstitial content, delay, and href
		var interstitial_content = interstitial.attr('content');
		var interstitial_delay = interstitial.attr('delay');
		var interstitial_href = interstitial.attr('href');
		var interstitial_cookie_key = interstitial.attr('content');

		// if interstitial has content, show it.
		if ( interstitial_content.length > 0 && !$.cookie(interstitial_cookie_key) ) {

			// do ze interstitial popup
			$.magnificPopup.open({
				key: 'interstitial',
				items: {
					src: interstitial_content
				},
				type: ( is_image( interstitial_content ) ? 'image' : 'iframe' ),
				callbacks: {
					// callback that gets called when the popup is loaded.
					imageLoadComplete: function() {
						var mfp_interstitial = $.magnificPopup.instance
						
						// delay and hide interstitial after delay (if not 0)
						if ( interstitial_delay != 0 ) {
							setTimeout( function(){
								mfp_interstitial.close();
							}, ( parseInt( interstitial_delay ) * 1000 ));
						}

						// navigate when they click the content of the magnific popup.
						mfp_interstitial.content.click(function(){
							if ( interstitial_href.length != 0 ) {
								location.href = interstitial_href;
							}
						});
					},
				}
			}, 0 );

			$.cookie(interstitial_cookie_key, 1, {
				expires : 1           //expires in 10 days
			});

		}
	}

});
