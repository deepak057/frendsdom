<?php


class InboxController extends CController {


	public function filters(){

		return array('accessControl',);
	}


	/**
	** Access rules for InboxController
	**/

	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('index'),
				'users'=>array('@'),
				),
			array('deny',
				'users'=>array('*'),),
			);
	}


function actionIndex(){

	//get the users with whom curent user has a conversation with
	$users=Helpers::get_controller(MESSAGES)->ConversationsUsers();

	$this->render("index",array(

				"users"=>$users
		));
}

	

/**
** Method to return HTML for conversation between two given users
**/

function GetConversationView($uid1,$uid2=false,$viewing_user_id=false){

//get user controller
$user_c=Helpers::get_controller(USERS);	

//fix user ids
$uid1=Helpers::uid($uid1);
$uid2=Helpers::uid($uid2);

//get user objects
$user1=$user_c->GetUserById($uid1);
$user2=$user_c->GetUserById($uid2);
$viewing_user_id=!$viewing_user_id?$uid2:$viewing_user_id;

//get the messages exchnaged between the given users
$messages=Helpers::get_controller(MESSAGES)->GetMessages($uid1,$uid2);

return $this->renderPartial("conversation",array(

						"messages"=>$messages,
						"user1"=>$user1,
						"user2"=>$user2,
						"user_c"=>$user_c,
						"viewing_user_id"=>$viewing_user_id

						),true);

}

/**
** Method to return the HTML for single message in a conversation
**/

function GetSingleMessageView($msg,$viewing_user_id=false){

return $this->renderpartial("single_message",array("msg"=>$msg,"viewing_user_id"=>Helpers::uid($viewing_user_id)),true);

}


}


?>