<div class="chat <?php if($msg->from_id!=$viewing_user_id) echo "chat-right"; ?>"> 
                <div class="chat-body">  
                 <div title="Your text" data-toggle="tooltip" class="chat-content" data-original-title="8:30 am">                     <?php echo Helpers::text($msg->message); ?>                   </div>                 </div>               
</div>  
