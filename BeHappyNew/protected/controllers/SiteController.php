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
				'actions'=>array('login','signup','index','resetpassword','error','test','callback'),
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
	require(__DIR__.'/../thirdparty/facebook/autoload.php');
	$fb = new Facebook\Facebook([
	  'app_id' => FB_ID, // Replace {app-id} with your app id
	  'app_secret' => 'a0b252138b04485e1134c7564fce7e23',
	  'default_graph_version' => 'v2.2',
	  ]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('http://circleshouts.com/dev/site/callback', $permissions);
	
	$this->render("forms",array(
	"active"=>$active_form_,
	"email"=>!empty($_GET['email'])?trim($_GET['email']):false,
	"phone"=>!empty($_GET['phone'])?trim($_GET['phone']):false,
	"login_url"=>htmlspecialchars($loginUrl),
	));

	}

	/**
	** Action to log in the user after facebook callback
	*/

	public function actionCallback()
	{	
		require(__DIR__.'/../thirdparty/facebook/autoload.php');
		$fb = new Facebook\Facebook([
		  'app_id' => FB_ID, // Replace {app-id} with your app id
		  'app_secret' => 'a0b252138b04485e1134c7564fce7e23',
		  'default_graph_version' => 'v2.2',
		  ]);


		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  //echo 'Graph returned an error: ' . $e->getMessage();
		  //exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  //exit;
		}

		if (! isset($accessToken)) {
		  if ($helper->getError()) {
		    //header('HTTP/1.0 401 Unauthorized');
		   // echo "Error: " . $helper->getError() . "\n";
		    //echo "Error Code: " . $helper->getErrorCode() . "\n";
		    //echo "Error Reason: " . $helper->getErrorReason() . "\n";
		    //echo "Error Description: " . $helper->getErrorDescription() . "\n";
		  } else {
		   // header('HTTP/1.0 400 Bad Request');
		    //echo 'Bad request';
		  }
		  //exit;
		}

		// Logged in
		//echo '<h3>Access Token</h3>';
		//var_dump($accessToken->getValue());

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		//echo '<h3>Metadata</h3>';
		//var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId(FB_ID); // Replace {app-id} with your app id
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
		  // Exchanges a short-lived access token for a long-lived one
		  try {
		    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		  } catch (Facebook\Exceptions\FacebookSDKException $e) {
		    //echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
		    //exit;
		  }

		 //echo '<h3>Long-lived</h3>';
		  //var_dump($accessToken->getValue());
		}

		//$_SESSION['fb_access_token'] = (string) $accessToken;

		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');
			try {
			  // Returns a `Facebook\FacebookResponse` object
			  $response = $fb->get('/me?fields=id,name,email,picture.type(large)', $accessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  //echo 'Graph returned an error: ' . $e->getMessage();
			  //exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  //exit;
			}

			$user = $response->getGraphUser();

			if($this->IsRegistered($user["email"])){
			
			$userController = helpers::get_controller(USERS); //get Users Controller object
			$user = Users::model()->find(array('condition'=>'email="'.$user["email"].'"'));
			$user->facebook_id = $user["id"];
			$user->save();
			$userController->OnLogin($user);
			$userController->RememberLogin($user);
			$this->redirect(Yii::app()->homeUrl);
			}
			else
			{
				$userd=helpers::get_controller(USERS); //get Users Controller object

				$user_new=$userd->RegisterSocial($user["email"],$user["name"],$user["picture"]["url"],"social_login",true,$user["id"],"facebook");
				$this->redirect(Yii::app()->homeUrl);
			}
	

			//helpers::get_controller(USERS)->RegisterSocial($user["email"],$user["name"],$user["picture"]["url"],"social_login",true,$user["id"],"facebook");
			//header("Location:".Yii::app()->getBaseUrl());
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

		/**
		** Method to check if the given email is registered with app
		**/

		function IsRegistered($email){

		$user=helpers::get_controller(USERS); //get Users Controller object

		return $user->IsRegistered($email);


		}

	function actionDemo()
	{

	}

}



?>
