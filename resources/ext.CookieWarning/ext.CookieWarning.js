( function ( mw, $, d ) {

	$( d ).ready( function() {
		$('.mw-cookiewarning-container').toggle( 800 );
	});
	/**
	 * Sets the cookie, that the cookiewarning is dismissed. Called,
	 * when the api query to save this information in the user preferences,
	 * failed for any reason.
	 */
	function setCookie() {
		$.cookie( wgCookiePrefix + 'cookiewarning_dismissed', 1 );
	}

	// Click handler for the "Ok" element in the cookiewarning information bar
	$( '.mw-cookiewarning-dismiss' ).on( 'click', function ( ev ) {
		// an anonymous user doesn't have preferences, so don't try to save this in
		// the user preferences.
		if ( !mw.user.isAnon() ) {
			$.ajax({
				dataType: "json",
				type: 'post',
				url: mw.util.wikiScript( 'api' ),
				data: {
					action: 'options',
					format: 'json',
					change: 'cookiewarning_dismissed=1',
					token: mw.user.tokens.get( 'editToken', '' )
				},
				success: function( oData, oTextStatus ) {
					console.log(oData);
					mw.log.warn( 'Failed to save dismissed CookieWarning' );
					setCookie();
				}
			});
		} else {
			// use cookies for anonymous users
			setCookie();
		}
		// always remove the cookiewarning element
		$( '.mw-cookiewarning-container' ).detach();

		ev.preventDefault();
	} );
} )( mediaWiki, jQuery, document );
