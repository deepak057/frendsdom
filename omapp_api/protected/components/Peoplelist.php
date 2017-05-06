<?php


class Peoplelist extends CWidget{

public $users=array();

public function run(){

$this->render("people_list",array("users"=>$this->users));

}



}


?>