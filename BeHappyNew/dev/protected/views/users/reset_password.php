<body class="login-content">

<?php $this->Widget("Landingnavbar",array("links_enabled"=>true)); ?>

<div class="lc-block toggled" id="l-login">



<?php

if(!$user){

?>

<div class="alert alert-danger">Sorry, invalid/expired data provided.</div>

<?php
}

else {

?>


<form id="reset-pswd-form" accept-charset="UTF-8" action="login" method="post" role="form" class="form">
	

<p class="text-left">
Welcome back! Please choose a new password for your account.

</p>							
<div class="input-group m-b-20">

<span class="input-group-addon">
<i class="md md-person"></i></span><div class="fg-line">
<input type="hidden" name="abcxyz"/>
<input type="password" required="" placeholder="Enter Password" id="reset-pswd" class="form-control">


</div></div>

<div class="input-group m-b-20"><span class="input-group-addon">
<i class="md md-person"></i></span><div class="fg-line">

 <input type="password" required="" placeholder="Repeat Password" id="reset-pswd-repeat" class="form-control">
										
</div></div>

<div class="clearfix"></div>


<button class="btn btn-login btn-danger btn-float waves-effect waves-button waves-float" id="reset-pswd-btn"><i class="md md-arrow-forward"></i></button>

</form>


<?php

}

?>

<ul class="login-navigation">
<li  class="bgm-orange"><a href="<?php echo helpers::base_url(); ?>">Home</a></li>
</ul>

</div>

</body>