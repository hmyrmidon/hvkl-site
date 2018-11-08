( function( $ ) {

	$( document ).ready(function( $ ) {

		// Search icon.
		if( $( '.search-icon' ).length > 0 ) {
			$( '.search-icon' ).on('click', function( e ) {
				e.preventDefault();
				$( '.search-box-wrap' ).slideToggle();
			});
		}

		// Mobile menu.
		$( '#mobile-trigger' ).sidr({
			timing: 'ease-in-out',
			speed: 500,
			source: '#mob-menu',
			name: 'sidr-main'
		});

		$( '#mobile-trigger-quick' ).sidr({
			timing: 'ease-in-out',
			side: 'right',
			speed: 500,
			source: '#mob-menu-quick',
			name: 'sidr-quick'
		});

		// Implement go to top.
		var $scrollup_object = $( '#btn-scrollup' );
		if ( $scrollup_object.length > 0 ) {
			$( window ).scroll( function() {
				if ( $( this ).scrollTop() > 100 ) {
					$scrollup_object.fadeIn();
				} else {
					$scrollup_object.fadeOut();
				}
			});

			$scrollup_object.on('click', function() {
				$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
				return false;
			});
		}

	});

} )( jQuery );
