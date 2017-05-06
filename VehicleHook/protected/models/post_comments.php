<?php

class post_comments extends CActiveRecord
{	
	
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'post_comments';
	}

	
	
	
}