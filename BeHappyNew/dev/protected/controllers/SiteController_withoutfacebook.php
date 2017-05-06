<?php


class SiteController extends CController

{


	public function filters()
	{
		return array(
			'accessControl', 
			
		);
	}

	/**
	** Access rules for SiteController
	**/

	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('login','signup','index','resetpassword','error','test'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('logout'),
				'users'=>array('@'),
				),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}


    function actionIndex(){
        if(isset($_GET["rajuj"])&&$_GET["rajuj"]=="Hello")
        {
    	    var_dump(Yii::app()->session['uid']);
        }
	
	if(!helpers::is_logged_in()) {
	
		$this->RenderLandingPage();
	
	}

	else {

		$this->RenderDashboard();

	}

	
	}


	/**
	** Error action
	**/

	function actionError(){

		$this->layout="custom";

		$this->pageTitle="Error";

		$this->render("error",array("error"=>"Either this page does not exist or you are not authorized to view it."));

	}





	/**
	** Method to render Landing page
	**/	

	function RenderLandingPage(){

		$this->layout="landing";

		$this->pageTitle=$GLOBALS['app_config']['seo']['title'];

		$this->render("main",array(

		"SignUpForm"=>$this->ContentSignUpPage(),
		"global_circles"=>Helpers::PickRandom(Helpers::get_controller(CIRCLES)->GetGlobalCircles(),$GLOBALS['app_config']['default_count']['circles_in_trending']),
		"background_image"=>Helpers::LandingPageImage(),
				
		));

	}


	/**
	** Method to render Dashboard
	** Only to be called after user sessions are created 
	**/

	function RenderDashboard(){

		$this->pageTitle=Yii::app()->name."- Home";

		echo $this->render("dashboard",array(
		
		"user"=>helpers::GetUser()
		
		));

	}


	/**
	** Render login page
	**/
	

	function actionLogin(){
	
	$this->pageTitle="Log In";	

	//render login form
	$this->UserForms();
	

	}


	/**
	** Method to render different kind of forms
	**/
	
	function UserForms($active_form_="sign_in"){
	
	helpers::ToAppRoot();// restric access to this page if a user is logged in

	$this->layout="custom";

	$this->render("forms",array(

	"active"=>$active_form_,
	"email"=>!empty($_GET['email'])?trim($_GET['email']):false,
	"phone"=>!empty($_GET['phone'])?trim($_GET['phone']):false,
	));

	}



	/**
	** Action to log the user out, destroy sessions and cookies
	*/

	function actionLogout(){

		$user=helpers::get_Controller(USERS);

		$user->LogOut(); //destroy sessions and cookies

		$this->redirect(helpers::base_url());
	}

	/**
	** Render Sign Up page
	**/

	function actionSignUp(){

	$this->pageTitle="Sign Up";	
		
	//render sign up page
	$this->UserForms("sign_up");

	}


	/**
	** Render Reset Password page page
	**/

	function actionResetPassword(){

	$this->pageTitle="Reset Password";	

	//render page
	$this->UserForms("reset_password");

	}

		

	function RenderLandingPageContent($content){
	
	$this->layout="landing";
	
	$this->render("render_content",array("content"=>$content));

	}


	/**
	** method to get the content of Sign Up page
	**/
	function ContentSignUpPage(){
	
	return $this->renderPartial("signup",array(),true);
	
	}



	function actionTest(){

		$this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
        'style'=>'horizontal',
        'networks' => array('facebook','googleplus','linkedin','twitter'),
        'data_via'=>'', //twitter username (for twitter only, if exists else leave empty)
));
	}



}



?>
