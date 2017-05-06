<?php
   include("environment.php");

   //if logged-in cookies are found on client's system then redirect user to home page
   to_home();
   
   //keeping record of user's visit
   keep_track();
   
   //compressing HTML content 
//   ob_start("ob_gzhandler"); 
   
   
   ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Deepak Mishra">
	<meta name="google-site-verification" content="oRCLqsQjyMwr97rUW-UAwdbfsTgr-tyaiOh_RAJcuno" />

   <title>A social network to expand your world</title>
               <meta name="keywords" content="social network,social networking,social web application,new social networking,new social network,have fun,new social web application,web 2.0 sites,social media sites,new social networking sites,find new friends,find people" />
               <meta name="description" content="An emerging colorful social web application with new, colorful and innovative fun features. It allows users to socialize online in ways completely different from those popularized by today's big social networks and aims to be an unique one in the field of social networking ,free to join" />
    <link rel="shortcut icon" href="<?php echo get_image("favicon.ico"); ?>">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
 <?php 

         //insert google analytic code
         include($ga_file); 
         
         ?>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo SITE_URL; ?>"><img src="<?php echo get_image("frendsdom.gif"); ?>" alt="logo"/></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo SITE_URL; ?>/users.php">Recent users</a>
                    </li>
                    <li>
                        <a target="_blank" href="http://circleshouts.com/">Circle Shouts</a>
                    </li><li>

<a href="<?php echo SITE_URL."/terms.php"; ?>" title="Terms & Conditions">Terms</a>
</li>
<li><a href="<?php echo SITE_URL."/privacy.php"; ?>">Privacy</a></li>
<li><a href="<?php echo SITE_URL."/copyright.php"; ?>">Copyright</a></li>
                    <li>
                        <a href="<?php echo SITE_URL; ?>/contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header -->
    <div class="intro-header">

        <div class="container">



            <div class="row">
                <div class="col-lg-12">

                <div class="alert alert-danger app-alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
 <div class="row">

    <div class="col-lg-8 text-left" >   


<h3>Circle Shouts: A platform for Sharing opinions.</h3>

<p>Sometimes people know the answer to a question but they want to hear other's opinion on it.</p>

</div>

    <div class="col-lg-3"> <a href="http://circleshouts.com" target="_blank" class="btn btn-lg btn-info">Visit the site!</a> </div>

 
</div>


  </div>
      

                </div>
                </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Frendsdom</h1>
                        <h3>A Social Network to expand your world</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="<?php echo SITE_URL; ?>/login.php" class="btn btn-default btn-lg"> <span class="network-name">Log in</span></a>
                            </li>
                            <li>
                                <a href="<?php echo SITE_URL; ?>/signup.php" class="btn btn-default btn-lg"> <span class="network-name">Sign up</span></a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Goal and Mission</h2>
                    <p class="lead">It allows users to connect with a cross-section of the unknown world! Different people from different cultures and backgrounds now have a similar ground to connect and truly learn about one-another.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="<?php echo SITE_URL; ?>/images/main_page/mission.JPG" alt="Goal and Mission">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">What it does</h2>
                    <p class="lead">Frendsdom cross-culturally connects users across the globe willing to share pieces of their lives with others looking to learn.</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="<?php echo SITE_URL; ?>/images/main_page/3.JPG" alt="What it does">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">How you benefit</h2>
                    <p class="lead">In this ever-broadening global future, Frendsdom allows people to connect and interact with like-minded people around the world.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="<?php echo SITE_URL; ?>/images/main_page/2.JPG" alt="How you benefit">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

<div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">How it's different</h2>
                    <p class="lead">Different social networks connect users with their own networks in varying degrees in every country. Frendsdom aims to break restrictive network boundaries and help users establish far-flung connections with different people around the world.</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="<?php echo SITE_URL; ?>/images/main_page/5.JPG" alt="How it's different">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>


<div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Advantages</h2>
                    <p class="lead">It opens a line to connect with others in a real way, creating a path for seemingly disconnected cultures to form friendships, business connections, and cultural awareness and appreciation.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="<?php echo SITE_URL; ?>/images/main_page/4.JPG" alt="Advantages">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect to Frendsdom:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a target="_blank" href="https://www.facebook.com/Frendsdom" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://twitter.com/frendsdom" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://plus.google.com/112605741449524685695" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google Plus</span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="<?php echo SITE_URL; ?>/users.php">Recent users</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a target="_blank" href="http://circleshouts.com">Circle Shouts</a>
   
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="<?php echo SITE_URL."/terms.php"; ?>" title="Terms & Conditions">Terms</a>

                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="<?php echo SITE_URL."/privacy.php"; ?>">Privacy</a>

                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
<li>
                            <a href="<?php echo SITE_URL."/copyright.php"; ?>">Copyright</a>


                        </li>                        <li class="footer-menu-divider">&sdot;</li>
<li>
<a href="<?php echo SITE_URL; ?>/contact.php">Contact</a>

</li>

                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Frendsdom <?php echo current_year(); ?>. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script type="text/javascript">

    $(document).ready(function(){

        var app_alert=$(".app-alert");

        if(app_alert.length){

            app_alert.slideDown(1000);
        }
    });

    </script>

</body>

</html>
