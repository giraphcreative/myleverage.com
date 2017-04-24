

var hash = function( str ) {

	var hash = 0, i, chr;

	if ( str.length === 0 ) return hash;

	for ( i = 0; i < str.length; i++ ) {
		chr   = str.charCodeAt(i);
		hash  = ((hash << 5) - hash) + chr;
		hash |= 0; // Convert to 32bit integer
	}

	if ( hash < 0 ) hash = hash * -1;

	return hash;
};


// do the notification.
jQuery(document).ready(function($){

	var notification = $( '.notification-bar' );

	// if the notification exists and the size of the screen is right.
	if ( notification.length ) {

		// store the notification content, delay, and href
		var notification_cookie_key = 'notification-' + hash( notification.find('.notification-content').text() );

		var notification_cookie = typeof( $.cookie( notification_cookie_key ) ) != 'undefined' ? $.cookie( notification_cookie_key ) : false;

		// if notification has content, show it.
		if ( !notification_cookie ) {

			notification.slideDown( 300 );

			notification.find('.close').click(function(){
				notification.slideUp( 300 );

				$.cookie( notification_cookie_key, 1, {
					expires : 1 //expires in 1 day
				});
			});

		}

	}

});

