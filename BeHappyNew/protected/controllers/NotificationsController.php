<?php

class NotificationsController extends CController {

	//Function to save Notifications
	public function SaveNotification($post,$type,$content="",$users=array(),$act_id)
	{	
		if($post!=""&&sizeof($users)>0)
		{
			foreach($users as $key => $value)
			{
					if(trim($value)==trim(helpers::uid()))
					{
						
					}
					else
					{
						$notification = new NotificationsModel();
						$notification->post = $post;
						$notification->type = $type;
						$notification->seen = '0';
						$notification->content = $content;
						$time = gmmktime();
						$notification->time = date("Y-m-d H:i:s", $time); ;
						$notification->from = Helpers::uid();
						$notification->to = $value;
						$notification->activity_id = $act_id;
						$notification->save();
					}
					
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	//Function to delete notifications
	public function DeleteNotification($post_id,$type="like",$user)
	{
		$post = NotificationsModel::model()->findByAttributes(array('post'=>$post_id,'type'=>$type,'from'=>$user));
		if($post)
		{
			if($post->delete())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else{
			return false;
		}	
	}

	//Function to mark as read notifications
	public function markAsRead($notification)
	{
		$notification = NotificationsModel::model()->find("id=".$notification);
		if($notification)
		{
			$notification->seen = "1";
			$notification->save();
			return true;
		}
		else
		{
			return false;
		}
	}



	/**
	** Method to get "notifications" of a user
	**/

	function GetNotifications($uid=false,$last_notification=false){

	$query_=$last_notification?" and `id`> {$last_notification}":"";

	$notifications = NotificationsModel::model()->findAll("`to` =".helpers::uid($uid).$query_." order by `time` desc limit 10");

	if($notifications!=NULL){

	//get user controller
	$user_c=Helpers::get_controller(USERS);

	foreach ($notifications as $k=>$notification){

	$notifications[$k]->user = $user_c->GetUserById($notification->from);

	}


	}


	return $notifications==null?array():$notifications;

	} 

	public function markAllAsRead()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('`to` ='.Helpers::uid());
		NotificationsModel::model()->updateAll(array('seen'=>'1'),$criteria);

		return true;
	}

	/**
	** Method to get unread "notifications" of a user
	**/

	function GetUnreadNotifications($uid=false,$last_notification=false){

	$query_=$last_notification?" and `id`> {$last_notification}":"";

	$notifications = NotificationsModel::model()->findAll("`to` =".helpers::uid($uid).$query_." and `seen`='0' order by `time` desc");

	if($notifications!=NULL){

	//get user controller
	$user_c=Helpers::get_controller(USERS);

	foreach ($notifications as $k=>$notification){

	$notifications[$k]->user = $user_c->GetUserById($notification->from);


	}


	}


	return $notifications==null?array():$notifications;

	}


	/**
	** Get Previous Notifications
	**/

	function GetPreviousNotifications($uid=false,$last_notification=false){

	$query_=$last_notification?" and `id`< {$last_notification}":"";

	$notifications = NotificationsModel::model()->findAll("`to` =".helpers::uid($uid).$query_." order by `time` desc limit 10");

	if($notifications!=NULL){

	//get user controller
	$user_c=Helpers::get_controller(USERS);

	foreach ($notifications as $k=>$notification){

	$notifications[$k]->user = $user_c->GetUserById($notification->from);

	}


	}

	return $notifications==null?array():$notifications;

	} 
}
