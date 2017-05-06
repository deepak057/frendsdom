<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand c-white" href="<?php echo helpers::base_url(); ?>"><b><?php echo Yii::app()->name; ?></b></a>
        
	<!--<div class="landing-nav-bar-search-wrap">
	
	<?php //echo HtmlComponents::TopSearchBar("Search anything"); ?>
	
	</div>-->

	<?php ?>


	</div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            

<?php if($links_enabled) {
?>


                                <li>
                                    <a class="c-white" href="<?php echo AppURLs::PageURL("terms"); ?>"> <i class="md  md-description"></i> Terms </a>
                                </li>

                                 <li>
                                    <a class="c-white" href="<?php echo AppURLs::PageURL("privacy"); ?>"><i class="md md-lock-outline"></i> Privacy </a>
                                </li>

                                <li>
                                    <a class="c-white" href="<?php echo AppURLs::PageURL("copyright"); ?>"> <i class="md md-book"></i> Copyright </a>
                                </li>


                                 <li>
                                    <a class="c-white" href="<?php echo AppURLs::PageURL("Contact"); ?>"><i class="md  md-perm-phone-msg"></i> Contact Us </a>
                                </li>

<?php


  }


else {

  ?>



            <li class="dropdown">


<?php 


if(!$login_popup_disabled){

if(!$user){

  ?>

            <a href="javascript:void(0)" class="dropdown-toggle highlight-border c-white" data-toggle="dropdown">Log In</a>
<ul id="login-dp" class="dropdown-menu">
        <li>

<?php 

$this->widget("LoginPopup");

 ?>
</li>


</ul>


<?php

}

else {


?>

            <a href="javascript:void(0)" class="dropdown-toggle" role="button" data-toggle="dropdown"><?php echo Helpers::get_controller(USERS)->UserName($user); ?><span class="caret"></span></a>



<ul class="dropdown-menu">
  
  <li><a href="<?php echo Helpers::base_url(); ?>">Home</a></li>
  <li><a href="<?php echo AppURLs::LogOutURL(); ?>">Logout</a></li>

</ul>



<?php

}

}

?>

            </li>

<?php if(!$user){ ?>
<li class="highlight-border"><a class="c-white" href="<?php echo Yii::app()->createAbsoluteUrl("site/signup") ?>">Sign Up</a></li>
<?php } 


}

?>



          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

