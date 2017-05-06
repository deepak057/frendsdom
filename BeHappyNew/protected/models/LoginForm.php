<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $rememberMe=false;

	private $_identity;

	public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
			
	        );
    }

 public function authenticate($attribute,$params)
    {
        $this->_identity=new UserIdentity($this->email,$this->password,$this->rememberMe);
		$error=$this->_identity->authenticate();
		switch($error)
		{
			case 0:
			{
				break;
			}
			case 1:
			{
				$this->addError('email',"Please enter a valid email.");
				break;
			}
			case 2:
			{
				$this->addError('password','Please enter a valid password.');
				break;
			}
			case 4:
			{
				$this->addError('','You are Banned, '.CHtml::link('Contact Admin',array('pages/contact')).' to resolve issue.');
				break;
			}
			case 5:
			{
				$this->addError('','You are Deleted, '.CHtml::link('Contact Admin',array('pages/contact')).' to resolve issue.');
				break;
			}
			case 6:
			{
				$this->addError('','Your Email is not verified yet, Please check your email or '.CHtml::link('Resend',array('email/verify')).' verification email');
				break;
			}
			default:
			{
				$this->addError('','An error occured.');
			}
			
		}
       
	}
	
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
	


}
