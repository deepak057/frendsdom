 <div class="dropdown-menu pull-right dropdown-menu-lg c-notifications-dropdown">
                            <div class="current_time" current_time="<?php echo time(); ?>">
                            <div class="listview">
                                <div class="lv-header lv-notification-header">
                                    Notifications
                                    <?php
                                        if($notification_all&&count($notification_all)>0)
                                        {
                                    ?>
                                    <a href="javascript:void(0)"  title="Mark all as Read" class="action-btn br-50 c-green small c-notification-all">
                                    <i class="md md-check">
                                    </i>
                                    <?php
                                        }
                                    ?>
                                </a>
                                </div>
                                <div class="lv-body notifications-container">

				<?php 
				
				if(!empty($notifications)){
				
				foreach($notifications as $notification){ 

				$this->widget("Singlenotification",array("notification"=>$notification));		

				}			
					
				}   

				
				else {

				?>

				<div class="alert alert-info italic-text center no-new-notifications"><h3>No new notificiatons yet.</h3></div>

			
				<?php
				

				}
			
	
				?>












                                 <!--   <div class="lv-item">
                                        <div class="lv-title m-b-5">HTML5 Validation Report</div>
                    
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                                                <span class="sr-only">95% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lv-item">
                                        <div class="lv-title m-b-5">Google Chrome Extension</div>
                    
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lv-item">
                                        <div class="lv-title m-b-5">Social Intranet Projects</div>
                    
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lv-item">
                                        <div class="lv-title m-b-5">Bootstrap Admin Template</div>
                    
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lv-item">
                                        <div class="lv-title m-b-5">Youtube Client App</div>
                    
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                    
                               <!-- <a class="lv-footer" href="">View All</a>-->
                            </div>
                        </div>