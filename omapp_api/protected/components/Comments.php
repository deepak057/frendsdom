<?php


class Comments extends CWidget{

public $post=false;

function run(){

if($this->post){

$this->render("comments",$this->post);

}

}



}


?>