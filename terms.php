<?php
   
	include("environment.php");
   
   //compressing HTML content 
   //ob_start("ob_gzhandler"); 
   
   ?>
<!doctype html>
<html>
   <head>
      <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <META HTTP-EQUIV="Content-Language" Content="en">
      <meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application,top social networking,best social networking,top social network" />
      <meta name="description" content="social web application,sign up,log in" />
      <title>Terms and Conditions- Frendsdom</title>
      <link rel="stylesheet" type="text/css" href="css8.css"/>
      <link rel="stylesheet" type="text/css" href="main_stylesheet.css"/>
      <script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script>
      <script type="text/javascript" src="main_script.js"></script>
   </head>
   <body>
      <?php 
         //insert google analytic code
         include($ga_file); 
         
         get_header_1();
         
         ?>
      <div class="center">
      <div class="page-caption">Terms and Conditions</div>

<div class="policies-container site_width centered left">


<h2>Terms and conditions</h2>
               <p>By signing up, you indicate that you agree to our terms and conditions.</p>
               
                  
                     <p>
                        You are not allowed to upload any picture anywhere on the site that might be perceived as sexually explicit or obscene in nature. We are highly against such actions and can't tolerate them. You are requested to keep the website safe and clean for people of any age group or community.
                     </p>
                     <p>
                        A person can report against others on following grounds-

<br/>The person witnesses or receives content belonging to or produced by another that may contain :


</p>
                        
<ul>

                        <li>
                           Violence and Threats
                        </li>
                        <li>
                           Self-Harm
                        </li>
                        <li>
                           Bullying and Harassment
                        </li>
                        <li>
                           Hate Speech
                        </li>
                        <li>
                           Disturbing Graphic Content
                        </li>
                        <li>
                           Phishing and Spam
                        </li>
                        <li>
                           Security breach
                        </li>
                     </ul>
                     <p>
                        Website administrators can access and delete or alter your account settings and other personal data if necessary for probing purposes in case someone reports against you.
                     </p>
                     <p>
                        You agree that you will not provide false information during signing up and will maintain only one legitimate Frendsdom account.
                     </p>
                     <p>You agree that you will never intentionally  try to put efforts to damage website by means of uploading virus affected content or carrying out other hacking attacks. You understand that any damage caused by you could cause a lot of inconvenience to others and may take some time and efforts from our side to be recovered.</p>
                     <p>We reserve all rights not expressly granted to you.</p>
                     <p>We hold the right to permanently delete your account without any prior notification or communication if the terms are violated to a serious extent. The same action can be taken not only for these terms but also for unforeseen activities that might be deemed as unacceptable. We are highly in favor of Freedom of Expression. However We expect you to be able to judge whether your own activities lie within certain boundaries.</p>
                  

</div>

</div>

      <?php get_footer_1(); ?>
   </body>
</html>
