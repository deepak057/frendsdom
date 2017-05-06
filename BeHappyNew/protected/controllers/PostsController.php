<?php


class PostsController extends CController{


public function filters()
	{

	if(!$GLOBALS['app_config']['public_visibility']['posts']) {	

	
		return array(
			'accessControl', 
			
		);

	}

	return array();	

	}

	/**
	** Access rules for PostsController
	**/

	public function accessRules()
	{

	
		return array(
			array('allow',  
				'actions'=>array('post'),
				'users'=>array('@'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);

		

	}



/**
** Method to create a post
**
**/


function CreatePost($circle_id,$content=array(),$user_id=false){

$post=new posts(); //get the model

$post->created_by=helpers::uid($user_id); //Id of user that created this post

$post->circle_id=$circle_id; //Which circle this post belongs to

$post->date_created=helpers::SqlDateTime(); //Save "post creation date"
 
$post->supporting_text=!empty($content['supporting_text'])?$content['supporting_text']:""; //save "question" or "supporting text"

$post->content=!empty($content['content'])?$content['content']:""; //save post content

$post->post_image=!empty($content['post_image'])?$content['post_image']:""; //save the name of uploaded image if any

$post->save();

//save "post options if any"
Helpers::get_controller(POST_VOTE)->SaveOptions($post->id,$content['options']);

//save notification that post has been posted in a circle
$users = Helpers::get_controller(CIRCLES)->AssociatedUsers($circle_id);

//Save like notification for owner of the post

$notiController = helpers::get_controller(NOTIFICATION);

$notiController->SaveNotification($post->id,"posted","",$users,"");

return helpers::get_controller(POST_VOTE)->AddPostOptions($post);

}


/**
** Method to return a dummy POSTS object having some basic properties
**/

function GetDummyObject($content,$uid=false){

$post = new stdClass;

$post->id=rand(100,100000000);

$post->supporting_text=$content['supporting_text'];

$post->content=$content['content'];

$post->post_options=$this->DummyPostOptions($content['options']);

$post->post_image=!empty($content['post_image'])?$content['post_image']:"";

$post->created_by=helpers::uid($uid);

$post->date_created=helpers::SqlDateTime();

$post->total_votes=0;

return $post;

}


/**
** Method to get a dummy Post_options object 
** used for showing preview of a post
**/ 

function DummyPostOptions($options_array){

$return =array();

if(!empty($options_array)){

foreach($options_array as $k=>$arr){

	$option=new stdClass;

	$option->option_id=$k;

	$option->option_name=$arr['name'];

	$option->votes_percentage=0;

	$return []=$option;

}

}

return $return;

}


/**
** Method to get a post object
**/

function GetPost($post){

	if(!is_object($post)){

		return $this->PostById($post);
	}

	return $post;
}


/**
** Method to get a POST object on by its id
**/

function PostById($post_id){

$post=posts::model()->findByPk($post_id);

return $post!=NULL?helpers::get_controller(POST_VOTE)->AddPostOptions($post):false;

}



/**
** Method to get posts for given circle id
**/

function GetCirclePosts($cid,$uid=false,$offset=0,$limit=10){

$posts=posts::model()->findAll("circle_id=".$cid." order by `date_created` DESC limit ".$offset.", ".$limit);

return $posts!=NULL?helpers::get_controller(POST_VOTE)->AddPostOptions($posts):false;

}


/**
** Method to get the array of default Post options
**/

function DefaultPostOptions(){

	return $GLOBALS['app_config']['post_default_options'];
}


/**
** Method to upload a POST image
**/

function UploadPostImage($image_file,$uploaded_by=false){

//get an unique name for this uploaded file
$name=mktime()."_".Helpers::uid($uploaded_by).".".pathinfo($image_file['name'], PATHINFO_EXTENSION);

//path to save this image at
$target=directories::PathPostImage($name);

return move_uploaded_file($image_file['tmp_name'],$target) && chmod($target,0777) ?$name:false;

}


/**
** Method to delete a post
**/

function DeletePost($post_id,$uid=false){

$post=$this->PostById($post_id);

if($post && $post->created_by==Helpers::uid($uid)){

	$post->delete();

	NotificationsModel::model()->deleteAll('post='.$post_id);

	return true;
}

return false;

}


/**
** Method to return posts that are to be pushed into the browser of given user
**/

function RealTimePosts($c_id,$last_post=false,$uid=false){

$last_post=$last_post?$last_post:0;

$posts=posts::model()->findAll("circle_id={$c_id} and `id`>{$last_post} ");

return $posts==NULL?false:helpers::get_controller(POST_VOTE)->AddPostOptions($posts);

}


/**
** Method to "like" or "unlike" a given post
**/

function LikeUnlike($p_id,$action_="like",$uid=false){

$post=$this->PostById($p_id);

if($post){

$uid=helpers::uid($uid);

$likes=$post->likes;

//add "like"
if(!$action_ || $action_=="like"){

if(!in_array($uid,$likes)){

$likes[]=$uid;

//Save like notification for owner of the post

$notiController = helpers::get_controller(NOTIFICATION);

$notiController->SaveNotification($p_id,"like","",array(helpers::GetOwner($p_id)),"");

}


}

//remove "like"
else {

if(in_array($uid,$likes)){

$likes=array_diff($likes,array($uid));

//Delete like notification for owner of the post

$notiController = helpers::get_controller(NOTIFICATION);

$notiController->DeleteNotification($p_id,"like",helpers::uid());

}

}

$post->likes=json_encode($likes);

$post->save();




return helpers::get_controller(POST_VOTE)->AddPostOptions($post);

}

}



/**
** Methohd to check wether given user can access given post
**/

function CanAccessPost($post,$uid=false){

//fix post
$post=$this->GetPost($post);

if($post){

return Helpers::get_controller(CIRCLES)->CanAccessCircle($post->circle_id,$uid);

}

return false;

}




/**
** Action Method to render a single Post page
**/

function actionPost(){

if(!empty($_GET['id'])){

//get the post
$post=Helpers::get_controller(POSTS)->PostById($_GET['id']);

if(!$post || !$this->CanAccessPost($post)){

throw new CHttpException(404);

}

else {

$this->pageTitle = ucwords($post->supporting_text);

$this->render("post",array(

	"post"=>$post,
	"circle"=>Helpers::get_controller(CIRCLES)->GetCircleById($post->circle_id),

	));

}

}

}

/**
** Method to get the array containing user objects of users who have voted on a given post
**/

function GetPostVotesUsers($post_id){

	$post=$this->PostById($post_id);

	return Helpers::get_controller(USERS)->UsersbyIds($post->post_votes);
}


/**
**Method to search Posts based on the given keyword
**/

function SearchPosts($keyword,$offset=0,$limit=10){

$posts=posts::model()->findAll("(supporting_text like '%{$keyword}%' or `content` like '%{$keyword}%') and circle_id in ( select id from ".circles::model()->tableName()." where privacy = 0) order by `date_created` desc limit {$offset}, {$limit} ");

return $posts==NULL?false:helpers::get_controller(POST_VOTE)->AddPostOptions($posts);

}


/**
** Method to return the CActive object of posts that are more recent than the given date(in SQL date-time format)
** for a given circle id
**/

function GetNewPosts($cid,$date=false){

$posts=posts::model()->findAll("circle_id=".$cid." and date_created>'".$date."'");

return $posts!=null?$posts:0;

}






}


?>