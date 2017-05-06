<!DOCTYPE html>

<?php

$base_url = helpers::base_url();
$yiics = Yii::app()->getClientScript();


?>



<html class="csstransforms no-csstransforms3d csstransitions" lang="en"><head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8"> 

	<title><?php  echo !empty($this->pageTitle)? $this->pageTitle:Yii::app()->name; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<!-- FAVICON -->
	<link rel="shortcut icon" href="http://electricblaze.com/unicore/images/favicon.ico">



		<?php

	$yiics->registerScriptFile($base_url."/static/js/jquery_005.js",CClientScript::POS_END);
	$yiics->registerScriptFile($base_url."/static/js/bootstrap.js",CClientScript::POS_END);
	$yiics->registerScriptFile($base_url."/static/js/slick.js",CClientScript::POS_END);

	$yiics->registerScriptFile($base_url."/static/js/jquery.js",CClientScript::POS_END);
$yiics->registerScriptFile($base_url."/static/js/jquery_003.js",CClientScript::POS_END);

$yiics->registerScriptFile($base_url."/static/js/isotope.js",CClientScript::POS_END);

$yiics->registerScriptFile($base_url."/static/js/jquery_002.js",CClientScript::POS_END);
$yiics->registerScriptFile($base_url."/static/js/main.js",CClientScript::POS_END);

$yiics->registerScriptFile($base_url."/static/js/jquery_004.js",CClientScript::POS_END);

$yiics->registerScriptFile($base_url."/static/js/main_002.js",CClientScript::POS_END);



	$yiics->registerCssFile($base_url."/static/css/bootstrap.min.css");
	$yiics->registerCssFile($base_url."/static/css/style_004.css");
	$yiics->registerCssFile($base_url."/static/css/style_003.css");
	$yiics->registerCssFile($base_url."/static/css/style_002.css");
	$yiics->registerCssFile($base_url."/static/css/swipebox.css");

	$yiics->registerCssFile($base_url."/static/css/slick.css");
	$yiics->registerCssFile($base_url."/static/css/prettyphoto.css");
	$yiics->registerCssFile($base_url."/static/css/style.css");
	
	
	?>
	


    
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body id="page-top">

<div class="body">

	<!-- HEADER -->
	<header>
		<nav style="background: transparent none repeat scroll 0% 0%;" class="navbar-inverse navbar-lg navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="<?php echo $base_url; ?>" class="navbar-brand brand"><?php echo Yii::app()->name; ?></a>
				</div>

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right navbar-login">
						<li>
							<a href="#"><span class="icon-unlock2"></span> Login</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a class="page-scroll" href="#page-top">Home</a></li>
						<li><a class="page-scroll" href="#pricing">Pricing</a></li>
						<li class="dropdown">
							<a href="http://electricblaze.com/unicore/about.html">Pages</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="http://electricblaze.com/unicore/about.html">About</a></li>
								<li><a href="http://electricblaze.com/unicore/faq.html">Faq</a></li>
								<li><a href="http://electricblaze.com/unicore/404.html">404 Page</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="http://electricblaze.com/unicore/elements-alerts.html">Elements</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="http://electricblaze.com/unicore/elements-alerts.html">Alerts</a></li>
								<li><a href="http://electricblaze.com/unicore/elements-accordion.html">Accordion</a></li>
								<li><a href="http://electricblaze.com/unicore/elements-iconbox.html">Icon Box</a></li>
								<li><a href="http://electricblaze.com/unicore/elements-progressbar.html">Progress Bar</a></li>
								<li><a href="http://electricblaze.com/unicore/elements-tables.html">Tables</a></li>
								<li><a href="http://electricblaze.com/unicore/elements-team.html">Team</a></li>
								<li><a href="http://electricblaze.com/unicore/elements-tabs.html">Tabs</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="http://electricblaze.com/unicore/portfolio-2col.html">Portfolio</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="http://electricblaze.com/unicore/portfolio-2col.html">Portfolio - 2 col</a></li>
								<li><a href="http://electricblaze.com/unicore/portfolio-3col.html">Portfolio - 3 col</a></li>
								<li><a href="http://electricblaze.com/unicore/portfolio-4col.html">Portfolio - 4 col</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="http://electricblaze.com/unicore/blog-classic-full.html">Blog</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="http://electricblaze.com/unicore/blog-full.html">Blog - FullWidth</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-full-ls.html">Blog - Left Sidebar</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-full-rs.html">Blog - Right Sidebar</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-full-2col.html">Blog - 2 Col</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-full-3col.html">Blog - 3 Col</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-classic.html">Blog Classic</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-classic-ls.html">Blog Classic - Left Sidebar</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-classic-rs.html">Blog Classic - Right Sidebar</a></li>
								<li><a href="http://electricblaze.com/unicore/blog-single.html">Blog Single</a></li>
							</ul>
						</li>
						<li><a href="http://electricblaze.com/unicore/contact.html">Contact</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- INTRO -->
	<div class="intro intro6 " style="background:url(<?php echo Helpers::LandingPageImage(); ?>)">
		<div class="overlay"></div>
		<div class="container">
			<div class="row center-content center-content-ipad">
				<div class="col-md-10 col-md-offset-1 text-center">
					<h2>Search for a vehicle</h2>
				 	<!--<p>Search the vehicle owners by their vehicle number</p>-->
					<p class="lead"><input placeholder="Enter the vehicle number" type="text" class="form-control input-lg"/></p>
					<!--<a href="#" class="btn btn-lg btn-primary btn-cta">Search Now</a>-->
				</div>
			</div>
		</div>
	</div>

	<!-- SERVICES -->
	<section class="services">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4">
					<div class="service-box">
						<i class="icon2-laptop-phone"></i>
						<div>
							<h4>Responsive Design</h4>
							<p>Nam tellus turpis blandit et ligula sit amet mattis congue semper euismod massa auctor magna eget nunc iaculis nunc.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="service-box">
						<i class="icon2-magic-wand"></i>
						<div>
							<h4>Cross Browser</h4>
							<p>Nam tellus turpis blandit et ligula sit amet mattis congue semper euismod massa auctor magna eget nunc iaculis nunc.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="service-box">
						<i class="icon2-rocket"></i>
						<div>
							<h4>No Credit Card</h4>
							<p>Nam tellus turpis blandit et ligula sit amet mattis congue semper euismod massa auctor magna eget nunc iaculis nunc.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- INFO CONTENT -->
	<div class="info-content">
		<div class="container">
			<div class="row center-content">
				<div class="col-md-6 col-md-push-6">
					<h3>Creative &amp; Professional</h3>
					<p>Lorem ipsum dolor sit amet tempor incididunt laboris nisi 
aliquip ex. Suspendisse aliquet imperdiet commodo. Aenean vel lacinia 
elit. Class aptent taciti sociosqu ad litora torquent per.</p>
					<ul class="list">
						<li><i class="icon-check"></i> Etiam sed dolor ac diam volutpat</li>
						<li><i class="icon-check"></i> Erat volutpat aliquet imperdiet</li>
					</ul>
					<div class="space30"></div>
					<a href="#" class="btn btn-lg btn-primary">Learn More <i class="icon-arrow-right"></i></a>
				</div>

				<div class="col-md-6 col-md-pull-6 text-center">
					<img src="<?php echo Helpers::get_image("1.png");?>" class="pull-right" alt="">
				</div>
			</div>
		</div>
	</div>

	<!-- TESTIMONIALS -->
	<div class="testimonials">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">

					<div role="toolbar" class="quote slick-initialized slick-slider">
						<div aria-live="polite" class="slick-list draggable"><div role="listbox" style="opacity: 1; width: 5700px; left: -4395.84px;" class="slick-track"><div tabindex="-1" style="width: 1140px;" aria-hidden="true" data-slick-index="-1" class="slick-slide slick-cloned">
							<i class="icon-chat5"></i>
							<p>Unicore is hands down the most flexible and enjoyable HTML 
template. It was built with the awesome bootstrap framework and with 
multiple layouts and more.</p>
							<span class="author">Jackie Doe - Front End</span>
						</div><div aria-describedby="slick-slide00" role="option" tabindex="-1" style="width: 1140px;" aria-hidden="false" data-slick-index="0" class="slick-slide slick-current slick-active">
							<i class="icon-chat5"></i>
							<p>Unicore is hands down the most flexible and enjoyable HTML 
template. It was built with the awesome bootstrap framework and with 
multiple layouts and more.</p>
							<span class="author">Mark Dave - Web Design</span>
						</div><div aria-describedby="slick-slide01" role="option" tabindex="-1" style="width: 1140px;" aria-hidden="true" data-slick-index="1" class="slick-slide">
							<i class="icon-chat5"></i>
							<p>Unicore is hands down the most flexible and enjoyable HTML 
template. It was built with the awesome bootstrap framework and with 
multiple layouts and more.</p>
							<span class="author">John Doe - UX Designer</span>
						</div><div aria-describedby="slick-slide02" role="option" tabindex="-1" style="width: 1140px;" aria-hidden="true" data-slick-index="2" class="slick-slide">
							<i class="icon-chat5"></i>
							<p>Unicore is hands down the most flexible and enjoyable HTML 
template. It was built with the awesome bootstrap framework and with 
multiple layouts and more.</p>
							<span class="author">Jackie Doe - Front End</span>
						</div><div tabindex="-1" style="width: 1140px;" aria-hidden="true" data-slick-index="3" class="slick-slide slick-cloned">
							<i class="icon-chat5"></i>
							<p>Unicore is hands down the most flexible and enjoyable HTML 
template. It was built with the awesome bootstrap framework and with 
multiple layouts and more.</p>
							<span class="author">Mark Dave - Web Design</span>
						</div></div></div>

						

						
					<ul role="tablist" style="display: table;" class="slick-dots"><li id="slick-slide00" aria-controls="navigation00" aria-selected="true" role="presentation" aria-hidden="false" class="slick-active"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">1</button></li><li class="" id="slick-slide01" aria-controls="navigation01" aria-selected="false" role="presentation" aria-hidden="true"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">2</button></li><li class="" id="slick-slide02" aria-controls="navigation02" aria-selected="false" role="presentation" aria-hidden="true"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">3</button></li></ul></div>
				</div>
			</div>
		</div>
	</div>

	<!-- ABOUT -->
	<div class="about-inline text-center">
		<div class="container">
			<h3>Unicore provides wide range of<br>layouts for your every needs of a landing page.</h3>
			<p>Praesent non neque pretium, malesuada dui non, pretium neque. 
Aliquam at odio in sem aliquet faucibus tempor nibh sit amet est 
porttitor non dictum eros venenatis.</p>
			<img src="<?php echo Helpers::get_image("11.png");?> class="img-responsive center-block" alt="">
			<div class="ai-list">
				<ul>
					<li><i class="icon-plane"></i> Purchase</li>
					<li><i class="icon-signal"></i> Edit</li>
					<li><i class="icon-science"></i> Launch</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- INFO CONTENT -->
	<div class="info-content2">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-md-push-5">
					<div class="video-box">
						<a href="https://www.youtube.com/watch?v=ir1xdtIb-g0" class="prettyPhoto video-link">
						<img src="<?php echo Helpers::get_image("4.jpg");?>" alt="" class="img-responsive">
						<span class="icon-play2"></span>
						</a>
					</div>
				</div>

				<div class="col-md-5 col-md-pull-7">
					<h3>Responsive Devices</h3>
					<p>Lorem ipsum dolor sit amet tempor incididunt laboris nisi 
aliquip ex. Suspendisse aliquet imperdiet commodo. Aenean vel lacinia 
elit. Class aptent taciti sociosqu ad litora torquent per.</p>
					<ul class="list">
						<li><i class="icon-check"></i> Etiam sed dolor ac diam volutpat</li>
						<li><i class="icon-check"></i> Erat volutpat aliquet imperdiet</li>
					</ul>
					<div class="space20"></div>
					<a href="#" class="btn btn-lg btn-default">Learn More <i class="icon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<!-- FEATURES -->
	<div class="features-content">
		<div class="container">
			<div class="section-head text-center col-md-8 col-md-offset-2 space50">
				<h1>Features of Unicore</h1>
				<p>Lorem ipsum dolor sit amet consectetur adipiscing elit quisque 
elementum volutpat massa ac interdum velit imperdiet vel lacinia massa 
viverra dolor quis congue pellentesque.</p>
			</div>
			<div class="row">
				<div class="col-md-4 fc-info">
					<img src="<?php echo Helpers::get_image("1_002.jpg");?>" class="img-responsive" alt="">
					<div>
						<h4>Page Analysis</h4>
						<p>Lorem ipsum dolor sit amet tempor laboris nisi aliquip ex aliquet imperdiet commodo.</p>
						<a href="#">Learn More <i class="icon2-arrow-right"></i></a>
					</div>
				</div>
				<div class="col-md-4 fc-info">
					<img src="<?php echo Helpers::get_image("2.jpg");?>" class="img-responsive" alt="">
					<div>
						<h4>Corporate Training</h4>
						<p>Lorem ipsum dolor sit amet tempor laboris nisi aliquip ex aliquet imperdiet commodo.</p>
						<a href="#">Learn More <i class="icon2-arrow-right"></i></a>
					</div>
				</div>
				<div class="col-md-4 fc-info">
					<img src="<?php echo Helpers::get_image("3_002.jpg");?>" class="img-responsive" alt="">
					<div>
						<h4>Marketing Sales</h4>
						<p>Lorem ipsum dolor sit amet tempor laboris nisi aliquip ex aliquet imperdiet commodo.</p>
						<a href="#">Learn More <i class="icon2-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- PRICING -->
	<div class="pricing" id="pricing">
		<div class="container">
			<div class="section-head-lite text-center col-md-8 col-md-offset-2 space80">
				<h1>Choose your plan</h1>
				<p>Suspendisse egestas mattis rhoncus pellen tesque euismod erat at 
sed do eiusmod tempor posuere molestie lorem lectus interdum augue</p>
			</div>
			<div class="row">
				<div class="col-md-12">

					<!-- Pricing Plan - 1 -->
					<div class="col-md-4 col-sm-4">
						<div class="pricing__item">
							<h3 class="pricing__title">Startup</h3>
							<p class="pricing__sentence">Perfect for small less than 10 team</p>
							<div class="pricing__price"><span class="pricing__currency">$</span>19<span class="pricing__period">/ month</span></div>
							<ul class="pricing__feature-list">
								<li class="pricing__feature">1 GB of space</li>
								<li class="pricing__feature">Support at $25/hour</li>
								<li class="pricing__feature">Small social media</li>
							</ul>
							<button class="btn btn-default">Choose Plan</button>
						</div>
					</div>

					<!-- Pricing Plan - 2 -->
					<div class="col-md-4 col-sm-4">
						<div class="pricing__item pricing__item__popular">
							<div class="popular">Most Popular</div>
							<h3 class="pricing__title">Enterprise</h3>
							<p class="pricing__sentence">Perfect for small less than 10 team</p>
							<div class="pricing__price"><span class="pricing__currency">$</span>49<span class="pricing__period">/ month</span></div>
							<ul class="pricing__feature-list">
								<li class="pricing__feature">1 GB of space</li>
								<li class="pricing__feature">Support at $25/hour</li>
								<li class="pricing__feature">Small social media</li>
							</ul>
							<button class="btn btn-default">Choose Plan</button>
						</div>
					</div>

					<!-- Pricing Plan - 3 -->
					<div class="col-md-4 col-sm-4">
						<div class="pricing__item">
							<h3 class="pricing__title">Developer</h3>
							<p class="pricing__sentence">Perfect for small less than 10 team</p>
							<div class="pricing__price"><span class="pricing__currency">$</span>99<span class="pricing__period">/ month</span></div>
							<ul class="pricing__feature-list">
								<li class="pricing__feature">1 GB of space</li>
								<li class="pricing__feature">Support at $25/hour</li>
								<li class="pricing__feature">Small social media</li>
							</ul>
							<button class="btn btn-default">Choose Plan</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- INFO CONTENT -->
	<div class="info-content no-padding-bottom">
		<div class="container">
			<div class="row center-content center-content-ipad">
				<div class="col-md-6 col-sm-7 text-center">
					<img src="<?php echo Helpers::get_image("10.png");?>" class="img-responsive center-content" alt="">
				</div>
				<div class="col-md-6 col-sm-5">
					<h3>Unicore for Iphone</h3>
					<p>Lorem ipsum dolor sit amet tempor incididunt laboris nisi 
aliquip ex. Suspendisse aliquet imperdiet commodo. Aenean vel lacinia 
elit. Class aptent taciti sociosqu ad litora torquent per.</p>
					<div class="space30"></div>
					<a href="#" class="btn btn-lg btn-primary">Download on the app store <i class="fa fa-android"></i></a>
				</div>
			</div>
		</div>
	</div>

	<!-- FOOTER -->
	<footer>
		<div class="container">
			<ul class="list-inline">
				<li>
					<div class="footer-logo">Unicore</div>
				</li>
				<li>
					<div class="contact-info"><i class="fa fa-map-marker"></i><br>234 Wall Street<br>East Newyork, NY 20001</div>
				</li>
				<li>
					<div class="contact-info"><i class="fa fa-phone"></i><br>1800 1234 5678<br>(080) 1234 56789</div>
				</li>
				<li>
					<div class="contact-info no-border"><i class="fa fa-envelope"></i><br>info@website.com<br>Support@website.com</div>
				</li>
				<li class="pull-right">
					<div class="footer-social">
						<a href="#" class="fa fa-linkedin"></a>
						<a href="#" class="fa fa-facebook"></a>
						<a href="#" class="fa fa-twitter"></a>
						<a href="#" class="fa fa-dribbble"></a>
						<a href="#" class="fa fa-google-plus"></a>
						<a href="#" class="fa fa-instagram"></a>
					</div>
				</li>
			</ul>
		</div>
	</footer>

	<!-- COPYRIGHT -->
	<div class="footer-copy">
		<div class="container">
			&copy; <?php echo Helpers::Current_Year();?>  <?php echo Yii::app()->name; ?>.  All rights reserved.
		</div>
	</div>
</div>

<!-- STYLE SWITCHER 
============================================= -->

<!--<div class="b-settings-panel">
	<div class="simplebar visible">
	<div class="settings-section">
		<span>Boxed</span>
		<div class="b-switch">
			<div class="switch-handle"></div>
		</div>
		<span>Wide</span>
	</div>

	<div class="settings-section color-list">
	<h5>Color Scheme</h5>
		<div data-src="css/skin/default.css" class="active" style="background: #29d9c2"></div>
		<div data-src="css/skin/blue.css" style="background: #03A9F4"></div>
		<div data-src="css/skin/indigo.css" style="background: #3F51B5"></div>
		<div data-src="css/skin/cyan.css" style="background: #00BCD4"></div>
		<div data-src="css/skin/green.css" style="background: #4CAF50"></div>
		<div data-src="css/skin/yellow.css" style="background: #FFC107"></div>
		<div data-src="css/skin/orange.css" style="background: #FF9800"></div>
		<div data-src="css/skin/deep-orange.css" style="background: #FF5722"></div>
		<div data-src="css/skin/purple.css" style="background: #673AB7"></div>
		<div data-src="css/skin/pink.css" style="background: #E91E63"></div>
		<div data-src="css/skin/red.css" style="background: #F44336"></div>
		<div data-src="css/skin/brown.css" style="background: #795548"></div>
		<div data-src="css/skin/lite-green.css" style="background: #8BC34A"></div>
		<div data-src="css/skin/mist.css" style="background: #8fafc3"></div>
		<div data-src="css/skin/stone.css" style="background: #336a86"></div>
		<div data-src="css/skin/crimson.css" style="background: #8c230e"></div>
		<div data-src="css/skin/hot-pink.css" style="background: #f52549"></div>
		<div data-src="css/skin/lettuce.css" style="background: #b8d00a"></div>
	</div>

	<div class="demos-list">
		<a href="http://electricblaze.com/unicore/index.html"><img src="<?php echo Helpers::get_image("1.jpg");?>" class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index2.html"><img src="<?php echo Helpers::get_image("2_002.jpg");?> class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index3.html"><img src="<?php echo Helpers::get_image("3.jpg");?>" class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index4.html"><img src="<?php echo Helpers::get_image("4_002.jpg");?>" class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index5.html"><img src="<?php echo Helpers::get_image("5.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index6.html"><img src="<?php echo Helpers::get_image("6.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index7.html"><img src="<?php echo Helpers::get_image("7.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index8.html"><img src="<?php echo Helpers::get_image("8.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index9.html"><img src="<?php echo Helpers::get_image("9.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index10.html"><img src="<?php echo Helpers::get_image("10.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index11.html"><img src="<?php echo Helpers::get_image("11.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index12.html"><img src="<?php echo Helpers::get_image("12.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index13.html"><img src="<?php echo Helpers::get_image("13.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index14.html"><img src="<?php echo Helpers::get_image("14.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index15.html"><img src="<?php echo Helpers::get_image("15.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index16.html"><img src="<?php echo Helpers::get_image("16.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index17.html"><img src="<?php echo Helpers::get_image("17.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index18.html"><img src="<?php echo Helpers::get_image("18.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index19.html"><img src="<?php echo Helpers::get_image("19.jpg");?> "  class="img-responsive" alt=""></a>		
		<a href="http://electricblaze.com/unicore/index20.html"><img src="<?php echo Helpers::get_image("20.jpg");?> "  class="img-responsive" alt=""></a>		
	</div>
	</div>

	<div class="btn-settings">Styleswitcher <i class="fa fa-cog"></i></div>
</div>-->
<!-- END STYLE SWITCHER 
============================================= -->

<!-- JAVASCRIPT =============================-->

</body></html>