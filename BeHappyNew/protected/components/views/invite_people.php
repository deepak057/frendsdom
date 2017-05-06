<?php

$theme_url=AppURLs::ThemeURL();

?>

<div role="tabpanel">
                                <ul role="tablist" class="tab-nav" style="overflow: hidden;" tabindex="1">
                                    <li class="active"><a data-toggle="tab" role="tab" aria-controls="home11" href="#home11" aria-expanded="false">Add people By Name</a></li>
                                    <li class=""><a data-toggle="tab" role="tab" aria-controls="profile11" href="#profile11" aria-expanded="false">Social Media</a></li>
                                           </ul>
                              
                                <div class="tab-content">
                                    <div id="home11" class="tab-pane active" role="tabpanel">



 <div class="card">
                            
                            
                            <div class="card-body clearfix">       




<form class="invite-people-form">


<p>Search for the people who are on the site.</p>


                    <div class="fg-line">
                        <input id="ppl-on-site-field" class="form-control" placeholder="Type name or email" type="text">
                    </div>


<button cid="<?php echo $circle->id; ?>" type="submit" id="invite-ppl-trigger-btn" class="btn btn-info m-t-20 m-b-10">

<i class="md md-check"> 
  </i> Invite Now

</button>

</form>





<!--<form  accept-charset="UTF-8" method="post" role="form" class="form ">
<div class="input-group m-b-20">
<span class="input-group-addon">
<div class="fg-line">
<input type="email"  placeholder="Type names here" class="form-control"/>
</div>
</div>

<button  class="btn btn-danger waves-effect waves-button waves-float waves-effect waves-button waves-float" type="submit">
Invite</button>
</form>
-->


</div>
</div>





                                    </div>
                                    <div id="profile11" class="tab-pane" role="tabpanel">
                                    
                                    <div class="card go-social">
                            <div class="card-header">
                              
                            </div>
                            
                            <div class="card-body clearfix">
                                <a href="" class="col-xs-4">
                                    <img alt="" class="img-responsive" src="<?php echo $theme_url; ?>/img/social/facebook-128.png">
                                </a>
                                
                                <a href="" class="col-xs-4">
                                    <img alt="" class="img-responsive" src="<?php echo $theme_url; ?>/img/social/twitter-128.png">
                                </a>
                                
                                <a href="" class="col-xs-4">
                                    <img alt="" class="img-responsive" src="<?php echo $theme_url; ?>/img/social/googleplus-128.png">
                                </a>

                                <a href="" class="col-xs-4">
                                    <img alt="" class="img-responsive" src="<?php echo $theme_url; ?>/img/social/linkedin-128.png">
                                </a>
                                
                                <a href="" class="col-xs-4">
                                    <img alt="" class="img-responsive" src="<?php echo $theme_url; ?>/img/social/youtube-128.png">
                                </a>
                                
                                <a href="" class="col-xs-4">
                                    <img alt="" class="img-responsive" src="<?php echo $theme_url; ?>/img/social/blogger-128.png">
                                </a>
                            </div>
                        </div>

                        <?php //$this->widget('ext.hoauth.widgets.HOAuth'); ?>


                                    </div>
                                    
                                </div>
                            </div>