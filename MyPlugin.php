<?php

/**
 * Plugin Name: MyPlugin
 * Description: This is my first Custom plugin
 * Version:1.0
 * Author: Shubham
 * Author URI: www.shubham-bodkhe.com
 */



 function myplugin_tst_shortcode( $atts, $content='' ){
    global $post;
    $atts = shortcode_atts( array(
        'color' => '#0a0a0a',
    ) , $atts); 
    ob_start();
    ?>
<div class="test">
    <h2><?php echo $content; ?>(<?php echo $post->ID; ?>)</h2>
    <span style="color:<?php echo $atts['color'] ?>">testing</span>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('my-test-code' , 'myplugin_tst_shortcode');


function content_filter($content){

if(is_page('about')){
$content = str_ireplace('Lorem Ipsum','Shubham Bodkhe',$content);
$content = $content ."<h1>At the Bottom</h1>";

return $content;



}}

add_filter('the_content','content_filter');

















?>