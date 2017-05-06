<?php


class MessagesController extends CController{


/**
** Method to send a message to a given user
**/

function SendMessage($message,$to,$from=false){

$msg=new messages();

$msg->to_id=Helpers::uid($to);

$msg->from_id=Helpers::uid($from);

$msg->date=Helpers::SqlDateTime();

$msg->message=trim($message);

$msg->save();

return $msg;

}

/**
** Method to get the array containing user objects of the users
** with whom, the given user has had a conversation with
**/

function ConversationsUsers($uid=false){

//get the user id
$uid=Helpers::uid($uid);

//Array to keep track of ids of users
$users=array();

$messages=messages::model()->findAll("from_id=".$uid." OR to_id=".$uid);

if($messages!==NULL){

foreach($messages as $msg){

if($msg->to_id!=$uid) $users[]=$msg->to_id;

else $users[]=$msg->from_id;


}

}

return empty($users)?$users:Helpers::get_controller(USERS)->UsersbyIds(Helpers::ArrayUnique($users));


}

/**
** Method to get the array containing message objects of the messages
** exchnaged betwenn the given two users
**/

function GetMessages($uid1,$uid2=false){

$uid1=Helpers::uid($uid1);
$uid2=Helpers::uid($uid2);

//get the messages exchanged
$messages=messages::model()->findAll("(from_id={$uid1} AND to_id={$uid2}) OR (from_id={$uid2} AND to_id={$uid1}) order by `date`");

return $messages==NULL?false:$messages;


}



}


?>