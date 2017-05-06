<?php
   include("environment.php");
   
   //compressing HTML content 
  // ob_start("ob_gzhandler"); 
   
   ?>
<!doctype html>
<html>
   <head>
      <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <META HTTP-EQUIV="Content-Language" Content="en">
      <meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application,top social networking,best social networking,top social network" />
      <meta name="description" content="social web application,sign up,log in" />
      <title>Contact- Frendsdom</title>
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
      <div class="page-caption">Contact us for your queries, suggestions, feedback or anything related to or involving Frendsdom.</div>
      <div class="cu_form">
         <div >
            <p>Please fill all the following fields.</p>
            <center>
               <form onsubmit="return cu_send_msg(this);">
                  <table cellspacing="10">
                     <tr>
                        <td align="right"><label class="light_text pointer" for="cu_vn">Name</label></td>
                        <td><input type="text" id="cu_vn" required="yes" class="blue_onhover "/></td>
                     </tr>
                     <tr>
                        <td align="right"><label class="light_text pointer" for="cu_vemail">Email</label></td>
                        <td><input type="email" id="cu_vemail" required="yes" class="blue_onhover "/></td>
                     </tr>
                     <tr>
                        <td align="right"><label class="light_text pointer" for="cu_sub">Subject</label></td>
                        <td><input type="text" id="cu_sub" required="yes" class="blue_onhover "/></td>
                     </tr>
                     <tr>
                        <td align="right"><label class="light_text pointer" for="cu_msg">Message</label></td>
                        <td><textarea id="cu_msg" class="blue_onhover flexible_textarea" style="height:70px;" required="yes"></textarea></td>
                     </tr>
                     <tr>
                        <td></td>
                        <td><input type="submit" value="Send" class="special_btn" id="cu_submit"/></td>
                     </tr>
                  </table>
               </form>
            </center>
            <div class="center small" style="margin-top:50px;margin-left:62px;">In case this form fails to work, you can send mail directly to <a href="mailto:admin@frendsdom.com"><b>admin@frendsdom.com</b></a></div>
         </div>
      </div>
      <?php get_footer_1(); ?>
   </body>
</html>
