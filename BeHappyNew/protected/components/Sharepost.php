<?php

class Sharepost extends CWidget{

	public $post=false;

	public function run(){

	if($this->post){
	
	//get the post object 
	$post=Helpers::get_controller(POSTS)->GetPost($this->post);
	
	if(!$post)return false;
	
	//get the post URL
	$post_url=AppUrls::PostURL($post->id);
	
	//get the Post title
	$post_title=ucfirst($post->supporting_text);

	//get the "Sharing" widget	
	$widget=$this->GetWidget($post_url,$post_title);
	
	//render the content
	$this->render("share_post",array(

		"post_url"=>$post_url,
		"post_title"=>$post_title,
		"widget"=>$widget,

		));
	
	
	}

	}

	/**
	** Method to return the HTML for 
	** the Sharing widget for given post
	**/

	function GetWidget($post_url,$post_title){
	
	return Helpers::WidgetOutPut('ext.sharebox.EShareBox', array(
   	
   	 'url' => $post_url,
 
    	// the title of the post to be shared.
    	// Some services will ignore this value.
    	'title'=> $post_title,
 
    	// Size of the icons to display, in pixels.
    	// Default is 24px, available sizes : 16, 24, 32, 48.
    	'iconSize' => 48,
 
    	// Whether to animate the links.
    	// Default is true
    	'animate' => false,
 
   	// Social networks to include, excluding all others.
   	// The exclude filter is still run.
   	//'include' => array('technorati', 'digg'),
 
   	// Social networks to exclude from display.
   	// By default none are excluded.
   	//'exclude' => array('technorati', 'digg'),
 
   	// Use your own icons! Note that you will need to have
   	// a subfolder of the appropriate icons sizes.
   	// ie: /myimages/social/16px /myimages/social/24px ...
   	//'iconPath' => '/myimages/social',
 
   	// HTML options for the UL element.
  	// 'ulHtmlOptions' => array('class' => 'myCustomUlClass'),
 
   	// HTML options for all the LI elements.
   	//'liHtmlOptions' => array('class' => 'm-r-5'),
	
	));
		

	}
	
}



?>