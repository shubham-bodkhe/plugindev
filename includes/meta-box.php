<?php




function add_location_metabox() {
	add_meta_box( 'news_meta_box', 'News Location', 'render_news_location', 'news', 'normal', 'low' );
}
function render_news_location( $post ) {
	$location = get_news_location( $post->ID );

	?>
<div class='name'>

	<p> <label class="screen-reader" for='location'>Location</label>
		<input id='location' name='news_location' type="text"
			value="<?php echo esc_attr( get_post_meta( $post->ID, '_news_location', true ) ); ?>">
	</p>
	<p> <label for='location_lat'>Location Latitude</label>
		<input id='location_lat' name='news_location_lat' type="text" value="<?php echo esc_attr( $location->lat ); ?>">
	</p>
	<p> <label for='lon'>Location Longitude</label>
		<input id='location_lon' name='news_location_lon' type="text" value="<?php echo esc_attr( $location->lon ); ?>">
	</p>
</div>

	<?php
}


function save_meta_location( $post_id ) {
	if ( isset( $_POST['news_location'] ) ) {
		update_post_meta( $post_id, '_news_location', sanitize_text_field( $_POST['news_location'] ) );
	}
	if ( isset( $_POST['news_location_lat'] ) && ( isset( $_POST['news_location_lon'] ) ) ) {
		save_news_location( $post_id, floatval( $_POST['news_location_lat'] ), floatval( $_POST['news_location_lon'] ) );
	}
}
 add_action( 'save_post_news', 'save_meta_location' );

 add_action( 'add_meta_boxes_news', 'add_location_metabox' );
















?>
