<?php


class InvitationController extends CController {



/**
** method to send an invite to a given user
** to join a circle of given id
**/


function SendInvite($from_id,$to_id,$cid){

$invite=$this->GetModel($from_id,$to_id,$cid);

$invite->from_id=$from_id;

$invite->to_id=$to_id;

$invite->cid=$cid;

$invite->save();

return $invite;

}


/**
** Method to get the model object
**/

function GetModel($from_id,$to_id,$cid){

$invite=invites::model()->find("from_id={$from_id} and to_id={$to_id} and cid={$cid}");

if($invite==NULL){

$invite=new invites();

$invite->date=helpers::SqlDateTime();



}

return $invite;

}


/**
** Method to get "circle invites" received by given user
**/

function GetInvites($uid=false,$last_invite=false){

$query_=$last_invite?" and `id`> {$last_invite}":"";

$invites=invites::model()->findAll("to_id=".helpers::uid($uid).$query_." order by `date` desc");

if($invites!=NULL){

//get circle controller
$circle_c=Helpers::get_controller(CIRCLES);

foreach ($invites as $k=>$invite){

$invites[$k]->circle=$circle_c->GetCircleById($invite->cid);


}


}


return $invites==null?array():$invites;

}



/**
** Method to handle an invite
** Accepts or rejects it
**/

function HandleInvite($invite_id,$action){

$invite=invites::model()->findByPk($invite_id);

if($invite!=null) {

$cid=$invite->cid;

if($action=="accept"){

Helpers::get_controller(CIRCLES)->UserCircle($cid,$invite->to_id);

}

$invite->delete();

return $cid;

}

return false;


}



}



?>