<?php
   
   /*
   
   This class is used to put a horizontally scrollable grid of pics of recently online users
   This class relies on FunctionList.php which must already be included
   
   */
   
   
   class recently_online{
   
   
   //method to get n users who were online most recently
   
   function last_active_users($limit=20){
   
   $mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
   	
   if($result=$mysqli->query("select * from userdata where ".SQL_valid_users()." AND pp_featured_on_recent_users=1 ORDER BY `last_active` DESC limit {$limit}"))
   {
   if($result->num_rows>0)
   {
   while($row=$result->fetch_array()){
   
   $return[]=array(
   
   	"id"=>$row['id'],
   	"name"=>$row['first']." ".$row['last'],
   	"country"=>$row['country']
   	
   	);
   
   }
   
   }
   
   }
   
   return $return;
   
   }
   
   //method to put pic grid
   
   function put_recently_online($users=48){
   
   //get users
   $users=$this->last_active_users($users);
   
   //include required CSS,Javascript files
   $this->include_files();
   
   //put html content
   $this->put_html($users);
   
   }
   
   function put_html($users){
   
   //number of pics in single slide
   $pics_in_slide=12;
   
   //calculate number of slides, each slide will contain 12 pics
   $slide_count=count($users)/$pics_in_slide;
   
   ?>
<div id="slideshow">
   <div id="slidesContainer">
      <?php
         for($i=1;$i<=$slide_count;$i++){
         
         ?>
      <div class="uo-slide">
         <ul>
            <?php
               for($j=($i-1)*$pics_in_slide;$j<$i*$pics_in_slide;$j++) {
               
               ?>
            <li class="uo-user-li">
               <a href="<?php echo get_profile_url($users[$j]['id']); ?>"><img alt="<?php echo $users[$j]['name']; ?>" src="<?php echo get_thumb($users[$j]['id'],200,200); ?>"/></a>
               <div class="no_wh">
                  <div class="small uo-user-info none">
                     <a href="<?php echo get_profile_url($users[$j]['id']); ?>">
                     <?php echo $users[$j]['name']; ?>
                     </a>
                     <div class="grey"><?php echo country_name($users[$j]['country']);?></div>
                  </div>
               </div>
            </li>
            <?php
               }
               ?>
         </ul>
         <div class="clear"></div>
      </div>
      <?php
         }
         
         
         ?>
   </div>
</div>
<?php
   }
   
   
   function include_files(){

   ?>
<link rel="stylesheet" type="text/css" href="css/users_slider.css"/>
<script src="js/users_slider.js" type="text/javascript"></script>
<?php
   }
   
   
   
   }
   
   
   
   ?>