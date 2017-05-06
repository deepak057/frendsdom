<?php



class Postoptions extends CWidget{


	public $post=false;

	public function run(){

		if($this->post){

			$this->render("post_options",array(

				"post"=>$this->post,

				//get random colors	
				"colors"=>!empty($this->post->post_options)?Helpers::PickRandom($GLOBALS['app_config']['colors'],count($this->post->post_options)):array(),


				));
		}


	}

}



?>