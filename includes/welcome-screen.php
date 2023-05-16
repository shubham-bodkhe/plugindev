<?php
/**
 * Welcome Screen.
 *
 * Welcome code description.
 *
 * @package category
 */

/**
 * Function fro register Welcome Screen.
 * */
function welcome_screen() {
	add_dashboard_page( 'Welcome', 'Welcome', 'read', 'plugin-welcome', 'display_welcome_page' );

}
add_action( 'admin_menu', 'welcome_screen' );

/** Display WelCome Screen.*/
function display_welcome_page() {
	include dirname( __FILE__ ) . '/templates/welcom-page.php';

}
/** Removed the menu post-type.*/
function remove_welcome_page() {
	remove_submenu_page( 'index.php', 'plugin-welcome' );
}

/**
 * $plugin HelloWorld
 */
add_action( 'admin_head', 'remove_welcome_page' );

/**
 * $plugin HelloWorld
 * Redirect to Welcome page.
 */
function welcome_page_redirect( $plugin ) {
	if ( 'HelloWorld/HelloWorld.php' === $plugin ) {
		wp( wp_safe_redirect( admin_url( 'index.php?page=plugin-welcome' ) ) );
		die();
	}
}

add_action( 'activated_plugin', 'welcome_page_redirect' );
