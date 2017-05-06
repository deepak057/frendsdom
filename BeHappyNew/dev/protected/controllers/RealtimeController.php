<?php


class RealtimeController extends CController {


/**
** Method to return the HTML content for posts to be pushed 
** into the client's browser
**/

function RealTimePosts($c_id,$last_post=false,$uid=false){

$posts=helpers::get_controller(POSTS)->RealTimePosts($c_id,$last_post,helpers::uid($uid));

if(!empty($posts)){

foreach($posts as $post){

$return[]=helpers::WidgetOutput("Post",array("post"=>$post,"options"=>array(

		"comments_enabled"=>true,
		"class"=>Helpers::CoulmnClass(),

		)));

}

return $return;

}

return array();

}


/**
** Method to return HTML content for invites to be pushed to client's browser in realtime
**/

function RealTimeInvites($last_invite,$uid=false){

$invites=helpers::get_controller(INVITATION)->GetInvites($uid,$last_invite);

if(!empty($invites)){

foreach ($invites as $invite){

$return[]=helpers::WidgetOutput("Singleinvite",array("invite"=>$invite));

}

return $return;

}

return array();

}

/**
** Method to return HTML content for notifications to be pushed to client's browser in realtime
**/

function RealTimeNotifications($last_notification,$uid=false){

$notifications=helpers::get_controller(NOTIFICATION)->GetNotifications($uid,$last_notification);

if(!empty($notifications)){

foreach ($notifications as $notification){

$return[]=helpers::WidgetOutput("Singlenotification",array("notification"=>$notification));
	
}

return $return;

}

return array();

}

/**
** Method to return the array containing app's 
** meta info sent from client side
**/

function GetMetaInfo(){

	return !empty($_POST['app_meta'])? json_decode($_POST['app_meta'],true):array();
}




/**
** Method to return only some specific attributes of current user
** to be used on client side
**/

function UserInfo(){

	//get user
	if(Helpers::is_logged_in()){

	//get the id of current user
	$uid=Helpers::uid();

	//get app's meta info
	$app_meta=$this->GetMetaInfo();

	/*
	**Boolean variable to check wether user is logged in based on the App_meta info 
	**It Also helps find out wether a user was om Landing Page or on Dashboard
	*/
	$meta_logged_in=!empty($app_meta['logged_in']) && $app_meta['logged_in'];

	//get the User object
	$user=Helpers::get_controller(USERS)->GetUserById($uid);
		
	//Lets decide wether to show the user (that just logged in) the Welcome message
	if(!empty(Yii::app()->session['logged_in']) && !Helpers::IsToday($user->registration_date) && $meta_logged_in){
	
	$welcome=true;	
	unset(Yii::app()->session['logged_in']);
	
	}

	/**
	** check wether user is to go through the Site Tour
	** After the first login
	**/
	if($user->tour_enabled && $meta_logged_in){

	$tour_enabled=true;	

	$user->tour_enabled=0;
	
	$user->save();	

	}

	return array(

		"id"=>$uid,
		"message"=>!empty($welcome)?"Welcome back ".Helpers::get_controller(USERS)->UserName($uid):false,
		"tour_enabled"=>!empty($tour_enabled),

		);

	}

	return array();
}


/**
** Method to return the number of real-time new posts 
** for each of the circles of given user
**/

function CircleNewPosts($uid=false){

return Helpers::get_controller(NEW_POSTS)->CircleNewPosts($uid);

}



}



?>