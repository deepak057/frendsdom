<?php
class UserIdentity extends CUserIdentity {
	private $_id;
	public $email,$password,$rememberMe;
	
	function __construct($email,$pass,$remember=false)
	{
		$this->email=$email;
		$this->password=$pass;
		$this->rememberMe=$remember;
	}
	
	public function authenticate()
	{
        $record=users::model()->findByAttributes(array('email'=>$this->email));
        if($record===null) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if($record->password!=encrypt($this->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else if($record->status!='1')
		{
			return $this->errorCode=4;
		}
		
		/*else if($record->email_verified!='1')
		{
			Yii::app()->session['email'] =$this->email;
			return $this->errorCode=6;
			
		}*/
		 else {
			 
		
		$this->_id=$record->id;


             //start sessions
               get_controller(SITE)->on_login($record);
				
				if($this->rememberMe){
			
					remember_login($this->id,encrypt($this->password));
			
				}
				
            $this->errorCode=self::ERROR_NONE;
		}
        return $this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
	

}
?>