(function ($) {
	
	$(document).ready( function() {
		// fitvids
		$( '.entry-content' ).fitVids(  
			{ customSelector: "iframe[src^='www.slideshare.net']" }
		);
		
		// primary navigation toggle
		$( '#header-nav .toggle' ).click( function( e ) {
			$( this ).find( 'i.fa' ).toggleClass( 'fa-bars' ).toggleClass( 'fa-times' );
			$( '#header-nav .menu' ).slideToggle();
			e.preventDefault();
		} );
		
		// window resize
		$( window ).resize( function() {
			if( $( window ).width() >= 960 ) {
				$( '#header-nav .menu' ).show();
				$( '#header-nav .toggle' ).hide();
			}
			else {
				if( ! $( '#header-nav .menu' ) .is( ':visible' ) ) {
					$( '#header-nav .menu' ).hide();
					$( '#header-nav .toggle' ).show();
				}
			}
		} );
		
		// match heights
		$( '.gallery-item, .row [class*="col-"]' ).matchHeight();
		
		// scroll to
		
		// scrollto
		$( 'a[href^="#"]' ).click( function( e ) {
			e.preventDefault();
			$( window ).stop( true ).scrollTo( this.hash, { duration:1000, interrupt:true } );
		} );
	} );
	
}(jQuery));