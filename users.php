<?php
   include("includes/includes.php");
   
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
      <title>Recent Users | Top Users | Recently Online- Frendsdom</title>
      <link rel="stylesheet" type="text/css" href="css8.css"/>
      <link rel="stylesheet" type="text/css" href="main_stylesheet.css"/>
      <script src="jquery-1.4.js" type="text/javascript"></script>
      <script src="script.js" type="text/javascript"></script>
      <script type="text/javascript" src="jquery.monnaTip.js"></script>
      <script type="text/javascript" src="scroll_to.js"></script>
      <script type="text/javascript" src="nicescroll.js"></script>
      <script type="text/javascript" src="js/jquery.flex.min.js"></script>
      <script>
         $(function(){$('*[title]').monnaTip()});
      </script>
      <style type="text/css">
         .users-wrapper{min-height:750px;margin-top:100px}.page-caption{top:-10px;}
      </style>
   </head>
   <body>
  <div id="body">
      <?php 
         //insert Google analytic code
         include($ga_file); 
         
         //put navigation bar
         include("modules/nav/nav.php");
         $nav=new nav();
         $nav->get_nav_2();
         
         ?>
      <div class="users-wrapper">
         <div class="recent-users center" id="recent-users">
            <div class="page-caption">People who are new to Frendsdom</div>
            <?php 
               //get Pic Grid module
               include('modules/pic_grid/pic_grid.php');
               
               $grid=new pic_grid();
               
               //render grid
               $grid->put_new_users_grid();
               ?>
         </div>
         <div class="center top-users none" id="top-users">
            <div class="page-caption">Top users on Frendsdom</div>
            <?php 
               //get Top Users module
               include('modules/top_users/top_users.php');
               
               $tu=new top_users();
               
               //render users
               $tu->put_dock();
               ?>
         </div>
         <div class="center online-users none" id="online-users">
            <div class="page-caption">People recently found online</div>
            <?php 
               //get Recntly Online module
               include('modules/recently_online/recently_online.php');
               
               $ro=new recently_online();
               
               //render users
               $ro->put_recently_online();
               ?>
         </div>
      </div>
      <?php get_footer_1(); ?>
</div>
   </body>
</html>