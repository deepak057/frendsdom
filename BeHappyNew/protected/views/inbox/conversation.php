<div class="card no-shadow">         

<!--
<div class="card-header">      


     <div class="card-title">                          


<div class="right">               <h2 class="c-default">Conversation with 


<a title="Go to profile" href="<?php echo AppURLs::ProfileURL($user1->id); ?>" class="avatar margin-left-15">  
<?php echo $user_c->UserName($user1); ?>                



               <img src="<?php echo $user_c->ProfilePicUrl($user1); ?>">               </a> </h2>    
                       </div> 



                                 </div>         </div>    -->     <div class="card-body">           <div class="chat-box">             <div class="chats">                            <?php               if(!empty($messages)){              	foreach($messages as $msg){        



echo $this->GetSingleMessageView($msg,$viewing_user_id);
            		



            	}             }               ?>                 </div>           </div>         </div>         <div class="card-footer p-r-10">           <form class="ib-send-msg-form">             <div class="input-group form-material">              
 <!--<span class="input-group-btn">                 <a class="btn btn-pure btn-default icon md-refresh m-t-10" href="javascript: void(0)"></a>               </span> -->                <div class="fg-line">                <textarea placeholder="Type message here ..." class="form-control ib-msg-text"></textarea></div>               <span class="input-group-btn">                 <buttn title="Send the message" class="btn btn-pure btn-default icon md-send ib-send-msg m-t-10" uid="<?php echo $user1->id; ?>" type="button">                                  </buttn></span>             </div>           </form>         </div>       </div>