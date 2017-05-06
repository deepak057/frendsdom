<?php


class Postitem extends Cwidget{

	public $post=false;

	function run(){

		if($this->post){

		$this->render("post_item",array(

				"post"=>$this->post,

				));
	}

	}

}




?>