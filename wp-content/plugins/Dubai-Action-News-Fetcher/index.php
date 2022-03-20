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
	CURLOPT_URL => "https://free-news.p.rapidapi.com/v1/search?q=Dubai",
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
}
$i=0;

 foreach ($articles['articles'] as $news){
  
    $page = get_page_by_title($news['title'], OBJECT, 'post');

    if (is_null($page)){
    $my_post = array(
        'post_title'    => wp_strip_all_tags( $news['title'] ),
        'post_content'  =>  $news['summary']." <br/><br/><a href='"+$news['link']+"Source</a>",
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array( 1 )
      );
       
      // Insert the post into the database
      $post_id=wp_insert_post( $my_post );

      update_post_meta($post_id,'featuredimg', $news['media']);

    
    }
}
}