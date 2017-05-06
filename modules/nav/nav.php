<?php

/*

This class is used to put different kind of navigation bars
This class relies on FunctionList.php which must already be included

*/

class nav{

private $lu=false;

//method to get instance of logged in user
function get_lu($lu=false){

if(!$this->lu || !$lu){

$this->lu=new user(uid());

}

return $this->lu;

}


function get_logo_element($logo_link_enabled=false){

$logo_id=!$logo_link_enabled?" id ='hp-top-logo'":"";

$logo_img='<img '.$logo_id.' class="pointer top-bar-logo" src="'. get_image('frendsdom.gif').'"/>';

return !$logo_link_enabled?$logo_img:"<a href='".SITE_URL."'>".$logo_img."</a>";

}


function fixed_nav($tabs_set,$logo_link_enabled=false){

//if user is found to be logged in, put the Point box

if(is_logged_in()){
echo $this->get_point_box();
}

?>

<div class="strip clickeffect home-nav-bar"> <?php echo $this->get_logo_element($logo_link_enabled); ?>
    <div class="mainbar">
<?php echo $tabs_set; ?>
    </div>
    <ul>
   	
<?php 

if(is_logged_in())
$this->get_user_menu();

 ?>
       
      <li>
        <form method="post" action="search.php">
          <input type="text" id="search_field" class="home-bar-search" name="query" title='Search a user by name,email,location' class='poshsytip-1' placeholder="Search user">
        </form>
      </li>
    </ul>
  </div>
  <div class="clearboth"></div>


<?php
}


function get_user_menu(){

//get logged in user
$user=$this->get_lu();

?>
<ul class="menu_profile">
       
<li class="unhide">
<img src="<?php echo prof_pic(uid()) ?>" class="prof_pic pointer" />
<img class="uo-down-tip" src="<?php echo get_image("down_arrow.png");?>"/>
</li>

<li class="uo-dropdown none">

<div><a href="<?php echo !empty($user->user->user_name)?profile_url_with_username($user->user->user_name):get_profile_url(uid());?>" class="small">&nbsp;<img src="profile.gif">My Profile</a></div>

<div><a href="msgbox.php">&nbsp;<img src="msgbox.gif" width="20" height="20">Inbox</a></div>
<div><a class="trigger-click" id-to-click="trigger-cats-popup" href="<?php echo $this->home_url("trigger_cats"); ?>">&nbsp;<img src="<?php echo get_image("categories.gif"); ?>" width="20" height="20">My Categories</a></div>
<div><a class="trigger-click" id-to-click="trigger-hobbies" href="<?php echo $this->home_url("trigger_hobbies"); ?>">&nbsp;<img src="<?php echo get_image("hobbies.png"); ?>" width="20" height="20">My Hobbies</a></div>
<div><a href="collection.php">&nbsp;<img src="collection.gif" width="20" height="20">Picture Collections</a></div>
<div><a href="discover.php">&nbsp;<img src="<?php echo get_image("chat.png"); ?>" width="20" height="20">View recent posts</a></div>
<div><a href="users.php">&nbsp;<img src="<?php echo get_image("people_1.png"); ?>" width="20" height="20">Top/recent users</a></div>
<div><a href=update.php>&nbsp;<img src="update.gif" width="20" height="20">Profile & Account Settings</a></div>
<div><a href=friends3.php>&nbsp;<img src="1.gif" width="20" height="20">Log out</a></div>

</li>



</ul>

<?php
}


/**
*method to return link to home page else the class
* that makes the element of certain id click
*/

function home_url($noty_action){

return SITE_URL."/home.php?noty_action=".$noty_action;

}

//method to get Point box

function get_point_box(){

//get logged-in user
$lu=$this->get_lu();

return "<style type='text/css'>.points_count{background:".$lu->get_strip_color()."}</style><div class='points_count show_expand_rel' style='position:fixed;top:-14px;z-index:101;height:74px;padding-top:22px;'><span id='points_digit' class='points_digit'>+".$lu->get_points()."</span>
    <div class='spend_it underline_onHover'>Spend it</div>
  </div>";

}


/*method to get special navigation bar for the given user*/

function get_nav_1($lu){

$this->fixed_nav($this->get_tabs_set_1($lu));

}

//for navigation bar on "Recently Online" page

function get_nav_2(){

$this->fixed_nav($this->get_tabs_set_2(),true);

}

//for navigation bar on profile page

function get_nav_3(){

$this->fixed_nav($this->get_tabs_set_3(),true);

}

function get_tabs_set_1($lu){

$lu=$this->get_lu($lu);

return '<div title="Go to Home" page-view="pic_view" callback="check_left_panel" relates-to="lu_pic_wrapper lu_info_container" id="main_view_vc_left" class="hp-main-view-btns pointer fl '.($lu->get_home_main_view()==PIC_VIEW ? "main_view_vc_left_active":"").'"><span class="adjust-hpmt">Home</span></div>
      <div title="See updates in your network" page-view="status_view" callback="check_left_panel" relates-to="status_view_wrapper" id="main_view_vc_right" class="hp-main-view-btns pointer fl '.($lu->get_home_main_view()==STATUS_VIEW ? "main_view_vc_right_active":"").'" ><span class="adjust-hpmt">World</span></div>
      <div title="Earn some points" page-view="mp_view" callback="mp_ini" relates-to="hp-mp-wrapper" id="main_view_vc_mp" class="hp-main-view-btns pointer fl '.($lu->get_home_main_view()==MP_VIEW? "main_view_vc_mp_active":"").'"><span>Earn Points</span></div>';
    
}

function get_tabs_set_2(){

return '<div title="See recent users" page-view="none" callback="check_blue_hover" relates-to="recent-users" id="users-recent-users" class="blue-hover hp-main-view-btns pointer fl center active"><span>Recent Users</span></div>
      	<div title="See top users" page-view="none" callback="check_blue_hover" relates-to="top-users" id="users-top-users" class="blue-hover hp-main-view-btns pointer fl center" ><span>Top Users</span></div>
	<div title="Users who were recently online" page-view="none" callback="check_blue_hover" relates-to="online-users" id="users-online-users" class="blue-hover hp-main-view-btns pointer fl center" ><span>Recently Online</span></div>';


}

function get_tabs_set_3(){

return '<div class="blue-hover click-anchor pointer fl center"><a href="home_view.php?view='.PIC_VIEW.'">Home</a></div>
      	<div class="blue-hover click-anchor pointer fl center" ><a href="home_view.php?view='.STATUS_VIEW.'">World</a></div>
	<div class="blue-hover click-anchor pointer fl center" ><a href="home_view.php?view='.MP_VIEW.'">Earn Points</a></div>';

}


}
?>