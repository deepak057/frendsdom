<?php

//including system environment
include("environment.php");

//verifying log-in
check_log_in($_SERVER["REQUEST_URI"]);
   
//including following file that contains definition of class user 
include('class_lib.php');
   
//creating object lu(logged-in user)
   $lu=new user(uid());
?>

<!doctype html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <META HTTP-EQUIV="Content-Language" Content="en"/>
      <meta name="Description"  content="Visit other user's or one's own profile"/>
      <title>Discover People -Frendsdom</title>
      <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
      <script src="jquery-1.4.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
<script src="nicescroll.js"></script>
<script src="scroll_to.js"></script>
<script src="apprise/apprise.min.js" type="text/javascript"></script>
<script src="jquery.hovercard.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.monnaTip.js"></script>
<script src="js/jquery.outside.events.js"></script>
<script type="text/javascript" src="jplayer.js"></script>
<script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script>
      <script type="text/javascript" src="resources/jquery/js.js"></script>
<script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script>
<script type="text/javascript" src="tokeninput/src/jquery.tokeninput.js"></script>
<script type="text/javascript" src="jquery.flexibleArea.js"></script>
<script type="text/javascript" src="chat/chat.js"></script>
<script type="text/javascript" src="noty/js/jquery.noty.js"></script>
<script type="text/javascript" src="noty/js/layouts/top.js"></script>
<script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script>
<script type="text/javascript" src="noty/js/themes/default.js"></script>
      <script type="text/javascript" src="js/liteaccordion.jquery.min.js"></script>
      <script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
      <script type="text/javascript" src="jeditable.js"></script>
      <script src="js/jquery.prettyPhoto.js"></script>
      <script src="js/minimalect.js"></script>
      <script type="text/javascript" src="fancyBox_source/jquery.fancybox.js"></script>
      <script type="text/javascript" src="js/masonry.js"></script>
	<script type="text/javascript" src="js/discover_script.js"></script>	

      <link rel="stylesheet" type="text/css" href="css8.css">
      <link rel="stylesheet" type="text/css" href="css/discover_stylesheet.css">


      <link rel="stylesheet" type="text/css" href="css/minimalect.css">
      <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css"/>
      <link rel="stylesheet" type="text/css" href="fancyBox_source/jquery.fancybox.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
      <link href="http://jplayer.org/latest/skin/pink.flag/jplayer.pink.flag.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/>
      <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
      <link rel="stylesheet" href="tokeninput/styles/token-input-facebook.css" type="text/css" />
      <link rel="stylesheet" type="text/css" href="chat/chat.css"/>
      <link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
      <script type="text/javascript">
 vars['lu_name']="<?php echo tunethename($lu->first." ".$lu->last)?>";vars['lu_profile']="<?php echo get_profile_url($lu->id); ?>";vars['lu_dp']="<?php echo prof_pic($lu->id); ?>";
</script>
   </head>
   <body id="mother_body">
      <?php 
         //insert google analytic code
         include($ga_file); 
         
         ?>
      <div id="body" style="margin-top:70px;">
         <?php
            //put navigation
            include("modules/nav/nav.php");
            $nav=new nav();
            $nav->get_nav_3($lu);
            ?>


<div class="page-caption" style="top:18px;">Find out what people said recently</div>
         

<div id="posts-container" class="center">
<?php
            //put content
            include(get_module_path("discover/discover_people.php"));
            $dp_module=new discover_people();
            

	$dp_module->get_view();

?>
</div>            

</div>

<iframe id='fback_statistic_post' class='fback_statistic none' name='fback_statistic_post'></iframe>


</body>
</html>