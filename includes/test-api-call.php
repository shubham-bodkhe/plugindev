<?php
/**
 * The Test Api.
 *
 * @package category
 */

 /**
  * The fetch function.
  */
function test_api_call() {
	$data = wp_remote_get( 'https://jsonplaceholder.typicode.com/posts' );
	if ( is_array( $data ) ) {
		$posts = json_decode( $data['body'] );
		foreach ( $posts as $post ) {
			?>
<h2><?php echo esc_html( $post->title ); ?></h2>
<p><?php echo esc_html( $post->body ); ?></p>
			<?php
		}
	}
}

add_filter( 'the_content', 'test_api_call' );




?>
