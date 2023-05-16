<?php
/** 
 * Short Code.
*/

/**
 * Short Code Function.
 */
function my_short_code( $atts, $content ) {

	$atts = shortcode_atts(
		array(
			'title' => '',
			'color' => 'red',
		),
		$atts
	);

	ob_start();
	?>

<div class="test">
    <h2><span style="color:<?php echo $atts['color']; ?>" ;> <?php echo $content; ?></h2></span>
</div>
<?php

	return ob_get_clean();
	// return 'test';
}

add_shortcode( 'my-test-code', 'my_short_code' );
?>