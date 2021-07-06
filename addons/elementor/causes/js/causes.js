(function($) {
"use strict";

	jQuery(document).ready(function() {

		//START masonry
		jQuery(function ($) {

			var $nd_donations_masonry_content = $(".nd_donations_masonry_content").imagesLoaded( function() {
				$nd_donations_masonry_content.masonry({ itemSelector: ".nd_donations_masonry_item" });
			});

		});
		//END masonry
		
	});


})(jQuery);