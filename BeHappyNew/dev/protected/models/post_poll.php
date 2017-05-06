<?php

class post_poll extends CActiveRecord
{
	

	public $is_selected=false,
		   $votes_percentage=0;


    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'post_poll';
	}

	
	
	
}