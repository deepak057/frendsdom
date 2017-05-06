<?php

/**
 * Notifications class.
 * Notifications is the data structure for keeping
 * Notifications. It is used by the Notifications Controller.
 */

class NotificationsModel extends CActiveRecord
{
	public $user;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'notifications';
	}

}