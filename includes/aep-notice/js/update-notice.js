jQuery( document ).ready( function() {

	jQuery( document ).on( 'click', 'a', function(event) {
        if( jQuery(event.target).hasClass('wpte-never-show')) {
            var data = {
                action: 'wpte_never_show',
            };
        }
		
		jQuery.post( wpte_notice_params.ajaxurl, data, function() {
            if(data){
                jQuery('.aep-notice').fadeOut();
            }
		});
    });

});