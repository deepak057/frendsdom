﻿       <?php


$theme_url=AppURLs::ThemeUrl();


?>
 <div class="block-header">
                        <h2>Dashboard</h2>
                        
                        <ul class="actions">
                            <li>
                                <a href="">
                                    <i class="md md-trending-up"></i>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="md md-done-all"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="md md-more-vert"></i>
                                </a>
                                
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh</a>
                                    </li>
                                    <li>
                                        <a href="">Manage Widgets</a>
                                    </li>
                                    <li>
                                        <a href="">Widgets Settings</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h2>Sales Statistics <small>Vestibulum purus quam scelerisque, mollis nonummy metus</small></h2>
                            
                            <ul class="actions">
                                <li>
                                    <a href="">
                                        <i class="md md-cached"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="md md-file-download"></i>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="" data-toggle="dropdown">
                                        <i class="md md-more-vert"></i>
                                    </a>
                                    
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="">Change Date Range</a>
                                        </li>
                                        <li>
                                            <a href="">Change Graph Type</a>
                                        </li>
                                        <li>
                                            <a href="">Other Settings</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="card-body">
                            <div class="chart-edge">
                                <div style="padding: 0px; position: relative;" id="curved-line-chart" class="flot-chart "><canvas height="200" width="1314" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1314px; height: 200px;" class="flot-base"></canvas><canvas height="200" width="1314" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1314px; height: 200px;" class="flot-overlay"></canvas></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mini-charts">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-cyan">
                                    <div class="clearfix">
                                        <div class="chart stats-bar"><canvas height="45" width="83" style="display: inline-block; width: 83px; height: 45px; vertical-align: top;"></canvas></div>
                                        <div class="count">
                                            <small>Website Traffics</small>
                                            <h2>987,459</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-lightgreen">
                                    <div class="clearfix">
                                        <div class="chart stats-bar-2"><canvas height="45" width="83" style="display: inline-block; width: 83px; height: 45px; vertical-align: top;"></canvas></div>
                                        <div class="count">
                                            <small>Website Impressions</small>
                                            <h2>356,785K</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-orange">
                                    <div class="clearfix">
                                        <div class="chart stats-line"><canvas height="45" width="85" style="display: inline-block; width: 85px; height: 45px; vertical-align: top;"></canvas></div>
                                        <div class="count">
                                            <small>Total Sales</small>
                                            <h2>$ 458,778</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="mini-charts-item bgm-bluegray">
                                    <div class="clearfix">
                                        <div class="chart stats-line-2"><canvas height="45" width="85" style="display: inline-block; width: 85px; height: 45px; vertical-align: top;"></canvas></div>
                                        <div class="count">
                                            <small>Support Tickets</small>
                                            <h2>23,856</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="dash-widgets">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div id="site-visits" class="dash-widget-item bgm-teal">
                                    <div class="dash-widget-header">
                                        <div class="p-20">
                                            <div class="dash-widget-visits"><canvas height="95" width="263" style="display: inline-block; width: 263px; height: 95px; vertical-align: top;"></canvas></div>
                                        </div>
                                        
                                        <div class="dash-widget-title">For the past 30 days</div>
                                        
                                        <ul class="actions actions-alt">
                                            <li class="dropdown">
                                                <a href="" data-toggle="dropdown">
                                                    <i class="md md-more-vert"></i>
                                                </a>
                                                
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="">Refresh</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Manage Widgets</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Widgets Settings</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="p-20">
                                        
                                        <small>Page Views</small>
                                        <h3 class="m-0 f-400">47,896,536</h3>
                                        
                                        <br>
                                        
                                        <small>Site Visitors</small>
                                        <h3 class="m-0 f-400">24,456,799</h3>
                                        
                                        <br>
                                        
                                        <small>Total Clicks</small>
                                        <h3 class="m-0 f-400">13,965</h3>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div id="pie-charts" class="dash-widget-item">
                                    <div class="bgm-pink">
                                        <div class="dash-widget-header">
                                            <div class="dash-widget-title">Email Statistics</div>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                        
                                        <div class="text-center p-20 m-t-25">
                                            <div class="easy-pie main-pie" data-percent="75">
                                                <div class="percent">45</div>
                                                <div class="pie-title">Total Emails Sent</div>
                                            <canvas width="148" height="148"></canvas></div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-t-20 p-b-20 text-center">
                                        <div class="easy-pie sub-pie-1" data-percent="56">
                                            <div class="percent">56</div>
                                            <div class="pie-title">Bounce Rate</div>
                                        <canvas width="95" height="95"></canvas></div>
                                        <div class="easy-pie sub-pie-2" data-percent="84">
                                            <div class="percent">84</div>
                                            <div class="pie-title">Total Opened</div>
                                        <canvas width="95" height="95"></canvas></div>
                                    </div>
    
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div class="dash-widget-item bgm-lime">
                                    <div id="weather-widget"><div class="weather-status">73°F</div><ul class="weather-info"><li>Austin, TX</li><li class="currently">Fair</li></ul><div class="weather-icon wi-33"></div><div class="dash-widget-footer"><div class="weather-list tomorrow"><span class="weather-list-icon wi-38"></span><span>93/74</span><span>Mostly Sunny</span></div><div class="weather-list after-tomorrow"><span class="weather-list-icon wi-38"></span><span>92/74</span><span>AM Thunderstorms</span></div></div></div>
                                </div>
                            </div>
    
                            <div class="col-md-3 col-sm-6">
                                <div id="best-selling" class="dash-widget-item">
                                    <div class="dash-widget-header">
                                        <div class="dash-widget-title">Best Sellings</div>
                                        <img src="<?php echo $theme_url; ?>/img/alpha.jpg" alt="">
                                        <div class="main-item">
                                            <small>Samsung Galaxy Alpha</small>
                                            <h2>$799.99</h2>
                                        </div>
                                    </div>
                                
                                    <div class="listview p-t-5">
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/note4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Samsung Galaxy Note 4</div>
                                                    <small class="lv-small">$850.00 - $1199.99</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/mate7.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Huawei Ascend Mate</div>
                                                    <small class="lv-small">$649.59 - $749.99</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="<?php echo $theme_url; ?>/img/535.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Nokia Lumia 535</div>
                                                    <small class="lv-small">$189.99 - $250.00</small>
                                                </div>
                                            </div>
                                        </a>
                                        
                                        <a class="lv-footer" href="">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Calendar -->
                            <div class="fc fc-ltr ui-widget" id="calendar-widget"><div class="fc-toolbar"><div class="fc-left"></div><div class="fc-right"></div><div class="fc-center"><button type="button" class="fc-prev-button ui-button ui-state-default ui-corner-left ui-corner-right"><span class="ui-icon ui-icon-circle-triangle-w"></span></button><h2>June 2014</h2><button type="button" class="fc-next-button ui-button ui-state-default ui-corner-left ui-corner-right"><span class="ui-icon ui-icon-circle-triangle-e"></span></button></div><div class="fc-clear"></div></div><div style="" class="fc-view-container"><div style="" class="fc-view fc-month-view fc-basic-view"><table><thead><tr><td class="ui-widget-header"><div class="fc-row ui-widget-header"><table><thead><tr><th class="fc-day-header ui-widget-header fc-sun">Sun</th><th class="fc-day-header ui-widget-header fc-mon">Mon</th><th class="fc-day-header ui-widget-header fc-tue">Tue</th><th class="fc-day-header ui-widget-header fc-wed">Wed</th><th class="fc-day-header ui-widget-header fc-thu">Thu</th><th class="fc-day-header ui-widget-header fc-fri">Fri</th><th class="fc-day-header ui-widget-header fc-sat">Sat</th></tr></thead></table></div></td></tr></thead><tbody><tr><td class="ui-widget-content"><div style="" class="fc-day-grid-container"><div class="fc-day-grid"><div class="fc-row fc-week ui-widget-content"><div class="fc-bg"><table><tbody><tr><td class="fc-day ui-widget-content fc-sun fc-past" data-date="2014-06-01"></td><td class="fc-day ui-widget-content fc-mon fc-past" data-date="2014-06-02"></td><td class="fc-day ui-widget-content fc-tue fc-past" data-date="2014-06-03"></td><td class="fc-day ui-widget-content fc-wed fc-past" data-date="2014-06-04"></td><td class="fc-day ui-widget-content fc-thu fc-past" data-date="2014-06-05"></td><td class="fc-day ui-widget-content fc-fri fc-past" data-date="2014-06-06"></td><td class="fc-day ui-widget-content fc-sat fc-past" data-date="2014-06-07"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2014-06-01">1</td><td class="fc-day-number fc-mon fc-past" data-date="2014-06-02">2</td><td class="fc-day-number fc-tue fc-past" data-date="2014-06-03">3</td><td class="fc-day-number fc-wed fc-past" data-date="2014-06-04">4</td><td class="fc-day-number fc-thu fc-past" data-date="2014-06-05">5</td><td class="fc-day-number fc-fri fc-past" data-date="2014-06-06">6</td><td class="fc-day-number fc-sat fc-past" data-date="2014-06-07">7</td></tr></thead><tbody><tr><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-cyan fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">All Day</span></div><div class="fc-resizer"></div></a></td><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-not-end bgm-orange fc-draggable"><div class="fc-content"> <span class="fc-title">Long Event</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week ui-widget-content"><div class="fc-bg"><table><tbody><tr><td class="fc-day ui-widget-content fc-sun fc-past" data-date="2014-06-08"></td><td class="fc-day ui-widget-content fc-mon fc-past" data-date="2014-06-09"></td><td class="fc-day ui-widget-content fc-tue fc-past" data-date="2014-06-10"></td><td class="fc-day ui-widget-content fc-wed fc-past" data-date="2014-06-11"></td><td class="fc-day ui-widget-content fc-thu fc-past" data-date="2014-06-12"></td><td class="fc-day ui-widget-content fc-fri fc-past" data-date="2014-06-13"></td><td class="fc-day ui-widget-content fc-sat fc-past" data-date="2014-06-14"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2014-06-08">8</td><td class="fc-day-number fc-mon fc-past" data-date="2014-06-09">9</td><td class="fc-day-number fc-tue fc-past" data-date="2014-06-10">10</td><td class="fc-day-number fc-wed fc-past" data-date="2014-06-11">11</td><td class="fc-day-number fc-thu fc-past" data-date="2014-06-12">12</td><td class="fc-day-number fc-fri fc-past" data-date="2014-06-13">13</td><td class="fc-day-number fc-sat fc-past" data-date="2014-06-14">14</td></tr></thead><tbody><tr><td colspan="2" class="fc-event-container"><a class="fc-day-grid-event fc-event fc-not-start fc-end bgm-orange fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Long Event</span></div><div class="fc-resizer"></div></a></td><td rowspan="2"></td><td rowspan="2"></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-gray fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Lunch</span></div><div class="fc-resizer"></div></a></td><td rowspan="2" class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-pink fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Birthday</span></div><div class="fc-resizer"></div></a></td><td rowspan="2"></td></tr><tr><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-lightgreen fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Repeat</span></div><div class="fc-resizer"></div></a></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-teal fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Meet</span></div><div class="fc-resizer"></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week ui-widget-content"><div class="fc-bg"><table><tbody><tr><td class="fc-day ui-widget-content fc-sun fc-past" data-date="2014-06-15"></td><td class="fc-day ui-widget-content fc-mon fc-past" data-date="2014-06-16"></td><td class="fc-day ui-widget-content fc-tue fc-past" data-date="2014-06-17"></td><td class="fc-day ui-widget-content fc-wed fc-past" data-date="2014-06-18"></td><td class="fc-day ui-widget-content fc-thu fc-past" data-date="2014-06-19"></td><td class="fc-day ui-widget-content fc-fri fc-past" data-date="2014-06-20"></td><td class="fc-day ui-widget-content fc-sat fc-past" data-date="2014-06-21"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2014-06-15">15</td><td class="fc-day-number fc-mon fc-past" data-date="2014-06-16">16</td><td class="fc-day-number fc-tue fc-past" data-date="2014-06-17">17</td><td class="fc-day-number fc-wed fc-past" data-date="2014-06-18">18</td><td class="fc-day-number fc-thu fc-past" data-date="2014-06-19">19</td><td class="fc-day-number fc-fri fc-past" data-date="2014-06-20">20</td><td class="fc-day-number fc-sat fc-past" data-date="2014-06-21">21</td></tr></thead><tbody><tr><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-blue fc-draggable fc-resizable"><div class="fc-content"> <span class="fc-title">Repeat</span></div><div class="fc-resizer"></div></a></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week ui-widget-content"><div class="fc-bg"><table><tbody><tr><td class="fc-day ui-widget-content fc-sun fc-past" data-date="2014-06-22"></td><td class="fc-day ui-widget-content fc-mon fc-past" data-date="2014-06-23"></td><td class="fc-day ui-widget-content fc-tue fc-past" data-date="2014-06-24"></td><td class="fc-day ui-widget-content fc-wed fc-past" data-date="2014-06-25"></td><td class="fc-day ui-widget-content fc-thu fc-past" data-date="2014-06-26"></td><td class="fc-day ui-widget-content fc-fri fc-past" data-date="2014-06-27"></td><td class="fc-day ui-widget-content fc-sat fc-past" data-date="2014-06-28"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2014-06-22">22</td><td class="fc-day-number fc-mon fc-past" data-date="2014-06-23">23</td><td class="fc-day-number fc-tue fc-past" data-date="2014-06-24">24</td><td class="fc-day-number fc-wed fc-past" data-date="2014-06-25">25</td><td class="fc-day-number fc-thu fc-past" data-date="2014-06-26">26</td><td class="fc-day-number fc-fri fc-past" data-date="2014-06-27">27</td><td class="fc-day-number fc-sat fc-past" data-date="2014-06-28">28</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end bgm-bluegray fc-draggable fc-resizable" href="http://google.com/"><div class="fc-content"> <span class="fc-title">Google</span></div><div class="fc-resizer"></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week ui-widget-content"><div class="fc-bg"><table><tbody><tr><td class="fc-day ui-widget-content fc-sun fc-past" data-date="2014-06-29"></td><td class="fc-day ui-widget-content fc-mon fc-past" data-date="2014-06-30"></td><td class="fc-day ui-widget-content fc-tue fc-other-month fc-past" data-date="2014-07-01"></td><td class="fc-day ui-widget-content fc-wed fc-other-month fc-past" data-date="2014-07-02"></td><td class="fc-day ui-widget-content fc-thu fc-other-month fc-past" data-date="2014-07-03"></td><td class="fc-day ui-widget-content fc-fri fc-other-month fc-past" data-date="2014-07-04"></td><td class="fc-day ui-widget-content fc-sat fc-other-month fc-past" data-date="2014-07-05"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2014-06-29">29</td><td class="fc-day-number fc-mon fc-past" data-date="2014-06-30">30</td><td class="fc-day-number fc-tue fc-other-month fc-past" data-date="2014-07-01">1</td><td class="fc-day-number fc-wed fc-other-month fc-past" data-date="2014-07-02">2</td><td class="fc-day-number fc-thu fc-other-month fc-past" data-date="2014-07-03">3</td><td class="fc-day-number fc-fri fc-other-month fc-past" data-date="2014-07-04">4</td><td class="fc-day-number fc-sat fc-other-month fc-past" data-date="2014-07-05">5</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week ui-widget-content"><div class="fc-bg"><table><tbody><tr><td class="fc-day ui-widget-content fc-sun fc-other-month fc-past" data-date="2014-07-06"></td><td class="fc-day ui-widget-content fc-mon fc-other-month fc-past" data-date="2014-07-07"></td><td class="fc-day ui-widget-content fc-tue fc-other-month fc-past" data-date="2014-07-08"></td><td class="fc-day ui-widget-content fc-wed fc-other-month fc-past" data-date="2014-07-09"></td><td class="fc-day ui-widget-content fc-thu fc-other-month fc-past" data-date="2014-07-10"></td><td class="fc-day ui-widget-content fc-fri fc-other-month fc-past" data-date="2014-07-11"></td><td class="fc-day ui-widget-content fc-sat fc-other-month fc-past" data-date="2014-07-12"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-other-month fc-past" data-date="2014-07-06">6</td><td class="fc-day-number fc-mon fc-other-month fc-past" data-date="2014-07-07">7</td><td class="fc-day-number fc-tue fc-other-month fc-past" data-date="2014-07-08">8</td><td class="fc-day-number fc-wed fc-other-month fc-past" data-date="2014-07-09">9</td><td class="fc-day-number fc-thu fc-other-month fc-past" data-date="2014-07-10">10</td><td class="fc-day-number fc-fri fc-other-month fc-past" data-date="2014-07-11">11</td><td class="fc-day-number fc-sat fc-other-month fc-past" data-date="2014-07-12">12</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
                            
                            <!-- Todo Lists -->
                            <div id="todo-lists">
                                <div class="tl-header">
                                    <h2>Todo Lists</h2>
                                    <small>Add, edit and manage your Todo Lists</small>
                                    
                                    <ul class="actions actions-alt">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="">Refresh</a>
                                                </li>
                                                <li>
                                                    <a href="">Manage Widgets</a>
                                                </li>
                                                <li>
                                                    <a href="">Widgets Settings</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                    
                                <div class="clearfix"></div>
                                    
                                <div class="tl-body">
                                    <div id="add-tl-item">
                                        <i class="add-new-item md md-add"></i>
                                        
                                        <div class="add-tl-body">
                                            <textarea placeholder="What you want to do..."></textarea>
                                            
                                            <div class="add-tl-actions">
                                                <a href="" data-tl-action="dismiss"><i class="md md-close"></i></a>
                                                <a href="" data-tl-action="save"><i class="md md-check"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="md md-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Duis vitae nibh molestie pharetra augue vitae</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="md md-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>In vel imperdiet leoorbi mollis leo sit amet quam fringilla varius mauris orci turpis</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="md md-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Suspendisse quis sollicitudin erosvel dictum nunc</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="md md-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Curabitur egestas finibus sapien quis faucibusras bibendum ut justo at sagittis. In hac habitasse platea dictumst</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="md md-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Suspendisse potenti. Cras dolor augue, tincidunt sit amet lorem id, blandit rutrum libero</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="checkbox media">
                                        <div class="pull-right">
                                            <ul class="actions actions-alt">
                                                <li class="dropdown">
                                                    <a href="" data-toggle="dropdown">
                                                        <i class="md md-more-vert"></i>
                                                    </a>
                                                    
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="">Delete</a></li>
                                                        <li><a href="">Archive</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="media-body">
                                            <label>
                                                <input type="checkbox">
                                                <i class="input-helper"></i>
                                                <span>Proin luctus dictum nisl id auctor. Nullam lobortis condimentum arcu sit amet gravida</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <!-- Recent Items -->
                            <div class="card">
                                <div class="card-header">
                                    <h2>Recent Items <small>Phasellus condimentum ipsum id auctor imperdie</small></h2>
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="">Refresh</a>
                                                </li>
                                                <li>
                                                    <a href="">Settings</a>
                                                </li>
                                                <li>
                                                    <a href="">Other Settings</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="card-body m-t-0">
                                    <table class="table table-inner table-vmiddle">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th style="width: 60px">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="f-500 c-cyan">2569</td>
                                                <td>Samsung Galaxy Mega</td>
                                                <td class="f-500 c-cyan">$521</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">9658</td>
                                                <td>Huawei Ascend P6</td>
                                                <td class="f-500 c-cyan">$440</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">1101</td>
                                                <td>HTC One M8</td>
                                                <td class="f-500 c-cyan">$680</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">6598</td>
                                                <td>Samsung Galaxy Alpha</td>
                                                <td class="f-500 c-cyan">$870</td>
                                            </tr>
                                            <tr>
                                                <td class="f-500 c-cyan">4562</td>
                                                <td>LG G3</td>
                                                <td class="f-500 c-cyan">$690</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="padding: 0px; position: relative;" id="recent-items-chart" class="flot-chart"><canvas height="150" width="655" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 655px; height: 150px;" class="flot-base"></canvas><canvas height="150" width="655" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 655px; height: 150px;" class="flot-overlay"></canvas></div>
                            </div>
                            
                            <!-- Recent Posts -->
                            <div class="card">
                                <div class="card-header ch-alt m-b-20">
                                    <h2>Recent Posts <small>Phasellus condimentum ipsum id auctor imperdie</small></h2>
                                    <ul class="actions">
                                        <li>
                                            <a href="">
                                                <i class="md md-cached"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="md md-file-download"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown">
                                                <i class="md md-more-vert"></i>
                                            </a>
                                            
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="">Change Date Range</a>
                                                </li>
                                                <li>
                                                    <a href="">Change Graph Type</a>
                                                </li>
                                                <li>
                                                    <a href="">Other Settings</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    
                                    <button class="btn bgm-cyan btn-float waves-effect waves-button waves-float"><i class="md md-add"></i></button>
                                </div>
                                
                                <div class="card-body">
                                    <div class="listview">
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
                                        <a class="lv-footer" href="">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            