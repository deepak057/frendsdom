<?php

class posts extends CActiveRecord
{
	
	public $post_options=array(),$total_votes=0,$comments=array(),$total_comments=0,$post_votes=array();
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'posts';
	}

	
	
}