<?php
   include("environment.php");
   check_log_in($_SERVER["REQUEST_URI"]);
   
   include('class_lib.php');
   $lu=new user($_SESSION['userid']);
   
   ?>
<!doctype html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <META HTTP-EQUIV="Content-Language" Content="en">
      <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
      <title>Profile and Account settings -Frendsdom</title>
      <script src="jquery-1.4.js" type="text/javascript"></script>
      <script src="script.js" type="text/javascript"></script>
      <script src="js/update_script.js" type="text/javascript"></script>
      <script src="js/jquery.outside.events.js"></script>
      <script type="text/javascript" src="jquery.monnaTip.js"></script>
      <script type="text/javascript" src="resources/jquery/jquery-ui-1.8.9.custom.min.js"></script>
      <script type="text/javascript" src="resources/jquery/js.js"></script>
      <script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script>
      <script type="text/javascript" src="chat/chat.js"></script>
      <script type="text/javascript" src="noty/js/jquery.noty.js"></script>
      <script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script>
      <script type="text/javascript" src="noty/js/themes/default.js"></script>
      <script src="apprise/apprise.min.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="css8.css">
      <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/>
      <link rel="stylesheet" type="text/css" href="chat/chat.css"/>
      <link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
      <link rel="stylesheet" type="text/css" href="css/update_stylesheet.css">
      <link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
      <script>user_online();</script>
<style type="text/css">.chatboxhead{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $lu->get_strip_color(); ?>', endColorstr='#000000');background:-moz-linear-gradient(top,<?php echo $lu->get_strip_color();?>,#000)}.chatboxtextareaselected{border:2px solid <?php echo $lu->get_strip_color();?>}</style>
   </head>
   <body>
      <?php 
         //insert google analytic code
         include($ga_file); 
         
         ?>
      <div id="body" style="margin-top:71px;">
         
         <?php
            //put navigation
            include(get_module_path("nav/nav.php"));
            $nav=new nav();
            $nav->get_nav_3($lu);
            
            ?>
         <div class="page-caption" style="top:16px;">Edit/update your account info</div>
         <div id="up-tabs" class="body-text">
            <ul>
               <li><a href="#tabs-basic-info">Basic Info</a></li>
               <li><a href="#tabs-others">Settings</a></li>

<?php

if(empty($lu->user->user_name)){

?>
<li><a href="#tabs-username">User Name</a></li>
<?php

}


?>


            </ul>
            <div id="tabs-basic-info">
               <center>
                  <form  name="form" onsubmit="return false;">
                     <div class="loginform" id="loginform">
                        <table width="100%" >
                           <tr>
                              <td>
                                 <div>First Name</div>
                                 <input class="shaded_fields" name="first" value="<?php  echo $lu->get_first();?>" type="text" size="40">
                              </td>
                              <td>
                                 <div>Last name</div>
                                 <input class="shaded_fields" name="last" value="<?php echo $lu->get_last();?>" type="text" size="45">
                              </td>
                           </tr>
                        </table>
<?php

if(!empty($lu->user->user_name)){
?>
                        <br/>
                        <table width="100%" >
                        <tr>
                        <td>
                        <div>User Name</div>
                        <input readonly="readonly" class="shaded_fields disabled " value="<?php echo $lu->user->user_name;?>" size="100" type="text">
                        </td>
                        </tr>
                        </table>
                        <br/>

<?php

}

?>
                        <table width="100%">
                           <tr>
                              <td>
                                 <div class="main-label grey">Sex</div>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input name="sex" value="male" <?php if($lu->get_sex()=="male")echo 'checked';?> type="radio" align="center">Male
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                 <input name="sex" value="female" type="radio" <?php if($lu->get_sex()=="female")echo 'checked';?>>Female
                              </td>
                           </tr>
                        </table>
                        <br/>
                        <table width="100%" >
                           <tr>
                              <td colspan="3">
                                 <div class="main-label grey">Date Of Birth</div>
                              </td>
                           </tr>
                           <tr>
                              <td align='left'>
                                 <b>Day</b>
                                 <select name="day" class="shaded_fields">
                                    <option value="">........Day.......</option>
                                    <?php
                                       for($i=1;$i<=31;$i++)
                                       {
                                       
                                       echo "<option value='{$i}' ";
                                       if($lu->get_day()==$i)
                                       echo " selected >{$i}";
                                       
                                       else echo ">{$i}";
                                       }
                                       
                                       echo "</select>";
                                       
                                       ?>
                              </td>
                              <td>
                              <b>Month</b>
                              <select name="month" class="shaded_fields">
                              <option value="">...........Month...........
                              <option value="1" <?php if($lu->get_month()=="1")echo 'selected';?>>January</option>
                              <option value="2" <?php if($lu->get_month()=="2")echo 'selected';?>>February</option>
                              <option value="3" <?php if($lu->get_month()=="3")echo 'selected';?>>March</option>
                              <option value="4" <?php if($lu->get_month()=="4")echo 'selected';?>>April</option>
                              <option value="5" <?php if($lu->get_month()=="5")echo 'selected';?>>May</option>
                              <option value="6" <?php if($lu->get_month()=="6")echo 'selected';?>>Jun</option>
                              <option value="7" <?php if($lu->get_month()=="7")echo 'selected';?>>July</option>
                              <option value="8" <?php if($lu->get_month()=="8")echo 'selected';?>>Augest</option>
                              <option value="9" <?php if($lu->get_month()=="9")echo 'selected';?>>September</option>
                              <option value="10" <?php if($lu->get_month()=="10")echo 'selected';?>>October</option>
                              <option value="11" <?php if($lu->get_month()=="11")echo 'selected';?>>November</option>
                              <option value="12" <?php if($lu->get_month()=="12")echo 'selected';?>>December</option>
                              </select>
                              </td>
                              <td>
                                 <b>Year</b>
                                 <select name="year" class="shaded_fields">
                                    <option value="">
                                       .........Year..........
                                       <?php
                                          for($i=2011;$i>=1900;$i--)
                                          {
                                          
                                          echo "<option value='{$i}' ";
                                          if($lu->get_year()==$i)
                                          echo " selected >{$i}";
                                          
                                          else echo ">{$i}";
                                          
                                          }
                                          
                                          echo "</select>";
                                          ?>
                              </td>
                           </tr>
                        </table>
                        <br/>
                        <table width="100%" >
                        <tr>
                        <td>
                        <div>Email</div>
                        <input class="shaded_fields" name="email" value="<?php echo $lu->get_email();?>" size="100" type="text">
                        </td>
                        </tr>
                        </table>
                        <br/>
                        <table width="100%" >
                        <tr>
                        <td>
                        <div>New Password</div>  
                        <input class="shaded_fields" name="pass1" size="100" type="password">
                        </td></tr>
                        </table>
                        <br/>
                        <table width="100%" >
                        <tr>
                        <td>
                        <div>Confirm password</div>
                        <input class="shaded_fields" name="pass2" size="100" type="password">
                        </td></tr>
                        </table>
                        <br/>
                        <table width="100%" >
                        <tr><td>
                        <div>Country</div>
                        <select class="shaded_fields" name="country" >
                        <option value="">......................................................Country...........................................................................</option>
                        <?php
                           $arr=return_array("countries","country");
                           
                           for($i=0;$i<sizeof($arr);$i++)
                           {
                           
                           echo "<option value='{$arr[$i]}' ";
                           if($lu->get_country()==$arr[$i])
                           echo " selected >{$arr[$i]}";
                           
                           else echo ">{$arr[$i]}";
                           }
                           
                           
                           ?>
                        </select>
                        </td></tr>
                        </table><br/>
                        <table width="100%">
                           <tr>
                              <td>
                                 <div>City</div>
                                 <input class="shaded_fields" name="city" value="<?php echo $lu->get_city(); ?>" size="40" type="text">
                              </td>
                              <td>
                                 <div>State</div>
                                 <input class="shaded_fields" name="state" value="<?php echo $lu->get_state(); ?>" size="46" type="text">
                              </td>
                           </tr>
                           <tr>
                              <td colspan="2" align="center">
                                 <input id="button1" value="Update" onclick="check_data();" class="special_btn" type="submit" >
                              </td>
                           </tr>
                        </table>
                     </div>
                  </form>
               </center>
            </div>
            <div class="left" id="tabs-others">
               <div id="up-accordion" class="up-accordion">
                  <h3>Profile Pic</h3>
                  <div class="small up-acc-content">
                     <p>Can be featured on Landing page/Recent Users
                        <input value="true" name="pp_conf[pp_featured_on_landing_page]" type="radio" <?php if($lu->user->pp_featured_on_landing_page) echo "checked" ?>/>Yes 
                        <input value="false" name="pp_conf[pp_featured_on_landing_page]" type="radio" <?php if(!$lu->user->pp_featured_on_landing_page) echo "checked" ?>/>No
                     </p>
                     <p>Can be featured on Top Users
                        <input value="true" name="pp_conf[pp_featured_on_top_users]" type="radio" <?php if($lu->user->pp_featured_on_top_users) echo "checked" ?>/>Yes 
                        <input value="false" name="pp_conf[pp_featured_on_top_users]" type="radio" <?php if(!$lu->user->pp_featured_on_top_users) echo "checked" ?>/>No
                     </p>
                     <p>Can be featured on Recent Online
                        <input value="true" name="pp_conf[pp_featured_on_recent_users]" type="radio" <?php if($lu->user->pp_featured_on_recent_users) echo "checked" ?>/>Yes 
                        <input value="false" name="pp_conf[pp_featured_on_recent_users]" type="radio" <?php if(!$lu->user->pp_featured_on_recent_users) echo "checked" ?>/>No
                     </p>
                     <p><input type="button" class="special_btn pp_save_settings" value="Save"/></p>
                  </div>
                  <h3>Notifications</h3>
                  <div class="small up-acc-content">
                     <p>Receive notification via email
                        <input value="true" name="pp_conf[e_mail_notification]" type="radio" <?php if($lu->user->e_mail_notification) echo "checked" ?>/>Yes 
                        <input value="false" name="pp_conf[e_mail_notification]" type="radio" <?php if(!$lu->user->e_mail_notification) echo "checked" ?>/>No
                     </p>
                     <p>Receive Messages via email
                        <input value="true" name="pp_conf[message_notification]" type="radio" <?php if($lu->user->message_notification) echo "checked" ?>/>Yes 
                        <input value="false" name="pp_conf[message_notification]" type="radio" <?php if(!$lu->user->message_notification) echo "checked" ?>/>No
                     </p>
                     <p><input type="button" class="special_btn pp_save_settings" value="Save"/></p>
                  </div>
                  <h3>Privacy</h3>
                  <div class="small up-acc-content">
                     <p>Email should be visible to 
                        <input value="public" name="pp_conf[email_visibility]" type="radio" <?php if($lu->user->email_visibility=="public") echo "checked"; ?>/>Everyone 
                        <input value="private" name="pp_conf[email_visibility]" type="radio" <?php if($lu->user->email_visibility=="private") echo "checked"; ?>/>No one
                        <input value="relations" name="pp_conf[email_visibility]" type="radio" <?php if($lu->user->email_visibility=="relations") echo "checked"; ?>/>Relations
                     </p>
                     <p><input type="button" class="special_btn pp_save_settings" value="Save"/></p>
                  </div>
                  <h3>Others</h3>
                  <div class="small up-acc-content">
                     <p>Who can message you
                        <input value="public" name="pp_conf[messages_from]" type="radio" <?php if($lu->user->messages_from=="public") echo "checked"; ?>/>Everyone 
                        <input value="private" name="pp_conf[messages_from]" type="radio" <?php if($lu->user->messages_from=="private") echo "checked"; ?>/>No one
                        <input value="relations" name="pp_conf[messages_from]" type="radio" <?php if($lu->user->messages_from=="relations") echo "checked"; ?>/>Relations
                     </p>
                     <p>Accept invitations 
                        <input value="true" name="pp_conf[accept_invitations]" type="radio" <?php if($lu->user->accept_invitations) echo "checked"; ?>/>Yes 
                        <input value="false" name="pp_conf[accept_invitations]" type="radio" <?php if(!$lu->user->accept_invitations) echo "checked"; ?>/>No
                     </p>
                     <p>Allow people to find you through search 
                        <input value="true" name="pp_conf[to_be_found_on_search]" type="radio" <?php if($lu->user->to_be_found_on_search) echo "checked"; ?>/>Yes 
                        <input value="false" name="pp_conf[to_be_found_on_search]" type="radio" <?php if(!$lu->user->to_be_found_on_search) echo "checked"; ?>/>No
                     </p>
                     <p><input type="button" class="special_btn pp_save_settings" value="Save"/></p>
                  </div>
                  <h3>Account</h3>
                  <div class="small up-acc-content">
                     <p><button class="special_btn redback del-account-btn">Delete Account</button></p>
                  </div>
               </div>
            </div>
<?php
if(empty($lu->user->user_name)){

?>
<div id="tabs-username">

<p class="grey un-hide-on-success">Choose an unique user name. You will have an easy to remember URL to your Frendsdom profile.</p>


<div>
<p><input type="text" id="user-name-field" class="shaded_fields"/></p>



<p class="un-choose-btn-container"><button class="special_btn " id="un-choose-btn">Done</button></p>
</div>

<ul style="margin-top:30px" class="small un-hide-on-success centered half-width grey info-box">
<li>Must be alphanumeric</li>
<li>Maximum 50 characters</li>
<li>Once you choose, it can't be changed later</li>

</ul>


</div>


<?php

}
?>

         </div>

      </div>
      <?php pop_up_msg($_SESSION['userid']);?>
      <div id="progress" class='hidden'>
      <div>
   </body>
</html>