<?php


$theme_url=AppURLs::ThemeUrl();


?>
<!--<aside id="chat">
                <ul tabindex="0" style="overflow: hidden;" class="tab-nav tn-justified" role="tablist">
                    <li role="presentation" class="active"><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">Friends</a></li>
                    <li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Online Now</a></li>
                </ul>
            
                <div class="chat-search">
                    <div class="fg-line">
                        <input class="form-control" placeholder="Search People" type="text">
                    </div>
                </div>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="friends">
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
                                    <div class="pull-left">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/1.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">David Belle</div>
                                        <small class="lv-small">Last seen 3 hours ago</small>
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
                                    <div class="pull-left">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/5.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">Bill Phillips</div>
                                        <small class="lv-small">Last seen 3 days ago</small>
                                    </div>
                                </div>
                            </a>
                            
                            <a class="lv-item" href="">
                                <div class="media">
                                    <div class="pull-left">
                                        <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/6.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title">Wendy Mitchell</div>
                                        <small class="lv-small">Last seen 2 minutes ago</small>
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
-->