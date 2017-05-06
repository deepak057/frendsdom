<?php


class AjaxController extends CController{



/***
** Method to print JSON response
**/

function PrintResponse($arr){

		header('Content-type: application/json');
		echo json_encode($arr);
		exit;

}


function GetResponseArray($status,$message,$data=array()){

return array(

	"status"=>$status?1:0,
	"message"=>$message,
	"data"=>$data


	);

}



/*
*** Login via Ajax
*/

function actionLogin(){


if(!empty($_POST['email']) && !empty($_POST['password'])){

	$user=helpers::get_controller(USERS); //get Users Controller object

	$user=$user->LoginValidate($_POST['email'],$_POST['password'],true,!empty($_POST['remember']));

	if($user){


		$response_=$this->GetResponseArray(true,"Successfully logged in",$user);


	}


	else {

		$response_=$this->GetResponseArray(false,"Invalid email or password");
	}


	$this->PrintResponse($response_);

}


}

/**
** Method to register a user
*/

function actionRegister(){

if(!empty($_POST['email']) && !empty($_POST['password'])){

	//first, check if email is already registered
	if($this->IsRegistered($_POST['email'])){
	
	$response_=$this->GetResponseArray(false,"A user already exists with this email");

	}

	else {

	$user=helpers::get_controller(USERS); //get Users Controller object

	$user_new=$user->Register($_POST['email'],$_POST['password'],empty($_POST['no_auto_login']));

	if($user_new){

	$response_=$this->GetResponseArray(true,"Successfully registered",$user_new);

	}

	else {

		$response_=$this->GetResponseArray(false,"Failed to register");


	}
	
	}

	$this->PrintResponse($response_);

}

}


/**
** Method to check if the given email is registered with app
**/

function IsRegistered($email){

$user=helpers::get_controller(USERS); //get Users Controller object

return $user->IsRegistered($_POST['email']);


}


function actionIsRegistered(){

if(!empty($_POST['email'])){

$user=$this->IsRegistered($_POST['email']);

if($user){

$response_=$this->GetResponseArray(true,"A user already exists with this email",$user);

}

else {

$response_=$this->GetResponseArray(false,"User doesn't exist");


}

$this->PrintResponse($response_);

}

}

function actionSendRestPasswordLink(){

if(!empty($_POST['email'])){

$user=$this->IsRegistered($_POST['email']);

if(!$user){

$response_=$this->GetResponseArray(false,"Sorry, this email is not registered with us.",$user);

}

else {

if(helpers::get_controller(USERS)->SendPasswordResetLink($_POST['email']))
$response_=$this->GetResponseArray(true,"We have successfully sent a mail to your email address (".trim($_POST['email']).") with further instructions. Please check your mail.",$user);

else
$response_=$this->GetResponseArray(false,"Sorry, failed to send mail. Please try later.",$user);

}

$this->PrintResponse($response_);

}

}


/**
** Method to set a new password for the
** given user on the basis of given unique hash
**/

function actionResetPassword(){


	if(!empty($_POST['password']) && !empty($_POST['hash'])){


		//get user controller 
		$user=helpers::get_controller(USERS);

		if($user->ChangePasswordByHash($_POST['password'],$_POST['hash'])){

		$response_=$this->GetResponseArray(true,"Your account password is successfully changed.");	

		}

		else {

			$response_=$this->GetResponseArray(false,"Sorry, failed to set new password.");
		}


		$this->PrintResponse($response_);


	}


}


/**
** Method to create a circle by its title
**/


function actionCreateCircle(){


	if(!empty($_POST['title'])){

		//get Circle controller
		$circle_controller=helpers::get_controller(CIRCLES);

		$circle_obj=$circle_controller->CreateCircle(array(

		"title"=>$_POST['title'],
		"circle_image"=>empty($_POST['circle_image'])?"":$_POST['circle_image'],
		"privacy"=>!empty($_POST['privacy']) && $_POST['privacy']=='public'?0:1,

		));

		//create circle
		if($circle_obj){

		$response_=$this->GetResponseArray(true,"Circle successfully created.",$this->WidgetOutput("Circlesslider",array("container_width"=>!empty($_POST['container_width'])?$_POST['container_width']:false)));	

		}

		else {
		
		$response_=$this->GetResponseArray(false,"Failed to create circle.");	


		}

		$this->PrintResponse($response_);


	}


}

function actionGetCircleData(){


if(!empty($_POST['cid'])){

//get the circle
$circle=helpers::get_controller(CIRCLES)->GetCircleById($_POST['cid']);	

if($circle){

$response=$this->GetResponseArray(true,"Circle is found.",$this->WidgetOutput("Circledata",array("circle"=>$circle)));

//Keep record of when current user visited this circle last time
Helpers::get_controller(NEW_POSTS)->CircleVisited($_POST['cid']);

}

else {

$response=$this->GetResponseArray(false,"The circle doesn't exist.");


}

$this->PrintResponse($response);


}

}


/***
** This method returns the HTML Output of the given widget
***/

function WidgetOutput($widget_,$params_=array()){

return helpers::WidgetOutput($widget_,$params_);

}

/**
** Method to create a new post
**/

function actionCreatePost(){


if(!empty($_POST['cid'])){

//get Posts controller
$post=helper::get_controller(POSTS);

//prepare "content" array
$content=array(

"supporting_text"=>!empty($_POST['supporting_text'])?$_POST['supporting_text']:"",
"content"=>!empty($_POST['content'])?$_POST['content']:""

);

//get the user id, default is the id of current user
$uid=!empty($_POST['uid'])?$_POST['uid']:helpers::uid();

$post=$post->CreatePost($_POST['cid'],$content,$uid);


if($post){

$response=$this->GetResponseArray(true,"Post created successfully",$post);


}


else {

$response=$this->GetResponseArray(false,"Failed to create this post");


}


$this->PrintResponse($response);


}



}


/**
** Method to return the HTML content for Previewing a post
**/

function actionPreviewPost(){


	if(!empty($_POST['content'])){


		//get controller
		$post_c=helpers::get_controller(POSTS);

		//get post
		$post=$post_c->GetDummyObject(json_decode($_POST['content'],true));

		if($post){

			$response=$this->GetResponseArray(true,"Post preview generated successfully",$this->WidgetOutput("Post",array("post"=>$post)));


		}

		else {

			$response=$this->GetResponseArray(false,"Failed to generate Post preview");

		}


		$this->PrintResponse($response);



	}
}

/***
** This method creates a "Status" post tagged to given circle id
**/

function actionSaveStatus(){


	if(!empty($_POST['cid']) && !empty($_POST['content'])){

		
		//get Posts controller
		$posts_c=Helpers::get_controller(POSTS);

		//create post
		$post=$posts_c->CreatePost($_POST['cid'],json_decode($_POST['content'],true));

		if($post){
		
		$output=!empty($_POST['all_posts'])?$this->WidgetOutput("Circledata",array("circle"=>$_POST['cid'])):$this->WidgetOutput("Post",array("post"=>$post,"options"=>array(

			"comments_enabled"=>true,
			"class"=>Helpers::CoulmnClass(),

			)));
	
		$response=$this->GetResponseArray(true,"Post created successfully",$output);


		}

		else {

		$response=$this->GetResponseArray(false,"Failed to create post");

		}


		$this->PrintResponse($response);
	}


}

/***
** Method to output the HTML content for rendering 
** 'Invite People' popup
**/


function actionInvitePeople(){

if(!empty($_POST['cid'])){

$response=$this->GetResponseArray(true,"Invite people",$this->WidgetOutput("Invitepeople",array("circle"=>$_POST['cid'])));

$this->PrintResponse($response);


}


}

/**
** Method to Upload Post Image
**/

function actionUploadPostImage(){

if(!empty($_FILES['post_image'])){

if(!Helpers::IsValidImage($_FILES['post_image']['tmp_name'])){

$response=$this->GetResponseArray(false,"Invalid image file.");

$this->PrintResponse($response);

}

//save the uploaded image
$image=Helpers::get_controller(POSTS)->UploadPostImage($_FILES['post_image']);


if($image){

$response=$this->GetResponseArray(true,"Image successfully uploaded.",array("image"=>$image,"image_url"=>AppURLs::PostImageURL($image)));

$this->PrintResponse($response);


}

}

}


/**
** Action to get HTML content for rendering "Add Post" popup
**/

function actionLoadAddPost(){


	if(!empty($_POST['cid'])){

		$circle=Helpers::get_controller(CIRCLES)->GetCircleById($_POST['cid']);

		if(empty($circle)){

			$response=$this->GetResponseArray(false,"Circle not found.");

		}


		else {

			$response=$this->GetResponseArray(true,"Circle found", $this->WidgetOutput("Addpost",array("circle"=>$circle)));

		}


		$this->PrintResponse($response);


	}


}


/**
** Action to create voting record on a given post 
**/

function ActionVote(){

if(!empty($_POST['post_id']) && !empty($_POST['option_id'])){

//model object
$post_poll=helpers::get_controller(POST_VOTE)->Vote($_POST['post_id'],$_POST['option_id']);

if($post_poll){

$response=$this->GetResponseArray(true,"Successfully voted.",$this->WidgetOutput("Post",array(

	"post"=>helpers::get_controller(POSTS)->PostById($_POST['post_id']),
	"options"=>array(

		"comments_enabled"=>true,
		"class"=>Helpers::CoulmnClass(),

		),

		)));

}

else {

$response=$this->GetResponseArray(false,"Failed to vote.");

}

$this->PrintResponse($response);

}

}


function ActionDeletePost(){


	if(!empty($_POST['post_id'])){

		if(helpers::get_controller(POSTS)->DeletePost($_POST['post_id'])){

			$response=$this->GetResponseArray(true,"Post successfully deleted.");

		}

		else {

			$response=$this->GetResponseArray(false,"Failed to delete the post.");

		}


		$this->PrintResponse($response);


	}


}


/**
** Method to Upload Circle Image
**/

function actionUploadCircleImage(){

if(!empty($_FILES['circle_image'])){

if(!Helpers::IsValidImage($_FILES['circle_image']['tmp_name'])){

$response=$this->GetResponseArray(false,"Invalid image file.");

$this->PrintResponse($response);

}

//save the uploaded image
$image=Helpers::get_controller(CIRCLES)->UploadCircleImage($_FILES['circle_image']);


if($image){

$response=$this->GetResponseArray(true,"Image successfully uploaded.",array("image"=>$image,"image_url"=>AppURLs::CircleImageURL($image)));

$this->PrintResponse($response);


}

}

}


/**
** Method to return HTML content for rendering "Add circle" popup
**/


function actionLoadAddCirclePopup(){

if(!empty($_POST['flag'])){

$this->PrintResponse($this->GetResponseArray(true,"Add circle",$this->WidgetOutput("Addcircle")));

}


}

/**
** Method to return posts for a given circle id 
**/

function actionGetPosts(){


	if(!empty($_POST['cid']) && !empty($_POST['offset'])){

		$limit=10;

		//get posts
		$posts=Helpers::get_controller(POSTS)->GetCirclePosts($_POST['cid'],Helpers::uid(),$_POST['offset']*$limit,$limit);


		if($posts){

		$response=$this->GetResponseArray(true,"Posts found",$this->WidgetOutput("Postgrid",array("posts"=>$posts)));


		}


		else {

			$response=$this->GetResponseArray(false,"No posts found");

		}


		$this->PrintResponse($response);

	}


}

/**
** Method to return array of users whose email is matched with posted Keyword
** in a JSON encoded format so that client side "auto suggestions" can be generated
**/

function actionSearchPeople(){


	if(!empty($_GET['q'])){

		//get user controller
		$users_c= Helpers::get_controller(USERS);
		
		//get Users
		$users=$users_c->SearchUsers($_GET['q']);
		
		//final array to be returned
		$return=array(); 

		if($users){

			foreach($users as $user){

				$return[]=array(

					"id"=>$user->id,
					"name"=>$users_c->UserName($user),
					"image"=>$users_c->ProfilePicURL($user),

					);
			}
		}	

		$this->PrintResponse($return);
	}
}


/**
** Method to Send invites
** to the users based on their given ids
**/

function actionSendInvites(){


if(!empty($_POST['data_']) && !empty($_POST['cid_']) ){


$users_=json_decode($_POST['data_'],true);

if(!empty($users_)){

$invite_c=Helpers::get_controller(INVITATION);
$circle_c=Helpers::get_controller(CIRCLES);

foreach ($users_ as $user){

//send invite only if invited user is not already associated with given circle

if(!$circle_c->GetUserCircle($_POST['cid_'],$user['id'])) 
$invite_c->sendInvite(Helpers::uid(),$user['id'],$_POST['cid_']);

}

$response=$this->GetResponseArray(true,"Invites sent successfully.");

}

else {

$response=$this->GetResponseArray(false,"Failed to send invites.");


}


$this->printResponse($response);



}



}


/***
** Method to handle acception or rejection of a circle invitation
**/

function actionHandleInvite(){


	if(!empty($_POST['action'])  && !empty($_POST['invite_id'])  ){

		$msg=$_POST['action']=="accept"?"Accepted":"Rejected";

		//handle this invitation and get the id of "circle" in a variable
		$cid_=helpers::get_controller(INVITATION)->HandleInvite($_POST['invite_id'],$_POST['action']);

		if($cid_){

		$response=$this->GetResponseArray(true,$msg,$this->WidgetOutput("Circlesslider",array("container_width"=>!empty($_POST['container_width'])?$_POST['container_width']:false)));

		}

		else {

			$response=$this->GetResponseArray(false,"failed to perform this action.");

		}

		$this->printResponse($response);

	}

}


/**
** Method to provide JSON response containing data/info to be shown in real time on client's browser
**/

function actionRealtime(){

if(helpers::is_logged_in()){

//Get instance of Realtime controller
$rt=Helpers::get_controller(REALTIME);

//Get realtime posts
$posts=!empty($_POST['current_circle'])?$rt->RealTimePosts($_POST['current_circle'],$_POST['first_post']):array();

//Get realtime invites
$invites=$rt->RealTimeInvites(!empty($_POST['last_invite'])?$_POST['last_invite']:0);

//Update the "last_visit" date for currently selected Circle
if(!empty($_POST['current_circle']))
Helpers::get_controller(NEW_POSTS)->CircleVisited($_POST['current_circle']);

$this->PrintResponse($this->GetResponseArray(true,"Success",array(

								//send posts
								"posts"=>$posts,
								
								//send invites
								"invites"=>$invites,

								//current user's info to be sent to the client side	
								"user"=>$rt->UserInfo(),
								
								//get number of new posts for each of the current user's circles
								"circle_new_posts"=>$rt->CircleNewPosts(),

								)));
}


else {

$this->PrintResponse($this->GetResponseArray(false,"User is not logged in"));

}


}


/**
** Method to like or unlike a post
**/

function actionLikeUnlike(){

if(!empty($_POST['p_id']) && !empty($_POST['action'])){

//do the "like" or "unlike" and get the Post object
$post=Helpers::get_controller(POSTS)->LikeUnlike($_POST['p_id'],$_POST['action']);

if($post){

$response=$this->GetResponseArray(true,"Success",$this->widgetOutput("Post",array(

	"post"=>$post,
	"options"=>array(

		"comments_enabled"=>true,
		"class"=>Helpers::CoulmnClass(),

		),


		)));

}

else {

$response=$this->GetResponseArray(false,"Failed to like this post");

}


$this->PrintResponse($response);

}

}


/**
** Action to create a comment on a given post
**/

function actionComment(){

if(!empty($_POST['text']) && !empty($_POST['p_id'])){

//create comment
$comment=helpers::get_controller(COMMENTS)->CreateComment($_POST['text'],$_POST['p_id']);

if($comment){

$response=$this->GetResponseArray(true,"Comment posted successfully",$this->WidgetOutput("SingleComment",array("comment"=>$comment)));

}

else {

$response=$this->GetResponseArray(false,"Failed to post comment");

}

$this->PrintResponse($response);

}

}


/**
** Method to delete a comment based on its given id
**/

function actionDeleteComment(){

if(!empty($_POST['comment_id'])){

//delete the comment
$success=Helpers::get_controller(COMMENTS)->DeleteComment($_POST['comment_id']);

if($success){

$response=$this->GetResponseArray(true,"Comment successfully deleted.");

}

else {

$response=$this->GetResponseArray(false,"Failed to delete comment.");

}

$this->printResponse($response);

}

}


/**
** Method to get al the remaining comments on a given post in HTML format
**/

function actionLoadMoreComments(){

if(!empty($_POST['post_id'])){

//get the id of last comment
$last_comment=!empty($_POST['last_comment_id'])?$_POST['last_comment_id']:false;

//get older comments
$comments=Helpers::get_controller(COMMENTS)->GetOlderComments($_POST['post_id'],$last_comment);

if($comments){

$response="";

foreach($comments as $comment){

$response.=$this->WidgetOutput("SingleComment",array("comment"=>$comment));

}

$this->printResponse($this->GetResponseArray(true,"More comments found.",$response));


}

else {

$this->printResponse($this->GetResponseArray(false,"No More comments on this post."));


}

}

}


/**
** Method to get HTML content for showing list of people who have voted
** on the post of given id
**/

function actionGetPostVotes(){

	if(!empty($_POST['post_id'])){

    //get users who have voted on this post
	$users=Helpers::get_controller(POSTS)->GetPostVotesUsers($_POST['post_id']);	

	if($users){

		$response=$this->GetResponseArray(true,"Votes successfully retreived.",$this->WidgetOutput("Peoplelist",array("users"=>$users)));

	}

	else {

		$response=$this->GetResponseArray(false,"No users voted on this post yet.");

	}

	$this->printResponse($response);

	}


}


/**
** Method to upload profile picture
**/

function actionUploadProfilePicture(){

if(!empty($_FILES['profile_pic'])){

if(!Helpers::IsValidImage($_FILES['profile_pic']['tmp_name'])){

$response=$this->GetResponseArray(false,"Invalid image file.");

$this->PrintResponse($response);

}

//save the uploaded image
$user=Helpers::get_controller(USERS)->UploadProfilePicture($_FILES['profile_pic']);

if($user){

$response=$this->GetResponseArray(true,"Image successfully uploaded.", $this->WidgetOutput("Profilepicture",array("user"=>$user)));
	
}

else {

$response=$this->GetResponseArray(false,"Failed to save image.");


}

$this->PrintResponse($response);

}

}


/**
** Method to remove the profile picture of current user
**/

function actionRemoveProfilePic(){

if(!empty($_POST['flag'])){

$user=Helpers::get_controller(USERS)->RemoveProfilePic();

if($user){

$response=$this->GetResponseArray(true,"Picture successfully removed.", $this->WidgetOutput("Profilepicture",array("user"=>$user)));

}

else {

$response=$this->GetResponseArray(false,"Failed to remove picture.");

}

$this->PrintResponse($response);

}

}

/**
** Method to update profile info
**/

function actionSaveProfileInfo(){

if(!empty($_POST['data'])){

//get Users controller
$user_c=Helpers::get_controller(USERS);	

//Save this data
$user=$user_c->SaveProfileInfo(json_decode($_POST['data'],true));

if($user){

$response=$this->GetResponseArray(true,"Profile successfully updated.",$user_c->GetAboutContent($user));

}

else {

$response=$this->GetResponseArray(false,"Failed to update your profile.");

}

$this->PrintResponse($response);

}

}

/**
** Method to send a message to a given user
**/

function actionSendMessage(){

if(!empty($_POST['message']) && !empty($_POST['to'])){

//send the message
$msg=Helpers::get_controller(MESSAGES)->SendMessage($_POST['message'],$_POST['to']);

if($msg){

$response=$this->GetResponseArray(true,"Message successfully sent",$this->GetAfterMessageSentView($msg));

}

else {

$response=$this->GetResponseArray(false,"Failed to send message");

}

$this->PrintResponse($response);

}

}


/**
** 
**/

function GetAfterMessageSentView($msg){

//get the HTML to send to the client
return empty($_POST['single_message_view'])?$this->WidgetOutput("Sendmessage",array(

	"user"=>Helpers::get_controller(USERS)->GetUserById($_POST['to']))):

	Helpers::get_controller(INBOX)->GetSingleMessageView($msg);
	
	

}


/**
** Method to get the HTML for rendering conversation view (with current user)
**/

function actionGetConversation(){

	if(!empty($_POST['uid'])){

		$response=$this->GetResponseArray(true,"Conversation found",Helpers::get_controller(INBOX)->GetConversationView($_POST['uid']));

		$this->PrintResponse($response);

	}
}


/**
** Method to return HTML for search results that are loaded as part of auto-loading process
** on the client side
**/

function actionSearch(){

	if(!empty($_POST['type'])){

		//get the limit and offset values
		$limit=$GLOBALS['app_config']['default_count']['search_items_per_page'];
		$offset=!empty($_POST['offset'])?$_POST['offset']*$limit:0;

		//get the keyword, allow search for even empty keywords
		$k=empty($_POST['k'])?"":$_POST['k'];

		//get data, the HTML to be printed on the client side
		$data=Helpers::get_controller(SEARCH)->GetResults($k,$_POST['type'],$offset,$limit);

		if(!empty($data)){

		$response=$this->GetResponseArray(true,"Results found.",$data);	
			
		}

		else {

		$response=$this->GetResponseArray(false,"No more results found.");	

		}

		$this->printResponse($response);
	}
}

/**
** Method to return the HTML output of Circles Bar widget
**/

function actionGetCirclesBar(){

if(!empty($_POST['flag'])){

$this->PrintResponse($this->GetResponseArray(true,"Circles",$this->WidgetOutPut("Circlesbar")));

}

}


/**
** Method to get the HTML for "circle settings"
**/

function actionCircleSettings(){

if(!empty($_POST['cid'])){

$data=Helpers::get_controller(CIRCLES)->CirclesSettingsView($_POST['cid']);

$this->PrintResponse($this->GetResponseArray(true,"Circle Settings",$data));

}


}

/**
** Method to update a given circle
** Updates its title and pic name
**/

function actionUpdateCircle(){

	if(!empty($_POST['cid']) && !empty($_POST['title'])){

		//update the circle
		$circle=Helpers::get_controller(CIRCLES)->UpdateCircle($_POST['cid'],array(

									"title"=>$_POST['title'],
									"circle_image"=>empty($_POST['circle_image'])?"":$_POST['circle_image'],
									"privacy"=>!empty($_POST['privacy']) && $_POST['privacy']=='public'?0:1,


									));


		if($circle){

			$response=$this->GetResponseArray(true,"Circle successfully updated",$this->WidgetOutput("Circle",array("circle"=>$circle)));
		}


		else {

			$response=$this->GetResponseArray(false,"Failed to update the circle");
	

		}

		$this->PrintResponse($response);


	}


}



/**
** Method to un-join a circle based on its given Circle_id for the current user
**/

function actionUnjoin(){

	if(!empty($_POST['cid'])){

		if(Helpers::get_controller(CIRCLES)->UnJoinCircle($_POST['cid'])){

			$response=$this->GetResponseArray(true,"You have un-joined the Circle.");
		}

		else {

			$response=$this->GetResponseArray(false,"Failed to unjoin the circle");
		}

		$this->PrintResponse($response);
	}
}


/**
** Method to receive "contact us" request submitted through Contact Us form
**/

function actionContact(){

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){

	//form the message
	$message="From: ".$_POST['name']."<br/>"."Email: ".$_POST['email']."<br/>Message: <br/>".$_POST['message'];

	if(Helpers::get_controller(MAIL)->SendMail($GLOBALS['app_config']['admin_email'],"Contact Request",$message)){

		$this->printResponse($this->GetResponseArray(true,"Your message is successfully sent. We'll get in touch as soon as possible."));
}

else {

		$this->printResponse($this->GetResponseArray(false,"Failed to send the message. Please try again."));


}

}

}


/**
*** Method to get the HTML content for the Circles Slider 
**/

function actionGetCirclesSlider(){

if(!empty($_POST['flag'])){

/**
*claculate the number of circles in a slide if the with of Slider Container
** is received from the client side
**/
$container_width=!empty($_POST['container_width'])?$_POST['container_width']:false;

$response=$this->GetResponseArray(true,"Success",$this->WidgetOutPut("Circlesslider",array("container_width"=>$container_width)));

}

else {

$response=$this->GetResponseArray(false,"Failed to load Circles");


}

$this->PrintResponse($response);

}


/**
** Method to make the given Circle default for current user
**/

function actionDefaultCircle(){

	if(!empty($_POST['cid'])){

		$user=Helpers::get_controller(USERS)->DefaultCircle($_POST['cid'],!empty($_POST['default_']));

		if($user){

		$response=$this->GetResponseArray(true,!empty($_POST['default_'])?"Circle is set as default successfully.":"Settings updated successfully.");	

		}

		else {

		$response=$this->GetResponseArray(false,"Failed to make this your default Circle.");	


		}

		$this->PrintResponse($response);

	}
}


/**
** Method to search for posts options that exist in the database based on 
** the given keyword
**/

function actionSearchPostOptions(){

$return=array();

if(!empty($_GET['q'])){

	//get the post options
	$options=Helpers::get_controller(POST_VOTE)->SearchPostOptions($_GET['q']);

	if($options){

		foreach($options as $opt){

			$return[]=array(

				"id"=>$opt->id,
				"name"=>$opt->option_name,

				);

		}

	}
}

	$this->PrintResponse($return);



}



/**
** Method to get the HTML content for rendering the Tour Wizard
**/

function actionGetTourWizard(){

	if(!empty($_POST['flag'])){

		$response=$this->GetResponseArray(true,"HTML content",Helpers::get_controller(TOUR)->GetWizardView());

		$this->PrintResponse($response);

	}
}


/**
** Method to have current user edit a given comment
**/

function actionEditComment(){

    if(!empty($_POST['comment_id']) && !empty($_POST['comment'])){

    //update the comment
    $comment=Helpers::get_controller(COMMENTS)->EditComment($_POST['comment_id'],$_POST['comment']);

    if($comment){

    $response=$this->GetResponseArray(true,"Comment successfully updated.",array("comment"=>$comment->comment_text));

    }

    else {

    $response=$this->GetResponseArray(false,"Failed to update comment.");
   
    }

    $this->printResponse($response);

    }
}


/**
** Method to have current user join a given circle
**/

function actionJoinCircle(){

if(!empty($_POST['cid'])){

//make the user join this circle
if(Helpers::get_controller(CIRCLES)->UserCircle($_POST['cid'])){

$response=$this->GetResponseArray(true,"Joined the Circle successfully.",$this->WidgetOutput("Circlesslider",array("container_width"=>!empty($_POST['container_width'])?$_POST['container_width']:false)));

}

else {

$response=$this->GetResponseArray(false,"Failed to join Circle");

}

$this->PrintResponse($response);

}

}


/**
** Method to cancel current user's vote on a given post
**/

function actionCancelVote(){

if(!empty($_POST['post_id'])){

$clean_vote=Helpers::get_controller(POST_VOTE)->CleanVote($_POST['post_id']);

if($clean_vote){

$response=$this->GetResponseArray(true,"Vote cancled successfully",$this->WidgetOutput("Post",array(

	"post"=>helpers::get_controller(POSTS)->PostById($_POST['post_id']),
	"options"=>array(

		"comments_enabled"=>true,
		"class"=>Helpers::CoulmnClass(),

		),

		)));

}

else {

$response=$this->GetResponseArray(false,"Failed to cancel the Vote");

}

$this->PrintResponse($response);


}

}


/**
** Method to return the HTML content to render the Social Button widget 
** to let users share a given post on social networks
**/

function actionPostSocialSharing(){

if(!empty($_POST['post_id'])){

	$widget=$this->WidgetOutput('Sharepost',array("post"=>$_POST['post_id']));
        
	$this->PrintResponse($this->GetResponseArray(true,"Share this post",$widget));

}


}







}



?>