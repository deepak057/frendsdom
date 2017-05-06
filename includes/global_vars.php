<?php

//Global constants
define('SITE_URL',"http://frendsdom.com");
define('ROOT','/var/www');
define('HOME',ROOT.'/html');

//Global database configuration variables
$host="localhost";$db_user="root";$db_passwd="6%hHByeMdSC=A=3E";$selected_db="userinfo";$pic_db="picdata";$msg_sentbox="msg_sentbox";$msg_inbox="msg_inbox";$nudgeset_records="nudgeset_records";$nudgesets_db="nudgesets";$feedback_to_website="feedback_to_website";$comment_on_website="comment_on_website";$soundclips_db="soundclips";$autoresponses_db="autoresponses";$authority_recpients_db="authority_recpients";$comment_on_profile_db="comment_on_profile";$feedback_to_profile_db="feedback_to_profile";$pic_collection_record_db="pic_collection_record";$picdata_db="picdata";$news_db="news_record";$share_box_db='sharebox';$eyecandy_db="eyecandy_pics";$chat_db="chat_db";$other_data_db="other_data";$visitors_record_db="visitors_record";$posts_db="posts_record";$status_view_db="status_view_db";$conf_db="other_conf_db";$fback_to_posts_db="fback_to_posts";$cmnt_on_posts_db="cmnt_on_posts_db";$other_conf_db2="other_conf_db2";$post_suggestion_db="post_suggestion_db";$post_pic_data="post_pic_data";$ps_news_db="ps_news_db";$ps_movies_db="ps_movies_db";$ps_videos_db="ps_videos_db";$cats_post_records_db="cats_post_records";$cache_db="cache";$max_width=500;$max_thumb_width=80;$prof_pic_size=300;$vpb_dir="vp_backgrounds/";$max_msgs_to_stangers=10;$msgs_to_stangers_hours=24;$tbl_key_id_mapping="key_id_mapping";$hobbies_db="hobbies_db";$hobbies_subscription_db="hobbies_subscription_db";

//directory containing temporary pics used by Make Points module
$mp_temp_pic_dir="user_data/temp";

//default database connection
$con=mysql_connect($host,$db_user,$db_passwd);

//array containing ids of users with special privileges
$privileged_ids=array(1);

//path to background images for index page
$path_bg_images="images/main_back/";

//variables used by module "Post suggestion" but also needed in global context
$movie_api_base="http://api.themoviedb.org/3/movie";
$movie_api_pic_base="http://cf2.imgobject.com/t/p/w500";
$movie_module="modules/post_suggestion/movies";

//path to third party's content
$third_party_dir="third_party_data";
$tmdb_dir="tmdb";
$youtube_dir="youtube";

//URL where data from Facebook will be processed during signup
$url_to_process_fb_data=SITE_URL."/modules/register_fb/process.php";

//path to file that inserts Google analytic code 
$ga_file="others/google_analyctics/ga.php";

//paths to Adsense's scripts
$adsense="others/adsense";

//paths to Chitika's ads scripts
$chitika="others/chitika";
$ad_468_60=$chitika."/ad_468_60.php";
$ad_468_250=$chitika."/ad_468_250.php";
$ad_200_600=$chitika."/ad_200_600.php";

//variables related to cover picture
$cover_pic_conf['max_size']=2048;
$cover_pic_conf['frame_width']=990;
$cover_pic_conf['frame_height']=490;

//how many bytes are there in 1 MB
$bytes_in_mb=1048576;

//dimensions for share box pictures
$sbox_pics['width_smaller']="350";
$sbox_pics['height_smaller']="250";
$sbox_pics['width_regular']="500";
$sbox_pics['height_regular']="400";

//default configuration for profile page slider
$pp_slider_conf=array(

		"theme"=>"dark",
		"firstSlide"=>3,
		"activateOn"=>"click",
		"autoPlay"=>false
		
		);


//array containing ids of users whose profile pictures are banned from being featured on main page
$not_featured=array(25,47);

//ids of posts that are banned on Discover page
$banned_posts_ids=array("'dummy_post'");

?>
