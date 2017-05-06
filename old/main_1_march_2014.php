<?php
   
   include("environment.php");

   //if logged-in cookies are found on client's system then redirect user to home page
   to_home();
   
   //keeping record of user's visit
   keep_track();
   
   //compressing HTML content 
   ob_start("ob_gzhandler"); 
   
   //get the path of background image
   $back_img=random_pic($path_bg_images);


   ?>
<!doctype html>
<html itemscope="itemscope" itemtype="http://schema.org/WebPage" lang="en">
   <head>
      <meta charset="utf-8" />
      <meta itemprop="image" content="awesom.bmp"/>
      <link rel="shortcut icon" href="awesom.bmp">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <meta name="keywords" content="social network,social networking,social web application,new social networking,new social network,have fun,new social web application,web 2.0 sites,social media sites,new social networking sites,find new friends,find people" />
      <meta name="description" content="An emerging colorful social web application with new, colorful and innovative fun features. It allows users to socialize online in ways completely different from those popularized by today's big social networks and aims to be an unique one in the field of social networking ,free to join" />
      <meta name="author" content="Deepak Mishra" />
      <meta name="robots" content="index,follow" />
      <title>A social network to expand your world</title>
      <script src="jquery-1.4.js" type="text/javascript"></script>
      <script src="script.js" type="text/javascript"></script>
      <script src="js/jquery.outside.events.js" type="text/javascript"></script>
      <script src="nicescroll.js" type="text/javascript"></script>
      <script src="scroll_to.js" type="text/javascript"></script>
      <script src="jquery.flexibleArea.js" type="text/javascript"></script>
      <script type="text/javascript" src="intro_script_main.js"></script>
      <script type="text/javascript" src="main_script.js"></script>
      <link type="text/css" rel="stylesheet" href="css8.css"/>
      <link rel="stylesheet" type="text/css" href="main_stylesheet.css"/>
      <link rel="stylesheet" type="text/css" href="css/main_new2.css"/>
      <style type="text/css">.content{background:url(<?php echo  $back_img; ?>) no-repeat}</style>
   </head>
   <body>
      <?php 
         //insert google analytic code
         include($ga_file); 
         
         ?>
      <div class="wrapper" id="body">
         <div class="header">
            <div class="header-wrapper">
               <div class="fl">
                  <a href="<?php echo SITE_URL;?>" title="Frendsdom"><img width="200" style="position:relative;top:20px;" alt="logo" src="images/frendsdom.gif"/></a>
               </div>
               <div class="fr">
                  <table class="nav">
                     <tr>
                        <td><a id="wii-btn" href="javascript:void(0)" title="Know more about Frendsdom">What Is It?</a></td>
                        <td><a href="javascript:void(0)" onclick="about_init();" title="Why should you join?">Reasons To Join</a></td>
                        <td><a id="cu_btn" href="javascript:void(0)" title="Contact us">Contact Us</a></td>
                     </tr>
                  </table>
               </div>
               <div class="clear"></div>
            </div>
         </div>
         <div class="content">
            <div class="site-width">
               <div class="sign-up-register">
                  <h1>Member <span class="orange">Login !</span></h1>
                  <center>
                     <form name="login" action="check.php" method="POST">
                        <table cellspacing="10">
                           <tr>
                              <td><label for="email">Email</label></td>
                              <td><input type="email" name="user" placeholder="Email" id="email" class="main-input-field"/></td>
                           </tr>
                           <tr>
                              <td><label for="main-password">Password</label></td>
                              <td><input type="password" name="pass" id="main-password" placeholder="Password" class="main-input-field"/></td>
                           </tr>
                           <tr>
                              <td></td>
                              <td><input type="checkbox" id="login-check" name="loggedin" value="true"/><label for="login-check" class="pointer">Remember me</label></td>
                           </tr>
                           <tr>
                              <td colspan="2" align="center"><input class="big-btn grey-back" type="submit" value="LOGIN"/></td>
                           </tr>
                           <tr>
                              <td colspan="2" align="center">
                                 <a href="signup.php" class="big-btn orange-back" title="Sign up with Frendsdom">JOIN IT'S FREE</a>
                              </td>
                           </tr>
                           <tr>
                              <td><a onclick="about_init();" class="light_text small" href="javascript:void(0)" title="Learn why you should join in"><u>Why Join?</u></a></td>
                              <td align="right"><a class="light_text small" href="forgot_pswd.php" title="Set a new password">Forgot your password?</a></td>
                           </tr>
                        </table>
                     </form>
                  </center>
               </div>
               <div class="content-bottom">
                  <div class="fhmf-div left">
                     <h3>Frendsdom helps you make friends from all around the world</h3>
                     <table>
                        <tr>
                           <td>
                              <table cellspacing="10">
                                 <tr>
                                    <td class="width_"><img alt="make points" src="images/main-mp.gif"/></td>
                                    <td align="left">
                                       <h4>Be Creative, Be Interesting</h4>
                                       <p>Share something interesting and make people give their feedback or comment.</p>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td>
                              <table cellspacing="10">
                                 <tr>
                                    <td class="width_">
                                       <img alt="find people" src="images/main-fp.gif"/>
                                    </td>
                                    <td align="left">
                                       <h4>Find People</h4>
                                       <p>Find people of your interest from anywhere in the world.</p>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table cellspacing="10">
                                 <tr>
                                    <td class="width_">
                                       <img alt="offer points" src="images/main-op.gif"/>
                                    </td>
                                    <td align="left">
                                       <h4>Invite Them</h4>
                                       <p>Offer them some points so that they accept your invitation.</p>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td>
                              <table cellspacing="10">
                                 <tr>
                                    <td class="width_">
                                       <img alt="other features" src="images/main-lm.gif"/>
                                    </td>
                                    <td align="left">
                                       <h4>Lot More</h4>
                                       <p>A lot of other unique features for you to discover.</p>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <ul class="user-pics">
                     <?php
                        
                        //get Pic Grid module
                        include('modules/pic_grid/pic_grid.php');
                        
                        foreach (pic_grid::get_latest_users(5) as $user){
                        ?>
                     <li>
                        <a title="<?php echo $user['name']." from ".$user['country']; ?>" href="<?php echo get_profile_url($user['id']); ?>"><img src="<?php echo prof_pic($user['id']); ?>" alt="<?php echo $user['name']; ?>"/></a>
                     </li>
                     <?php
                        }
                        
                        
                        ?>
                  </ul>
                  <div class="clear"></div>
               </div>
            </div>
         </div>
         <?php echo get_footer_1(); ?>
      </div>
   </body>
</html>