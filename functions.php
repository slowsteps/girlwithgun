<?php

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
  //uncommment next line to hardwire wp admin setting for featured image size
  set_post_thumbnail_size( 100, 75 );
}

add_action('publish_page', 'add_custom_field_automatically');
add_action('publish_post', 'add_custom_field_automatically');
function add_custom_field_automatically($post_ID) {
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        add_post_meta($post_ID, 'swf-height', 'custom value', true);
        add_post_meta($post_ID, 'swf-width', 'custom value', true);
	}
}

add_action('wp_insert_post', 'mk_set_default_custom_fields');
 
function mk_set_default_custom_fields($post_id)
{
    if ( $_GET['post_type'] != 'page' ) {
		add_post_meta($post_id, 'swf-height', '', true);
        add_post_meta($post_id, 'swf-width', '', true);
        
    }
 
    return true;
}


?>
