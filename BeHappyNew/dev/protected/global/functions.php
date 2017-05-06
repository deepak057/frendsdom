<?php

require_once("constants.php");
require_once("global_vars.php");


/*

function to get the path of a static image

*/


function get_image($image){

return $GLOBALS['cdn']['enabled'] ? $GLOBALS['cdn']['image_server_url']."/images/".$image : base_url().'/images/'.$image;

}


/*

function to get basepath of the app

*/


function basepath(){

return str_replace(DS."protected","",Yii::app()->basePath);

}

/*

function to get Base URL of the app

*/

function base_url(){

return Yii::app()->request->baseUrl;

}


/*

function to encode a given string 

*/

function encrypt($str){

    return sha1($str);

}

/*

function to return given date in MYSQL datetime format

*/

function SQL_date($date=false)
{
return date('Y-m-d H:i:s', !$date?time():strtotime($date));
}


/*

function to get user object of given id

*/


function get_user_by_id($uid = false)
{
    
    //get user object
    return users::model()->findByPk(uid($uid));
    
}

function user_obj($uid = false)
{

    $uid = empty($uid)?uid():$uid;
    return is_object($uid)?$uid:get_user_by_id($uid);

}

/*

function to return id of logged in user

*/

function uid($uid=false){

   return $uid?$uid:Yii::app()->session['uid'];
}

/*

function to return a given controller

*/


function get_controller($controller)
{
    $cc = Yii::app()->createController($controller);
    return $cc[0];
}

/*

function to check if a user is logged in or not

*/


function is_logged_in()
{
    return empty(Yii::app()->session['uid'])?false:true;
    
}

/*

function to get the name of given user, by default set to current USER

*/


function user_name($user=false)
{
    $user=user_obj($user);
    return ucwords($user->fname . " " . $user->lname);
    
}


function get_timestamp_for_days($days=7){
		
		return time()+60*60*24*$days;
		
		}
	
	
	
	function remember_login($uid,$pass){
		
		
		$uid = new CHttpCookie('uid', $uid);
		$uid->expire =get_timestamp_for_days() ; 
		Yii::app()->request->cookies['uid'] = $uid;
		
		$pass = new CHttpCookie('pass', $pass);
		$pass->expire =get_timestamp_for_days() ; 
		Yii::app()->request->cookies['pass'] = $pass;
		
		
		
		}
	
	
	/*

	function to check if login is valid

	*/
	

	function is_login_valid($email,$password,$model = false)
		{
			
			
		$user = users::model()->find("email= '".$email."' && password= '".$password."'");
		
		if(!$model)
		return empty($user)?false:true;
		else
		return empty($user)?NULL:$user;
		
		}
		


	/*


	function to check if logged in cookies are found on client's system
	
	*/

	function check_login(){
		
       
  		if(!empty(Yii::app()->request->cookies['uid']) && !empty(Yii::app()->request->cookies['pass'])){

		
		  if(is_logged_in())
		  {		

		  	$user=get_user_by_id(Yii::app()->request->cookies['uid']);

			
						
			if($user){
			$user=is_login_valid($user->email,Yii::app()->request->cookies['pass'],true,true);
			get_controller(SITE)->on_login($user);
			
			remember_login(Yii::app()->request->cookies['uid'],Yii::app()->request->cookies['pass']);
									
			}

			else
			{
               get_controller(SITE)->logout();
               get_controller(SITE)->redirect(Yii::app()->homeUrl);


			}
			
		}

			
		  }
		
		}
	
	
	function redirect_to($controller){
		
		Yii::app()->request->redirect(Yii::app()->createUrl($controller)); 
		
		
		}

function pre_action_call()
{
    $action = Yii::app()->controller->action->id;
    if ($action != 'logout') {
       // authenticate_user();
		check_login();
    }
}


/*

function to return current year

*/

function current_year(){

    return date("Y");

}

/*

function to return LOGIN URL

*/


function login_url($redirect_to=false){

return Yii::app()->createAbsoluteUrl(SITE."/login".($redirect_to?"?".REDIRECT_TO."=".urlencode($redirect_to):""));

}

/*

function to return path to directory containing User uploaded content

*/

function path_to_uploads(){

return path_to_root_dir($GLOBALS['path_uploads']);
}

function path_to_root_dir($dir){

	$dir=basePath().DS.$dir;

	check_dir($dir);

	return $dir;
}

/*

function to check if a given PHP extension exists

*/

function extension_exists($extension){
$extension_soname = $extension . "." . PHP_SHLIB_SUFFIX;
$extension_fullname = PHP_EXTENSION_DIR . DS . $extension_soname;
//return extension_loaded($extension);
return true;
}

/*

function to return path to a directory inside directory "UPLOADS"

*/


function directory_in_uploads($dir){

$dir= path_to_uploads().DS.$dir;

check_dir($dir);

return $dir;

}

function team_logo($logo){

	return directory_in_uploads($GLOBALS['path_team_logo']).DS.$logo;
}


/*

returns URL to logo of a given team

*/

function team_logo_url($logo){

	return path2url(team_logo($logo));
}

/*

This function returns the name of file from the given path

*/

function extract_title_from_file($file){

$path_parts = pathinfo($file);

return $path_parts['filename'];

}

function get_file_name($file_path){

$path_parts = pathinfo($file_path);

return $path_parts['basename'];

}


/*

function to create a given directory if not exists

*/


function check_dir($dir){

if(!file_exists($dir)){

mkdir($dir);

}

}

/*

function to return path to a directory inside directory "VIDEOS"

*/

function directory_in_videos($dir){

$dir=directory_in_uploads("videos")."/".$dir;

check_dir($dir);

return $dir;

}


/*

function to return path to a directory inside directory "POSTERS"

*/


function directory_in_posters($dir){

$dir=directory_in_uploads(POSTERS).DS.$dir;

check_dir($dir);

return $dir;

}


/*

function to return path of given video poster

*/


function video_poster($video_id,$size=false){

return directory_in_posters($size?$size:LARGE).DS.$video_id.".jpg";

}


function poster_url($video_id,$size=false){

	$video_poster = video_poster($video_id,fix_posetr_size($size));
	//if poster found then use poster
	if(file_exists($video_poster))
	{
		return path2url($video_poster);	
	}
	else
	{
		//if video pipeline set true
		if($GLOBALS['set_video_pipeline']){
			//if no poster then check if video processing status
			$status = get_controller(PROCESS_VIDEOS)->get_video_status($video_id);
		
			if($status === null)
			{
				$size=$size?$size:LARGE;
				return get_image("no_preview_".$size.".png");	
			
			 }
			else if($status==2)
			{
				//check if poster exist
				if(file_exists($video_poster))
				{
					return path2url($video_poster);	
				}
				else
				{
					$size=$size?$size:LARGE;
					return get_image("no_preview_".$size.".png");
				}

			}
			else if($status == 1 || $status == 0 )
			{
				$size=$size?$size:LARGE;
				//return get_image("video_uploading_".$size.".png");
				return get_image("video_uploading_medium.png");
				//return get_image("no_preview_".$size.".png");	
				//uploading video priview image
			}
		}
		else
		{
			$size=$size?$size:LARGE;
			return get_image("no_preview_".$size.".png");	
		}
		
		
	}

}

function video_url($video_id,$size=false){
	return ifVideoExists(video_path($video_id,$size),$video_id);
}

//check if file exists among the global video file extensions and return its url
function ifVideoExists($videoPath,$video_id)
{
	foreach($GLOBALS['video_extensions'] as $ext)
	{
		//append extension from global variable
		$file = substr($videoPath,0,-3).$ext;
		if(file_exists($file)){
		
		if($GLOBALS['set_video_pipeline']){
			//check status of the video, if processed
			$status = get_controller(PROCESS_VIDEOS)->get_video_status($video_id);
			
			//if video is processed, only then move file to CDN
			if($status == 2){
				//Also, if file is found to be existing on Local server, move it to CDN Asynchronously
				get_controller(CDN)->move_video($file);		
			}
		}
		else
		{
			//Also, if file is found to be existing on Local server, move it to CDN Asynchronously
				get_controller(CDN)->move_video($file);		
		}

		return path2url($file);

		}
		
		
		
	}

	return video_url_from_cdn($video_id);

}

function path2url($file, $Protocol='http://') {
    return $Protocol.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
}



/**
* function to return the Video's URL from CDN 
*/

function video_url_from_cdn($video_id){

return $GLOBALS['cdn']['videos_standard']."/".$video_id.".".$GLOBALS['format_convert_videos'];

}

/*
* function to make the given command Asynchronous
*/

function make_asynch($cmd){

return $cmd." &> /dev/null &";

}


//function to return path to a given video file

function video_path($video_id,$size=false){

return directory_in_videos($size?$size:STANDARD).DS.$video_id.".".$GLOBALS['format_convert_videos'];

}

/*  
* Determine video duration with ffmpeg   
* ffmpeg should be installed on server.  
*/  

function get_file_duration($file){
if(extension_exists("ffmpeg")){
$time =  exec("ffmpeg -i $file 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");   
return convert_time_to_seconds($time); 
}

return 0;
}


/*

Get video Cactive record object by primary key

*/

function get_video_by_id($id){

	$video = videos::model()->findByPk($id);
	return get_video_model($video);
}


/*

function to return CAactive Video object based on given VIDEO_ID

*/


function video_by_video_id($v_id){


	$video= videos::model()->findByAttributes(array("video_id" => $v_id));
	return get_video_model($video);
}

/* 

check if video is a comment video & if its title is empty then
find video's parent battle or video and put their title and category 
in the commented video.


*/

function get_video_model($video){

	if(!empty($video)){
		 if ($video->type==COMMENT && empty($video->title)){

				$get_video_comment_info =get_video_comment_info($video);
			if($get_video_comment_info){
				$video->title=$get_video_comment_info['title'];

				$video->category=$get_video_comment_info['cat_id'];

				$video->save();
			}
		}
	return $video;
	}

return false;
}

/*

function to return the URL to WATCH page based on the given video id

*/

function watch_url($video_id){

return Yii::app()->createAbsoluteUrl("/{$video_id}");
}


function page_title($title){


	return $title." - ".Yii::app()->name;
}

/*

get videos via category of directories with/without limit

*/

function getVideosViaCategory($catId,$limit=false)
{

	//get category configuration
	global $cats_conf;

	$criteria=new CDbCriteria();
	$criteria->condition = 'category= '.$catId;
	$criteria->order='id desc';

	$count=videos::model()->count($criteria);
	$pages=new CPagination($count);

	// results per page
	$pages->pageSize=$limit?$limit:$cats_conf['sub_cat_results_limit'];
	$pages->applyLimit($criteria);
	$models=videos::model()->findAll($criteria);
	$videosAll = videos::model()->count(array("condition"=>"category=".$catId));
	return array("videosArray"=>$models,"pages"=>$pages,"countVideos"=>$videosAll);
}




function add_remove_id_to_json($json_string,$id,$action=false){

//default action
$action=$action?$action:ADD;

$ids=json_decode($json_string,true);

if($action==ADD){

	if(count($ids)>0 && !in_array($id,$ids)){

		$ids[]=$id;
	}


else {

	$ids=array($id);
}


}



else {

if(is_array($ids) && in_array($id,$ids)){


	$ids=remove_item_from_array($ids,$id);
}


}

 return  json_encode($ids);

}


function remove_from_array($arr,$arr_to_be_removed){

return array_diff($arr,$arr_to_be_removed);

}


function remove_item_from_array($arr,$item){

return remove_from_array($arr,array($item));

}


/**
 *returns excerpt of specified length from given string			
 */
function excerpt($text,$numb = 140){
				
	if (strlen($text) > $numb) { 
		$text = substr($text,0,$numb);
		
		if(strrpos($text," ") != false )
			$text = substr($text,0,strrpos($text," ")); 

		$etc = " ...";  
		$text = $text.$etc; 
	}

	return $text ; 
}		
	


				function format_date($timestamp){


					return date("j M Y",$timestamp);

				}

				function getPath4XMLFile()
{
	
	return path_to_root_dir($GLOBALS['path_XML_Playliet_File']);
}



// ---- get diffrence in time of file creation and current date --- //
function get_file_creation_time_difference($filePath,$timeDifferenceIn)
{
//	date("M-d-Y H:i",
	//-- get file create time (Gets the inode change time of a file) IN UNIX Timestamp --//
	if(file_exists($filePath))
	{
		$finfo =   filectime($filePath); 
		//-- get current time -- in UNIX timestamp --//
		$current_date_time= strtotime(current_date_time());
		//find time difference in hours
		if($timeDifferenceIn == 'HOURS')
		{
			$divideBy = 3600;
		}
		
		//-- fine time difference in hours --//
		return $diff = abs($current_date_time - $finfo)/$divideBy;
	}
	else
	{
	  return 'NoFile';
	}
}


/*

function to return current date time

*/


function current_date_time(){

    return date("M-d-y H:i");
}


/*

Function to get URL to a given video category

*/


function cat_url($cat_id){
if($cat_id==1)
{
	return "/";
}
return yii::app()->createAbsoluteUrl(BROWSE."/".$cat_id);

}

function red5_streams_path($stream_name)
{

	$dir = $GLOBALS['dir_path_red5_streams'];

	//$dir = directory_in_uploads($dir);

	check_dir($dir);

	return $dir.DS.$stream_name;;
}

function directory_in_comments($dir){

$dir=directory_in_uploads($GLOBALS['path_comments']).DS.$dir;

check_dir($dir);

return $dir;

}

function audio_comment_path($audio_comment_id){

return directory_in_comments(AUDIO).DS.$audio_comment_id.".".$GLOBALS['audio_conf']['convert_to'];

}
//audio battle directory
function audio_battle_dir(){

return directory_in_uploads(AUDIO);

}

//directory parth of audio file
function audio_file_path($audio_id)
{
	return audio_battle_dir().DS.$audio_id.".mp3";
}
// url of audio file
function audio_file_url($audio_id)
{
	return path2url(audio_file_path($audio_id));
}
/*

returns the URL to an audio comment/clip based on given id

*/

function audio_comment_url($audio_comment_id){

	return path2url(audio_comment_path($audio_comment_id));
}

function video_comment_path($video_id){

return directory_in_comments(VIDEOS).DS.$video_id.".".$GLOBALS['format_convert_videos'];

}

function video_comment_posetr_path($video_id){

return directory_in_comments(POSTERS).DS.$video_id."."."jpg";


}

function comment_video_url($video_id){
//return path2url(video_comment_path($video_id));
	return ifVideoExists(video_comment_path($video_id));
}


function comment_poster_url($video_id){

	return path2url(video_comment_posetr_path($video_id));
}


//-- get videos for playlist --//
function getVideosForPlaylist(){
	//find videos with max views
	$getVideos1 = get_controller(WATCH)->most_watched_videos("is_deleted=0",$GLOBALS['max_videos_show_on_home_slider']/2,false,false);

//-- get all id from above array
	$getIds= array();
	foreach($getVideos1 as $getVideos)
	{
		$getIds[]=$getVideos->id;
	}

	$exclude_Ids= implode(",",$getIds);
	$condition="";
	//if ids found
	if(count($getIds)){
		$condition = "id not in (".$exclude_Ids.") and is_deleted=0";
	}

	 //-- find videos most recently created & also where videos not matching above array --//
	$getVideos2 = get_controller(WATCH)->recently_created_videos($condition, $GLOBALS['max_videos_show_on_home_slider']/2, false,false);
	//club both arrays
	
	return custom_shuffle(array_merge($getVideos1,$getVideos2));
}

/*
 * return an array whose elements are shuffled in random order.
 */
function custom_shuffle($my_array = array()) {
  $copy = array();
  while (count($my_array)) {
    // takes a rand array elements by its key
    $element = array_rand($my_array);
    // assign the array and its value to an another array
    $copy[$element] = $my_array[$element];
    //delete the element from source array
    unset($my_array[$element]);
  }
  return array_filter($copy);
}


//function to return the command used to conver videos using FFMPEG

function video_conversion_command($input,$output,$resolution){

  //return "ffmpeg -i {$input} -ar 22050 -ab 32 -f flv -s {$resolution}  -qscale 0 {$output} 2>/dev/null";

/*

Convert to MP4 using libx264 codec

Could be very slow, receommended only if very powerful CPU is used

*/

return "ffmpeg -i {$input} -strict -2 -vcodec libx264 -preset slow -vb 500k -maxrate 500k -bufsize 1000k -vf 'scale=-1:480 ".fix_video_orientation($input)."' -threads 0 -ab 128k -s {$resolution}  -movflags faststart -metadata:s:v:0 rotate=0 {$output}";

//return "ffmpeg -y -i {$input} -strict experimental -acodec aac -ac 2 -ar 44100 -ab 96k -vcodec libx264 -s {$GLOBALS['video_resolutions']['standard']}  -preset medium -crf 18 -profile baseline -r 24 -g 72 -vb 800000 -metadata:s:v:0 rotate=90{$output}";

}


/*
*function to return option to be placed in video conversion command that will fix video orientation
*if the video is uploaded using iPhone 4S
*/

function fix_video_orientation($input){

$return= ", transpose=1 ";

$dd= exec("ffprobe -of json -show_streams  {$input}   | grep rotate");

if(!empty($dd)){

$dd=explode(":",$dd);
$rotate=str_replace(",","",str_replace('"',"",$dd[1]));

if($rotate=="90")return $return;

else if ($rotate=="180") return ", transpose=2,transpose=2 ";

else if($rotate == "270") return ", transpose=2 ";
}
/*


//Now check if video was uploaded through iPhone


$output= exec ("mediainfo {$input} | grep model-eng");

if(!empty($output) && strpos($output,"iPhone")!==false){

return $return;

}
*/

return "";


}





/*

This function returns video dimensions for a given video size

*/

function get_video_dimensions($size){

return get_dimension($GLOBALS['player_resolutions'][$size]);
}


function get_dimension($var){

$var=explode("x",$var);

return array(

	"width"=>$var[0],
	"height"=>$var[1]

	);
}

/*

function to return command used to extract a poster from video using FFMPEG

*/

function poster_extraction_command($input,$output,$resolution,$duration){

 return "ffmpeg -i {$input} -an -ss {$duration} -t 00:00:01 -r 1 -y -s {$resolution} {$output}";

}

/*

execute Mysql queries directly 

*/
	function SQLCommand($sqlStatement)
	{
		$command=Yii::app()->db->createCommand($sqlStatement);
		$command->execute();	
	}
	//return team_names model
	function team_names_model($query=false)
	{
		return team_names::model()->findAll($query);
	}
	//return user_bids model
	function user_bids_model($query=false)
	{
		return user_bids::model()->findAll($query);
	}
	
	function get_remote_content($url){
	
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	
	}
	
	function record_sort($records, $field, $reverse=false)
	{
		$hash = array();
	   
		foreach($records as $record)
		{
			$hash[$record[$field]] = $record;
		}
	   
		($reverse)? krsort($hash) : ksort($hash);
	   
		$records = array();
	   
		foreach($hash as $record)
		{
			$records []= $record;
		}
	   
		return $records;
	}
	
	function searchSubArray($array, $key, $value) {   
		foreach ($array as $subarray){  
			if (isset($subarray[$key]) && $subarray[$key] == $value)
			  return $subarray;       
		} 
	}

	function like_dislike_url($video_id,$action=false){

return Yii::app()->createAbsoluteUrl(AJAX."/LikeDislikeVideo?video_id={$video_id}&action={$action}");

}


	function like_dislike_battles_url($battle_id,$action=false){

return Yii::app()->createAbsoluteUrl(AJAX."/LikeDislikeBattle?battle_id={$battle_id}&action={$action}");

}

function like_dislike_comment_url($comment_id,$action=false){

return Yii::app()->createAbsoluteUrl(AJAX."/LikeDislikeComment?comment_id={$comment_id}&action={$action}");

}

function mark_app_comment_url($comment_id){

return Yii::app()->createAbsoluteUrl(AJAX."/MarkCommentInapp?id={$comment_id}");

}

function mark_app_battle_url($id){

return Yii::app()->createAbsoluteUrl(AJAX."/MarkBattleInapp?id={$id}");

}



/*

function to register a JS or CSS file using Assets Manager

*/


 function register_file($alias,$file,$pos=false)
{
	$pos=!$pos?CClientScript::POS_END:$pos;
    $url = Yii::app()->getAssetManager()->publish(
    Yii::getPathOfAlias($alias));

    $path = $url . '/' . $file;
    if(strpos($file, 'js') !== false)
        return Yii::app()->clientScript->registerScriptFile($path,$pos);
    else if(strpos($file, 'css') !== false)
        return Yii::app()->clientScript->registerCssFile($path,$pos);

    return $path;
}



	/* get all unique game leagues from game table */ 	
	function getGameLeagues()
	{

		//return game_api_variables::model()->findAll(array("condition"=>"status='Active'","order"=>"league desc"));
		return leagues::model()->findAll(array("condition"=>"isActive=1","order"=>"name desc"));
	}

	
	
	/* convert stdClass object to associative array  */
	 function objectToArray($object)
	 {
		// Cast to an array
		$array = (array) $object;
		
		// get_object_vars
		return get_object_vars($object);
		
	 }


	 function battle_url($id){

return Yii::app()->createAbsoluteUrl("/{$id}");
	 }

	  /* get league id */
	 function getLeagueId($league)
	 {
		return directories::model()->find(array("condition"=>"item='".$league."'"));
	 }



/*

Get command for audio conversion

*/


function audio_conversion_command($input,$output){

//return "ffmpeg -i {$input} -f mp2 {$output}";
return "ffmpeg -i {$input} -vn -ar 44100 -ac 2 -ab 192 -f mp3 -write_xing 0 {$output}";

}

/*

Method to get array of all kind of allowed Video and Audio file types

*/


function allowed_media_types($isVideo=false){
	if(!$isVideo)
		return array_merge($GLOBALS['video_extensions'],$GLOBALS['audio_conf']['allowed_formats']);
	else
		return $GLOBALS['video_extensions'];
}


/* function to return Extension of given file*/

function file_ext($file){

return pathinfo($file, PATHINFO_EXTENSION);

}

/*

this function returns the directory path containing the given file

*/

function dir_name($file){

return pathinfo($file, PATHINFO_DIRNAME);

}


function clean_string($string) {
   $string = str_replace("-","",str_replace(' ', '_', $string)); 
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}


/*

This function renames the given file to remove special characters

*/


function clean_file_name($file_path){

$new_name=dir_name($file_path).DS.clean_string(extract_title_from_file($file_path)).".".file_ext($file_path);

rename($file_path,$new_name);

return $new_name;

}

function numberToWord($amt) {
        $words = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine'
        );
		if ($amt >= 0 && $amt < 10)
            return $words[$amt];
		else
			return false;
}

//function to redirect to home page in case a user is found to be logged in

function to_home(){


	if(is_logged_in()){

		Yii::app()->request->redirect(base_url());
	}
}

/*

function to redirect users (guests) away from protected pages

*/

function handle_guests(){

	if(!is_logged_in()){
		
		Yii::app()->request->redirect(base_url());


}

}


function watch_popup_url($video_id){

	return Yii::app()->createAbsoluteUrl(AJAX."/GetWatchView?video_id={$video_id}");
}

function battle_popup_url($battle_id){

	return Yii::app()->createAbsoluteUrl(AJAX."/BattleViewPopup?battle_id={$battle_id}");
}
//get ajax audio popup url
function audio_popup_url($audio_id){

	return Yii::app()->createAbsoluteUrl(AJAX."/AudioViewPopup?audio_id={$audio_id}");
}
//check whether is audio, a comment audio of battle audio file, return {title, type, id}
function get_audio_info($audio_id)
{
	return audios::model()->get_audio_title($audio_id);
}
/* get user name via user id*/
function getUserName($userId=false)
{
	$user =user_obj(uid($userId));
	if(!empty($user)){
		if(!empty($user->fname) && !empty($user->lname)){
			return $user->fname." ".$user->lname;
		}
		else
		{
			$username = explode("@",$user->email);
			return $username[0];
		}
	}
	return false;
}
/* calculate bid win percentage */
function calcWinPercent($total,$wins)
{
	if($wins==0 || $total ==0)
		return 0;
	else
		return round($wins/$total*100,1);
}

function searchLinkViewAll($categoryId)
{
	return "<a class='view-all' href='".cat_url($categoryId) ."' >View All</a>";
}

function getParentCategory($parentId)
{
	$parent = directories::model()->findAll(array("condition"=>"id=".$parentId));
	return $parent[0]['item'];
}


function getFirstWordFrmString($string)
{
	$string = explode(" ",$string);
	return $string[0]."...";
}

function parse_boolean($value){

return filter_var($value, FILTER_VALIDATE_BOOLEAN);

}

function getGames($game_id)
{
	return games::model()->find(array("condition"=>"id='".$game_id."'"));
}

/* function getWinnerImage($winner,$team)
{
	if($winner!="")
	{
		if($winner=="won")
		{
			return "<img src='".get_image("tick-icon.png")."' alt='bid won' class='img-bid-result' />";
		}
		else if($winner=="lost")
		{
			return "<img src='".get_image("cancel-icon.png")."' alt='bid lost' class='img-bid-result' />";
		}
		else
		{
			return "<span class='user-bid-result-pending'>Awaiting results</span>";
		}
	}
} */





function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}

function get_comment_by_id($id){

return comments::model()->findByPk($id);

}

//function to mark a notification as seen if notification id is supplied as parameter 


function mark_noti_seen($noti_id=false){
	
	if(!empty($_REQUEST['_noti_id']) || $noti_id){
		$noti_id=$noti_id?$noti_id:$_REQUEST['_noti_id'];
	
		$return = get_controller(NOTIFICATIONS)->mark_seen($noti_id);
	
		if(empty($_REQUEST['_noti_id']))
		{
			return $return;
		}
	}
}

/*

returns directory path to user profile image

*/

function user_profile_pic($uid){

	return profile_pics_base_dir($uid).DS.uid($uid).".jpg";
}


function profile_pics_base_dir($uid){

$dir=directory_in_uploads($GLOBALS['path_images']).DS.$uid;

check_dir($dir);

return $dir;

}

/*

Method to return URL of profile pic for given user id

*/

function prof_pic_url($uid=false,$width=false,$height=false,$profile_large_pic=false){
	
	$file=user_profile_pic(uid($uid));

	if(file_exists($file)){

		if(!$width || !$height)
			return path2url($file).get_user_login_timestamp();
		
		else {
		
			$output=profile_pics_base_dir(uid($uid)).DS.modified_profile_pic($file,$width,$height);
			
			if(!file_exists($output))create_image($file,$output,$width,$height);
	
			return path2url($output).get_user_login_timestamp();
		}
	}
//return type of profile picture, if large profile picture is requested then send large one otherwise small pic
	if(!$profile_large_pic)
		return get_image($GLOBALS['profile_pic_conf']['default_small_pic']);
	else
		return get_image($GLOBALS['profile_pic_conf']['default_pic']);

	//create_image('user.png',$output,$width,$height);
}

/*

function to return URL to the thumb profile pic of given user

*/

function profile_pic_thumb($uid){

return prof_pic_url($uid,32,32);

}


/*

function to return name/path of profile pic in case its height and width are given

*/

function modified_profile_pic($original,$width,$height){

return extract_title_from_file($original)."_".$width."_".$height.".".file_ext($original);

}



/*

function to create output of a given image with given dimensions

*/

function create_image($input,$output,$width,$height,$aspect_ratio=false){

	$image = new EasyImage($input);

	$image->resize($width,$height,(!$aspect_ratio?EasyImage::RESIZE_NONE:EasyImage::RESIZE_WIDTH));
	
	$image->save($output);

	return $output;
}




function profile_url($uid=false){

$uid=$uid?"/{$uid}":"";
return Yii::app()->createAbsoluteUrl($uid);
}




function text($text){

return make_clickable(nl2br(htmlentities($text)));

}


//get years
function getYearsforDoB()
{
	$year = date("Y");
	$yearFrom = $year -100;
    $yearTo = $year - 4;    
	$arr=array();
	foreach(range($yearFrom, $yearTo) as $number)
	{
		$arr[$number] = $number;
	}
	return array_reverse($arr);
}
//get days 
function getDaysforDoB()
{
	$arr=array();
	for($i=1;$i<=31;$i++)
	{
		$arr[$i] = $i;
	}
	return $arr;

}

function getMonthsForDoB()
{
return array("01"=>"Jan",
			"02"=>"Feb",
			"03"=>"Mar",
			"04"=>"Apr",
			"05"=>"May",
			"06"=>"Jun",
			"07"=>"Jul",
			"08"=>"Aug",
			"09"=>"Sept",
			"10"=>"Oct",
			"11"=>"Nov",
			"12"=>"Dec"
			);
}

/* get country */

function country_model($query=false)
{
	return countries::model()->findAll($query);
}
// /get country id via name
function getcountryIdViaName($country)
{
if($country){
$country = country_model("country='".$country."'");
return $country[0]['id'];
}
}
//get country name via id 
function getcountryNameViaId($cid)
{
if($cid)
{	
$country = country_model("id='".$cid."'");
return htmlspecialchars_decode($country[0]['country']);
}
}
/* fetch coutnry from js country dropdown */
function getAllCoutnries()
{
	$counties = country_model(array("select"=>"id,country"));
	$arr = array();
	//var_dump($counties);die;
	foreach($counties as $country =>$value)
	{
		$arr[$value->id]=$value->country;
	}
	return	json_encode($arr);
}

function check_email_address($email) {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }
//function to manipulate the user name 
function TuneTheName($n,$length=21){

	if(strlen($n)>$length){$ex=explode(" ",$n);



if(isset($ex[str_word_count($n)-1])){


	$name=$ex[0]." ".$ex[str_word_count($n)-1];
}

else {


	$name=$ex[0];
}



	if(strlen($name)<=$length){return urldecode($name);}else{if(strlen($ex[0])>=$length){return urldecode(substr($ex[0], 0, $length));}else {return urldecode($ex[0]);}}}else{return urldecode($n);}}

/*Function for adding a role for user id 
@uid , the user id need to add role to , integer
@role , instance of role defined in data/auth.php

@return , true / false
*/
function add_auth_role($uid,$role = 'admin')
{
	$auth=Yii::app()->authManager;
	if(!$auth->isAssigned($role,$uid))
	{
		if(Yii::app()->authManager->assign($role,$uid))
		{
			return Yii::app()->authManager->save();
		}
	}
	return false;
}
/*Remove any roles assigned to a user
@uid , the user id , integer

@return  null */
function clear_auth_roles($uid)
{
	//obtains all assigned roles for this user id
	$assigned_roles = Yii::app()->authManager->getRoles($uid); 
	
	//checks that there are assigned roles
    if(!empty($assigned_roles)) 
    {
        $auth=Yii::app()->authManager;
        foreach($assigned_roles as $n=>$role)
        {
			//remove each assigned role for this user
            if($auth->revoke($n,Yii::app()->user->id)) 
                Yii::app()->authManager->save();
        }
    }
}

function is_admin($uid =false)
{
	return Yii::app()->authManager->isAssigned('admin',$uid?$uid:uid());
}


function bool_to_human($assertion)
{
	return $assertion ? 'Yes' : 'No' ;
}

/*

function to return a rendom second on video to capture a screenshot at

*/

function get_random_second($duration){

//pick up a random second to capture a thumbnail
return $duration?rand(1,$duration):$GLOBALS['video_thumb_start'];

}

/*

function to fix image size depending upon given video size resolution

*/

function fix_posetr_size($video_resolution){

	return $video_resolution==STANDARD?LARGE:$video_resolution;
}


function content_id($id_){

return "content-id-".$id_;

}

function battle_title_id($id,$is_battle){

return ($is_battle ? "battle" : "video") . "-title-header-" . $id;

}
/* function to parse team name to a proper filename 
	converting each " " to  "_"
	appending the .jpg in end

	@team name , the name of team
*/
function generate_logo_name($team_name)
{
	if(is_array($team_name)){
		if(empty($team_name)){ return ''; }
		return strtolower($team_name[0])."_".generate_logo_name(array_slice($team_name,1));
	}
	else
		return trim(generate_logo_name(explode(" ",$team_name)),"_").".jpg";
}

//get command builder from the criteria
function toSQLCommand($criteria,$tableName)
{
	$schema=Yii::app()->db->schema;

	$builder=$schema->commandBuilder;

	return $builder->createFindCommand($schema->getTable($tableName), $criteria);

}


/*

function to return difference in hours between two given timestamps

*/

function hours_diff($from,$to=false){

return round((($to?$to:time()) - $from) / 3600); 


}

//filter array by removeing empty values from array
function removeElementWithValue($array, $key){
     foreach($array as $subKey => $subArray){
			  if(empty($subArray[$key]))
               unset($array[$subKey]);
     }
     
     return $array;
}


//compare parameter to set order (using with usort)
function compare($a,$b)
{
	//return ($a["commentId"]>$b["commentId"])?-1:1;
	return (strtotime($a['created'])>strtotime($b['created']))?-1:1;
}

//compare leaderboard percentage to set order (using with usort)
function order($a,$b){
	if($a["percentage"]==$b["percentage"])
	{
		if($a["total"] == $b["total"])
		{
			return orderUsername($a["userName"],$b["userName"]);
		}
		return ($a["total"] > $b["total"])?-1:1;
	}
	return ($a["percentage"]>$b["percentage"])?-1:1;
}

//order username alphabetically
function orderUsername($param1,$param2)
{
	return strnatcmp($param1, $param2);
}
function is_page($controller,$action){
	return (Yii::app()->controller->id == $controller &&  Yii::app()->controller->action->id == $action) ? true : false;
}
function is_home_page(){
		return is_page('site','index');
	}
	
//get poster image path
function poster_path($video_id,$size=false){
	
	return video_poster($video_id,fix_posetr_size($size));
}

/*

function to remove all the files in given directory
*/


function clean_dir($dir){

$files = glob($dir.DS.'*'); // get all file names
if(count($files)>1){
foreach($files as $file){ // iterate files

  if(is_file($file))
    unlink($file); // delete file
}
}
}

//cdn access path for the js
function js_cdn($file)
{
	return $GLOBALS['cdn']['enabled'] ? $GLOBALS['cdn']['js_server_url']."/".$file : base_url().'/js/'.$file;
}

//cdn access path for the css
function css_cdn($file)
{
	return $GLOBALS['cdn']['enabled'] ? $GLOBALS['cdn']['css_server_url']."/".$file : base_url().'/css/'.$file;
}

function get_random_items($arr,$total){

foreach( array_rand($arr, $total) as $k ) {
  $result[] = $arr[$k];
}

return $result;
}

/**
* Function for converting one time zone to another
* Output is SQL based format
* Not desired to be called directly
*/
function convert_timezone($sql_date,$to_timezone = false,$from_timezone = false){
	
	//sql date should be sql
	$sql_date = sql_date($sql_date);

	//set the default timezone to which to convert if not supplied
	$to_timezone = !empty($to_timezone) ? $to_timezone : Yii::app()->timeZone;
	
	//set the time zone from which to convert if not supplied
	$from_timezone = !empty($from_timezone) ? $from_timezone : $GLOBALS['timezones']['admin'];

	$date = new DateTime($sql_date, new DateTimeZone($from_timezone));
	$date->setTimezone(new DateTimeZone($to_timezone));

	//return the converted date
	return $GLOBALS['timezones']['enabled'] ? sql_date($date->format('Y-m-d H:i:s')) : $sql_date; 
}

/**
* Function for converting server time to admin time zone
*/
function server_to_admin($date)
{
	return convert_timezone($date,$GLOBALS['timezones']['admin'],Yii::app()->timeZone);
}

/**
* Function for converting admin time zone to server time zone 
*/
function admin_to_server($date)
{
	return convert_timezone($date);
}

/*
 function to return path to RSS folder files used for generating video slider on iPhone landing page
*/
function mbl_playlist_file_path(){
	return getPath4XMLFile().DS.$GLOBALS["video_slider_playlist_conf"]["iphone_videoSlider_playlist_name"];	
}

/*function rss_file_path(){

return getPath4XMLFile().DS.$GLOBALS["video_slider_playlist_conf"]["desktop_videoSlider_playlist_name"];

}*/
/*function mbl_playlist_file_url(){
	return path2url(mbl_playlist_file_path());
}
function rss_file_url(){
	return path2url(rss_file_path());
}*/

/* method to get dark status on a battle */
function get_go_dark_record_for_battle($id,$uid){

	//if old one exist for this
	return battle_user_settings_map::model()->findByAttributes(array(
		'uid' => $uid,
		'bid' => $id,
		//'type' => $type == $GLOBALS['comment_type']['video'] ? $GLOBALS['comment_type']['video'] : $GLOBALS['comment_type']['battle'])
	));
}

/* is dark preserved */
function get_preserved_settings($id,$uid = false){

	$model = get_go_dark_record_for_battle($id,uid($uid));


	return !empty($model) ? $model->is_dark : false ;
}

/* 

shift to category: if user choose parent category to create battle or add video in parent category then
shift battle/video to its 'General' category

*/
function shiftToCategory($catId)
{
	$model = new directories;
	$categoryId = $model->checkIfParent($catId);
	if(!$categoryId)
		$categoryId = $catId; 
	return $categoryId;
}
// user profile url to notification tab
function url_userNotificationTab()
{
	return Yii::app()->createAbsoluteUrl(PROFILE."#tab6");
}


//convert max video upload size to MB
function convertBytesToMB()
{
	$size = $GLOBALS['max_video_size']/(1024*1024);
	return $size." MB";
}

// add who posted the post/video also check if its created by Admin
function ifCreatedByAdmin($createdBy_id)
{
	$username="";
	$posted_by="";
	if($createdBy_id>0)
	{ 
		$username = TuneTheName(getusername($createdBy_id));	
		$posted_by ="<a href=".profile_url($createdBy_id)." title='Click to view profile'>".$username."</a>";
	}
	else
	{
		$posted_by=$GLOBALS['created_by_admin_user'];
	}
	
	return "<div class='posted_by'>Posted by: $posted_by</div>";
	
}

//process a video as battle
function process_video_as_battle($model){

	return array(

	"title"=>$model->title,
	"date_created"=>$model->uploading_date,
	"battle_id"=>$model->id,
	"created_by"=>$model->uploaded_by,
	"video"=>$model,
	"battle_model"=>false,
	"cat_id"=>$model->category,
	"is_deleted"=>$model->is_deleted,
	"type"=>!empty($model->type)?$model->type:false,

	);

}


//create playlist file for desktop and iPhone
function create_playlist_file($timeDiff,$file_path,$playlist)
{
	 //if differene in file creation and current time is greater or equals 6 hours
    if($timeDiff >= $GLOBALS["video_slider_playlist_conf"]["refresh_home_slider_playlist_time"])
    {
        //delete previous playlist
        unlink($file_path);
        // and create a new file
        file_put_contents($file_path,$playlist);
    }
    else if($timeDiff == 'NoFile')
    {
        file_put_contents($file_path, $playlist);
    }
}
//check if flame name already exists
function ifFlameNameExists($flameName,$user_id)
{
	return users::model()->count(array("condition"=>"flame_name='".$flameName."' and id!=".$user_id));
}

//generate a token which expires on same day
function generate_token($user){
	return rand(0,9).'-'.$user->id.'-'.sha1('GeH'.$user->email.'eNa'.date('Y-m-d H'));
}
function parse_token($token)
{
	$token = explode("-",$token);

	$array['uid'] = $token[1];
	$array['_token'] = $token[2];

	return $array;
}

// directory for pictures for API 

function api_dir()
{
	return directory_in_uploads($GLOBALS['conf_WS']['path_api_pics']);
}
//video poster url for api
function api_picture_url($video_id)
{
	$picturePath = video_poster($video_id);

	$tmp = explode(DS,$picturePath);
	$fileName = end($tmp);
	
	$output_large = api_dir().DS.append_text_before_file_extenstion("_large",$fileName);
	$output_small = api_dir().DS.append_text_before_file_extenstion("_small",$fileName);
	$output_thumb = api_dir().DS.append_text_before_file_extenstion("_thumb",$fileName);
	$output_slider = api_dir().DS.append_text_before_file_extenstion("_slider",$fileName);
	
	//$output = api_dir().DS.$fileName;
	$outputFileExists = file_exists($output_large);
	$originalPictureFileExists = file_exists($picturePath); 
	
	if(!$outputFileExists && $originalPictureFileExists){
		$dimension_large = explode("x",$GLOBALS['conf_WS'][LARGE]);
		$dimension_small = explode("x",$GLOBALS['conf_WS'][SMALL]);
		$dimension_thumb = explode("x",$GLOBALS['conf_WS'][THUMB]);
		$dimension_slider = explode("x",$GLOBALS['conf_WS'][VIDEOSLIDER]);

		create_image($picturePath,$output_large,$dimension_large[0],$dimension_large[1],true);
		create_image($picturePath,$output_small,$dimension_small[0],$dimension_small[1],true);
		create_image($picturePath,$output_thumb,$dimension_thumb[0],$dimension_thumb[1],true);
		create_image($picturePath,$output_slider,$dimension_slider[0],$dimension_slider[1],true);
		
		return array("large"=>path2url($output_large),"small"=>path2url($output_small),"thumb"=>path2url($output_thumb),"slider"=>path2url($output_slider));

	}
	else if($outputFileExists)
	{
		//return path2url($output); 
		return array("large"=>path2url($output_large),"small"=>path2url($output_small),"thumb"=>path2url($output_thumb),"slider"=>path2url($output_slider));
	}
	else
	{
		//if original file doesn't exists
		//in this case iphone unit will use their own no preview image
		return null;
	}
}
//append text before file extension
function append_text_before_file_extenstion($text,$fileName)
{
	if($fileName){
		$ext = file_ext($fileName);
		$file = substr($fileName,0,-4);
		return $file.$text.".".$ext;
	}
	return false;
}

//category favorite limit
function count_user_favorite_category($user_id=false)
{
	$user = get_user_by_id(uid($user_id));
	return  count(json_decode($user->fav_cat,true));
}

//remove user profile images from directory
function removeUserProfileImages($userId=false)
{
	clean_dir(profile_pics_base_dir(uid($userId)));
}
//check if user profile picture exists
function isExistProfile_picture($uid=false,$group_id=false){
	
	if(!$group_id)
		$file=user_profile_pic(uid($uid));
	else
		$file = group_logo_path($group_id);

	if(!file_exists($file)){
		return false;
	}
	return true;
}

//function to prepart browse name
function prepare_browse_name($parent,$current){
	if(!empty($parent) ||!empty($current)) {
		if($parent->id == $current->id)
			return $parent->item;
		else
			return $parent->item."(".$current->item.")";
	}
	return "";
}

/**
* Get related videos
*
* @param video_id/model $video , the video_id of the video or its model itself
*/
function get_related_videos($cat_id,$offset = 0,$limit = 5,$video_id=false){
   if(empty($cat_id)) return null;

   //get category of the video
   $parent = directories::model()->GetParent($cat_id);

   $childs = directories::model()->findAllNestedChilds($parent->id);

   $childs = array_filter(array_unique($childs));

   $criteria = new CDbCriteria;
   $criteria->addInCondition('category',$childs);
   if($video_id)
   $criteria->addNotInCondition('video_id',array($video_id));
   $criteria->limit = $limit;
   $criteria->offset = $offset;
   $criteria->order = "RAND()";

   $data = videos::model()->findAll($criteria);

   return $data;
}

//check if flame name
function checkFlameName($user_id)
{
	$user = get_user_by_id($user_id);
	
	if(!empty($user->flame_name))
	{
		return true;
	}
	return false;
}

//get category name 
function getCategoryName($id)
{
	$dir = directories::model()->find("id=".$id);
	return $dir->item;
}

//defaut scope for all videos and battles, audios

function default_model_scope(){
	return array(
            'condition'=>"is_deleted = '0' AND (( length(marked_by) - length(replace(marked_by, ',', '')) + 1) < ".$GLOBALS['inappropriate_marks_ceiling'].")",
        );
}

function dir_espn_news(){

return directory_in_uploads("espn_images");

}

//check if ark_inappropriate
	function mark_inappropriate($obj)
	{
		$mark_inapp_obj_contr = get_controller(MARKED_INAPP_OBJ);

		$marked_inapp = false;
		$marks = $mark_inapp_obj_contr->marks_info($obj);

		return $marked_inapp = $marks['total_marks'] >= $GLOBALS['inappropriate_marks_ceiling'];	
	}
	
	//temp directory for uploading profile picture
	function temp_directory_path()
	{
		return directory_in_uploads($GLOBALS['path_images'].DS.$GLOBALS['path_temporary']);
	}
	function temp_dirctory_url()
	{
		return path2url(temp_directory_path());
	}
	function temp_uploaded_profile_pic_path($uid)
	{
		return temp_directory_path().DS.uid($uid).".jpg";
	}
	function temp_uploaded_profile_pic_url($uid)
	{
		return path2url(temp_uploaded_profile_pic_path($uid));
	}

	//get last name of the team
	function getGameLastname($teamName,$league_id)
	{
		if(str_word_count($teamName)>1 && !in_array($league_id,$GLOBALS['pointspread_conf']['full_teamName_for_league_ids'])){
			$team = explode(" ",$teamName);
			return end($team);
		}
		else
		{ 
			return $teamName;
		}
	}
//get battle by id
function get_battle_by_id($id)
{
	return battles::model()->findByPk($id);
}
//get logged user's login timestamp for makeing profile picture non-cache
function get_user_login_timestamp()
{
	if(is_logged_in())
		return "?".Yii::app()->session['login_timestamp'];
	else
		return "";
}
//check if video type is comment, if yes, then return video's parent category, title and model
function get_video_comment_info($video)
	{
		if($video->type==COMMENT)
		{
			$resultArr =array();
			$comment= comments::model()->find("video_id='".$video->video_id."'");
			if(!empty($comment))
			{
				$posted = posts_comments_nm::model()->find("commentId='".$comment->id."'");
				if(!empty($posted->postId))
				{
					$videos = videos::model()->findByPk($posted->postId);
					if(!empty($videos)){
						$resultArr['title']=!empty($video->title)?$video->title:$videos->title;
						$resultArr['cat_id']=$videos->category;
						$resultArr['parent_model']=$videos;
						$resultArr['type']=VIDEO;
						$resultArr['video_id']=$video->video_id;
						$resultArr['user_id']=$video->uploaded_by;
					}
				}
				else
				{
					$battles = battles::model()->findByPk($posted->text_battle_id);
					if(!empty($battles)){
						$resultArr['title']=!empty($video->title)?$video->title:$battles->title;
						$resultArr['cat_id']=$battles->cat_id;
						$resultArr['parent_model']=$battles;
						$resultArr['type']=BATTLE;
						$resultArr['video_id']=false;
						$resultArr['user_id']=$battles->created_by;
					}
				}
				return $resultArr;
			}
			return false;
		}
		return false;
	}
/* 
check video type, i.e. if the video is uploaded as comment, category video or battle video
* old function name: check_if_video_is_battle (incase i)	
*/
//check if video is battle
	function get_video_type($video)
	{
		if($video['type'] != COMMENT){
			$criteria =  new CDbCriteria();
			$criteria->condition="video_id='".$video['video_id']."'";
			$model = battles::model()->find($criteria);
			if(!empty($model))
			{
				return BATTLE;
			}
			return VIDEO;
		}
		return COMMENT;
	}

//get glyph icons for audio/video type (battle/video/comment)
	function get_audio_video_type_icons($type)
	{
		if($type=="battle")
			return '<span class="glyphicon glyphicon-tower" title="Battle"></span>';
		elseif($type=="comment")
			return '<span class="glyphicon glyphicon-edit" title="Comment"></span>';
		else
			return '<span class="glyphicon glyphicon-facetime-video" title="Video"></span>';
	}

//get glyph icons for battle video and comment
	function get_icon_type($type)
	{
		if($type=="battles")
			return '<span class="glyphicon glyphicon-tower" title="Battle"></span>';
		elseif($type=="videos")
			return '<span class="glyphicon glyphicon-facetime-video" title="Video"></span>';
		else
			return '<span class="glyphicon glyphicon-edit" title="Comment"></span>';
	}

//method to generate the dropdown from the tree structure
function generateDroDown()
{
	$model = directories::model()->GetAllParents();
	$tree_view = new TreeDropdown();
	return $tree_view->makeDropDown($model);
}


/*
check if remote file exists or not
@file: file path
*/

	function if_remote_file_exists($file)
	{
		$ch = curl_init($file);

		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// $retcode >= 400 -> not found, $retcode = 200, found.
		curl_close($ch);
		return $retcode==200;
	}

//make url clickable in when user post comment/textboxes
	function make_url_clickable($matches) {
	$ret = '';
	$url = $matches[2];
 
	if ( empty($url) )
		return $matches[0];
	// removed trailing [.,;:] from URL
	if ( in_array(substr($url, -1), array('.', ',', ';', ':')) === true ) {
		$ret = substr($url, -1);
		$url = substr($url, 0, strlen($url)-1);
	}
	return $matches[1] . "<a target='_blank' href=\"$url\" rel=\"nofollow\">$url</a>" . $ret;
}
 
/* make ftp url clickable
function make_web_ftp_clickable($matches) { //hiding for now
	$ret = '';
	$dest = $matches[2];
	$dest = 'http://' . $dest;
 
	if ( empty($dest) )
		return $matches[0];
	// removed trailing [,;:] from URL
	if ( in_array(substr($dest, -1), array('.', ',', ';', ':')) === true ) {
		$ret = substr($dest, -1);
		$dest = substr($dest, 0, strlen($dest)-1);
	}
	return $matches[1] . "<a target='_blank' href=\"$dest\" rel=\"nofollow\">$dest</a>" . $ret;
}*/
 //make email clickable when user post email in comment/textboxes
function make_email_clickable($matches) {
	$email = $matches[2] . '@' . $matches[3];
	return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
}
 
function make_clickable($ret) {
	$ret = ' ' . $ret;
	// in testing, using arrays here was found to be faster
	$ret = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', 'make_url_clickable', $ret);
	//$ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', 'make_web_ftp_clickable', $ret);
	$ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', 'make_email_clickable', $ret);
 
	// this one is not in an array because we need it to run last, for cleanup of accidental links within links
	$ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
	$ret = trim($ret);
	return $ret;
}

//delete video by setting is_delete to 1 via video_id
function delete_video_by_video_id($video_id)
{
	$video = video_by_video_id($video_id);
	if(!empty($video)){
		$video->is_deleted=1;
		$video->save();
	}
}

//delete audio by setting is_delete to 1 via video_id
function delete_audio_by_audio_id($audio_id)
{
	$audio = get_audio_by_audio_id($audio_id);
	if(!empty($audio)){
		$audio->is_deleted=1;
		$audio->save();
	}
}

//get audios model by audio_id
function get_audio_by_audio_id($audio_id)
{
	return audios::model()->find("audio_id='".$audio_id."'");
}

//get video uploaded count
function get_videos_count($type=false,$is_deleted=false)
{
	$criteria = new CDbCriteria();

	if($type=="current_week")
	{
		$criteria->condition = "WEEK(uploading_date) = WEEK(NOW()) ".($is_deleted?" and is_deleted = 1":'');
	}
	else if($type=="current_month")
	{
		$criteria->condition = "MONTH(uploading_date) = MONTH(NOW()) ".($is_deleted?" and is_deleted = 1":'');	
	}
	else if(!$type && $is_deleted)
	{
		$criteria->condition = ($is_deleted?" is_deleted = 1":'');		
	}

	
	return videos::model()->resetScope()->count($criteria);
}  

//get audios uploaded count
function get_audios_count($type=false,$is_deleted=false)
{
	$criteria = new CDbCriteria();

	if($type=="current_week")
	{
		$criteria->condition = "WEEK(uploading_date) = WEEK(NOW())";
	}
	else if($type=="current_month")
	{
		$criteria->condition = "MONTH(uploading_date) = MONTH(NOW())";	
	}
	else if(!$type && $is_deleted)
	{
		$criteria->condition = ($is_deleted?" is_deleted = 1":'');		
	}
	
	return audios::model()->resetScope()->count($criteria);
}  
//get comments created count
function get_comments_count($type=false)
{
	$criteria = new CDbCriteria();

	if($type=="current_week")
	{
		$criteria->condition = "WEEK(createDate) = WEEK(NOW())";
	}
	else if($type=="current_month")
	{
		$criteria->condition = "MONTH(createDate) = MONTH(NOW())";	
	}
	
	return comments::model()->resetScope()->count($criteria);
} 
 //get users registered count
function get_users_registered_count($type=false,$is_deleted=false)
{
	$criteria = new CDbCriteria();

	if($type=="current_week")
	{
		$criteria->condition = "WEEK(reg_date) = WEEK(NOW())";
	}
	else if($type=="current_month")
	{
		$criteria->condition = "MONTH(reg_date) = MONTH(NOW())";	
	}
	/*else if(!$type && $is_deleted)
	{
		$criteria->condition = ($is_deleted?" is_deleted = 1":'');		
	}*/
	
	return users::model()->resetScope()->count($criteria);
} 
 //get contests created count
function get_contests_count($type=false)
{
	$criteria = new CDbCriteria();

	if($type=="current_week")
	{
		$criteria->condition = "WEEK(created) = WEEK(NOW())";
	}
	else if($type=="current_month")
	{
		$criteria->condition = "MONTH(created) = MONTH(NOW())";	
	}
	
	
	return games::model()->resetScope()->count($criteria);
} 
//get battle created count
function get_battles_count($type=false,$is_deleted=false)
{
	$criteria = new CDbCriteria();

	if($type=="current_week")
	{
		$criteria->condition = "WEEK(date_created) = WEEK(NOW()) ".($is_deleted?" and is_deleted = 1":'');
	}
	else if($type=="current_month")
	{
		$criteria->condition = "MONTH(date_created) = MONTH(NOW()) ".($is_deleted?" and is_deleted = 1":'');	
	}
	else if(!$type && $is_deleted)
	{
		$criteria->condition = ($is_deleted?" is_deleted = 1":'');		
	}

	return battles::model()->resetScope()->count($criteria);
} 

/*
save file duration via model, used For API if duration is sent via request
FOR VIDEO & AUDIO
*/

function save_file_duration($model, $duration)
{
	$model->duration = convert_time_to_seconds($duration);
	$model->save();
}

function convert_time_to_seconds($time)
{
	$duration = explode(":",$time);

	$duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);   

	return $duration_in_seconds;  
}

//get parent category via category id
function getCategoryParent($cat_id)
{
	//return row
	return directories::model()->GetParent($cat_id);
}

//update audios category
function update_audios_attributes($audio_id, $category)
{
	if(!empty($audio_id) && !empty($category)){
	
		$audio =  get_audio_by_audio_id($audio_id);
		$audio->category=$category;
		$audio->save();
	}
}

//compare and sort array aplhabetically
function orderAlphabetical($a,$b)
{
	return (($a['name'] == 'General') || ($b['name'] == 'General') )?1:orderUsername($a['name'], $b['name']);
}

/* exclude specific array, with specific value, from multi dimensional array
return both extracted and truncated array
*/
function exclude_array_from_multiD($array,$value)
{
	
	$returnArr = array();
	foreach($array as $k=>$v) {
	    if(isset($v['name']) && $v['name'] == $value) {
	        $returnArr = $array[$k];
	        unset($array[$k]);
        }
    }
	
	return array("extractedArray"=>$returnArr,"truncatedArray"=>$array);
}


//search 2D array and find specific record via array key
function searchMultiD($searchKey, $array) {
   foreach ($array as $key => $val) {
 
       if ($key === $searchKey) {
           return $val;
       }
   }
   //return null;
}

//search for value in array and remove it from array
function search_n_remove_valuefromArray($array,$value)
{
	if (($key = array_search($value, $array)) !== false) {
   	 unset($array[$key]);
	}
	return $array;
}

/* 
method to add user activity in logs 
@userId user_id of user
@log: type of log

*/
function add_in_logs($userId,$log,$content_id,$extra=false,$action=false,$addVideoId=false)
{
	get_controller(LOG)->keep_log($userId,$log,$content_id,$extra,$action,$addVideoId);
}
/* 

get array with comment's battle id and type of battle
*/

function get_comment_battle_info($array){
if(!empty($array))
	{
		$aCondition = ($array['type']=='B');
		$arrayKey=$aCondition?"battle_id":"video_id";
		$videoInfo = get_video_by_id($array['bid']);
		//var_dump($a);
		$arrayValue=$aCondition?$array['bid']:$videoInfo->video_id;
		//return array($arrayKey=>$arrayValue);
		return $arrayValue;
	}
	return false;

}

//get user favorite categories
function getUserFavCategories($uid=false)
{
	$user =	get_user_by_id(uid($uid));
	return json_decode($user->fav_cat,true);
}
	
function search_in_array($srchvalue, $array)
{
    if (is_array($array) && count($array) > 0)
    {
        $foundkey = array_search($srchvalue, $array);
        if ($foundkey === FALSE)
        {
            foreach ($array as $key => $value)
            {
                if (is_array($value) && count($value) > 0)
                {
                    $foundkey = search_in_array($srchvalue, $value);
                    if ($foundkey != FALSE)
                        return $foundkey;
                }
            }
        }
        else
            return $foundkey;
    }
}


function group_url($g_id){

return Yii::app()->createAbsoluteUrl("/".$g_id);
}

/**
  * function to return CActive Records object for the user of given email
  **/
function get_user_by_email($email)
{

  $user=users::model()->find("email='".$email."'");
  return $user==NULL?false:$user;
}

//path to groups folder
function path_to_groups()
{
	return path_to_root_dir($GLOBALS['group_conf']['group_folder']);
}

//group logo path
function group_logo_path($group_id)
{
	return directory_in_uploads($GLOBALS['group_conf']['group_folder']).DS.$group_id.".jpg";
}

//remove group logo
function removeGroupLogo($groupId)
{
	$file_path = group_logo_path($groupId);
	if(file_exists($file_path))
	{
		unlink($file_path);
	}
}


//group logo url
function group_logo_url($group_id)
{
	return path2url(group_logo_path($group_id));
}

//group logo temp dir
function temp_group_pic_path($group_id)
{
	return temp_directory_path().DS.$group_id.".jpg";
}

//group logo temp url
function temp_group_pic_url($group_id)
{
	return path2url(temp_group_pic_path($group_id));
}

/*
function to unlink file. function require full directory path of the file, 
if file exists then unlink file & return true otherwise return false
*/
function unlink_file($directory_path)
{
	if(file_exists($directory_path))
	{
		unlink($directory_path);
		return true;
	}
	return false;
}

//method to return group image, if group has no group-logo then return default image
function get_group_logo($group_id, $width=false, $height=false)
{
	if(!empty($group_id)){

		$group_logo = group_logo_path($group_id);

		if(file_exists($group_logo)){

			if(!$width || !$height)
				return group_logo_url($group_id);
			
			else {
			
				$output= directory_in_uploads($GLOBALS['group_conf']['group_folder']).DS.modified_profile_pic($group_logo,$width,$height);
				
				if(!file_exists($output))create_image($group_logo,$output,$width,$height);
		
				return path2url($output);
			}
		}



		/*if(file_exists($group_logo)){
			if(!file_exists($output))create_image($file,$output,$width,$height);
			return group_logo_url($group_id);
		

		}*/
		else
			return get_image($GLOBALS['group_conf']['group_icon']);
	}
	return get_image($GLOBALS['group_conf']['group_icon']);
}

//get battle by video_id
function get_battle_by_video_id($video_id)
{
	if(!empty($video_id)){
		$battle = battles::model()->find(array("condition"=>"video_id = '".$video_id."'"));
		if(!empty($battle))
		{
			return $battle;
		}
		return null;
	}
	return null;
}

/**
  *  method to check if existing group is created by current user
  **/

function check_group_owner($group,$user_id=false)
{

  if($group)
  {
    
    return $group->created_by==uid($user_id)?true:false;


  }

}

//get default credits set by admin
function get_default_credits()
{
	return web_config::model()->findByAttributes(array("name"=>"default_credit"));
}

//user available credits
function user_available_credits($user_id=false)
{
	$model = get_user_by_id(uid($user_id));
	if(!empty($model))
	{
		return $model->credits;
	}
	return false;
}

/**
*function to return CActive users objects by given array of user ids
*/
function getUserObjects($userIds=array())
{
	$criteria=new CDbCriteria();
    $criteria->addInCondition('id',$userIds);
    return users::model()->findAll($criteria);

}
//get user emaili via user id
function getUserEmail($userId=false)
{
	$user =user_obj($userId);
	if(!empty($user)){
		return $user->email;
	}
	return false;
}

//get all credit prices
function get_credit_quantity($quantity){
	if(is_numeric($quantity)){
		$cost  = $quantity * $GLOBALS['payment_conf']['credits_in_1Dollar'];
		//$query = !empty($amount)?"price = ".$amount:false;
		//return get_credits::model()->findAll($query);
		return $cost;
	}
}

//method to get leagues
function get_leagues()
{
	return leagues::model()->findAll();
}

/* 
check whether battle is audio/video/text battle
*/
function get_battle_type($battle_id)
{
	if(!empty($battle_id)){
		$model = battles::model()->findByPk($battle_id);
		if(!empty($model))
		{
			if(!empty($model->audio_id))
				return AUDIO;
			if(!empty($model->video_id))
				return VIDEO;

			return BATTLE;
		}
		return false;
	}
	return false;

}

//get user last payment
function get_user_last_payment($userId=false)
{
	//transactions::model()->find()
	$criteria = new CDbCriteria();
	$criteria->condition = "user_id = ".uid($userId);
	$criteria->limit = "1";
	$criteria->order = "id desc";
	$model = transactions::model()->find($criteria);

	return !empty($model)?$model:null;
}


//find content id of the battle or video on which comment is being posted
function get_post_content_id($key,$mapRelatedColumn)
{
	if($mapRelatedColumn == TEXT_BATTLE_ID)
		return $key;
	else{
		$video = get_video_by_id($key);
		if(!empty($video))
			return $video->video_id;
	}
	return null;
}

//order trends using usort
function orderTrends($a,$b)
{
	return $a['rank']>$b['rank']?-1:1;
}

function profile_tab_privacy($privacy_type,$setting=false,$profile_user_id=false,$otherUser=false)
{
	//echo "privacy_type:".$privacy_type.", profile_user_id:".$profile_user_id.", otherUser:".$otherUser."--<br>";
	//echo "<pre>";print_r($array);echo "</pre>";die;
	if(empty($setting))
	{
		return true;
	}

	if(empty($profile_user_id) && empty($otherUser))
	{
		return false;
	}
	else
	{

		if($setting[$privacy_type] == VISIBLE_FOLLOWERS)
		{
			//echo "profile_user_id:".$profile_user_id;
			$following_users = get_controller(FOLLOWING)->get_user_following_users($profile_user_id);
			//var_dump($following_users);
			if(!empty($following_users) && in_array($otherUser, $following_users)){
				//echo "here";
				return true;
			}

			return false;

		}
		else if($setting[$privacy_type] == VISIBLE_PRIVATE)
		{
			if(uid() == $profile_user_id)
				return true;
			return false;
		}
		else
		{ //public
			return true;
		}
	}
}

/**
* Get related battles
*
* @param battle_id/model $battle , the battle_id of the battle or its model itself
*/
function get_related_battles($cat_id,$offset = 0,$limit = 5,$battle_id=false){
   if(empty($cat_id)) return null;

   //get category of the video
   $parent = directories::model()->GetParent($cat_id);

   $childs = directories::model()->findAllNestedChilds($parent->id);

   $childs = array_filter(array_unique($childs));

   $criteria = new CDbCriteria;
   $criteria->addInCondition('cat_id',$childs);
   if($battle_id)
   $criteria->addNotInCondition('id',array($battle_id));
   $criteria->limit = $limit;
   $criteria->offset = $offset;
   $criteria->order = "RAND()";

   $data = battles::model()->findAll($criteria);

   return $data;
}

//compare posted by media from db to contant value
function get_post_media($media)
{
	$return=false;
	if($media == VIA_WEB)
		$return =  false;
	if($media == VIA_IOS)
		$return =  IOS;
	if($media == VIA_ANDROID)
		$return =  ANDROID;

	if($return)
		return " via ".$return;
}
/*
method to fetch battle id by video_id, IF battle is video battle
*/
function get_video_battle_id($video_id)
{
	$battle = battles::model()->find(array("condition"=>"video_id=".$video_id));
	if(!empty($battle))
	{
		return $battle->id;
	}
	return false;
}

?>