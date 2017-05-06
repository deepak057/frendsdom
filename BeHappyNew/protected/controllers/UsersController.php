<?php



class UsersController extends CController{


public function filters()
	{

		if(!$GLOBALS['app_config']['public_visibility']['users']) {	
	

		return array(
			'accessControl', 
			
		);
	
		}

	
		return array();
	}



	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('profile','resetpassword','timeline'),
				'users'=>array('@'),
			),

			array('allow', 
				'actions'=>array('resetpassword'),
				'users'=>array('*'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
	

/**
** Method to validate a login attempt
** Returns User CActive object on success else returns Boolean False
*/

function LoginValidate($email, $password, $create_session=false, $remember=false){

$user=$this->UserByEmailAndPassword($email, $password);

if($user){

	return $this->LogTheUserIn($user,$create_session,$remember);

}

	return false;

}


/**
** Method to log a user in
** based on the given CAtive user object
**/

function LogTheUserIn($user,$create_session=false, $remember=false){

if($create_session)$this->OnLogin($user); //create session variables
	if($remember)$this->RememberLogin($user); //create and renew cookies
	return $user;

}



/**
** Method to return CActive record of User model for given 
** Email and Password combination
**/

function UserByEmailAndPassword($email,$password,$encrypt=true){

$user=users::model()->find("email='{$email}' AND password='".($encrypt?helpers::encrypt($password):$password)."'");

return $user==null?false:$user;

}




/**
** Method to create cookies to keep user logged in
**/

function RememberLogin($user){

$expire_date=time() + (7*60*60*24);  //7 days

helpers::CreateCookie('ue', $user->email,$expire_date);

helpers::CreateCookie('up', $user->password,$expire_date);

}



/**
** Method to be called to update session variables 
** after successfull authentication
**/

function OnLogin($user){

Yii::app()->user->id=$user->id;

Yii::app()->session['user']=$user;

Yii::app()->session['uid']=$user->id;

Yii::app()->session['name']=$user->name;

/**Session variable to be set true when user logs in
**to be used to help display Welcome message on the client side 
**everytime after user logs in to the site
*/
Yii::app()->session['logged_in']=true;

}


/**
** Method to register a new user
**/

function Register($email,$mobile,$password,$autologin=false){

$user=new users();

$user->email=$email;

$user->mobile=$mobile;

$user->password=helpers::encrypt($password);

$user->registration_date=Helpers::SqlDateTime();

$user->save();

if($autologin)$this->OnLogin($user);

return $user;


}

/**
** Method to register a new user from facebook
**/

function RegisterSocial($email,$name,$profile_pic,$password,$autologin=true,$id,$website){

$user = new users();

$user->email=$email;

$user->name=$name;

$user->facebook_id = $id;

$user->profile_pic = $profile_pic;

$user->website = $website;

$user->password=helpers::encrypt($password);

$user->registration_date=Helpers::SqlDateTime();

$user->save();

$user->RememberLogin($user);

if($autologin)$this->OnLogin($user);

return $user;

}


/**
** Method to return user CActive record for a given user id
** Returns object for current user if no user id is provided
**/

function GetUserById($uid=false){

	if(is_object($uid)){
		
	return $uid;
	
	}
	
	$user=users::model()->findByPk(Helpers::uid($uid));

	return $user!=null?$user:false;
}


/**
** Method to return the name for given user id
**/

function UserName($user){

if(!is_object($user)){

$user=$this->GetUserById($user);

}
if(empty($user->name)){

$name=explode("@",$user->email);
return $name[0];
}

else {

return $user->name;

}


}


/**
** Method to return user CActive record for a given user's email
**/

function GetUserByEmail($email){

	return $this->UserByAttribute('email',$email);
}




/**
** Method to check if the given email is registered with the app
**/

function IsRegistered($email){

return $this->GetUserByEmail($email);

}

/**
**Method to check if user is to be auto logged in 
*based on the cookies found on their browser
*/

function CheckLogin(){

	if(!Helpers::is_logged_in() && !empty(Yii::app()->request->cookies['ue']) && !empty(Yii::app()->request->cookies['up'])){

		$user=$this->UserByEmailAndPassword(Yii::app()->request->cookies['ue'],Yii::app()->request->cookies['up'],false);

		if($user){
	
			$this->LogTheUserIn($user,true,true);
		}

	}
}


/**
** Method to log the current user out
** Destroys the session variables and all the cookies
**/

function Logout(){
	

		Yii::app()->session->clear();

		Yii::app()->session->destroy();

		Yii::app()->request->cookies->clear();

		return true;
}

/**
** Mehtod to render user profile page
***/

function actionProfile(){

if(!empty($_GET['id'])){

//get the user
$user=$this->GetUserById($_GET['id']);	

if($user){

$this->pageTitle=$this->UserName($user)."- ".Yii::app()->name." profile";

$this->render("profile",array(

		"user"=>$user,
		"own_profile"=>$user->id==Helpers::uid(),
		"about_content"=>$this->GetAboutContent($user),

		));

}

else {

		throw new CHttpException(404);

}


}

}

/**
** Method to return the HTML view for ABout Section on given user's profile page
**/

function GetAboutContent($user=false){

//get the user object
$user=$this->GetUserById($user);

return $this->renderPartial("about",array(
		
		"user"=>$user,
		"own_profile"=>$user->id==Helpers::uid(),

		),true);

}



/**
** Method to generate an unique Hash for given user
** Expects $user parameter to be CActive user record
**/

function UserHash($user){

if(empty($user->hash)){

$user->hash=helpers::encrypt($user->id.$user->email.$user->password.time());

$user->save();

}

return $user->hash;

}



/**
** Method to send "password reset link" to a given user's email
**/

function SendPasswordResetLink($email){

$user=$this->GetUserByEmail($email);

if($user){

//get Mail's body
$body=$this->renderPartial("reset_password_mail",array(

"user"=>$user,
"password_link"=>$this->ResetPasswordLink($user)


),true);

//now send the mail
return helpers::get_controller(MAIL)->SendMail($user->email,"Reset Password",$body);


}

}

/**
** Method to get user CActive record for a given attribute
**/

function UserByAttribute($attr,$value){

$user=users::model()->find($attr."='".$value."'");

	return $user!=null?$user:false;


}


/**
* Method to create Password reset link for the given user
**/

function ResetPasswordLink($user){

return $this->createAbsoluteURL(USERS."/ResetPassword?uh_=".$this->UserHash($user));

}

/**
** Reset password page
**/

function actionResetPassword(){

$hash=empty($_GET["uh_"])?false:trim($_GET["uh_"]);

$this->pageTitle="Reset Account Password";

$this->layout="custom";

$this->render("reset_password",array(

"user"=>$hash?$this->UserByAttribute('hash',$hash):false

));

}


/**
** Method to set a new password for a user account identified by given hash
**/

function ChangePasswordByHash($new_password,$hash){

	//get user
	$user=$this->UserByAttribute("hash",$hash);

	if(!$user)return false;

	else {

		$user->password=helpers::encrypt($new_password);

		$user->hash=""; //clear out the hash

		$user->save();

		return $user;
	}

}


function actionTimeLine(){

$this->render("timeline",array("user"=>helpers::GetUser()));

}


/**
** Method to search users based on the given keyword
**/

function SearchUsers($keyword,$offset=0,$limit=10){

//part of the sql query to exclude currently logged in user from search results
$sql=Helpers::is_logged_in()?"and id!=".Helpers::uid():"";

$users=users::model()->findAll("(email like '%{$keyword}%' or `name` like '%{$keyword}%' or `id` like '%{$keyword}%') ".$sql." order by `id` desc limit {$offset}, {$limit} ");

return $users==NULL?false:$users;


}

/**
** Method to return multiple User Objects for given array containing user ids
**/

function UsersbyIds($user_arr=array()){

if(empty($user_arr))return false;	

$criteria=new CDbCriteria();

$criteria->addInCondition('id',$user_arr); 

$criteria->order = 'FIELD(id,'.implode(",",$user_arr).')';

$users=users::model()->findAll($criteria);

return $users!=NULL?$users:false;

}

/**
** Get the URL of profile picture of given user
**/

function ProfilePicUrl($user=false){

$user=$this->GetUserById($user);

if(!filter_var($user->profile_pic, FILTER_VALIDATE_URL))
{
	return $user && !empty($user->profile_pic)?AppURLs::ProfilePictureURL($user->profile_pic):Helpers::get_image("nopic.png");
}
else
{
	return $user && !empty($user->profile_pic)?$user->profile_pic:Helpers::get_image("nopic.png");
}



}


/**
** Method to Upload a user's profile picture
**/

function UploadProfilePicture($image_file,$uploaded_by=false){

//get an unique name for this uploaded file
$name="pp_".Helpers::uid($uploaded_by).".".pathinfo($image_file['name'], PATHINFO_EXTENSION);

//path to save this image at
$target=directories::PathProfilePicture($name);

//Record the name of this picture
$user=$this->GetUserById($uploaded_by);

if($user){

$user->profile_pic=$name;

$user->save();

}

return move_uploaded_file($image_file['tmp_name'],$target) && chmod($target,0777) ?$user:false;


}


/**
** Method to remove the profile picture of given user
**/

function RemoveProfilePic($user=false){

$user=$this->GetUserById($user);

if($user){

$user->profile_pic="";

$user->save();

return $user;
}

return false;

}

/**
** Method to save user profile info
**/

function SaveProfileInfo($data,$uid=false){

if(!empty($data)){

//update given user's records
users::model()->updateAll($data,"id=".Helpers::uid($uid));

return $user=$this->GetUserById($uid);

}

return false;

}


/**
** Method to make a given circle Default for Given user id
**/

function DefaultCircle($cid,$make_default=true,$uid=false){

$user=$this->GetUserById($uid); if(!$user) return false;

if(!$make_default && $user->default_cid==$cid){

$user->default_cid=null;

}

else if($make_default) {

	$user->default_cid=$cid;

}

$user->save();

return $user;

}




}


?>
