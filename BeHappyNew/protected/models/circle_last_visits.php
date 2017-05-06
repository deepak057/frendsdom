<?php

class circle_last_visits extends CActiveRecord
{	
	
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'circle_last_visits';
	}

	
	
	
}