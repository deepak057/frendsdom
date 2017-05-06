
	
						<div class="row">
							<div class="col-md-12">
								<!--Login via
								<div class="social-buttons">
									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
								<span class="mark-it">or</span></div>-->
										<div class="form-group">
											Login via
										</div>
                                 		<div class="form-group social_buttons">
											  <button onclick="fb_login();" onlogin="checkLoginState();" type="submit" id="login-submit-fb" class="btn btn-primary btn-block facebook_login_button"><i class="fa fa-facebook" aria-hidden="true"></i>
 Facebook</button>
										<!--<div class="g-signin2" data-onsuccess="onSignIn"></div> -->
										<button id="customBtn" class="customGPlusSignIn btn btn-primary btn-block google_login_button">Google</button>
										</div>
										<div class="form-group">
											Or
										</div>
								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">

										<div class="form-group">
											 <label class="sr-only" for="login-email">Email address</label>
											 <input type="email" class="form-control" id="login-email" placeholder="Email address" required>
										</div>

										<div class="form-group">
											 <label class="sr-only" for="login-password">Password</label>
											 <input type="password" class="form-control" id="login-password" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="" class="toogle-class" show-elm="#forgot-password-form" hide-elm="#login-nav">Forgot the password ?</a></div>
										</div>

										<div class="form-group">
											 <button type="submit" id="login-submit" class="btn btn-primary btn-block">Sign in</button>
										</div>
										<div class="checkbox">
											 <label>
											 <input type="checkbox" name="login-remember" id="login-remember"> keep me logged-in
											 </label>
										</div>

								 </form>
										
										


								 <form class="form none" role="form" method="post" accept-charset="UTF-8" id="forgot-password-form">
								 	<div>Please enter your email address to continue.</div>
								 	<div class="form-group">
											 <label class="sr-only" for="login-email">Email address</label>
											 <input type="email" class="form-control" id="forgot-email" placeholder="Email address" required>
											  <div class="help-block text-right"><a href="" class="toogle-class" hide-elm="#forgot-password-form" show-elm="#login-nav">Cancel</a></div>
										</div>
<div class="form-group">
											 <button type="submit" id="forgot-submit" class="btn btn-primary btn-block">Done</button>
										</div>

								 </form>



							</div>
							<!--<div class="bottom text-center">
								New here ? <a href="<?php echo Yii::app()->createAbsoluteUrl("site/signup"); ?>"><b>Join Us</b></a>
							</div>-->
					 </div>
			
