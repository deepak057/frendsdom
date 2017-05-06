<?php


$theme_url=AppURLs::ThemeUrl();


?>
      <header id="header">
            <ul class="header-inner">
               


	<?php 


	if($user){


	?>

 <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>
            

<?php

}

?>
                <li class="logo hidden-xs">
                    <a href="<?php echo helpers::base_url(); ?>"><?php echo Yii::app()->name; ?></a>
                </li>


                <li class="nav-search-bar-container">
                	
		<?php echo HtmlComponents::TopSearchBar(); ?>

                </li>

                

	<?php 


	if($user){


	?>

                <li class="pull-right">
                <ul class="top-menu">
                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" hidden="hidden" type="checkbox">
                            <label title="Turn on/off side bar" for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>
                        <!--                <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-message" href=""><i class="tmn-counts">6</i></a>
                        <div class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="listview">
                                <div class="lv-header">
                                    Messages
                                </div>
                                <div tabindex="1" style="overflow: hidden;" class="lv-body c-overflow">
                                    <a class="lv-item" href="">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/1.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">David Belle</div>
                                                <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/2.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Jonathan Morris</div>
                                                <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/3.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Fredric Mitchell Jr.</div>
                                                <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/4.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Glenn Jecobs</div>
                                                <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/4.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Bill Phillips</div>
                                                <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a class="lv-footer" href="">View All</a>
                            </div>
                        <div style="width: 0px; z-index: 9; cursor: default; position: absolute; top: 0px; left: 298px; height: 275px; display: block; opacity: 0;" class="nicescroll-rails nicescroll-rails-vr" id="ascrail2002"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 0px; height: 271px; background-color: rgba(0, 0, 0, 0.5); border: 0px none; background-clip: padding-box; border-radius: 0px;"></div></div><div style="height: 0px; z-index: 9; top: 275px; left: 0px; position: absolute; cursor: default; display: none; width: 298px; opacity: 0;" class="nicescroll-rails nicescroll-rails-hr" id="ascrail2002-hr"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 0px; width: 298px; background-color: rgba(0, 0, 0, 0.5); border: 0px none; background-clip: padding-box; border-radius: 0px;"></div></div></div>
                    </li>-->
                                        <li class="dropdown">
                        <a class="tm-notification" href=""><i class="tmn-counts invites-count <?php if(empty($invites)) echo " none"; ?> "><?php if(!empty($invites)) echo count($invites); ?></i></a>

			<?php 
			
            
			//Put the invites
			$this->Widget("Circleinvites",array("invites"=>$invites));
			

			 ?>
                       
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-chat" href=""></a>
                        <ul class="dropdown-menu dm-icon pull-right">
                            
                             <li>
                                <a href="<?php echo AppURLs::ProfileURL(); ?>"><i class="md md-person"></i> My Profile</a>
                            </li>
                            <li>
                                
                                <a href="<?php echo AppURLs::InboxURL(); ?>"><i class="md md-message"></i> Inbox</a>

                            </li>

                            <!--<li>
                                <a data-action="fullscreen" href=""><i class="md md-fullscreen"></i> Toggle Fullscreen</a>
                            </li>-->
                           <!-- <li>
                                <a data-action="clear-localstorage" href=""><i class="md md-delete"></i> Reset Theme Settings</a>
                            </li>-->
                           
                            <!--<li>
                                <a href=""><i class="md md-settings"></i> Settings</a>
                            </li>-->

                            <li>
                                <a href="<?php echo AppURLs::LogOutURL(); ?>"><i class="md  md-report"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                    <!--<li class="hidden-xs" id="chat-trigger" data-trigger="#chat">
                        <a class="tm-chat" href=""></a>
                    </li>-->
                    </ul>
                </li>

<?php

}

?>

            </ul>
            
            <!-- Top Search Content -->
            <!--<div id="top-search-wrap">
               <form action="<?php echo AppURLs::SearchURL(); ?>" method="get"> <input placeholder="Search for People, Circles or Posts" name="k" id="top-search-field" type="text"></form>
                <i id="top-search-close">×</i>
            </div>-->
        </header>
