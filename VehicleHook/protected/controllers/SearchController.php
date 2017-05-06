<?php


class SearchController extends CController {


	public function filters(){
	
		if(!$GLOBALS['app_config']['public_visibility']['search']) {	
	
		return array('accessControl',);

		}


		return array();
	}
	


	/**
	** Access rules for SearchController
	**/

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index',),
				'users'=>array('@'),
				),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}


	function actionIndex(){
	
		$keyword=$this->GetKeyWord();
	
		$this->pageTitle="Search ".$keyword;

		$this->render("index",array(

		"keyword"=>$keyword,
		
		"users_view"=>$this->renderPartial("users",array("users"=>$this->GetResults($keyword)),true), 

		"circles_view"=>$this->CirclesView($keyword),

		"posts_view"=>$this->PostsView($keyword),

		"default_type"=>$this->SelectedTab(),
		
		));

	}

	
	/**
	** Method to check if a Particular tab has to be pre-selected based on the "type" parameter
	** in the URL. Default tab is for type "Users"
	**/

	function SelectedTab(){

	if(!empty($_GET['type']) && in_array($_GET['type'],array(POSTS,USERS,CIRCLES)) ){
	
	return $_GET['type'];
	

	}
	
	return USERS;
	
	}
	


	/**
	** Method to get default view for Circles search
	**/

	function CirclesView($keyword){

	return $this->renderPartial("circles",array(
		
		"circles"=>$this->GetResults($keyword,"circle")

		),true);	

	}



	/**
	** Method to get default view for Posts search
	**/

	function PostsView($keyword){

	return $this->renderPartial("posts",array(
		
		"posts"=>$this->GetResults($keyword,"post")

		),true);	

	}


	function GetKeyWord(){
	
	return !empty($_REQUEST['k'])?trim($_REQUEST['k']):false;
	
	}

	/**
	** Method to get array containing objects 
	** found for given keywords
	**/	
	
	function GetResults($keyword,$type="user",$offset=0,$limit=10){

	//fix the keyword containing single quotes	
	$keyword=addslashes($keyword);	

	switch ($type){

	case "user":
	default:

	$users=Helpers::get_controller(USERS)->SearchUsers($keyword,$offset,$limit);
	
	return $this->GetUsers($users);

	break;

	case "circle":

	$circles=Helpers::get_controller(CIRCLES)->SearchCircles($keyword,$offset,$limit);

	return $this->GetCircles($circles);

	break;

	case "post":

	$posts=Helpers::get_controller(POSTS)->SearchPosts($keyword,$offset,$limit);

	return $this->GetPosts($posts);

	break;

	}
	
	}

	/**
	** method to return HTML content for given 
	** array of search result objects (circles)
	**/ 

	function GetPosts($posts){

		//final output to return
	$return="";	

	if(!empty($posts)){

		foreach($posts as $post){

			$return.=Helpers::WidgetOutPut("Post",array("post"=>$post,"options"=>array(

					"comments_enabled"=>false,
					"class"=>"col-sm-4 widget-item",

					)));
		}
	}	

	return $return;
	

	}


	/**
	** method to return HTML content for given 
	** array of search result objects (circles)
	**/ 

	function GetCircles($circles){

		//final output to return
	$return="";	

	if(!empty($circles)){

		foreach($circles as $circle){

			$return.=Helpers::WidgetOutPut("Circleitem",array("circle"=>$circle));
		}
	}	

	return $return;
	

	}



	/**
	** method to return HTML content for given 
	** array of search result objects (users)
	**/ 

	function GetUsers($users){
	
	//final output to return
	$return="";	

	if(!empty($users)){

		foreach($users as $user){

			$return.=Helpers::WidgetOutPut("Personitem",array("user"=>$user));
		}
	}	

	return $return;
	
	}
	
	

	
}



?>