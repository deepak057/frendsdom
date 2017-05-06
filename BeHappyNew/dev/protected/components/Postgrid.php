<?php

class Postgrid extends CWidget{

	public $posts=false,
		   $cols=false;

	public function run(){

	if($this->posts){

	$this->render("posts_grid",array(

	"cols"=>$this->cols,
	"posts"=>$this->posts,

	));


	}
	
	}

	
	/**
	** Method to generate array with its elements
	** containing sub arrays of "posts" objects 
	**/
	
	public function GetContentArray($posts, $cols){

	$content_=array();

        for($i=0;$i<$cols;$i++){

        $previous_key=0;

        foreach ($posts as $k=>$post){

        if( $i==$k || ($k)==$previous_key+$cols){

        $content_[$i][]=$post;

        $previous_key=$k;

        }

        }


        }

	
	return $content_;
	}
	



	


}


?>
