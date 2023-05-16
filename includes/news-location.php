<?php
function location_table_name() {
	global $wpdb;
	return  $table_name = $wpdb->prefix . 'news_location';
}
function create_news_location_table() {
	global $wpdb;

	$table_name = location_table_name();
	$charset    = $wpdb->get_charset_collate();
	$sql        = "CREATE TABLE $table_name(
        post_id int(11) NOT NULL,
        lat decimal(9,6) NOT NULL,
        lon decimal(9,6)NOT NULL,
        PRIMARY KEY  (post_id)
        ) $charset;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( Plugin_file, 'create_news_location_table' );

function get_news_location( $post_id ) {
	global $wpdb;

	$table_name    = location_table_name();
	$news_location = get_transient( 'news_location' . $post_id );
	if ( $news_location ) {
		return $news_location;
	}
	$news_location = $wpdb->get_row( "SELECT * FROM $table_name WHERE post_id = " . intval( $post_id ) );
	set_transient( 'news_loaction' . $post_id, $news_location );

	return $news_location;

}


function save_news_location( $post_id, $lat, $lon ) {
	global $wpdb;
	if ( get_news_location( $post_id ) ) {
		// update
		$wpdb->update(
			location_table_name(),
			array(

				'lat' => $lat,
				'lon' => $lon,
			),
			array( 'post_id' => $post_id ),
			array( '%f', '%f' ),
			array( '%d' )
		);
	} else {
		// insert
		$wpdb->insert(
			location_table_name(),
			array(
				'post_id' => $post_id,
				'lat'     => $lat,
				'lon'     => $lon,
			),
			array(
				'%d',
				'%f',
				'%f',
			)
		);
	}
	delete_transient( 'news_location', $post_id );

}


