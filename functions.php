<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

if (function_exists('register_sidebar'))
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));

add_theme_support('post-thumbnails');
set_post_thumbnail_size(619, 268);
add_image_size('right-thumb', 311, 268);


// We want to prevent WordPress comments, but keep Disqus comments. Discqus will 
// obey the 'post_status' setting for each post.

// Prevent WordPress comments via Form
function fh_block_wp_comments() { 
	wp_die( __('Sorry, comments are closed for this item.') ); 
}
add_action('pre_comment_on_post', 'fh_block_wp_comments'); 

// Close comments and pings on the front-end
function fh_disable_comments_status( $open, $post_id ) {
	//die('fh_disable_comments_status');
	return false;
}

function fh_setup_filters() {
	/*
	$types = get_post_types( $typeargs, 'objects' );
	foreach( array_keys( $types ) as $type ) {
		if( post_type_supports( $type, 'comments' ) ) {
			remove_post_type_support( $type, 'comments' );
			remove_post_type_support( $type, 'trackbacks' );
		}
	}
	if (!is_admin()) {
		add_action( 'template_redirect', 'fh_check_comment_template' );
	}
	*/
	//add_filter('comments_open', 'fh_disable_comments_status', 20, 2);
	add_filter('pings_open', 'fh_disable_comments_status', 20, 2);

}
add_action( 'wp_loaded', 'fh_setup_filters' );
/*
function fh_check_comment_template() {
	//die('fh_check_comment_template');
	if( is_singular() ) {
		// Kill the comments template. This will deal with themes that don't check comment state properly!
		add_filter( 'comments_template', 'fh_dummy_comments_template', 20 );
		// Remove comment-reply script for themes that include it indiscriminately
		wp_deregister_script( 'comment-reply' );
		// feed_links_extra inserts a comments RSS link
		remove_action( 'wp_head', 'feed_links_extra', 3 );
	}
}
function fh_dummy_comments_template() {
	//die('fh_dummy_comments_template');
	return dirname( __FILE__ ) . '/comments-template.php';
}
*/


/*
// Disable pingback XMLRPC
function sar_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
add_filter( 'xmlrpc_methods', 'sar_block_xmlrpc_attacks' );
function sar_remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}
add_filter( 'wp_headers', 'sar_remove_x_pingback_header' );
*/

