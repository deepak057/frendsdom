<?php 

$user_c=Helpers::get_controller(USERS);

?>

<div class="inbox-wrap">



<div class="card">
	
<div class="card-header bgm-cyan">
	
	<h2>Inbox<small>Select a conversation</small></h2>

</div>


<div class="card-boddy card-padding">
	
	

<div class="col-md-3">
	
                           <?php if(!empty($users)){ ?>



<div class="listview ib-conv-items-list p-b-5 p-t-10">

<?php foreach ($users as $user){?>

                            <a href="javascript:void(0)" uid="<?php echo $user->id; ?>" class="lv-item ib-user-conv-item m-b-5">
                                <div class="media">
                                    <div class="pull-left p-relative">
                                        <img alt="" src="<?php echo $user_c->ProfilePicUrl($user); ?>" class="lv-img-sm">
                                        <!--<i class="chat-status-busy"></i>-->
                                    </div>
                                    <div class="media-body">
                                        <div class="lv-title"><?php echo $user_c->UserName($user); ?></div>
                                       <!-- <small class="lv-small">Available</small>-->
                                    </div>
                                </div>
                            </a>
                            
                            <?php } ?>



                            
                        </div>

                        <?php 

                    }

                    ?>








</div>

<div class="col-md-9 ib-conv-container">
	











</div>

</div>










<div class="clearfix"></div>
</div>
</div>