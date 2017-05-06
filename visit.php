<?php
   //function to notify the browser to use the cached version of this page if page was not modified 
   function caching_headers ($file, $timestamp) {$gmt_mtime = gmdate('r', $timestamp);header('ETag: "'.md5($timestamp.$file).'"');if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH'])) {if ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime || str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp.$file)) {header('HTTP/1.1 304 Not Modified');exit();}}header('Last-Modified: '.$gmt_mtime);header('Cache-Control: public');}
   caching_headers ($_SERVER['SCRIPT_FILENAME'], filemtime($_SERVER['SCRIPT_FILENAME']));
   
   //starting session 
   session_start();
   
   //referring to main page if no id supplied 
   if((empty($_SESSION["id"])) && (!isset($_GET['id'])))
   {
   header('location:main.php');
   }
   

   //compressing HTML content 
   //ob_start("ob_gzhandler");

//including system environment
   include("environment.php");
  
if(empty($_GET['id'])) 
   {
	die('The ID is invalid!');
}
 
//get ID of user whose profile is visited
$id=get_user_id();

if(!$id){
die('The ID is invalid!');
}
   
else {

$_GET['id']=$id;
}
   
   
   
   //check if this page is being visited while making points
   check_mp_();
   
   //if id supplied doesn't exist
   if(!if_exists("userdata","id",$id) || !account_status($id))
   header("location:".get_profile_url($_SESSION['userid']));
   
   //verifying log-in
   check_log_in($_SERVER["REQUEST_URI"]);
   
   //including following file that contains definition of class user 
   include('class_lib.php');
   
   //uv stands as abbreviation of 'visited user' or 'user being visited' 
   //lu stands as abbreviation of logged-in user
   
   //now creating instance 'vu' of class user 
   $vu=new user($id);
   
   //creating object lu(logged-in user)
   $lu=new user($_SESSION['userid']);
   
   //check if user is visiting their own profile
   $own_profile=$lu->user->id==$vu->user->id;
   
   //getting vu's sex
   $sex=$vu->get_sex();if($sex=="female") $h="She" ; else $h="He";if($sex=="female") $hh="her"; else $hh="him";
   
   //getting other values
   $strip_color=$vu->get_strip_color();
   $btnsetcolor=$vu->get_btnset_color();
   $rel_status=$vu->get_rel_status();
   $visit_backg=$vu->get_visit_backg();
   $rel_color=$vu->get_rel_color();
   $comment_backg=$vu->get_comment_backg();
   
   //creating new sessions for vu
   $_SESSION['id']=$vu->get_id();
   $_SESSION['visitname']=$vu->get_name();
   $_SESSION['visit']=$vu->get_email();
   
   ?>
<!doctype html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <META HTTP-EQUIV="Content-Language" Content="en"/>
      <meta name="Description"  content="Visit other user's or one's own profile"/>
      <title><?php echo $_SESSION['visitname'];?> -Frendsdom</title>
      <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
      <script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script src="nicescroll.js"></script><script src="scroll_to.js"></script><script src="apprise/apprise.min.js" type="text/javascript"></script><script src="jquery.hovercard.js" type="text/javascript"></script><script src="visit_script.js" type="text/javascript"></script><script src="visit_script1.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script src="js/jquery.outside.events.js"></script><script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script>
      <script type="text/javascript" src="resources/jquery/js.js"></script><script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script><script type="text/javascript" src="tokeninput/src/jquery.tokeninput.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="chat/chat.js"></script><script type="text/javascript" src="noty/js/jquery.noty.js"></script><script type="text/javascript" src="noty/js/layouts/top.js"></script><script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script><script type="text/javascript" src="noty/js/themes/default.js"></script>
      <script type="text/javascript" src="js/liteaccordion.jquery.min.js"></script>
      <script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
      <script type="text/javascript" src="jeditable.js"></script>
      <script src="js/jquery.prettyPhoto.js"></script>
      <script src="js/minimalect.js"></script>
<script type="text/javascript" src="js/icheck.min.js"></script>
<script type="text/javascript" src="js/mediaelement/build/mediaelement-and-player.min.js"></script>

      <script type="text/javascript" src="fancyBox_source/jquery.fancybox.js"></script>
      <script type="text/javascript" src="js/masonry.js"></script>
      <link rel="stylesheet" type="text/css" href="css8.css">
      <link rel="stylesheet" type="text/css" href="visit_styleSheet.css">
      <link rel="stylesheet" type="text/css" href="css/minimalect.css">
      <link rel="stylesheet" type="text/css" href="css/liteaccordion.css"/>
      <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css"/>
      <link rel="stylesheet" type="text/css" href="fancyBox_source/jquery.fancybox.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/>
      <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
      <link rel="stylesheet" href="tokeninput/styles/token-input-facebook.css" type="text/css" />
      <link rel="stylesheet" type="text/css" href="chat/chat.css"/>

<link rel="stylesheet" type="text/css" href="js/mediaelement/build/mediaelementplayer.min.css" />
<link type="text/css" rel="stylesheet" href="css/icheck/skins/minimal/blue.css"/>

      <link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
      <script type="text/javascript">user_online();
         vars['own_profile']=<?php echo $_GET['id']?>==<?php echo $_SESSION['userid'] ?>;
         vars['cp_frame_width']=<?php echo $GLOBALS['cover_pic_conf']['frame_width'];?>;
         vars['cp_frame_height']=vars['cp_frame_current_height']=<?php echo $GLOBALS['cover_pic_conf']['frame_height'];?>;
         vars['accordion_container_width']=accordion_container_width();
         vars['user_pp_slider_conf']=<?php echo json_encode(get_slider_conf($vu->user)); ?>;
         vars['pp_accordion_default']=get_pp_slider_conf(vars['user_pp_slider_conf']);
         vars['lu_name']="<?php echo tunethename($lu->first." ".$lu->last)?>";vars['lu_profile']="<?php echo get_profile_url($lu->id); ?>";vars['lu_dp']="<?php echo prof_pic($lu->id); ?>";
         var rcp_ids=new Array("<?php echo $_GET['id']; ?>");Array.prototype.findIndex=function(a){var b="";for(var i=0;i<this.length;i++){if(this[i]==a){return i}}return b};
         jQuery(document).ready(function(){
         init();
         $(".flexible_textarea").live("focus",function(){$(this).flexible();});
         $("#msg_recpients").tokenInput("namehints_json.php", {
                         theme: "facebook",
         prePopulate: [{id:"<?php echo $_GET['id']; ?>", name: "<?php echo $vu->get_name();?>"}],
         hintText:"Type your relation's name",onAdd: function (item) {
                             rcp_ids.push(item.id);
                         },
                         onDelete: function (item) {
                             rcp_ids.splice(rcp_ids.findIndex(item.id),1);
         
         }
         });
         
         $('#switcher').themeswitcher({
         loadTheme:"Smoothness"
         });
         });
      </script>
      <style type="text/css">
         .hp_post_container {background:<?php echo $vu->post_block_back; ?>}
         .lu_strip_back{background:<?php echo $lu->get_strip_color(); ?> !important;}.chatboxhead {
         background:#FF8C00;
         filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $vu->get_strip_color(); ?>', endColorstr='#000000');
         background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $vu->get_strip_color(); ?>), to(#000));
         background: -moz-linear-gradient(top,  <?php echo $vu->get_strip_color(); ?>,  #000);	
         }.chatboxtextareaselected {
         border: 2px solid <?php echo $vu->get_strip_color(); ?>;
         }.relation_status li{
         background-color:#00BFFF;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $vu->get_rel_color(); ?>',endColorstr='#eee') !important;background:-webkit-gradient(linear,left top,left bottom,from(<?php echo $vu->get_rel_color(); ?>),to(#eee)) !important;background:-moz-linear-gradient(top,<?php echo $vu->get_rel_color(); ?>,#fff)!important;background:-o-linear-gradient(top,<?php echo $vu->get_rel_color(); ?>,#fff)!important;
         }/*#other_actions{
         background-color:<?php echo $lu->get_nudgemenu_color();?>;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $lu->get_nudgemenu_color();?>',endColorstr='#eee') !important;background:-webkit-gradient(linear,left top,left bottom,from(<?php echo $lu->get_nudgemenu_color();?>),to(#eee)) !important;background:-moz-linear-gradient(top,<?php echo $lu->get_nudgemenu_color();?>,#eee)!important;background:-o-linear-gradient(top,<?php echo $lu->get_nudgemenu_color();?>,#eee)!important;}*/
      </style>
   </head>
   <body id="mother_body">
      <?php 
         //insert google analytic code
         include($ga_file); 
         
         ?>
      <div id="body">
         <?php
            //put navigation
            include("modules/nav/nav.php");
            $nav=new nav();
            $nav->get_nav_3($lu);
            ?>
         <div id='pp-accordion-container'>
            <ol>
               <li>
                  <h2 title="Feedback and Comments"><span>Feedback and Comments</span></h2>
                  <div class="pp-acd-sc-outer">
                     <div class="pp-acd-sub-container pp-same-bg-elem center">
                        <center>
                           <div class="response_div user_response_div pp-var-background-strip" id="response_div">
                              <?php $vu->user_response($_SESSION['userid']);?>
                           </div>
                        </center>
                     </div>
                  </div>
               </li>
               <li>
                  <h2 title="Recent Status"><span>Recent Status</span></h2>
                  <div class="pp-acd-sc-outer">
                     <div class="pp-acd-sub-container pp-rs-wrapper pp-same-bg-elem center overflow-auto">
                        <center>
                           <div class="pp-rs-container left">
                              <?php
                                 //Render "recent status" view
                                 display_posts(0,15,false,false,$lu->id,$vu->id);
                                 
                                 ?>
                           </div>
                        </center>
                     </div>
                  </div>
               </li>
               <li>
                  <h2 title="Cover Picture"><span>Cover Picture</span></h2>
                  <div class="pp-acd-sc-outer">
                     <div class="pp-acd-sub-container pp-var-background-strip center">
                        <div class="cover-pic-container overflow-auto">
                           <center>
                              <img id="pp-cover-pic-img" class="pp-cover-pic share_pic" alt="Click to see it big" src="<?php echo cover_pic($_SESSION['id']); ?>"/>
                           </center>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <h2 title="Basic Info"><span>Basic Info</span></h2>
                  <div class="pp-acd-sc-outer">
                     <div class="pp-acd-sub-container pp-var-background-strip center">
                        <center>
                           <div class="pp-basic-info-div">
                              <div class="pp-tagline back-1">
                                 <div id="pp-tagline-content" class="pp-tagline-content">
                                    <?php
                                       if(empty($vu->user->tagline) && $own_profile){
                                       echo "Click to put your tagline here";
                                       }
                                       else if (!empty($vu->user->tagline))
                                       {
                                       echo text($vu->user->tagline);
                                       }
                                       ?>
                                 </div>
                              </div>
                              <div class="pp-prof-pic-div">
                                 <img id='vu_prof_pic' src='<?php echo $vu->prof_pic();?>' class='share_pic' title='Click to zoom in' alt='<?php echo $_SESSION['visitname'];?>'>
                                 <div>
                                    <h2><i><?php echo $_SESSION['visitname']; ?></i></h2>
                                 </div>
                                 <div><?php echo $vu->get_country(); ?></div>
                              </div>
                              <div id="rel" class="pp-relation-div back-1">
                                 <?php $lu->get_rel($_SESSION['id']);?>
                              </div>
                           </div>
                           <?php
                              if($_SESSION['id']==$_SESSION['userid']){
                              ?>
                           <div class="pp-customize-slider">
                              <a href="javascript:void(0)" class="pp-customize-popup-trigger" id="pp-customize-popup-trigger"><img src="<?php echo get_image("pref.png");?>"/></a>
                              <a href="javascript:show_colorlist('backstrip_color','<?php echo $_SESSION['userid'];?>')" id="change_stripcolor"  class="change_stripcolor" onmouseover="this.style.opacity='.4';this.style.background='none';" onmouseout="this.style.opacity='1';" onclick="this.style.color='black';" title="Click to see the color list to change the color of the background"><span id="down_arrow"  class="special_icon">&#916;</span></a>
                              <div id="backstrip_color" class="colorlist"></div>
                           </div>
                           <?php
                              }
                              ?>
                        </center>
                     </div>
                  </div>
               </li>
               <li>
                  <h2 title="Share Box"><span>Share Box</span></h2>
                  <div class="pp-acd-sc-outer">
                     <div class="pp-acd-sub-container pp-var-background-strip center">
                        <?php
                           //Generate Sharebox
                           include(get_module_path("pp_sharebox/share_box.php"));
                           $sbox=new share_box($vu);
                           $sbox->put_sbox();
                           
                           ?>
                     </div>
                  </div>
               </li>
            </ol>
            <noscript>
               <p>Please enable JavaScript to get the full experience.</p>
            </noscript>
         </div>
         <script>
            $("#"+vars['pp-accordion-container-id']).liteAccordion(vars['pp_accordion_default']);
            adjust_pp_slider_position();
            $(function(){$('*[title]').monnaTip();});set_vpb("<?php echo $vpb_dir.$visit_backg;?>");cl_back("<?php echo $strip_color;?>");changecss(0,'.comment','background','<?php echo $comment_backg;?>');sessionStorage.setItem('vuid', '<?php echo $_SESSION['id'];?>');var vuid = sessionStorage.getItem('vuid');sessionStorage.setItem('luid', '<?php echo $_SESSION['userid'];?>');var luid=sessionStorage.getItem('luid');sessionStorage.setItem('ar_status', '<?php echo $vu->get_auto_response();?>');var ar_status=sessionStorage.getItem('ar_status');sessionStorage.setItem('atr_reqst','<?php if(in_array($_SESSION['id'],return_array_tweaked($authority_recpients_db,"authorityrecpients4user{$_SESSION['userid']}","request_from")))echo "true";else if(in_array($_SESSION['id'],return_array_tweaked($authority_recpients_db,"authorityrecpients4user{$_SESSION['userid']}","recpient_id"))) echo "granted"; else echo "false";?>');var art_reqst=sessionStorage.getItem('atr_reqst');sessionStorage.setItem('vu_gen', '<?php echo $vu->get_sex();?>');var vu_gen = sessionStorage.getItem('vu_gen');sessionStorage.setItem('vu_pa', '<?php echo $vu->get_visit_backg().",".$vu->get_strip_color().",".$vu->get_btnset_color().",".$vu->get_rel_color().",".$vu->get_comment_backg();?>');var vu_pa= sessionStorage.getItem('vu_pa');var vu_prof_pic=<?php if($vu->user_pic())echo "true";else echo "false"; ?>;var vpb_dir="/<?php echo $vpb_dir; ?>";
         </script>
         <center>
            <ul class="relation_status" id="relation_status">
               <h3><?php if($_SESSION['userid']==$_SESSION['id']){echo "<a href='javascript:void(0)'><img id='rel_img' align='top'></a>";}?>&nbsp;<span id="rel_caption"><?php if($_SESSION['id']==$_SESSION['userid']){echo "Your";} else{if($sex=="female")echo "Her"; else echo "His"; } echo " connections"; ?></span>&nbsp;<img id="rel_lock"></h3>
               <?php
                  //if relation status table is set to be visible to others, then displaying it
                   
                  if($rel_status=="yes")
                  {
                  
                  echo '<div id="main_container"><div id="rel_listcontainer">';
                  
                  //now fetching the data from database and displaying it
                  
                  $mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
                  if($mysqli===false)
                  {
                  die("Error :could not connect ".mysqli_connect_error());
                  }
                  $sql="select listid from user{$_SESSION['id']} limit 0, 10";
                  if($result=$mysqli->query($sql))
                  {
                  if($result->num_rows>0)
                  {
                  while($row=$result->fetch_array())                           
                  {
                  if(!empty($row['listid']) && account_status($row['listid']))
                  {
                  ?>
               <li>
                  <table>
                     <tr>
                        <td><a href='<?php echo get_profile_url($row['listid']);?>' title="&lt;img src='<?php echo prof_pic($row['listid']); ?>' height='160' width='160' /&gt;"><b><?php echo user_name($row['listid'])." ";?></b></a><span style="color:grey;"><?php echo $lu->get_relation_status($row['listid']);?></span></td>
                     </tr>
                  </table>
               </li>
               <?php
                  }
                  }
                  $result->close();
                  }
                  }
                  
                  //if relation status is set to be visible to others 
                  if($rel_status=="yes")
                  {
                  ?>
      </div>
      <span  id="rel_btn_container"><img onclick='getnextrel("next");' id='next_rel' title='<?php if($sex=="female")echo "her";else echo "his"; ?> next 10 relations' src="ngreyf.bmp" ></br><img title='<?php if($sex=="female")echo "her";else echo "his"; ?> previous 10 relations' onclick="getnextrel('pre');" id='pre_rel' src="ngreyb.bmp" class='hidden'></span>
      </div>
      <script>
         sessionStorage.setItem('rel_count', '2');var n = sessionStorage.getItem('rel_count');var total=<?php echo total_entries("user".$_SESSION['id'],"listid");?>;if(total<=10)hide('next_rel');
         function getnextrel(pre_next){el('rel_listcontainer').innerHTML="<p>"+loading+"</p>";if(pre_next=='pre'){var val=parseInt(n)-2;n=val+1;}if(pre_next=='next'){var val=parseInt(n);n=val+1;}if(val>1)show('pre_rel');else hide('pre_rel');if(val*10>=total)hide('next_rel');else show('next_rel');w.postMessage("getrel n="+val);w.onmessage=function(e)
         {el('rel_listcontainer').innerHTML=e.data;};}
      </script>
      <?php
         }
         }
         
         ?>
      </ul>
      </center>
      <script>
         var rel_status="<?php echo $rel_status ?>"; if(rel_status=="no"){rel_hide();el('rel_img').onclick=function(){el('rel_img').onclick="";var p=document.createElement("p");p.innerHTML=loading;el('relation_status').appendChild(p);if(!file_exists("getrelstatus.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "getrelstatus.js");document.getElementsByTagName("head")[0].appendChild(script);}};}else {rel_show();}
      </script>
      <?php
         //if logged-in user visits a profile other than his own, then allowing him to send messages, nudge etc to others by means of showing corresponding buttons
         
         if($_SESSION['userid']!=$_SESSION['id'])
         {
         
         //retreiving color value for nudgemenu
         $nudgemenucolor=entity_value('userdata','nudgemenu_color','id',$_SESSION['userid']);
         
         //now putting buttons for sending msgs,nudging and leading to vu's pic collection
         ?>
      <table cellspacing='7' id="visit_buttonset" class="visit_buttonset">
         <tr>
            <td id="action_menu">
               <img src="<?php echo get_image("settings_icon.gif"); ?>"/>
            </td>
            <td>
               <img src="<?php echo get_image("collection.gif"); ?>"/><a href="view_collection.php?id=<?php echo $_SESSION['id']; ?>">See <?php if($sex=="female") echo ' her'; else echo 'his';?> pic collection</a>
            </td>
            
<?php

//check whether logged-in user is allowed to send text messages to profile owner

if(is_allowd_to_text($vu,uid())){

?>
<td onclick="msg1();">
<img src="<?php echo get_image("message_icon.png"); ?>"/>
<a href='javascript:void(0)'>Leave <?php echo $hh;?> a message</a>
</td>
    

<?php

}
?>        

<td id="nudge">
               <img src="<?php echo get_image("nudge.gif"); ?>"/><a href='javascript:void(0)'>Nudge <?php echo $hh;?></a>
            </td>
         </tr>
      </table>
      <?php 
         }
         
         //on the other hand if users visit their own profile then allowing them to upload audio clips,change colors of various page components
         
         if ($_SESSION['id']==$_SESSION['userid'])
         {?>
      <table id='own_profile_btnset'>
         <tr>
            <td class="hover_red">
               <a href='javascript:void(0)' onclick='getbtnsetfile("<?php echo $_SESSION['userid'];?>");' title='Customize the buttonset appearing on your profile'>&#916;</a>
            </td>
            <td>
               <table>
                  <tr class="visit_buttonset">
                     <td id="wavefilebutton" onclick="<?php if($lu->clip_exists()) echo 'upldagain()'; else echo 'visible()'; ?>"  title="Upload an audio file that visitors will listen to as welcome note when they visit your profile. It could be your voice sample or any other sound clip you like." ><a href="javascript:void(0)"><?php if($lu->clip_exists()) echo 'Manage your audio clips'; else echo 'Upload an audio clip';?> </a></td>
                     <td id="action_menu">
                        <img src="<?php echo get_image("settings_icon.gif"); ?>"/>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
      <div id='change_page_backg'>
         <a href="javascript:void(0)" class="no_backg" title="Change background color of entire page" id="getcolorlist4back1" onclick="getcolorlist4back(<?php echo $_SESSION['userid']; ?>);">
            <h1 id="page_back_t">&#916;</h1>
         </a>
         <div id="backg_container" class="colorlist" ></div>
      </div>
      <div  class="hidden" id="rel_color_div">
         <a href="javascript:void(0)" class="no_backg" title="Change the color of this table" id="rel_color" onclick="getcolor4rel(<?php echo $_SESSION['userid'];?>);">
            <h1>&#916;</h1>
         </a>
         <div  id="relc_container"  class="colorlist" ></div>
      </div>
      <?php
         }
         
         //include client side script to get Other Actions menu working
         $vu->other_actions($_SESSION['userid']);
         
         //next are the button and media player used to listen to vu or lu's voice sample
         //they are always supposed to be on page even if lu visits his own profile allowing him to listen to his own voice sample 
         ?>
      <button id="listenbutton"  onclick="play()"><span><img align="middle" src="<?php echo get_image("play1.gif"); ?>"/>Listen to <?php echo $hh;?></span></button>
      <div id='player'>
         <img title="Close Player" onclick="enable_listen_btn();" id="pp-player-close" class="pointer" src="<?php echo get_image("close.png"); ?>"/>
         

<audio ></audio>

      </div>
      <?php
         pop_up_msg($_SESSION['userid']);
         ?>
      <!--body division ends here-->
      </div>
      <?php
         //now coming out of main 'body' division, components from now onwards falling outside that div can shine over blurred background
         //when any of these divisions is active, the main body division goes blured allowing neat and clear visuals of the active division
         
         //if logged-in user visits his own profile
         
         if($_SESSION['userid']==$_SESSION['id'])
         {
         ?>
      <div>
         <form id="uploadwavefilemenu" class="shaded_grey_back" method="post" action="waveclipupload.php" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();"><input type="file" name="uploaded_file" /><br /></br><input id="btn" type="submit" value="Upload" ><input id="btn" type="button" value="cancel" onclick='fade();'></form>
      </div>
      <iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;"></iframe>
      <div id="alreadyuploaded"></div>
      <table id="clipinfo" class="small" cellpadding="7">
         <tr>
            <td width='180' class='left'><b>Pay attention:</b></p>Please choose an audio file (with WAV,MPG,MP4 or MP3 extension) and make sure file size doesn't exceed <b>2MB.</b></td>
         </tr>
      </table>
      <div id='customize_btnset'>
         <table style="border:1px dotted black;">
            <tr>
               <td colspan='2' align="left" class='hover_red'><a href='javascript:void(0)' title="Close" onclick="$('#customize_btnset').hide('slow');" ><b>&#215;</b></a></td>
               <td></td>
            </tr>
            <tr>
               <td class='hover_red'><a id="getcolorlist4btnset" href='javascript:void(0)' title="get the colorlist" onclick="showcolorlist4btnset();">&#x21D2;</a></td>
               <td>
                  <table cellspacing="7" class="visit_buttonset" id="btnset">
                     <tr>
                        <td><a href="javascript:void(0)">See <?php if($sex=="female") echo ' her'; else echo 'his';?> pic collection</a></td>
                        <td ><a href='javascript:void(0)'>leave <?php echo $hh;?> a message</a></td>
                        <td ><a href='javascript:void(0)'>Nudge <?php echo $hh;?></a></td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
         <div id="visitbtnset_colorlist" class="colorlist" style="position:absolute;top:40px;left:-120px;visibility:hidden;"><img src="picon1.gif"> loading........</div>
      </div>
      <script>
         pp_change_btnset_color('<?php echo $btnsetcolor;?>');changebtnsetcolor('<?php echo $btnsetcolor;?>');if(rel_status=="yes" && total>=1)show('rel_color_div');
      </script>
      <?php
         }
         
         //and as long as logged-in user doesn't visit his own profile
         
         else
         {
         
         //if logged-in user is not in any list  
         
         if(!$lu->if_exists($_SESSION['id']))
         {
         
         //the popup asking user to select the type of the list before sending request 
         
         ?>
      <div id="menu" inp-id="inp_<?php echo $_GET['id']; ?>" class="shaded_grey_back"></div>
      <?php
         }

         
         //next comes the nudge menu allowing lu to nudge vu and others
         
        ?>
      <div id="nudgemenu">
         <span id="change_nudgemenucolor"  onclick="show_colorlist('nudgemenu_color','<?php echo $_SESSION['id'];?>');"><img id="down_arrow" src="/rightnew.png" height="15" width="20" title="Change the color of this menu"></span><span id="nudgemenu_color" class="colorlist"></span>
         <?php echo "<span id='nudgenames' style='font-size:1.2em;'>Nudging <b>".$_SESSION['visitname']."</b></span>";?>&nbsp;&nbsp;<input type="button" id="addmorebtn" value="+" title="Include others too" >
         <div style="position:relative;top:10px;" id="addmoretext"></div>
         <p id="ieltext"><a href="javascript:void(0)" style="color:black;text-decoration:underline;" onmouseover="this.style.color='grey';this.style.background='none';" onmouseout="this.style.color='black';" onclick="includelst();">Include entire list</a></p>
         <form name="nudgeform" id="nudgeform" method="post" action="nudge.php" enctype="multipart/form-data" target="upload_target" onsubmit="nudge();">
            <div id="includelist"></div>
            <div style="position:relative;">
               <p>
                  <spam style="position:absolute;top:40px;">Nudge text</br><span class="small light_text">Max 100 chars</span></spam>
                  &nbsp;&nbsp;&nbsp;
                  <textarea style="position:relative;top:40px;left:70px;font-family:sans-serif;resize:vertical;" name="nudgetext" cols="40" rows="3" class="flexible_textarea" maxlength="100"></textarea>
               </p>
            </div>
            </br></br><b>Optionals :</b>
            </br></br>Nudging clip&nbsp;<input type="file" name="nudgeclip" size="41" onmouseover="myTimer=setTimeout('show_payAttention()', 1500);el('beforeupload').innerHTML='<b>Pay attention:</b><p>Make sure that you upload a sound file with <b>.wave</b> extenision and size of file does not exceed <b>800kb</b></p> ';" onmouseout='clearTimeout(myTimer);myTimer=setTimeout("hide_payAttention()", 55000);'/>
            <p>Nudge pic&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="nudgepic" size="41" onmouseover="myTimer=setTimeout('show_payAttention()', 1500);el('beforeupload').innerHTML='<b>Pay attention:</b><p>Make sure that you upload an image file with <b>.jpg</b> or <b>.gif</b> extenision and size of file does not exceed <b>800kb</b></p>';" onmouseout='clearTimeout(myTimer);myTimer=setTimeout("hide_payAttention()", 55000);'/></p>
            <p id="known"></p>
            <p style="position:relative;left:150px;"></br><input type="hidden" name="userlist" value="<?php echo $_SESSION['id'];?>"><input type="hidden" name="list1" value=""><input type="hidden" name="send" value="yes"><input type="submit" id="btn" class="special_btn" value="Nudge <?php echo $hh;?> now">&nbsp;<input type="button" class="special_btn redback" value="Close" onclick='$("#nudgemenu").hide("slow");el("body").style.opacity="1";el("addmoretext").innerHTML=" ";$("#addmorebtn").show();'></p>
         </form>
         <div id="beforeupload" style="position:relative;left:-260px;"></div>
      </div>
      <span id="nudgelist"></span>
      <iframe id="upload_target" name="upload_target" style="width:0px;height:0px;border:0px solid #fff;"></iframe>
      <div id="msgmenu">
   <div align='left'>
      <h3><img src="images/message_icon.png" align="middle">&nbsp;Send Message</h3>
   </div>
   <table>
      <tr>
         <td>To:</td>
         <td><textarea class="blue_onhover msg-popup-fields" id="msg_recpients"></textarea></td>
      </tr>
      <tr>
         <td>Title: </td>
         <td><input type="text" name="title" id="msg_title" class="blue_onhover msg-popup-fields" value=" No title"></td>
      </tr>
      <tr>
         <td></td>
         <td>
            <textarea placeholder="Type your message here" class="blue_onhover msg-popup-fields flexible_textarea" style="height:auto;margin-top:15px;" id="msg_text" name="msg" rows="10" cols="49"></textarea>
         </td>
      </tr>
      <tr>
         <td></td>
         <td align="middle" style="padding-top:20px">
            <input type="submit" class="special_btn" value="Send now" onclick="sendmsg(el('msg_title').value,el('msg_text').value,rcp_ids);">&nbsp;<input type="button" class="special_btn redback" value="Cancel" onclick="offmsg()">
         </td>
      </tr>
   </table>
</div>
      <script>
         hide("nudgelist");if(el("nudgelist").innerHTML=="") el("nudgelist").innerHTML="<?php echo $_SESSION['id'];?>";el('nudgemenu').style.background="<?php echo $nudgemenucolor;?>"; $("#nudge").click(function(){show("nudgemenu");el("body").style.opacity=".2";$("#nudgemenu").hide();$("#nudgemenu").show("slow");});$("#addmorebtn").click(function(){$("#addmorebtn").hide("slow");el("addmoretext").innerHTML="<input type='text' style='border-bottom:1px solid black;background:grey;position:relative;' id='txt1' onkeyup='namehints(this.value)' name='name' autocomplete='off' maxlength='20' title='Type name here of another person you want to nudge'><div id='txtHint'></div>";$("#addmoretext").show("slow");});
      </script>
      <?php
         }
         
         //handling introduction phase
         if(($_SESSION['id']==$_SESSION['userid']) && (!empty($_GET['intro_enabled']) || $lu->get_intro_enabled_visit()))
         first_login_greeting(1,"visit");
         
         
         //following divs are put at highest layer level laying above all serving special purposes 
         ?><iframe id='fback_statistic' name='fback_statistic' class='hidden background2'></iframe><iframe id='fback_statistic_post' class='fback_statistic none' name='fback_statistic_post'></iframe>
      <div id="userinfo"></div>
      <div id="success" ></div>
      <div id="uploading"></div>
      <div id='fback_from' class='background2'></div>
      <table  id='profile_comments' class='comment'></table>
      <div id="other_actions" class='background2'  style='background:<?php echo $lu->get_nudgemenu_color();?>'></div>
      <div id='special_div' class='background2' style="visibility:hidden;background:<?php echo $lu->get_nudgemenu_color(); ?>;"></div>
      <div id="success"></div>
      <div id="userinlistmsg"></div>
      <div id="userinfo"></div>
      <p id="uploading" >Uploading your clip......<br/></p>
      <p id="result"></p>
      </div>
      <script>
         if(el('visit_buttonset')){for (var i=0;i<el('visit_buttonset').rows[0].cells.length;i++){el('visit_buttonset').rows[0].cells[i].style.background='<?php echo $btnsetcolor ;?>';}}var total=<?php echo total_entries("user".$_SESSION['id'],"listid");?>;window.onload=checkclips;$(document).ready(function() {preload(["locked1.bmp","unlocked1.bmp","picon1.gif","ngreyf.bmp","ngreyb.bmp","ndowng.bmp","nupr.bmp","share.png","authority.png","pref.png","response.png","move.png","remove.png","images/eyecandy.png"]);});
      </script>
   </body>
</html>
