<?php

/**
 * Plugin Name: Hello World
 * Description: This is my First Plugin
 * Author: Shubham
 * Version: 1.0
 * Text Domain: hello-world
 */


define( 'Plugin_file', __FILE__ );
define( 'version', '1.0' );
// define("Plugin_Version",1.0);
 require_once dirname( __FILE__ ) . '/includes/meta-box.php';
 require_once dirname( __FILE__ ) . '/includes/custom-post.php';
 require_once dirname( __FILE__ ) . '/includes/short-code.php';
 require_once dirname( __FILE__ ) . '/includes/admin-setting.php';
 require_once dirname( __FILE__ ) . '/includes/news-content.php';
 require_once dirname( __FILE__ ) . '/includes/news-location.php';
// require_once dirname(__FILE__).'/includes/test_api_call.php';
 require_once dirname( __FILE__ ) . '/includes/welcome-screen.php';
 require_once dirname( __FILE__ ) . '/includes/wp-requirements.php';
 require_once dirname( __FILE__ ) . '/includes/wp-requirements.php';


$plugin_checks = new Plugin_Requirements(
	'Hello World',
	__FILE__,
	array(
		'PHP'       => '5.3.3',
		'WordPress' => '4.1',
	)
);
if ( false === $plugin_checks->pass() ) {
	$plugin_checks->halt();
	return;
}
 // Styling FrontEnd

function frontend_style() {
	 wp_enqueue_style( 'frontend_style', plugins_url( 'includes/css/frontend.css', Plugin_file ) );
}
 add_action( 'wp_enqueue_scripts', 'frontend_style' );


 // Insert the post in PLugin


function add_content_on_activation() {
	// if(get_option('page_id',false)){
	// return;
	// }
	$post_id = wp_insert_post(
		array(
			'post_title'   => __( 'Hello World Confirmtion', 'hello-world' ),
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '[my-test-code]',
		)
	);
	update_option( 'page_id', $post_id );
}

 register_activation_hook( Plugin_file, 'add_content_on_activation' );