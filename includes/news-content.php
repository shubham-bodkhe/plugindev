<?php
// Display the Location
function add_meta_location( $content ) {
	if ( is_singular( 'news' ) ) {

		$location = get_news_location( get_the_ID() );
		$content  = '<p class="location">' . esc_html( get_post_meta( get_the_ID(), '_news_location', true ) ) . '</p>' . $content;

		$value   = isset( $location ) ? $location->lat : '';
		$value2  = isset( $location ) ? $location->lon : '';
		$content = '<p class="lat-lon">' . esc_html( $value ) . ',' . esc_html( $value2 ) . '</p>' . $content;
	}
	return $content;
}
 add_filter( 'the_content', 'add_meta_location' );

// Display Related News Title
function add_end_of_the_content( $content ) {
	global $post;
	if ( is_singular( 'news' ) ) {
		$args = array(
			'numberposts'  => intval( get_option( 'related_number', 3 ) ),
			'post_type'    => 'news',
			'post__not_in' => array( get_the_ID() ),
			'meta_key'     => '_news_location',
			'meta_value'   => get_post_meta( get_the_ID(), '_news_location', true ),

		);

		$wp_query = new  WP_Query( $args );
		if ( $wp_query->have_posts() ) {
			ob_start();
			?>
<h3><?php echo get_option( 'news_related_title', 'Realted News' ); ?></h3>
<ul>
			<?php
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();
				?>
	<li class='latest_post'> <a href="<?php echo get_the_permalink(); ?>"> <?php echo the_title(); ?></a></li>
				<?php
				endwhile
			?>
</ul>
			<?php
			$content .= ob_get_clean();
			wp_reset_postdata();
		}
	}
	return $content;
}

add_filter( 'the_content', 'add_end_of_the_content' );?>
