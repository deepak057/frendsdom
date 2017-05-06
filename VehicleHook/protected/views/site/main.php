<div id="headerwrap" style="<?php if(!empty($background_image)) echo "background:url(".$background_image.")";; ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>Your opinion matters <br/>
					let's share it with world.</h1>
					
					<?php echo $SignUpForm; ?>
					
					
				</div><!-- /col-lg-6 -->
				<div class="col-lg-6">
					<!--<img class="img-responsive " src="<?php echo helpers::get_image("ipad-hand.png");?> " alt=""/>-->
				</div><!-- /col-lg-6 -->
				
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
	
	

	
	<?php 

	// "Trending" section starts from here

	if(!empty($global_circles)){


	?>	


	<div class="container landing-page-circles-wrapper">
		
		<div class="row mt centered">

			<h1 class="m-t-0 ">A quick Demo</h1> <h3 class="m-b-50">Click on any of these random topics</h3></h1>
			
			<?php



foreach($global_circles as $circle){

$this->widget("Circleitem",array("circle"=>$circle));

}


?>


</div>

<hr>

</div>




<?php

} //trending section ends here

?>


<div class="container for-smallest-res">
		<hr>
		<div class="row centered">
			<div class="col-lg-6 col-lg-offset-3"><h3 class="m-t-0">Try it, find anything or anyone interesting</h3>
				<form method="get"  action="<?php echo AppURLs::SearchURL(); ?>" class="form-inline" role="form">
				  <div class="form-group">
				    <input name="k" type="text" class="form-control w-auto c-aligned" required placeholder="Type a keyword">

				  </div>
				  <button type="submit" class="btn btn-warning btn-lg m-t-5">Search Now!</button>
				</form>					
			</div>
			<div class="col-lg-3"></div>
		</div>
		<hr>
	</div><!-- /container -->



	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<h1>A platform for <br/>Sharing opinions.</h1>
				<h3>Sometimes people know the answer to a question but they want to hear other's opinion on it.</h3>
			</div>
		</div><!-- /row -->
		
		<div class="row mt centered">
			<div class="col-lg-4">
				<img src="<?php echo helpers::get_image("circle.png");?>" width="180" alt="">
				<h4>1 - Create or Join Circles(Groups)</h4>
				<p>

Circle is basically a group based on a particular topic such as News, Politics, Hollywood, Bussiness etc.

You can create a Circle on any topic and invite your contacts to be a part of it.


</p>
			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img src="<?php echo helpers::get_image("post.png");?>" width="180" alt="">
				<h4>2 - Create Posts</h4>
				<p>

You can create Posts within your circles. A post contains a title, optional description, Picture and options.

</p>

			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img src="<?php echo helpers::get_image("vote.png");?>" width="180" alt="">
				<h4>3 Seek or Share Opinion</h4>
				<p>

You can vote on any post that appers in your Circle Feed. You will see what people in your circle are thinking about the

questions being posted in the Circle.

</p>

			</div><!--/col-lg-4 -->
		</div><!-- /row -->
	</div><!-- /container -->
	
	
	
	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<h1><?php echo Yii::app()->name; ?> is for Everyone.</h1>
				<h3>

You don't have to be a reader or watch the news, you get it all in one place. 

One can follow "Times of India (news paper)" circle to see the news and people's opinions on Current affairs.


</h3>
			</div>
		</div><!-- /row -->
	
		<! -- CAROUSEL -->
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<div id="carousel-example-generic" class="carousel slide" data-pause="false" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="item active">
				      <img class="sliderimg" src="<?php echo helpers::get_image("p1.png");?>" alt="">
				    </div>
				    <div class="item" id="slidermiddle">
				      <img class="sliderimg" src="<?php echo helpers::get_image("p2.png");?>" alt="">
				    </div>
				    <div class="item">
				      <img src="<?php echo helpers::get_image("p3.png");?>" alt="">
				    </div>
				  </div>
				</div>			
			</div><!-- /col-lg-8 -->
		</div><!-- /row -->
	</div><! --/container -->
	
	<div class="container">
		<hr>
		<!--div class="row centered">
			<div class="col-lg-6 col-lg-offset-3">
				<form method="get" class="form-inline" action="site/signup" role="form">
				  <div class="form-group">
				    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">
				  </div>
				  <button type="submit" class="btn btn-warning btn-lg">Sign Up!</button>
				</form>					
			</div>
			<div class="col-lg-3"></div>
		</div>< /row -->
		<!--hr-->
	</div><!-- /container -->

	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<h1>A way to know <br/>What do people think?</h1>
				<h3>
It's for people to raise their opinion about any question/ headline/people or event within a group of people called Circle.


</h3>
			</div>
		</div><!-- /row -->
		
		<div class="row mt centered">
			<div class="col-lg-4">
				<img class="img-circle" src="<?php echo helpers::get_image("picb1.png");?>" width="140" alt="">
				<h4>User Profiles</h4>
				<p>You can set up your profile and socialize with others. </p>
				<!--<p><i class="glyphicon glyphicon-send"></i> <i class="glyphicon glyphicon-phone"></i> <i class="glyphicon glyphicon-globe"></i></p>-->
			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img class="img-circle" src="<?php echo helpers::get_image("picb2.png");?>" width="140" alt="">
				<h4>Mobile Friendly</h4>
				<p>The site is designed to run on any HTML5 based browser which is present in almost all the modern smartphones.</p>
				<!--<p><i class="glyphicon glyphicon-send"></i> <i class="glyphicon glyphicon-phone"></i> <i class="glyphicon glyphicon-globe"></i></p>-->
			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img class="img-circle" src="<?php echo helpers::get_image("picb3.png");?>" width="140" alt="">
				<h4>Fast and Intuitive</h4>
				<p>We have tried to keep the UI as easy to use as possible using material design philosophy.</p>
				<!--<p><i class="glyphicon glyphicon-send"></i> <i class="glyphicon glyphicon-phone"></i> <i class="glyphicon glyphicon-globe"></i></p>-->
			</div><!--/col-lg-4 -->
		</div><!-- /row -->
	</div><!-- /container -->
