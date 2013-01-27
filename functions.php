<?php

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
  //uncommment next line to hardwire wp admin setting for featured image size
  //set_post_thumbnail_size( 100, 75 );
}

add_action('publish_page', 'add_custom_field_automatically');
add_action('publish_post', 'add_custom_field_automatically');
function add_custom_field_automatically($post_ID) {
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        add_post_meta($post_ID, 'swf-height', 'custom value', true);
        add_post_meta($post_ID, 'swf-width', 'custom value', true);

        //add_post_meta($post_ID, 'orig-width', 'custom value', true);
        //add_post_meta($post_ID, 'orig-height', 'custom value', true);

        add_post_meta($post_ID, 'meta-description', 'custom value', true);

        add_post_meta($post_ID, 'post_views_count', '1', true);
	}
}

add_action('wp_insert_post', 'mk_set_default_custom_fields');
 
function mk_set_default_custom_fields($post_id)
{
    if ( $_GET['post_type'] != 'page' ) {
        add_post_meta($post_id, 'swf-width', '', true);
        add_post_meta($post_id, 'swf-height', '', true);

        //add_post_meta($post_ID, 'orig-width', 'custom value', true);
        //add_post_meta($post_ID, 'orig-height', 'custom value', true);

        add_post_meta($post_ID, 'meta-description', 'custom value', true);

        add_post_meta($post_ID, 'post_views_count', '1', true);
        
    }
 
    return true;
}
//custom field voor viewcounts

function getPostViews($postID){
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
    return "0 View";
}
return $count.' Views';
}

function setPostViews($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
}else{
    $count++;
    update_post_meta($postID, $count_key, $count);
}
}
//prevent prefetched articles from generating views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//extra field for admin general settings page

$new_general_setting = new new_general_setting();
 
class new_general_setting {
    function new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'siteinfo', 'esc_attr' );
        add_settings_field('siteinfo', '<label for="siteinfo">'.__('Siteinfo' , 'siteinfo' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'siteinfo', '' );
        echo '<input type="text" size="150" id="siteinfo" name="siteinfo" value="' . $value . '" />';
    }
}



function trace($instr) {

    echo "<script>console.log(\"$instr\")</script>";

}

?>
