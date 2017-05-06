  <?php


$theme_url=AppURLs::ThemeUrl();


?><div class="block-header">
                        <h2><?php echo Helpers::get_controller(USERS)->UserName($user); ?> <small><?php if(!empty($user->profile_bio)) echo Helpers::text($user->profile_bio); ?></small></h2>
                        
                        <!--<ul class="actions m-t-20 hidden-xs">
                            <li class="dropdown">
                                <a data-toggle="dropdown" href="">
                                    <i class="md md-more-vert"></i>
                                </a>
                    
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Privacy Settings</a>
                                    </li>
                                    <li>
                                        <a href="">Account Settings</a>
                                    </li>
                                    <li>
                                        <a href="">Other Settings</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>-->
                    </div>
                    
                    <div id="profile-main" class="card">
                        <div class="pm-overview c-overflow" style="overflow: hidden;" tabindex="4">
                            <?php $this->Widget("Profilepicture",array("user"=>$user)); ?>                            
                            <!--<div class="pmo-block pmo-contact hidden-xs">
                                <h2>Contact</h2>
                                
                                <ul>
                                    <li><i class="md md-phone"></i> 00971 12345678 9</li>
                                    <li><i class="md md-email"></i> malinda-h@gmail.com</li>
                                    <li><i class="socicon socicon-skype"></i> malinda.hollaway</li>
                                    <li><i class="socicon socicon-twitter"></i> @malinda (twitter.com/malinda)</li>
                                    <li>
                                        <i class="md md-location-on"></i>
                                        <address class="m-b-0">
                                            10098 ABC Towers, <br>
                                            Dubai Silicon Oasis, Dubai, <br>
                                            United Arab Emirates
                                        </address>
                                    </li>
                                </ul>
                            </div>-->
                            
                            <div class="pmo-block pmo-items hidden-xs">
                                <h2><?php if(!$own_profile && Helpers::is_logged_in()) echo "Mutual "; ?>Circles</h2>
                                
                                <div class="pmob-body">
                                    <div class="row">

					<?php $this->widget("Circleswidget",array("uid"=>$user->id)); ?>
		

                                       <!-- <a class="col-xs-2" href="">
                                            <img alt="" src="<?php echo $theme_url; ?>/img/profile-pics/1.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/2.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/3.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/4.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/5.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/6.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/7.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/8.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/1.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/2.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/3.jpg" class="img-circle">
                                        </a>
                                        <a class="col-xs-2" href="">
                                            <img alt="" src="img/profile-pics/4.jpg" class="img-circle">
                                        </a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pm-body clearfix">
                            <ul class="tab-nav tn-justified" style="overflow: hidden;" tabindex="1">
                                <li class="active waves-effect"><a class="left" href="">About</a></li>
                              <!--  <li class="waves-effect"><a href="profile-timeline.html">Timeline</a></li>
                                <li class="waves-effect"><a href="profile-photos.html">Photos</a></li>
                                <li class="waves-effect"><a href="profile-connections.html">Connections</a></li>-->
                            </ul>
                            
                            <div class="pp-about-content">
                            <?php echo $about_content; ?>
                            </div>

                        </div>
                    </div>