<?php

// working on individual post

// function add_content_at_bottom($content){
// if(is_page('About')){

// $content = str_replace('Lorem','Shubham',$content);
// return $content . "<h2> At the Bottom</h2>";
// }
// }

// add_filter('the_content','add_content_at_bottom');


// function add_advertistment($posts){


// $ad_post = get_post(67);
// array_splice($posts,1,0,array($ad_post));
// return $posts;
// }

// add_filter('the_posts','add_advertistment');



// custom post type
function custom_post() {
	$args = array(
		'public'      => true,
		'label'       => 'News',
		'has_archive' => true,
		'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
	);

	register_post_type( 'News', $args );
	register_taxonomy(
		'news_category',
		'news',
		array(
			'label'        => 'News category',
			'hierarchical' => true,

		)
	);
}
add_action( 'init', 'custom_post' );


function activates() {
	custom_post();
	flush_rewrite_rules();

}

	register_activation_hook( 'Plugin_file', 'activates' );
