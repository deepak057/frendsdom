<?php



class CirclesController extends CController{


public function filters()
	{

	if(!$GLOBALS['app_config']['public_visibility']['circles']) {	

		return array(
			'accessControl', 
			
		);

	}

	return array();	

	}

	/**
	** Access rules for CirclesController
	**/

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('circle',),
				'users'=>array('@'),
				),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}


/**
** Method to create a new circle
**/

function CreateCircle($content,$created_by=false){

//get model
$circle=new circles();

$circle->title=$content['title'];

$circle->circle_image=!empty($content['circle_image'])?$content['circle_image']:"";

$circle->created_by=helpers::uid($created_by);

$circle->date_created=helpers::SqlDateTime();

$circle->privacy=!empty($content['privacy'])?$content['privacy']:0;

$circle->save();

//associate this circle with its owner
$this->UserCircle($circle->id,helpers::uid($created_by));

return $circle;

}


/**
** Method to update a circle
**/

function UpdateCircle($cid,$content,$updated_by=false){

//get the circle
$circle=$this->GetCircleById($cid);

if($circle->created_by==Helpers::uid($updated_by)){

//update the title
$circle->title=trim($content['title']);	

$circle->circle_image=$content['circle_image'];

$circle->privacy=!empty($content['privacy'])?$content['privacy']:0;

$circle->save();

return $circle;

}

return false;


}




/**
** Method to get user circle object
**/

function GetUserCircle($cid,$uid) {

$circle=user_circles::model()->find("circle_id=".$cid." and uid=".$uid);

return $circle!=NULL?$circle:false;

}


/**
** Method to associate a given circle with the user of given id
**/

function UserCircle($cid,$uid=false){

$uid=Helpers::uid($uid);

$already_exists=$this->GetUserCircle($cid,$uid);

if(!$already_exists){

$record=new user_circles();

$record->circle_id=$cid;

$record->uid=$uid;

$record->date=helpers::SqlDateTime();

$record->save();

//also, update the "last_visit" date for this circle
Helpers::get_controller(NEW_POSTS)->CircleVisited($cid,$uid);

return $record;

}

return $already_exists;

}




/**
** Method to return the array of all the circles associated with 
** given user id
**/

function AssociatedCircles($uid=false){

$user_circles=user_circles::model()->findAll("uid=".helpers::uid($uid)." order by `date` asc" );

if($user_circles!=null){

foreach ($user_circles as $circle){

$return[]=$circle->circle_id;

}

return $return;

}

return array();

}





/**
** Method to return array of CActive records of Circle objects
** for given user
**/

function GetCircles($uid=false){

$cids=$this->AssociatedCircles(helpers::uid($uid));

return $this->CircleObjectsArray($cids);

}


/**
** Method to return array of circle objects for given circle ids
**/

function CircleObjectsArray($cids){

if(!empty($cids)){

$criteria=new CDbCriteria();

$criteria->addInCondition('id',$cids); 

$criteria->order = 'FIELD(id,'.implode(",",$cids).')';

$circles=circles::model()->findAll($criteria);

return $circles!=null?$circles:false;

}

return false;

}



/**
** Method to get Cactive Record object for the given circle id
*/

function GetCircleById($cid){

$circle=circles::model()->findByPk($cid);

return $circle==NULL?false:$circle;

}


/**
** Method to get a circle object
**/

function GetCircle($circle){

	if(!is_object($circle)){

		return $this->GetCircleById($circle);
	}

	return $circle;
}

/**
** Method to upload a Circle image
**/

function UploadCircleImage($image_file,$uploaded_by=false){

//get an unique name for this uploaded file
$name=mktime()."_".Helpers::uid($uploaded_by).".".pathinfo($image_file['name'], PATHINFO_EXTENSION);

//path to save this image at
$target=directories::PathCircleImage($name);

return move_uploaded_file($image_file['tmp_name'],$target) && chmod($target,0777) ?$name:false;

}



/**
** Method to render a single Circle page
**/

function actionCircle(){

if(!empty($_GET['id'])){

//get the circle
$circle=Helpers::get_controller(CIRCLES)->GetCircleById($_GET['id']);

if($circle && $this->CanAccessCircle($circle)){

$this->pageTitle = ucwords($circle->title);

//Keep record of when current user visited this circle last time
Helpers::get_controller(NEW_POSTS)->CircleVisited($circle->id);

$this->render("circle",array("circle"=>$circle));

}

else {

	throw new CHttpException(404);

}

}

}



/**
** Method to check wether a given user is authorized to access the given circle
**/

function CanAccessCircle($circle,$uid=false){

//fix circle object
$circle=$this->GetCircle($circle);

if($circle){

return ($circle->privacy==1 &&  $this->BelongToCircle($circle->id,$uid)) ||  $circle->privacy==0;

}

return false;

}


/**
** Method to return the array containing objects of mutual circle
** between given two users
**/

function MutualCircles($uid1,$uid2=false){

$uid1=Helpers::uid($uid1);
$uid2=Helpers::uid($uid2);

$circles=user_circles::model()->findAll(array(
					
				"select"=>"circle_id",
				"condition"=>"uid={$uid1} OR uid={$uid2}",
				"group"=>" 1 having count(*)>1"
				
				));


if(!empty($circles)){

foreach ($circles as $cid)$cids[]=$cid->circle_id;

return $this->CircleObjectsArray($cids);

}


return false;

}


/**
** Method to check wether a given user is part of a given circle
**/

function BelongToCircle($circle_id,$uid=false){

if(!Helpers::is_logged_in()) return false;

$circle=user_circles::model()->find("uid=".Helpers::uid($uid)." and circle_id={$circle_id}");

return $circle!=null?$circle:false;

}


/**
** Method to search circles based on the given keyword
**/

function SearchCircles($keyword,$offset=0,$limit=10){

$circles=circles::model()->findAll("title like '%{$keyword}%' and privacy=0 order by `date_created` desc limit {$offset}, {$limit} ");

return $circles==NULL?false:$circles;


}

/*
** Method to get the Settings view for the given circle
**/

function CirclesSettingsView($cid,$uid=false){

//get the circle
$circle=$this->GetCircleById($cid);

//get the user
$user=Helpers::get_controller(USERS)->GetUserById($uid);


return $this->renderPartial("circle_settings",array(

		"circle"=>$circle,
		"is_owner"=>$circle->created_by==Helpers::uid($uid),
		"user"=>$user,
		"default_cirlce"=>$user->default_cid==$cid,

		),true);

}

/**
** Method to make the given user un-join the given circle
**/

function UnJoinCircle($cid,$uid=false){

$record_=user_circles::model()->find("uid=".Helpers::uid($uid)." and circle_id=".$cid);

if($record_!=null){

	$record_->delete();

	//also, check if this circle is given user's default cirlcle
	Helpers::get_controller(USERS)->DefaultCircle($cid,false,$uid);

	return true;
}

return false;

}


/*
** Method to return array of circle objects of Global Circles
**/

function GetGlobalCircles($uid=false){

$circles=circles::model()->findAll("is_global=1");

return $circles!==null?$circles:false;

}





}

?>