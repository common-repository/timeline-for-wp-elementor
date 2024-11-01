<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WPTE_URL', plugins_url( '/', __FILE__ ) );
define( 'WPTE_PATH', plugin_dir_path(__FILE__));

add_action( 'elementor/preview/enqueue_styles', 'wpte_elementor_enqueue_style' );
add_action('wp_enqueue_scripts', 'wpte_elementor_enqueue_style');

function wpte_elementor_enqueue_style() {
    wp_enqueue_style( 'wpte-preview', WPTE_URL  . 'assets/css/style.css', array());
}

class WPTE_PLUGIN {
   private static $instance = null;
   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }
 
   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
	  add_action( 'elementor/elements/categories_registered', array( $this,'wpte_widget_categories') );
   }
 
   public function widgets_registered() { 
      // We check if the Elementor plugin has been installed / activated.
      if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
		   require_once WPTE_PATH .'/includes/helper/widgets_inc.php';
      }
   }
   public function wpte_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'wpte',
			[
				'title' => __( 'WP Timeline for Elementor', 'wpte' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
	
}
 
WPTE_PLUGIN::get_instance()->init();
//Admin Notice Inc
require_once WPTE_PATH .'/includes/aep-notice/admin-notice.php';