<!DOCTYPE html>
<html lang="en">


<?php

$base_url = helpers::base_url();
$yiics = Yii::app()->getClientScript();

$yiics->registerScriptFile($base_url."/static/js/jquery.js",CClientScript::POS_END);
$yiics->registerScriptFile($base_url."/static/js/jquery_migrate.js",CClientScript::POS_END);
$yiics->registerScriptFile($base_url."/static/js/bootstrap.min.js",CClientScript::POS_END);
$yiics->registerScriptFile($base_url."/static/js/jquery-ui-1.11.4.custom/jquery-ui.min.js",CClientScript::POS_END);
$yiics->registerScriptFile($base_url."/static/js/script.js",CClientScript::POS_END);

?>


  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if(empty($description)) echo $GLOBALS['app_config']['seo']['description'];else echo $description; ?>">
    <meta name="keywords" content="<?php if(empty($keywords)) echo $GLOBALS['app_config']['seo']['keywords'];else echo $keywords; ?>">
    <meta name="author" content="">
    <meta name="app_meta" content='<?php echo json_encode(helpers::AppMetaInfo()) ?>'>
    <link rel="shortcut icon" href="<?php echo $base_url."/static/images/favicon.png"; ?>" >
    <link rel="icon" type="image/x-icon" href="<?php echo Helpers::get_image("Favicon.ico"); ?>">

    <title><?php  echo !empty($this->pageTitle)? $this->pageTitle:Yii::app()->name; ?></title>


    <?php

	$yiics->registerCssFile($base_url."/static/css/bootstrap.min.css");
	$yiics->registerCssFile($base_url."/static/js/jquery-ui-1.11.4.custom/jquery-ui.css");
	$yiics->registerCssFile($base_url."/static/css/style.css");
	$yiics->registerCssFile($base_url."/static/css/main.css");
	$yiics->registerCssFile("http://fonts.googleapis.com/css?family=Lato:300,400,900");

    ?>

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="http://connect.facebook.net/en_US/sdk.js"></script>
    <script src="<?php echo helpers::base_url(); ?>/static/js/fb.js"></script>
    
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <meta name="google-signin-client_id" content="<?php echo GOOGLE_ID; ?>">
  </head>

  <body>

    
    <?php

    //render the navigation bar
    $this->Widget("Landingnavbar",array("user"=>helpers::GetUser()));


    ?>


	<?php  echo $content; ?>

	
	<div class="container">
		<hr>
		<div class="row centered">
			<div class="col-lg-6 col-lg-offset-3">
						<div class="centered"><a href="<?php echo AppURLs::PageURL("terms"); ?>">Terms</a> | <a href="<?php echo AppURLs::PageURL("privacy"); ?>">Privacy</a> | <a href="<?php echo AppURLs::PageURL("copyright"); ?>">Copyright</a> | <a href="<?php echo AppURLs::PageURL("contact"); ?>">Contact</a></div>
			
			</div>
			<div class="col-lg-3"></div>
		</div><!-- /row -->


		<hr>
		<p class="centered"><?php echo Yii::app()->name  ?> &copy; <?php echo helpers::current_year(); ?></p>
	</div><!-- /container -->
	
    
  </body>
</html>
