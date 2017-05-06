<?php

   include("environment.php");

   //get countries
   $countries=return_array("countries","country");
   
   //flag to put footer at relative position
   $footer_absolute=false;

   //compressing HTML content 
   //ob_start("ob_gzhandler"); 
   
   //function to check if signup is to be done by Facebook
   function fb_signup(){
   if(!empty($_GET['fb_signup']))
   return true;
   else return false;
   }
   
   ?>
<!doctype html>
<!--[if IE 8]> 
<html class="ie8" lang="en">
   <![endif]-->
   <!--[if IE 9]> 
   <html class="ie9" lang="en">
      <![endif]-->
      <!--[if (gt IE 9)|!(IE)]><!--> 
      <html lang="en">
         <!--<![endif]-->
         <head>
            <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
            <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>" />
            <title>Sign up with Frendsdom</title>
            <script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script>
            <script type="text/javascript" src="jquery.monnaTip.js"></script>
            <script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script>
            <script src="js/idealforms/jquery.idealforms.min.js" type="text/javascript"></script>
            <link rel="stylesheet" type="text/css" href="css8.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css" />
            <link rel="stylesheet" type="text/css" href="js/idealforms/jquery.idealforms.min.css" />
            <style type="text/css">.wrapper{
               margin:0px auto;
               }
               .wrapper .fl,.wrapper .fr{
               width:480px;
               text-align:left;
               min-height:700px;
               }
              .site_width{
              width:1020px
              }
               .wrapper .fr{
               border-left:1px solid #d2d2d2;
               padding-left:20px;
               }
               .fb-s{
               padding:0px 5px;
               border:1px solid #d2d2d2;
               color:grey;
               background:#eee;
               }
               ol li{
               margin-bottom:20px;
               }
               #tc{
               font-size:13px;
               color:#666;
               }#my-form{
               border:1px solid #e9e9e9;
               margin-bottom:20px;
               padding:0 8px
               }

            </style>
            <script type="text/javascript">
               $(function(){$('*[title]').monnaTip()});
            </script>
               </head>
               <body>
               <?php 
                  //insert google analytic code
                  include($ga_file); 
                  
                  ?>
               <div id="body">
              
 <?php get_header_1(); ?>

               <?php
                  if(!empty($_POST['first'])&& !empty($_POST['last'])&& !empty($_POST['sex'])&& !empty($_POST['dob'])&& !empty($_POST['email'])&& !empty($_POST['pass1'])&& !empty($_POST['pass2'])&& !empty($_POST['country'])&& !empty($_POST['state'])&& !empty($_POST['city'])){
                  echo "<center><div class='creation_report shaded_grey_back'>";
                  require('confirm.php');
                  $footer_absolute=true;
                  echo "</div></center>";
                  }
                  else{
                  ?>
               <div class="wrapper site_width">
               
               <div class="fl">
               
               <?php 
                  if(fb_signup()){
                  ?>
               <div id="fb-root"></div>
               <script src="https://connect.facebook.net/en_US/all.js#appId=396952593717300&xfbml=1">
            </script>
            <div style="position:relative;left:-14%;">
               <fb:registration 
                  fields="[{'name':'name'},{'name':'first_name'},{'name':'last_name'},{'name':'birthday'},{'name':'gender'},{'name':'location'},{'name':'email'},{'name':'state','description':'State/Province','type':'text'},{'name':'password'}]"
                  redirect-uri="<?php echo $url_to_process_fb_data; ?>"
                  width="530"></fb:registration>
            </div>
            <?php
               }
               else{
               ?>
            <form id="my-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
               <section name="Basic information">
                  <div>
                     <h1>Basic information</h1>
                     <p>Please let us know a little bit about you</p>
                  </div>
                  <!-- Text -->
                  <div><label>First Name:</label><input type="text" name="first" /></div>
                  <div><label>Last Name:</label><input type="text" name="last" /></div>
                  <div><label>Date of birth:</label><input type="text" name="dob" placeholder="mm/dd/yyyy" /></div>
                  <div>
                     <label>You are:</label>
                     <label><input type="radio" name="sex" value="male" />Male</label>
                     <label><input type="radio" name="sex" value="female" />Female</label>
                  </div>
                  <div>
                     <label>Country:</label>
                     <select name="country">
                        <option value="">....Please choose....</option>
                        <?php 
                           foreach($countries as $country){
                           echo '<option value="'.$country.'">'.$country.'</option>';
                           }
                           ?>
                     </select>
                  </div>
                  <div>
                     <label>State/Province:</label>
                     <input type="text" name="state" placeholder="State" />
                  </div>
                  <div>
                     <label>City:</label>
                     <input type="text" name="city" placeholder="City" />
                  </div>
               </section>
               <section name="Account information">
                  <div>
                     <h1>Account information</h1>
                     <p>Email and password</p>
                  </div>
                  <div>
                     <label>Email:</label>
                     <input type="text" name="email" />
                  </div>
                  <div>
                     <label>Password:</label>
                     <input type="password" name="pass1" id="pass1" />
                  </div>
                  <div>
                     <label>Confirm password:</label>
                     <input type="password" name="pass2" />
                  </div>
                  
               </section>
               <div>
                  <hr />
               </div>
               <div>
                  <button type="submit" id="s_f">Submit</button>
                  <button id="reset" type="button">Reset</button>
               </div>
            </form>
            <?php
               }
               ?>
            </div>
            <div class="fr">
               <h3>Terms and conditions</h3>
               <p>By signing up, you must agree to our <u><b><a target="_blank" href="<?php echo SITE_URL."/terms.php"; ?>">Terms & Conditions</a></b></u>.</p>
<p>Read our <u><b><a target="_blank" href="<?php echo SITE_URL."/privacy.php"; ?>">Privacy Policy</a></b></u>.</p>
               
               <div class="none" id="tc">
                  <ol>
                     <li>
                        You are not allowed to upload any picture anywhere on the site that might be perceived as sexually explicit or obscene in nature. We are highly against such actions and can't tolerate them. You are requested to keep the website safe and clean for people of any age group or community.
                     </li>
                     <li>
                        A person can report against others on following grounds-
                        <p>The person witnesses or receives content belonging to or produced by another that may contain :</p>
                        <p>
                           -Violence and Threats
                        </p>
                        <p>
                           -Self-Harm
                        </p>
                        <p>
                           -Bullying and Harassment
                        </p>
                        <p>
                           -Hate Speech
                        </p>
                        <p>
                           -Disturbing Graphic Content
                        </p>
                        <p>
                           -Phishing and Spam
                        </p>
                        <p>
                           -Security breach
                        </p>
                     </li>
                     <li>
                        Website administrators can access and delete or alter your account settings and other personal data if necessary for probing purposes in case someone reports against you.
                     </li>
                     <li>
                        You agree that you will not provide false information during signing up and will maintain only one legitimate Frendsdom account.
                     </li>
                     <li>You agree that you will never intentionally  try to put efforts to damage website by means of uploading virus affected content or carrying out other hacking attacks. You understand that any damage caused by you could cause a lot of inconvenience to others and may take some time and efforts from our side to be recovered.</li>
                     <li>We reserve all rights not expressly granted to you.</li>
                     <li>We hold the right to permanently delete your account without any prior notification or communication if the terms are violated to a serious extent. The same action can be taken not only for these terms but also for unforeseen activities that might be deemed as unacceptable. We are highly in favor of Freedom of Expression. However We expect you to be able to judge whether your own activities lie within certain boundaries. If you can't do that, we can't help.</li>
                  </ol>
               </div>
               <?php if(!fb_signup()){?>
               <div class="fb-s">
                  <h4>To save time, you can</h4>
                  <p><a href="<?php echo selfURL()."?fb_signup=true"; ?>"><img src="/images/register-with-facebook-sml.gif" /></a></p>
               </div>
               <?php
                  }
                  ?>
            </div>
            <div class="clear"></div>
            <script>
               var captcha_passed=true;
               
               function reloadCaptcha()
                       {
                           document.getElementById('siimage').src = 'modules/securimage/securimage_show.php?sid=' + Math.random();
                       }
               
               $('.toggle_tc').click(function() {
               $('#tc').toggle('slow');
               });
               
                var options = {
               
                   onFail: function(e) {
                     //alert( $myform.getInvalid().length +' invalid fields.' )
                   },
               
               onSuccess:function(e){
               
               if(!captcha_passed)
               e.preventDefault();
               
               $("#p_c").html("<img src='picon1.gif'/>").show();
               
               $.post("modules/securimage/check.php",{ct_captcha:$("#ct_captcha").val()},function(d){
               if(d=="true"){
               $myform.removeFields('ct_captcha');
               captcha_passed=true;
               $("#my-form").submit();
               }
               else{
               $("#p_c").html("<span style='color:red'>CAPTCHA test failed. Please try again</span>");
               reloadCaptcha();
               }
               
               });
               
               
               },
               
                   inputs: {
               
               'first':{filters:'required first min max name',
                data: { min: 3, max: 15 },
                       errors: {
                         min: 'Your first name should have at least three characters',
                         max: 'Sorry, your first name can not be longer than 15 characters'
                       }
               },
               
               'last':{filters:'required last min max',
                data: { min: 3, max: 25 },
                       errors: {
                         min: 'Your last name should have at least three characters',
                         max: 'Sorry, your last name can not be longer than 15 characters'
                       }
               },
               
               'dob':{filters:'required dob dob',format:'mm/dd/yyyy'},
               
                 
               
               'sex':{
                       filters: 'min',
                       data: { min: 1},
                       errors: {
                         min: 'Please specify your sex'
                         }
               },
               
               'country':{filters:'required country'},
               'state':{filters:'required state'},
               'city':{filters:'required city'},
               'email': {
                 filters: 'required email ajax',
                 data: {
                   ajax: { 
                     url: 'checkemail.php',
                     _success: function( resp, text, xhr ) {
                       //alert(xhr);
                     },
                     _error: function( xhr, text, error ) {
                       //alert(text);  
                     },
                     // Other $.ajax methods
                   }
                 },
                 errors: {
                   ajax: {
                     success: 'Invalid/registered email',
                     error: 'Sorry, there was an error on the server. Try again later.'
                   }
                 }
               }
               ,
               
               'pass1': {
                       filters: 'required pass1'
                     },
               
               'pass2': {
                 filters: 'required pass2 equalto',
                 data: { equalto: '#pass1' } ,
                errors: {
               
               equalto:'Must be same as password'
               
               }
                      
               
               }
               
                     
                   }
                 };
               
                 var $myform = $('#my-form').idealforms(options).data('idealforms');
               
                 $('#reset').click(function(){ $myform.reset().fresh().focusFirst() });
               
            </script>
            <?php
               }
               
               ?>
            </div>
<?php get_footer_1($footer_absolute); ?>
            </body>
      </html>