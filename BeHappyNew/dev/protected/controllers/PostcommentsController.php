<?php


class PostcommentsController extends CController{


/**
** Method to create a "comment" record associated with a given post id
**/

function CreateComment($text,$p_id,$uid=false){

//Save comment

$comment=new post_comments;

$comment->comment_text=$text;

$comment->uid=helpers::uid($uid);

$comment->post_id=$p_id;

$comment->date=helpers::SqlDateTime();

$comment->save();


//Save comment notification for owner of the post
$notiController = helpers::get_controller(NOTIFICATION);

$notiController->SaveNotification($p_id,"comment","",array(helpers::GetOwner($p_id)),$comment->id);

return $comment;

}


/**
** Method to retreive comments on a given post
**/

function GetComments($p_id,$offset=0,$limit=false){

$limit=$limit?$limit:$GLOBALS['app_config']['default_count']['comments_count'];

//get comments
$comments=post_comments::model()->findAll("post_id=".$p_id." order by `date` desc limit ".$offset.", ".$limit);

return $comments!=null?$comments:false;

}


/**
** Method to get comments that are older than given comment id for a given post
**/

function GetOlderComments($p_id,$comment_id=false){

//conditional part of SQL query
$sql_=$comment_id?" and `id`<".$comment_id:"";

$comments=post_comments::model()->findAll("post_id=".$p_id.$sql_." order by `date` desc");

return $comments!=null?$comments:false;

}






/**
** Method to return total "comments count" on a given post 
**/


function TotalCount($post_id){

return post_comments::model()->countByAttributes(array(
                        'post_id'=>$post_id));

}


/**
** Method to delete a comment
**/

function DeleteComment($comment_id){
	if($comment_id)
	{
		$p_id = helpers::GetPostId($comment_id);

	    //Delete comment notification for owner of the post

		$notiController = helpers::get_controller(NOTIFICATION);

		$notiController->DeleteNotification($p_id,"comment",helpers::uid());
	}
	

	if(post_comments::model()->deleteAll("id=".$comment_id)){

	return true;

	}

    else {

    	return false;

    }
}

/**
** Method to update a comment on the basis of
** its id
**/

function EditComment($comment_id,$comment,$uid=false){

$comment_=post_comments::model()->findByPk($comment_id);

if($comment_->uid==helpers::uid($uid)){

$comment_->comment_text=trim($comment);

$comment_->save();

return $comment_;

}

return false;

}




}
	


?>