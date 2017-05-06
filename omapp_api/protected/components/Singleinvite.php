<?php


class Singleinvite extends CWidget{

public $invite=false;

function run(){

if($this->invite){

$this->render("single_invite",array("invite"=>$this->invite));

}

}


}

?>