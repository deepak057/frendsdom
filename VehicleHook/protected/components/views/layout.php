<?php

//URL to theme's static content
$theme_url=AppURLs::ThemeUrl();

//URL to BX slider's bundle directory
$bx_slider_url=AppURLs::BundleURL("bx_slider"); 

//URL to Pointy's bundle directory
$pointy_js_url=AppURLs::BundleURL("pointy");

//URL to TokkenInput's bundle directory
$tokkenInput_url=AppURLs::BundleURL("tokken_input");

//URL to Waypoint's bundle directory
$waypoints_url=AppURLs::BundleURL("waypoints");


?>
<!Doctype html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app_meta" content='<?php echo json_encode(helpers::AppMetaInfo()) ?>'>
        <link rel="icon" type="image/x-icon" href="<?php echo Helpers::get_image("Favicon.ico"); ?>">
        <title><?php if(!empty($title)) echo $title ;else echo Yii::app()->name; ?></title>

        <!-- Vendor CSS -->
        <link href="<?php echo $theme_url; ?>/css/fullcalendar.css" rel="stylesheet">
        <link href="<?php echo $theme_url; ?>/css/animate.css" rel="stylesheet">
        <link href="<?php echo $theme_url; ?>/css/sweet-alert.css" rel="stylesheet">
        <link href="<?php echo $theme_url; ?>/css/material-design-iconic-font.css" rel="stylesheet">
        <link href="<?php echo $theme_url; ?>/css/socicon.css" rel="stylesheet">
        <link href="<?php echo $theme_url; ?>/css/lightGallary.css" rel="stylesheet">
         
        <!-- CSS -->
        <link href="<?php echo $theme_url; ?>/css/app_002.css" rel="stylesheet">
        <link href="<?php echo $theme_url; ?>/css/app.css" rel="stylesheet">

        <!-- Bx slider -->
        <link href="<?php echo $bx_slider_url; ?>/jquery.bxslider.css" rel="stylesheet" />

        <!-- Token Input -->
       <link href="<?php echo $tokkenInput_url; ?>/styles/token-input.css" rel="stylesheet"> 
       <link href="<?php echo $tokkenInput_url; ?>/styles/token-input-facebook.css" rel="stylesheet">

        <!--ShareBox extension-->
        <link href="<?php echo AppURLs::Path2URL(Yii::getPathOfAlias('ext.sharebox.')."/assets/style.css"); ?>" rel="stylesheet"> 


      	<!-- Custom rules -->	
	   <link href="<?php echo helpers::base_url(); ?>/static/css/style.css" rel="stylesheet">
	

        
    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>
    

<?php echo $content; ?>

<!-- Javascript Libraries -->
        <script src="<?php echo $theme_url; ?>/js/jquery-2.js"></script>
        <script src="<?php echo $theme_url; ?>/js/bootstrap.js"></script>
        
        <script src="<?php echo $theme_url; ?>/js/jquery_004.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery_003.js"></script>
        <script src="<?php echo $theme_url; ?>/js/curvedLines.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery_006.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery.js"></script>
        
        <script src="<?php echo $theme_url; ?>/js/moment.js"></script>
        <script src="<?php echo $theme_url; ?>/js/fullcalendar.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery_005.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery_007.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery_002.js"></script>
        <script src="<?php echo $theme_url; ?>/js/waves.js"></script>
        <script src="<?php echo $theme_url; ?>/js/bootstrap-growl.js"></script>
        <script src="<?php echo $theme_url; ?>/js/sweet-alert.js"></script>
        <script src="<?php echo $theme_url; ?>/js/bootstrap-datetimepicker.min.js
"></script>
        <script src="<?php echo $theme_url; ?>/js/lightGallary.js"></script>
        <script src="<?php echo $theme_url; ?>/js/curved-line-chart.js"></script>
        <script src="<?php echo $theme_url; ?>/js/line-chart.js"></script>
        <script src="<?php echo $theme_url; ?>/js/bootstrap_select.js"></script>
        <script src="<?php echo $theme_url; ?>/js/jquery.bootstrap.wizard.min.js"></script>


        <script src="<?php echo $tokkenInput_url; ?>/src/jquery.tokeninput.js"></script>

        <script src="<?php echo $theme_url; ?>/js/charts.js"></script>
        <script src="<?php echo $theme_url; ?>/js/functions.js"></script>
        <script src="<?php echo $bx_slider_url; ?>/jquery.bxslider.min.js"></script>
        <script src="<?php echo $pointy_js_url; ?>/src/jquery.pointy.js"></script>
        <script src="<?php echo $waypoints_url; ?>/lib/jquery.waypoints.js"></script>
    	<script src="<?php echo helpers::base_url(); ?>/static/js/masonry.js"></script>
        <script src="<?php echo helpers::base_url(); ?>/static/js/scroll_to.js"></script>
         <script src="<?php echo helpers::base_url(); ?>/static/js/script.js"></script>


</html>
