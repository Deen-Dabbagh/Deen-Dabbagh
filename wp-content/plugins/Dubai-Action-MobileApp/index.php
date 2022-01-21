<?php
/**
 * Plugin Name: Dubai Action Mobile App
 * Plugin URI: http://selectcreatives.com
 * Description: Custom API answers for Posts
 * Version: 1.0
 * Author: Deen Dabbagh
 * Author URI: http://selectcreatives.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



function da_rest_prepare_post($data, $post, $request) {
    $_data = $data->data;
    $_data["custom"]["td_video"] = get_post_meta($post->ID, 'td_post_video', true) ?? '';
    $_data['custom']["featured_image"] = get_the_post_thumbnail_url($post->ID, "original") ?? '';
	$_data['custom']["author"]["name"]   = get_author_name($_data['author']);
    $_data['custom']["author"]["avatar"] = get_avatar_url($_data['author']);
    $_data['custom']["categories"] = get_the_category($_data["id"]);
    $_data['custom']["startdate"] = get_field('event_start',$post->ID);
    $_data['custom']["enddate"] = get_field('event_end',$post->ID);
    $_data['ticketlink']= get_field('tickets_available',$post->ID);

    $data->data = $_data;
    return $data;
}

add_filter('rest_prepare_post', 'da_rest_prepare_post', 10, 3);



function da_attractions() {
	$args = [
		'numberposts' => 99999,
		'post_type' => 'attraction'
	];

	$posts = get_posts($args);

	$data = [];
	$i = 0;

	foreach($posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;
		$data[$i]['content'] = $post->post_content;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['price'] = get_field("price",$post->ID);
        $data[$i]['author'] = $post->post_author;
		$data[$i]['slug'] = $post->post_name;
        $data[$i]['date'] = $post->post_date;
		$data[$i]['featured_image'] = get_the_post_thumbnail_url($post->ID, "original") ?? '';
		$i++;
	}

	return $data;
}


add_action('rest_api_init', function() {
register_rest_route( 'da/v1', 'attractions/', array(
		'methods' => 'GET',
		'callback' => 'da_attractions',
	) );

});

function post_featured_image_json( $data, $post, $context ) {
  $featured_image_id = $data->data['featured_media']; // get featured image id
  $featured_image_url = wp_get_attachment_image_src( $featured_image_id, 'original' ); // get url of the original size

  if( $featured_image_url ) {
    $data->data['featured_image_url'] = $featured_image_url[0];
  }

  return $data;
}
add_filter( 'rest_prepare_post', 'post_featured_image_json', 10, 3 );



// Enable comment without being loggedin
/* function filter_rest_allow_anonymous_comments() {
    return true;
}*/

add_filter('rest_allow_anonymous_comments','filter_rest_allow_anonymous_comments');


add_action('rest_api_init', 'register_rest_images' );

function register_rest_images(){
    register_rest_field( array('page'),
        'page_image',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}



function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}





add_filter('onesignal_send_notification', 'onesignal_send_notification_filter', 10, 4);

function onesignal_send_notification_filter($fields, $new_status, $old_status, $post)
{
    $fields['isAndroid'] = true;
    $fields['isIos'] = true;
    $fields['isAnyWeb'] = false;
    $fields['isChrome'] = false;
	$fields['data'] = array(
        "postId" => $post->ID
    );
    /* Unset the URL to prevent opening the browser when the notification is clicked */
    unset($fields['url']);
    return $fields;
}

