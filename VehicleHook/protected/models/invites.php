<?php

class invites extends CActiveRecord
{	
	
	public $circle=false;
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'invites';
	}

	
	
	
}