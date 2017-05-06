<?php

//get user controller
$user_c=helpers::get_controller(USERS);

?>

<aside id="sidebar" >
                <div class="sidebar-inner">
                    <div class="si-inner">

                    <?php if($user){ ?>

                        <div class="profile-menu">
                            <a href="" style="background:url(<?php echo Helpers::LandingPageImage(); ?>);">
                                <div class="profile-pic ">
                                    <img src="<?php echo $user_c->ProfilePicUrl($user); ?>">
                                </div>
                                
                                <div class="profile-info bold">
                                    <?php echo $user_c->UserName($user);  ?>
                                    
                                    <i class="md md-arrow-drop-down"></i>
                                </div>
                            </a>
                            
                            <ul class="main-menu">
                                <li>
                                    <a href="<?php echo AppURLs::ProfileURL(); ?>"><i class="md md-person"></i> View Profile</a>
                                </li>

                                <li>
                                    <a href="<?php echo AppURLs::PageURL("terms"); ?>"><i class="md  md-description"></i> Terms </a>
                                </li>

                                 <li>
                                    <a href="<?php echo AppURLs::PageURL("privacy"); ?>"><i class="md md-lock-outline"></i> Privacy </a>
                                </li>

                                 <li>
                                    <a href="<?php echo AppURLs::PageURL("Contact"); ?>"><i class="md  md-perm-phone-msg"></i> Contact Us </a>
                                </li>

                               <!-- <li>
                                    <a href=""><i class="md md-settings"></i> Settings</a>
                                </li>-->
                             <!--   <li>
                                    <a href="<?php echo AppURLs::LogOutURL(); ?>"><i class="md  md-report"></i> Logout</a>
                                </li>-->
                            </ul>
                        </div>
                        
                        <ul class="main-menu">
                            <li class="<?php if(helpers::IsHome()) echo "active";?>"><a  href="<?php echo helpers::base_url(); ?>"><i class="md md-home"></i> Home</a></li>
                           

                           <li id="circles-bar-container">
                                 
                            <?php //$this->widget("Circlesbar"); ?>                 

                           </li>

<!--
                            <li><a href="http://byrushan.com/projects/ma/v1-3-1/typography.html"><i class="md md-format-underline"></i> Typography</a></li>
                            <li class="sub-menu">
                                <a href=""><i class="md md-now-widgets"></i> Widgets</a>

                                <ul>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/widget-templates.html">Templates</a></li>
                                    <li><a class="active" href="http://byrushan.com/projects/ma/v1-3-1/widgets.html">Widgets</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href=""><i class="md md-view-list"></i> Tables</a>
                
                                <ul>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/tables.html">Normal Tables</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/data-tables.html">Data Tables</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href=""><i class="md md-my-library-books"></i> Forms</a>
                
                                <ul>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/form-elements.html">Basic Form Elements</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/form-components.html">Form Components</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/form-examples.html">Form Examples</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/form-validations.html">Form Validation</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href=""><i class="md md-swap-calls"></i>User Interface</a>
                                <ul>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/colors.html">Colors</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/animations.html">Animations</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/box-shadow.html">Box Shadow</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/buttons.html">Buttons</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/icons.html">Icons</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/alerts.html">Alerts</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/notification-dialog.html">Notifications &amp; Dialogs</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/media.html">Media</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/components.html">Components</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/other-components.html">Others</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href=""><i class="md md-trending-up"></i>Charts</a>
                                <ul>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/flot-charts.html">Flot Charts</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/other-charts.html">Other Charts</a></li>
                                </ul>
                            </li>
                            <li><a href="http://byrushan.com/projects/ma/v1-3-1/calendar.html"><i class="md md-today"></i> Calendar</a></li>
                            <li><a href="http://byrushan.com/projects/ma/v1-3-1/generic-classes.html"><i class="md md-layers"></i> Generic Classes</a></li>
                            <li class="sub-menu">
                                <a href=""><i class="md md-content-copy"></i> Sample Pages</a>
                                <ul>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/profile-about.html">Profile</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/list-view.html">List View</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/messages.html">Messages</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/login.html">Login and Sign Up</a></li>
                                    <li><a href="http://byrushan.com/projects/ma/v1-3-1/404.html">Error 404</a></li>
                                </ul>
                            </li>

-->

                        </ul>
 <?php } ?>

                    </div>

                   
                </div>
            </aside>
