<?php
/**
 * Plugin Name: Dubai Action News Reader
 * Plugin URI: http://selectcreatives.com
 * Description: Custom API answers for Posts
 * Version: 1.0
 * Author: Deen Dabbagh
 * Author URI: http://selectcreatives.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$write=$_GET['write'];

if ($write==1)add_action('init', 'write_news');
function write_news(){
    // if ($write){
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://free-news.p.rapidapi.com/v1/search?q=Dubai&lang=en",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: free-news.p.rapidapi.com",
		"x-rapidapi-key: b16d628298msh0e899c12bcab65ap118708jsne76451d1a205"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $articles=json_decode($response,true);
	// print_r ($arr['articles'][0]['title']);
    // var_dump($arr['articles'][0]['title']);
}
$i=0;
// echo $articles[1]['title'];
// echo $articles[2]['title'];
// echo $articles[3]['title'];

//  print_r($articles['articles'][0]['title']);
//echo $articles[1]['title'];
// print_r($articles);
 foreach ($articles['articles'] as $news){
    //  $news=$articles['articles'][0];
    //  print_r( $news);
//  echo $news['title'];
    // print_r("News title:"+$news[$i]['title']);
    $page = get_page_by_title($news['title'], OBJECT, 'post');
    // print_r($page);
    if (is_null($page)){
    $my_post = array(
        'post_title'    => wp_strip_all_tags( $news['title'] ),
        'post_content'  =>  $news['summary'],
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array( 1 )
      );
       
      // Insert the post into the database
      $post_id=wp_insert_post( $my_post );

      update_post_meta($post_id,'featuredimg', $news['media']);

    //   $image = $news['media'];

    //   $attachment_file_type = wp_check_filetype(basename($image), null);
      
    //   $wp_upload_dir = wp_upload_dir();
      
    //   $attachment_args = array(
    //       'guid'           => $wp_upload_dir['url'] . '/' . basename($image),
    //       'post_title'     => preg_replace('/\.[^.]+$/', '', basename($image)),
    //       'post_mime_type' => $attachment_file_type['type']
    //   );
      
    //   $attachment_id = wp_insert_attachment($attachment_args, $image, $post_id);
      
    //   require_once(ABSPATH . 'wp-admin/includes/image.php');
      
    //   $attachment_meta_data = wp_generate_attachment_metadata($attachment_id, $image);
      
    //   wp_update_attachment_metadata($attachment_id, $attachment_meta_data);
      
    //   set_post_thumbnail($post_id, $attachment_id);
    }
}
}