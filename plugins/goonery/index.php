<?php 
/*
Plugin Name: Goonery
Description: Goon
Version:     20160911
Author:      the_goon
Text Domain: Goonery
*/
//Variables
$post_types = array('album','song');
$post_type_category_show_id = array('song'=>4,'album'=> 8);
//Includes
require_once('simplehtmldom/simple_html_dom.php');
//Shortcodes
//Hooks
add_action('init',function(){
    tan(40);
});
add_action( 'wp_ajax_get_episodes', 'get_episodes');
add_action( 'wp_ajax_nopriv_get_episodes', 'get_episodes');
add_action( 'wp_ajax_get_movie_link', 'get_movie_link');
add_action( 'wp_ajax_nopriv_get_movie_link', 'get_movie_link');

add_filter( 'manage_song_posts_columns', 'adding_columns' );
add_filter( 'manage_album_posts_columns', 'adding_columns' );
add_filter( 'manage_song_posts_custom_column', 'populate_rating_column',10,2 );
add_filter( 'manage_album_posts_custom_column', 'populate_rating_column',10,2 );
add_filter( 'manage_edit-song_sortable_columns', 'sortable_ratings',10,2);
add_filter( 'manage_edit-album_sortable_columns', 'sortable_ratings',10,2);
add_filter( 'pre_get_posts', 'before_admin_query',11,2);






//add column
function adding_columns($columns)
{
	$columns[ 'rating' ] = 'Rating';
	$columns[ 'ID' ] = 'ID';
	return $columns;
}
//add data IN column
function populate_rating_column($column_name, $post_id)
{
	if($column_name == 'rating')
	{
		echo '<div id="rating-' . $post_id . '">' . get_post_meta( $post_id, 'rating', true ) . '</div>';
	}
	else if($column_name == 'ID')
	{
		echo '<div id="ID-' . $post_id . '">' . get_the_ID($post_id) . '</div>';
	}
}
//sort column
function sortable_ratings($sortable_columns)
{
	$sortable_columns['rating' ] = 'rating';
	return $sortable_columns;
}
//have songs show up in admin in order
function before_admin_query($query)
{
	global $post_types;
	global $post_type_category_show_id;
	$current_post_type = get_query_var('post_type');
	//Sort by song rating
	if($current_post_type == 'album' && is_admin())
	{
		$query->set('meta_key','rating');
		$query->set('orderby','meta_value_num');
	}
	//Make sure that ONLY ONE CATEGORY can show for songs. If you want to see other categories, go to filter page
	if(in_array($current_post_type,$post_types) && empty(get_query_var('cat')))
	{
		$query->set('cat',$post_type_category_show_id[$current_post_type]);
	}
	return $query;
}



///////////////////////////////
////
////	mark's comment
////
////
////	THIS WILL GET THE EPISODES FOR THE TV PAGE. IT IS AN AJAX HANDLER
////
///////////////////////////////
function get_episodes()
{
	//verify
	// if(!wp_verify_nonce( $_GET['key'], 'safety' ))
	// {
	// 	die("Unverified");
	// }
	// if(empty(stripos($_SERVER['HTTP_REFERER'], 'machine')))
	// {
	// 	die("Malicious Request");
	// }

	echo 11;
	require_once('tv/wp_ajax_get_episodes.php');
	echo 22;
	// wp_die();
}
//for the function above
function get_first_pattern($pattern, $subject)
{
	preg_match_all($pattern, $subject, $matches);
	return $matches[0][0];
}

///////////////////////////////
////
////	mark's comment
////
////
////	THIS WILL GET THE MOVIE LINK, THE FINAL STEP
////
///////////////////////////////
function get_movie_link()
{
	//verify
	// if(!wp_verify_nonce( $_GET['key'], 'movie_link_safety' ))
	// {
	// 	die("Unverified");
	// }
	// if(empty(stripos($_SERVER['HTTP_REFERER'],'machine')))
	// {
	// 	die("Malicious Request");
	// }
	include_once('tv/wp_ajax_get_movie_link.php');
	wp_die();
}
function get_all_matches($pattern, $subject)
{
	preg_match_all($pattern, $subject, $matches);
	var_export($matches);
}
function get_first_match($pattern, $subject)
{
	preg_match($pattern, $subject, $matches);
	return $matches[0];
}
//
//	END SAVE DATABASE
//
//NO COOKIE NEEDED
function getHeader()
{
	return array(
		'Accept'=>':text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
		'Accept-Encoding'=>':gzip, deflate',
		'Accept-Language'=>':en-US,en;q=0.8',
		'Cache-Control'=>':max-age=0',
		'Connection'=>':keep-alive',
		'Content-Type'=>':application/x-www-form-urlencoded',
		//'Cookie'=>'lang=english; aff=859; __utmt=1; ppu_main_2db669c22a9a64fdde5ff1ccf886362f=1; ppu_exp_2db669c22a9a64fdde5ff1ccf886362f=1448859108007; ad_referer=; ppu_show_on_2db669c22a9a64fdde5ff1ccf886362f=2; __utma=80043521.552821872.1448850343.1448850343.1448855502.2; __utmb=80043521.2.10.1448855502; __utmc=80043521; __utmz=80043521.1448850343.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); total_count_2db669c22a9a64fdde5ff1ccf886362f=1; ppu_sub_2db669c22a9a64fdde5ff1ccf886362f=2; ppu_delay_2db669c22a9a64fdde5ff1ccf886362f=1',
		'Host'=>':gorillavid.in',
		'Origin'=>':http://gorillavid.in',
		'Upgrade-Insecure-Requests'=>':1',
		'User-Agent'=>':Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36');
}
?>