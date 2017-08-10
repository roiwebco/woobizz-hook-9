<?php
/*
Plugin Name: Woobizz Hook 9
Plugin URI: http://woobizz.com
Description: Add widget content on archive description
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook9
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook9_load_textdomain' );
function woobizzhook9_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook9', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	add_action( 'widgets_init', 'woobizzhook9_widget',109);
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook9_admin_notice' );
}
//Add Hook 9
function woobizzhook9_widget() {
	$args = array(
				'id'            => 'woobizzhook9_id',
				'name'          => __( 'Woobizz Hook 9', 'woobizzhook9' ),
				'description'   => __( 'Add widget content after any dynamic archive title','woobizzhook9' ),
				'before_title'  => '<h2 class="widgettitle">',
				'before_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'before_widget'  => '</li>',
	);
	register_sidebar( $args );
	add_action( 'woocommerce_archive_description', 'woobizzhook9_display',100);
	function woobizzhook9_display(){
		?>
		<div class="woobizzhook-widget-div">
			<div class="woobizzhook-widget-content">
				<?php dynamic_sidebar( 'Woobizz Hook 9' ); ?>
			</div>
		</div>
		<?php
	}
}
//Hook9 Notice
function woobizzhook9_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 9 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook9' ); ?></p>
    </div>
    <?php
}