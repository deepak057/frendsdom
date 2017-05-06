<?php

class shared_circles extends CActiveRecord
{
	
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'shared_circles';
	}

	
	
	
}