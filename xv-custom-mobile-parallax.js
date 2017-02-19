

xvCustomMobileParallax = function( data ) {

	if ((navigator.userAgent.match(/(Android)/)) || (navigator.userAgent.match(/(iPod|iPhone|iPad)/))) {
		
		for ( key in data ) {
			$sel = '#shapely_home_parallax-' + key + ' div';
			$parent = jQuery($sel);
			
			if ( $parent.length ) {
			
				// select the element
				$el = $parent[0];
				
				// remove all parallax metadata
				jQuery($el).data('px.parallax', false);
				
				for ( change in data[key] ) {
					
					jQuery($el).data( change, data[key][change] );
					
				}
			}
		}
		
		jQuery('[data-parallax="scroll"]').parallax();
	}
}

jQuery(document).ready(function() {
	xvCustomMobileParallax( JSON.parse( xv_parallax.data ) );
});
