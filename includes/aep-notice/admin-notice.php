<?php

if( get_option( 'wpte_notice' ) != 'wpte_never_show' ) {
    add_action( 'admin_notices', 'wpte_notice_options' );
}

function wpte_notice_options() {
      ?>

      <div class='notice aep-notice'>
        <div class="aep-notice-logo">
            <img src="<?php echo plugins_url( '/', __FILE__ ) .'/img/aep-inf-img.jpg'?>" style="width:160px">
        </div>
        <div class="aep-notice-content">
            <h3>Timeline for WP Elementor</h3>
            <p>Thank you for using <strong>Timeline for WP Elementor</strong>. If you love this plugin please make a small donation Or give us a five-star review of our motivation.</p>
			<p class="aep-links"><a href="https://paypal.me/HHaq?locale.x=en_US" class="donate"> <i class="icon-donation"></i> Donate</a>  | 
            <a href="https://wordpress.org/support/plugin/timeline-for-wp-elementor/reviews/?filter=5" class="review">
            <i class="icon-star-empty"></i> 
            Leave a Review</a> | 
            <a href="javascript:void(0)" class="wpte-never-show"><i class="icon-cancel-circle"></i> Never Show</a>
            </p>
        </div>
      </div>
<?php
}

add_action( 'admin_enqueue_scripts', 'wpte_add_script' );
function wpte_add_script() {
	wp_register_script( 'wpte-notice-update',  plugins_url( '/', __FILE__ ) . '/js/update-notice.js','','1.0', false );
	wp_enqueue_style( 'wpte-notice-update-css',  plugins_url( '/', __FILE__ ) . '/css/aep-notice.css',array());
	
	wp_localize_script( 'wpte-notice-update', 'wpte_notice_params', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	));
	
	wp_enqueue_script(  'wpte-notice-update' );
}
add_action( 'wp_ajax_wpte_never_show', 'wpte_never_show' );

function wpte_never_show() {
    update_option( 'wpte_notice', 'wpte_never_show' );
}

