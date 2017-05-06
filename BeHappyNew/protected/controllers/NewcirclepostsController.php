<?php


class NewcirclepostsController extends CController{


/**
** Method to return the array containing
** number of new post for each of the 
** circle of given user
**/

function CircleNewPosts($uid=false){

//final array to be returned
$return=array();

$last_visits=circle_last_visits::model()->findAll("uid=".Helpers::uid($uid));

if(!empty($last_visits)){

//get the PostsController object
$p_controller=Helpers::get_controller(POSTS);

foreach($last_visits as $lv){

//get number of new posts for this circle
$new_posts=$p_controller->GetNewPosts($lv->cid,$lv->last_visit);

$return[]=array("cid"=>$lv->cid,"new_posts"=>$new_posts?count($new_posts):0);

}

}


return $return;

}




/**
** Method to update "last_visit" time for given pair of 
** cid and uid
**/

function CircleVisited($cid,$uid=false){

if(!Helpers::is_logged_in())return false;

//get the model object representing the table row
$model=$this->GetModel($cid,$uid);

//update the date
$model->last_visit=Helpers::SqlDateTime();

$model->save();

return $model;

}


/**
** Method to create a new row or pull out the existing one
** for given unique "cid-uid" pair
**/

function GetModel($cid,$uid=false){

//fix the uid
$uid=Helpers::uid($uid);

$model=circle_last_visits::model()->find("cid=".$cid." and uid=".$uid);

if($model==null) {

$model=new circle_last_visits;

$model->cid=$cid;

$model->uid=$uid;

$model->save();

}


return $model;

}



}



?>