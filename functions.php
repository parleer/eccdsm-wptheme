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


// Disable WordPress built-in comments gobally, but allow for Disqus comments.
function block_wp_comments() { 
  wp_die( __('Sorry, comments are closed for this item.') ); 
}
add_action('pre_comment_on_post', 'block_wp_comments'); 
add_action('comment_on_trash', 'block_wp_comments'); 
add_action('comment_on_draft', 'block_wp_comments'); 
add_action('comment_on_password_protected', 'block_wp_comments'); 
