<?php

class Admin_Setting {

	function __construct() {

		add_action( 'admin_menu', array( $this, 'register_setting_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_styles' ) );

	}



	function add_styles( $hook ) {
		if ( 'news_page_news-setting' != $hook ) {
			return;
		}
		wp_enqueue_style( 'setting_style', plugins_url( 'includes/css/admin_setting.css', Plugin_file ), array() );
		wp_enqueue_script( 'setting_js', plugins_url( 'includes/js/setting.js', Plugin_file ), array() );

	}
	function register_setting_menu() {
		add_submenu_page( 'edit.php?post_type=news', 'News Setting', 'Setting', 'manage_options', 'news-setting', array( $this, 'render_setting_page' ) );
	}

	function render_setting_page() {
		if ( isset( $_POST['news_setting_nonce'] ) ) {
			$this->save_setting();
		}
		include dirname( __FILE__ ) . '/templates/settings.php';
	}
	function validate_setting() {
		if ( ! isset( $_POST['related_mail'] ) || ! is_email( $_POST['related_mail'] ) ) {
			$this->show_error_message( 'Related Email Invalid' );
			return false;
		}
		return true;
	}

	function save_setting() {
		if ( ! wp_verify_nonce( $_POST['news_setting_nonce'], 'news_settings_save' ) ) {
			wp_die( 'Security token invalid' );

		}
		if ( isset( $_POST['news_related_title'] ) ) {
			update_option( 'news_related_title', sanitize_text_field( $_POST['news_related_title'] ) );
		}

		if ( isset( $_POST['show_related'] ) ) {
			update_option( 'show_related_news', true );
		} else {
			update_option( 'show_related_news', false );
		}

		if ( isset( $_POST['related_number_post'] ) && ( intval( $_POST['related_number_post'] ) > 0 && intval( $_POST['related_number_post'] ) <= 10 ) ) {
			update_option( 'related_number', intval( $_POST['related_number_post'] ) );
		}
		if ( isset( $_POST['related_mail'] ) && is_email( $_POST['related_mail'] ) ) {
			update_option( 'show_related_mail', sanitize_email( $_POST['related_mail'] ) );
		}

		if ( ! $this->validate_setting() ) {
			return;
		}

		$this->show_success_message();

	}
	function show_success_message() {
		?>
<div class='notice notice-success'>
	Setting Saved.
</div>
		<?php

	}
	function show_error_message( $message ) {
		?>
<div class='notice notice-error'>
		<?php echo esc_html( $message ); ?>
</div><?php

	}

}

$admin_menu = new Admin_Setting();


?>
