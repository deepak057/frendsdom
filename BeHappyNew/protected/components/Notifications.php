<?php
class Notifications extends CWidget {
	public $uid=false;
	public $notifications=false;

	public function run()
	{
		//get all the circle invites received by current user
		$notifications=!$this->notifications?helpers::get_controller(NOTIFICATION)->GetNotifications($this->uid):$this->notifications;
		$notification_all = helpers::get_controller(NOTIFICATION)->GetUnreadNotifications($this->uid);

		$this->render("notifications",array("notifications"=>$notifications,"notification_all"=>$notification_all));
	}
}

?>