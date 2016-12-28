jQuery(document).ready(function($) {
	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();

	// Menu Mobile
	$( '#nav-icon' ).click(function() {
		$( 'body, html' ).addClass( 'no-scroll' );
		$( '#header-mobile' ).addClass( 'show-header' );

	});

	$( '#nav-icon-close' ).click(function() {
		$( 'body, html' ).removeClass( 'no-scroll' );
		$( '#header-mobile' ).removeClass( 'show-header' );
	});

});
