<?php


class Commonlayoutcontent extends CWidget{

public $content="",$minimal_layout=false;

public function run(){

	$this->render("Commonlayoutcontent",array(

	"content"=>$this->content,

	"minimal_layout"=>$this->minimal_layout,

	));
}


}


?>