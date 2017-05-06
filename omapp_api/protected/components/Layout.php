<?php


class Layout extends CWidget{

public $title, $content;

public function run(){

	$this->render("layout",array(

		"content"=>$this->content,
		"title"=>$this->title?$this->title:Yii::app()->name

		));
}



}


?>