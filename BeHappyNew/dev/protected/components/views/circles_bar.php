<?php

if(!empty($circles)){

$theme_url=AppURLs::ThemeURL();

?>

<aside id="chat" class="toggled">
                <ul tabindex="0" style="overflow: hidden;" class="tab-nav tn-justified" role="tablist">
                    <li role="presentation" class="active"><a class="left all-circles p-l-20 cursor-default" href="#friends" aria-controls="friends" role="tab" data-toggle="tab"><i class="  md-brightness-1 big-text m-r-10"></i>All Circles</a></li>
                 <!--   <li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Your Circles</a></li>
                    <li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Joined Circles</a></li>-->
                </ul>
            
                <div class="chat-search">
                    <div class="fg-line">
                        <input  class="form-control cs-search-field" placeholder="Search Your Circles" type="text">
                    </div>
                </div>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="friends">
                        <div class="listview">
                            

                        <?php 

                        foreach($circles as $circle){

                            ?>

                             <div circle-url="<?php echo AppURLs::CircleURL($circle->id); ?>" cid="<?php echo $circle->id; ?>" title="Click to load this circle" class="lv-item circle-bar-circle-item pointer">

                               


                                <div class="media"><ul title="Circle Settings" class="actions  pull-right">
                <li class="dropdown">





                  <a data-toggle="dropdown" href="" aria-expanded="false">
                    <i class="md md-menu">
                    </i>
                  </a>
                  
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a app-preloader="prepend" onclick="InvitePeopleToCircle.LoadInit($(this));" class="manage-circle-trigger" cid="<?php echo $circle->id; ?>" href="javascript:void(0)">
                        Add people
                      </a>
                    </li>
                    
                    
                    <li>
                      <a cid="<?php echo $circle->id; ?>" app-preloader="prepend" onclick="CircleSettings.RemoveImageTrigger($(this));" href="javascript:void(0);">
                        Settings
                      </a>
                    </li>

                   
                  </ul>
                </li>
              </ul>
                                    <div class="pull-left p-relative">
                                       <?php $this->widget("Circleicon",array("circle"=>$circle)); ?>
                                    


                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title"><?php echo helpers::text($circle->title); ?> <span class="tmn-counts bgm-red c-white none"></span>   </div>
                                        <small title="Date created- <?php echo helpers::AppDate($circle->date_created); ?>" class="lv-small"><?php echo date("M d",strtotime($circle->date_created));  ?></small>
                                    







                                    </div>
                                </div>
                            </div>
                           


                            <?php 
                        }


                        ?>


                            
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="online">
                        <div class="listview">
                            <a class="lv-item" href="">
                                <div class="media">
                                    <div class="pull-left p-relative">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/2.jpg" alt="">
                                        <i class="chat-status-busy"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">Jonathan Morris</div>
                                        <small class="lv-small">Available</small>
                                    </div>
                                </div>
                            </a>
                            
                            <a class="lv-item" href="">
                                <div class="media">
                                    <div class="pull-left p-relative">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/3.jpg" alt="">
                                        <i class="chat-status-online"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">Fredric Mitchell Jr.</div>
                                        <small class="lv-small">Availble</small>
                                    </div>
                                </div>
                            </a>
                            
                            <a class="lv-item" href="">
                                <div class="media">
                                    <div class="pull-left p-relative">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/4.jpg" alt="">
                                        <i class="chat-status-online"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">Glenn Jecobs</div>
                                        <small class="lv-small">Availble</small>
                                    </div>
                                </div>
                            </a>

                            <a class="lv-item" href="">
                                <div class="media">
                                    <div class="pull-left p-relative">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/7.jpg" alt="">
                                        <i class="chat-status-busy"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">Teena Bell Ann</div>
                                        <small class="lv-small">Busy</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <div style="width: 1px; z-index: 5; cursor: default; position: absolute; top: 20px; left: 259px; height: 49px; display: none;" class="nicescroll-rails nicescroll-rails-vr" id="ascrail2001"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 1px; height: 0px; background-color: transparent; border: 0px none; background-clip: padding-box; border-radius: 0px;"></div></div><div style="height: 1px; z-index: 5; top: 68px; left: 0px; position: absolute; cursor: default; display: none;" class="nicescroll-rails nicescroll-rails-hr" id="ascrail2001-hr"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 1px; width: 0px; background-color: transparent; border: 0px none; background-clip: padding-box; border-radius: 0px;"></div></div></aside>

<?php

}

?>