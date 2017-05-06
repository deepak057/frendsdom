
<div class="card search-page-wrap">
	
<div class="card-header bgm-cyan">
	

<form method="get" class="form">
								
								<div class="fg-line w-95">
									<input id="sp-serach-field" name="k" value="<?php if(!empty($keyword)) echo $keyword; ?>" type="text" class="form-control input-lg no-back white-placeholder c-white" placeholder="Enter your search here" >
									
								</div>
								<div class="dropdown m-t-10">

        <button class=" btn-float btn-default fix-float-btn waves-effect no-border " title="">
          <i class="md c-black md-search">
          </i>
        </button>
      
</div>
							
						
					</form>


</div>

<div class="card-body">
	
<div role="tabpanel" >

<div class="col-xs-2 tabs-container">
                                <ul role="tablist" class="nav nav-tabs  tabs-left " style="overflow: hidden;" tabindex="2">
                                    <li class="<?php if($default_type==USERS) echo "active"; ?>" ><a class="c-default bold search-page-tab" data-toggle="tab" role="tab" aria-controls="home1" href="#home1" aria-expanded="false"> USERS</a></li>
                                    <li class="<?php if($default_type==CIRCLES) echo "active"; ?>" role="presentation"><a class="c-default bold search-page-tab" data-toggle="tab" role="tab" aria-controls="profile1" href="#profile1" aria-expanded="true">CIRCLES</a></li>
                                    <li class="<?php if($default_type==POSTS) echo "active"; ?>"role="presentation"><a class="c-default bold search-page-tab" data-toggle="tab" role="tab" aria-controls="messages1" href="#messages1" aria-expanded="false">POSTS</a></li>
                                </ul></div>
                              
    <div class="col-xs-10 tabs-container-wrap">

                                <div class="tab-content">
                                    <div id="home1" class="tab-pane <?php if($default_type==USERS) echo "active"; ?>" role="tabpanel">
                                     
<?php echo $users_view; ?>

 </div>
                                    <div id="profile1" class="tab-pane <?php if($default_type==CIRCLES) echo "active"; ?>" role="tabpanel">
                                   <?php echo $circles_view; ?>     
                                    </div>
                                    <div id="messages1" class="tab-pane <?php if($default_type==POSTS) echo "active"; ?>" role="tabpanel">
                                    <?php echo $posts_view; ?>    
                                    </div>
                                    <div id="settings1" class="tab-pane" role="tabpanel">
                                        <p>Praesent turpis. Phasellus magna. Fusce vulputate eleifend sapien. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis.</p>
                                    </div>
                                </div></div>
                            </div></div>


<div  class="clearfix" ></div>

</div>

</div>