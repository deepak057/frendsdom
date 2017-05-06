<body class="login-content">

<?php 	$this->widget("Landingnavbar",array("links_enabled"=>true)); ?>


<div class="lc-block <?php if ($active=="sign_in") echo "toggled";?>" id="l-login">
<div class="form-text">Log In</div>
<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
								

<div class="input-group m-b-20">



<span class="input-group-addon">
<i class="md md-person"></i></span><div class="fg-line">
<input class="form-control" type="email" id="login-email" placeholder="Email address" required></div></div>

<div class="input-group m-b-20"><span class="input-group-addon">
<i class="md md-vpn-key"></i></span><div class="fg-line">
<input class="form-control" type="password" id="login-password" placeholder="Password" required></div></div>

<div class="clearfix"></div>

<div class="checkbox"><label><input type="checkbox" name="login-remember" id="login-remember"> <i class="input-helper"></i>Keep me signed in </label></div>

<button class="btn btn-login btn-danger btn-float waves-effect waves-button waves-float" id="login-submit"><i class="md md-arrow-forward"></i></button>

</form>

<ul class="login-navigation">


<li data-block="#l-register" class="bgm-red">Register</li>
 <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
 <li  class="bgm-orange"><a href="<?php echo helpers::base_url(); ?>">Home</a></li>

</ul>

</div>
<div class="lc-block <?php if ($active=="sign_up") echo "toggled";?>" id="l-register">
<div class="form-text">Join The Site Today</div>

<form class="form " role="form" method="post" accept-charset="UTF-8" id="signup-page-form">
<div class="input-group m-b-20"><span class="input-group-addon"><i class="md md-mail"></i></span>
<div class="fg-line">
<input required value="<?php echo $email?$email:""; ?>" class="form-control" placeholder="Email Address" type="email" id="signup-page-email" maxlength="150"></div></div>

<div class="input-group m-b-20"><span class="input-group-addon"><i class="md md-phone"></i></span>
<div class="fg-line">
<input required value="<?php echo $phone?$phone:""; ?>"  maxlength="15" class="form-control" placeholder="Phone" type="text" id="signup-page-mobile"></div></div>


<div class="input-group m-b-20"><span class="input-group-addon"><i class="md md-vpn-key"></i></span>
<div class="fg-line"><input class="none" name="axxssqq" type="text"/><input class="none" name="bxxssqq" type="password"/>
<input class="form-control" required placeholder="Password" type="password" id="signup-page-password"></div></div>
<div class="clearfix"></div><div class="checkbox"><label><input required id="signup-page-agreement-check" value="" type="checkbox"> <i class="input-helper"></i>Accept  </label> the <a target="_blank" href="<?php echo AppURLs::PageURL("terms") ?>"> <u>Terms and Conditions</u></a></div>
<button type="submit" class="btn" id="signup-page-submit">Sign Up</button>
</form>
<ul class="login-navigation">
<li data-block="#l-login" class="bgm-green">Login</li>
 <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
<li  class="bgm-orange"><a href="<?php echo helpers::base_url(); ?>">Home</a></li>

</ul>
</div>

<div class="lc-block <?php if ($active=="reset_password") echo "toggled";?>" id="l-forget-password">
<div class="form-text">Reset Password</div>

<form class="form " role="form" method="post" accept-charset="UTF-8" id="forgot-password-form">
							
<p class="text-left">

Please enter your email to continue.

<div class="input-group m-b-20">

<span class="input-group-addon"><i class="md md-email"></i></span>

<div class="fg-line">

<input class="form-control" type="email" id="forgot-email" placeholder="Email address" required></div></div>


<button class="btn btn-login btn-danger btn-float waves-effect waves-button waves-float" id="forgot-submit" type="submit"><i class="md md-arrow-forward"></i></button>

</form>

<ul class="login-navigation"><li data-block="#l-login" class="bgm-green">Login</li> <li data-block="#l-register" class="bgm-red">Register</li>
<li  class="bgm-orange"><a href="<?php echo helpers::base_url(); ?>">Home</a></li>


</ul></div><!--[if lt IE 9]><div class="ie-warning"><h1 class="c-white">IE SUCKS!</h1><p>You are using an outdated version of Internet Explorer, upgrade to any of the following web browser <br/>in order to access the maximum functionality of this website.</p><ul class="iew-download"><li><a href="http://www.google.com/chrome/"><img src="img/browsers/chrome.png" alt=""><div>Chrome</div></a></li><li><a href="https://www.mozilla.org/en-US/firefox/new/"><img src="img/browsers/firefox.png" alt=""><div>Firefox</div></a></li><li><a href="http://www.opera.com"><img src="img/browsers/opera.png" alt=""><div>Opera</div></a></li><li><a href="https://www.apple.com/safari/"><img src="img/browsers/safari.png" alt=""><div>Safari</div></a></li><li><a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie"><img src="img/browsers/ie.png" alt=""><div>IE (New)</div></a></li></ul>


<p>Upgrade your browser for a Safer and Faster web experience. <br/>Thank you for your patience...</p></div><![endif]-->
</body>

