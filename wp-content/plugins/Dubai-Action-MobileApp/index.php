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



// function da_rest_prepare_post($data, $post, $request) {
//     // $_data = $data->data;
//     // $_data["custom"]["td_video"] = get_post_meta($post->ID, 'td_post_video', true) ?? get_post_meta("featuredimg",true);
//     // $_data['custom']["featured_image"] = get_the_post_thumbnail_url($post->ID, "original") ?? get_post_meta( $post->ID, 'featuredimg', true );
    
//     // if ($_data['custom']["featured_image"]=='')$_data['custom']["featured_image"]=get_post_meta( $post->ID, 'featuredimg', true );
// 	// $_data['custom']["author"]["name"]   = get_the_author_meta($_data['author']);
//     // $_data['custom']["author"]["avatar"] = get_avatar_url($_data['author']);
//     // $_data['custom']["categories"] = get_the_category($_data["id"]);
//     // $_data['custom']["startdate"] = get_field('event_start',$post->ID);
//     // $_data['custom']["enddate"] = get_field('event_end',$post->ID);
//     // $_data['gallery'] = get_field('gallery');
//     // $_data['ticketlink']= get_field('tickets_available',$post->ID);

//     // $data->data = $_data;
//     // return $data;
    
//     $posts = get_posts();

// 	$data = [];
// 	$i = 0;

// 	foreach($posts as $post) {
// 		$data[$i]['id'] = $post->ID;
// 		$data[$i]['title'] = $post->post_title;
// 		$data[$i]['content'] = $post->post_content;
//         $data[$i]['excerpt'] = $post->post_excerpt;
//         $data[$i]['price'] = get_field("price",$post->ID);
//         $data[$i]['location'] = get_field("location",$post->ID);
//         $data[$i]['author'] = $post->post_author;
// 		$data[$i]['slug'] = $post->post_name;
//         $data[$i]['date'] = $post->post_date;
// 		$data[$i]['featured_image'] = get_the_post_thumbnail_url($post->ID, "original") ?? get_post_meta("featuredimg",true);
// 		$i++;
// 	}

// 	return $data;

// }

// add_filter('rest_prepare_post', 'da_rest_prepare_post', 10, 3);


function check_modified(){
$post_type=$_GET['post_type'];
$args = [
    'numberposts' => 999999,
    'post_type' => $post_type,
    'order_by' =>  "post_modified",
    'category' =>  $_GET['category'],
    'order' =>"ASC"
];
$i=0;
    $posts = get_posts($args);
    foreach($posts as $post) {
    $data[$i]['modified'] = $posts[$i]->post_modified;
    $data[$i]['count'] = count($posts);
    $data[$i]['post_title'] = $posts[$i]->post_title;
    $i++;
    }
    return $data;
}
function da_attractions($data) {
    $posts_in=explode("-",$data['includes']);
    // echo $data['includes'];
    //  print_r( $posts_in);
    
	$args = [
		'numberposts' => 99999,
		'post_type' => 'attraction',
        'post__in' => $posts_in,
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
        $data[$i]['location'] = get_field("location",$post->ID);
        $_data[$i]['author'] = $post->post_author;
        $data[$i]["author"]["name"]   = get_the_author_meta($_data['author']);
        $data[$i]["author"]["avatar"] = get_avatar_url($_data['author']);
		$data[$i]['slug'] = $post->post_name;
        $data[$i]['date'] = $post->post_date;        
        $data[$i]['modified'] = $post->post_modified;
        $data[$i]['featured_image']= getPostFeatured($post->ID);
        $data[$i]['gallery'] = get_field("gallery",$post->ID);
        $data[$i]['video'] = get_field("video",$post->ID);

        		$i++;
	}

	return $data;
}

function da_gem($data) {
	$post = get_post($data['id']);

	$data = [];

		$data['id'] = $post->ID;
		$data['title'] = $post->post_title;
		$data['content'] = $post->post_content;
        $data['excerpt'] = $post->post_excerpt;
        $data['price'] = get_field("price",$post->ID);
        $data['location'] = get_field("location",$post->ID);
        $_data['author'] = $post->post_author;
        $data["author"]["name"]   = get_the_author_meta($_data['author']);
        $data["author"]["avatar"] = get_avatar_url($_data['author']);
        $data['slug'] = $post->post_name;
$data['date'] = $post->post_date;
        $data['modified'] = $post->post_modified;        $data['featured_image']= getPostFeatured($post->ID);
        $data['gallery'] = get_field("gallery",$post->ID);
        $data['video'] = get_field("video",$post->ID);

	return $data;
}

function da_gems($data) {
    // echo $_GET['tags'];
   $tags=$_GET['tags'];

    if ($tags){
        $tags=explode(",",$_GET['tags']);
	$args = [
		'numberposts' => 99999,
		'post_type' => 'hidden',
        'post__in' => $tags,
        'tag' => $tags
    ];
    //  print_r($args);
}
else 
{
    $args = [
		'numberposts' => 99999,
		'post_type' => 'hidden',
    ];
}
	$posts = get_posts($args);

	$data = [];
	$i = 0;

	foreach($posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;
		$data[$i]['content'] = $post->post_content;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['price'] = get_field("price",$post->ID);
        $data[$i]['location'] = get_field("location",$post->ID);
        $data[$i]['gallery'] = get_field("gallery",$post->ID);
        $_data[$i]['author'] = $post->post_author;
        $data[$i]["author"]["name"]   = get_the_author_meta($_data['author']);
        $data[$i]["author"]["avatar"] = get_avatar_url($_data['author']);
        $data[$i]['tags'] = get_the_tags($post->ID);
        $data[$i]['date'] = $post->post_date;        
        $data[$i]['modified'] = $post->post_modified;
        $data[$i]['gallery'] = get_field("gallery",$post->ID);
        $data[$i]['video'] = get_field("video",$post->ID);
        $data[$i]['featured_image']= getPostFeatured($post->ID);
		$i++;
	}

	return $data;
}

function da_bucketlist($data) {
    $limit=$data['limit'];
if ($limit!='')$numposts=$limit; else $numposts=99999;
	$args = [
		'numberposts' => $numposts,
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
        $data[$i]['location'] = get_field("location",$post->ID);
        $data[$i]['gallery'] = get_field("gallery",$post->ID);
        $_data[$i]['author'] = $post->post_author;
        $data[$i]["author"]["name"]   = get_the_author_meta($_data['author']);
        $data[$i]["author"]["avatar"] = get_avatar_url($_data['author']);
		$data[$i]['slug'] = $post->post_name;
        $data[$i]['date'] = $post->post_date;        
        $data[$i]['modified'] = $post->post_modified;
        $data[$i]['gallery'] = get_field("gallery",$post->ID);
        $data[$i]['video'] = get_field("video",$post->ID);
		$data[$i]['featured_image'] = get_the_post_thumbnail_url($post->ID, "original") ?? get_post_meta($post->ID,"featuredimg",false);
		$i++;
	}

	return $data;
}

function da_posts($data) {
    // $posts_in=explode("-",$data['includes']);
    // echo $data['includes'];
    //  print_r( $posts_in);
    $categories=explode(",",$_GET['categories']);
    $orderby=$_GET['orderby'];
    $order=$_GET['order'];
	$args = [
		'numberposts' => 99999,
        'category__in'		=> $categories,
        'order_by' =>$orderby,
        'order' =>$order
		// 'post_type' => 'post',
        // 'post__in' => $posts_in,
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
        $data[$i]['location'] = get_field("location",$post->ID);
        $_data[$i]['author'] = $post->post_author;
        $data[$i]["author"]["name"]   = get_the_author_meta($_data['author']);
        $data[$i]["author"]["avatar"] = get_avatar_url($_data['author']);
		$data[$i]['slug'] = $post->post_name;
        $data[$i]['date'] = $post->post_date;        
        $data[$i]['modified'] = $post->post_modified;
        $data[$i]['featured_image']= getPostFeatured($post->ID);
        $data[$i]['gallery'] = get_field("gallery",$post->ID);
        $data[$i]['video'] = get_field("video",$post->ID);

        $i++;
	}

	return $data;
}
function getPostFeatured($id){
    $img=get_the_post_thumbnail_url($id, "original");
		$img!=false ? $returned=$img : $returned=get_post_meta($id,"featuredimg",true);

        return $returned;
}
function da_post($data) {
	$post = get_post($data['id']);

	$data = [];

		$data['id'] = $post->ID;
		$data['title'] = $post->post_title;
		$data['content'] = $post->post_content;
        $data['excerpt'] = $post->post_excerpt;
        $data['price'] = get_field("price",$post->ID);
        $data['location'] = get_field("location",$post->ID);
        $data['gallery'] = get_field("gallery",$post->ID);
        $data['video'] = get_field("video",$post->ID);
        $_data['author'] = $post->post_author;
        $data["author"]["name"]   = get_the_author_meta($_data['author']);
        $data["author"]["avatar"] = get_avatar_url($_data['author']);
		$data['slug'] = $post->post_name;
$data['date'] = $post->post_date;
        $data['modified'] = $post->post_modified;  
        $data['featured_image']= getPostFeatured($post->ID);

	return $data;
}

function da_attraction($data) {
	$post = get_post($data['id']);

	$data = [];
		$data['id'] = $post->ID;
		$data['title'] = $post->post_title;
		$data['content'] = $post->post_content;
        $data['excerpt'] = $post->post_excerpt;
        $data['price'] = get_field("price",$post->ID);
        $data['location'] = get_field("location",$post->ID);
        $data['gallery'] = get_field("gallery",$post->ID);
        $data['video'] = get_field("video",$post->ID);
        $_data['author'] = $post->post_author;
        $data["author"]["name"]   = get_the_author_meta($_data['author']);
        $data["author"]["avatar"] = get_avatar_url($_data['author']);
		$data['slug'] = $post->post_name;
        $data['date'] = $post->post_date;
        $data['modified'] = $post->post_modified;        
        $data['featured_image']= getPostFeatured($post->ID);


	return $data;
}



add_action('rest_api_init', function() {
register_rest_route( 'da/v2', 'attractions/(?P<includes>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'da_attractions',
	) );
    register_rest_route( 'da/v2', 'attraction/(?P<id>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'da_attraction',
	) );

    register_rest_route( 'da/v2', 'posts/', array(
		'methods' => 'GET',
		'callback' => 'da_posts',
	) );
    register_rest_route( 'da/v2', 'post/(?P<id>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'da_post',
	) );

    register_rest_route( 'da/v2', 'gems/', array(
		'methods' => 'GET',
		'callback' => 'da_gems',
	) );

    register_rest_route( 'da/v2', 'gems/(?P<includes>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'da_gems',
	) );
    register_rest_route( 'da/v2', 'gem/(?P<id>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'da_gem',
	) );

    register_rest_route( 'da/v2', 'bucketlist/(?P<limit>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'da_bucketlist',
	) );

    register_rest_route( 'da/v2', 'modified/', array(
		'methods' => 'GET',
		'callback' => 'check_modified',
	) );
    


});

function post_featured_image_json( $data, $post, $context ) {
  $featured_image_id = $data->data['featured_media']; // get featured image id
  $featured_image_url = wp_get_attachment_image_src( $featured_image_id, 'medium' ); // get url of the original size

  if( $featured_image_url ) {
    $data->data['featured_image_url'] = $featured_image_url[0];
  }

  return $data;
}
// add_filter( 'rest_prepare_post', 'post_featured_image_json', 10, 3 );



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

