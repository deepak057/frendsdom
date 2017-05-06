<?php

require_once("constants.php");

require_once("global_vars.php");

require_once("html_components.php");

/**
* This class contains various general purpose public static functions
*/

class helpers{

/***
* This method returns the id of current user if $uid parameter is false 
**/

public static function uid($uid=false){

	return $uid?$uid:Yii::app()->session['uid'];

}

/**
* Method to return the Ccontroller object of a given controller name
**/


public static function get_controller($controller)
{


    $cc = Yii::app()->createController($controller);
    
	return $cc[0];


}



/**
* Method to check wether a user is logged in or not
**/

public static function is_logged_in()
{
   
	return !empty(Yii::app()->session['uid']);
 
   
}

/*Method to get time 
Elapsed time*/

function timeAgoFromDate ($time)
{
	$time = strtotime($time);
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}

/**
*method to get Base URL of the app
*/

public static function base_url(){

return Yii::app()->request->getBaseUrl(true);

}


/**
*Method to get the URL of a static image
*/


public static function get_image($image){

return self::base_url().'/static/images/'.$image;

}

/**
*Method to return current year
*/

public static function current_year(){

    return date("Y");

}

/**
** This method returns the SHA1 hash for a given string
**/

public static function encrypt($str){

	return sha1($str);
}


/**
** Method to check wether a given component has to be enabled or not
**/

public static function IsComponentVisible($component){

if($GLOBALS['app_config']['app_components'][$component]){

return self::is_logged_in();
	

}

return true;	

}



/**
** Method to return a given value on HTML pages
** returns N/A if value is empty 
**/

public static function PrintValue($val,$na=true){

return !empty($val)?$val:($na?"N/A":"");

}



/**
** Method to create cookies
**/

public static function CreateCookie($name,$value,$expire_date=false){

$expire_date=$expire_date?$expire_date:time() + (7*60*60*24); //7 days

$cookie = new CHttpCookie($name, $value);

$cookie->expire = $expire_date; 

return Yii::app()->request->cookies[$name]=$cookie;


}

/**
** Method to get CActive object of currently logged in user
*/

public static function GetUser($uid=false){

		return helpers::get_controller(USERS)->GetUserById($uid);
	
}



/**
** Method to be called everytime the app starts
*/

 public static function pre_action_call(){

 	/*first, check if user is to be auto logged in 
	** only if user hasn't invoked site/logout URL
	**/
 	//if(Yii::app()->controller->action->id=="logout")	
  	self::get_controller(USERS)->CheckLogin();
 }



/**
** Method to access custom Global variables
**/

  public static function Config($variable){

	return $GLOBALS['app_config'][$variable];
	
  }


/**
** This method when invoked checks if a user is found logged in
** and if so, redirects them to app's root URL
**/

public static function ToAppRoot(){

if(self::is_logged_in()){

Yii::app()->request->redirect(self::base_url());

}

}



/**
** Method to return date string in MySQL datetime format
**/

public static function SqlDateTime($ts=false){


return date('Y-m-d H:i:s',(!$ts?time():$ts));

}

/**
** Method to convert a given date( in SQL datetime format) to
** an User frielndly format
**/

public static function AppDate($date=false){

return date ('F d, Y ',$date?strtotime($date):time());

}


/**
** Method to check wether given date is today
**/

public static function IsToday($timestamp){

if(empty($timestamp))return false;

return date('Ymd') == date('Ymd', strtotime($timestamp));

}



/**
** Method to return MYSQL query for inserting multiple records into the given table
** based on the given array that contains the coulmn names and their values
**/


public static function SQLMultipleRowsQuery($table_name,$array){


}

/***
** Method to execute a given SQL raw query
**/ 

public static function ExecuteQuery($sql){

$connection = Yii::app() -> db;
$command = $connection -> createCommand($sql);
$command -> execute();

return $command;

}

/**
** Method to remove last occurance of a string in given STRING
**/


public static function LStrReplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}


/**
** Method to pick up a random element from given array
**/

public static function PickRandom($arr,$n=false){

if(!$n || $n==1)
return $arr[array_rand($arr)];

else if(count($arr)<$n)
return $arr;

else {

$rand_keys = array_rand($arr, $n);

if(count($rand_keys)){

foreach($rand_keys as $k_){

$return[]=$arr[$k_];

}

return $return;

}


}

}

/**
** Method to check if the given file is a valid image file
**/

public static function IsValidImage($file){

return getimagesize($file); 

}


/***
** Method to return the appropriate class name for 
** given number of coulmns
**/

public static function CoulmnClass($cols=false){

	$cols=!$cols?$GLOBALS['app_config']['posts_grid']['column']:$cols;

	$col=(int)12/$cols;

	if($col%2!=0)$col++;

	return "col-sm-".$col;
}


/***
** This method returns the HTML Output of the given widget
***/

public static function WidgetOutput($widget_,$params_=array()){

ob_start();
Yii::app()->controller->widget($widget_,$params_);
return ob_get_clean();


}

/**
** Method to linkify a given piece of text
**/

function Linkify($string=""){

return preg_replace(
              "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~",
              "<a target='blank_' href=\"\\0\">\\0</a>", 
              $string);

}


/**
** Method to display text
**/

public static function Text($text,$nl2br=true,$na=true){

    $text_= empty($text)?self::PrintValue($text,$na):htmlspecialchars( $text);

    return self::Linkify($nl2br?nl2br($text_):$text_);
}

/**
** Method to filter out duplicate values and return array 
** only with unique elements
**/
public static function ArrayUnique($arr){

return array_filter(array_unique($arr));

}


/** 
** Method to return equivelent color to given action
*/

public static function FixColor($action){

if(strpos($action, "info")!==false)
	return "cyan";

if(strpos($action, "danger")!==false)
	return "red";

if(strpos($action, "success")!==false)
	return "green";

if(strpos($action, "warning")!==false)
	return "orange";

return "blue";

}


/**
** Method to return any random color
**/

public static function RandomColor(){

return self::PickRandom($GLOBALS['app_config']['colors']);

}

/**
** Method to check wether current page is home page or not
**/

public static function IsHome(){

$controller = Yii::app()->getController();

return $controller->getId() == 'site' && $controller->getAction()->getId() == 'index';

}



/**
** Method to return the content for site configuration
** this info is meant to be used on client side
**/

public static function AppMetaInfo(){


	return array(

		"controller"=>Yii::app()->controller->id,
		"action"=>Yii::app()->controller->action->id,
		"logged_in"=>self::is_logged_in(),
		"root_url"=>self::base_url(),


		);
}


/**
** Method to truncate the long texts and put a "read more"
** button that allows expanding the rest of the text
**/

public static function TruncateText($text,$chars=300,$class="c-gray pointer small hover_highlight"){

/**
**proceed only if the string length of given text is greater than
** the number of characters after which the text has to be truncated
**/

if(!empty($text) && strlen($text)>$chars){

//variables for holding two parts of the given string
$str1="";$str2="";

for($i=0;$i<$chars;$i++){

$str1.=$text[$i];

}

for($i=$chars;$i<strlen($text);$i++){

$str2.=$text[$i];

}

return $str1."<span class='read-more-btn ".$class."'>... read more</span><span class='none'>".$str2."</span>";

}

return $text;

}


/**
** method to pick a random image from given directory
**/

public static function RandomPic($imagesDir,$url=false){

$images = glob($imagesDir . '*.{jpg,,JPG,jpeg,png,gif}', GLOB_BRACE);

return $url?AppURLs::Path2URL($images[array_rand($images)]):$images[array_rand($images)];

}


/**
** Method to return the URL of the pic that will be used
** as the main background image on landing page
**/

public static function LandingPageImage(){

return self::RandomPic(Directories::BasePath().DS."static".DS."images".DS."bgs".DS,true);

}

/*Get owner of the post*/
public static function GetOwner($post_id)
{
	$post = posts::model()->find("id=".$post_id);
	if($post)
	{
		return $post->created_by;	
	}
	else
	{
		return false;
	}
}

/*Get post_id of the comment*/
public static function GetPostId($comment_id)
{
	$post = post_comments::model()->find("id=".$comment_id);
	if($post)
	{
		return $post->post_id;	
	}
	else
	{
		return false;
	}
}


}



/**
* Class containing methods for obtaining different kind of URLs
*/

class AppURLs extends helpers
{

	
/**
** method to convert a given SYSTEM PATH into an absolute URL
**/

public static function Path2URL($file, $Protocol='http://') {
	
    if(strtoupper(substr(PHP_OS,0,3))==='WIN'){

	$file_p=str_replace('\\','/',$file);
        $file_p=str_replace($_SERVER['DOCUMENT_ROOT'],'',$file_p);
        $url= $Protocol.$_SERVER['HTTP_HOST']."/".$file_p;

    }

    else {

    $url= $Protocol.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);

    }


	return file_exists($file) && self::IsValidImage($file)?$url."?".filemtime($file):$url;
}


/**
** Method to return the Single Post page URL for given post id
**/

public static function PostURL($post_id){

return Yii::app()->createAbsoluteUrl("post/".$post_id);

}


/**
** Method to return the Single Circle page URL for given circle id
**/

public static function CircleURL($circle_id){

return Yii::app()->createAbsoluteUrl("circle/".$circle_id);

}



/**
** Method to return the URL of a "post image"
**/

public static function PostImageURL($image_name){

return self::Path2URL(directories::PathPostImage($image_name));

}

/**
** Method to return the URL of a "circle image"
**/

public static function CircleImageURL($image_name){

return self::Path2URL(directories::PathCircleImage($image_name));

}


/**
** Method to return the URL of a "Profile Picture"
**/

public static function ProfilePictureURL($image_name){

return self::Path2URL(directories::PathProfilePicture($image_name));

}


	
/**
* Get LogOut URL
*/

public static function LogOutURL(){

	return Yii::app()->createAbsoluteUrl("site/logout");
}

/**
** Get theme's root URL
*/

public static function ThemeUrl(){

return self::base_url()."/static/theme/material";

}

/**
** URL to a given user's profile
**/

public static function ProfileURL($uid=false){

	return Yii::app()->createAbsoluteUrl("user/".self::uid($uid));
}

/**
** URl to "static" directory which contains static client side content such
** as JS, CSS, Fonts, Jquery plugins etc
**/

public static function StaticContentURL(){

	return self::base_url()."/static";
}

/**
** Method to return the URL of given Bundle directories inside "static"
**/

public static function BundleURL($bundle){

return self::StaticContentURL()."/bundles/".$bundle;

}


/**
** Get the URL of Inbox
**/

public static function InboxURL(){

	return Yii::app()->createAbsoluteUrl("Inbox");
}


/**
** Method to return the absolute URL of search page
**/

public static function SearchURL(){

return Yii::app()->createAbsoluteUrl("search");

}


/**
** Method to return the absolute URL of given page
**/

public static function PageURL($page){

return Yii::app()->createAbsoluteUrl("pages/".$page);

}



}



/**
** Class containing methods to manipulate directories
** and internal paths required and used by the application
**/


class Directories extends AppURLs {


/**
** Method to return the Root path of the app
**/ 

public static function BasePath(){

return str_replace(DS."protected","",Yii::app()->basePath);

}


/**
** Method to return path of "uploads" directory
**/

public static function UploadsDir(){

return self::CheckDir(self::BasePath().DS.$GLOBALS['app_config']['directories']["uploads"]);

}


/** 
** method to return path of a directory that is inside "uploads"
**/

public static function DirInUploads($dir){

	return self::CheckDir(self::UploadsDir().DS.$dir);

}

/**
** method to return path of a given "post image"
**/

public static function PathPostImage($img_name){

return self::dirInUploads($GLOBALS['app_config']['directories']["post_images"]).DS.$img_name;

}

/**
** method to return path of a given "circle image"
**/

public static function PathCircleImage($img_name){

return self::dirInUploads($GLOBALS['app_config']['directories']["circle_images"]).DS.$img_name;

}

/*
** Method to return path of Profile Picture of given user
*/

public static function PathProfilePicture($img_name){

if (!filter_var($img_name, FILTER_VALIDATE_URL) === false) {
	return $img_name;
}
else
{
	return self::dirInUploads($GLOBALS['app_config']['directories']["profile_pictures"]).DS.$img_name;
}

}



/**
** Method to check if the given
** directory exists and if it doesn't
** then create it
**/

public static function CheckDir($dir){

if(!file_exists($dir)){

	@mkdir($dir);

	@chmod($dir,0777);
}

return $dir;

}



}




?>