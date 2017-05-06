<?php


class Commonlayoutcontent extends CWidget{

public $content="";

public function run(){

	$this->render("Commonlayoutcontent",array(

	"content"=>$this->content

	));
}


}


?>