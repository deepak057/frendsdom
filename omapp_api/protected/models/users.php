<?php

class users extends CActiveRecord
{
	
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'users';
	}

	 public function findByEmail($email)
  {
    return self::model()->findByAttributes(array('email' => $email));
  }
	
	
}