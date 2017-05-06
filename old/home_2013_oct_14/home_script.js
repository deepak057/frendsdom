var no_pic="nopic.png",p_start=15,p_end=15,timer;jQuery(document).ready(function(){$("*[title]").monnaTip();cluetip_ini();
attach_hovercard();
$(".flexible_textarea").live("focus",function(){$(this).flexible()});$("#switcher").themeswitcher({loadTheme:"Smoothness"});$("#search_field").combogrid({url:"search_autocomplete.php",debug:true,sidx:"id",sord:"asc",rows:10,addClass:"combogrid_class",alternate:true,draggable:true,rememberDrag:true,colModel:[{columnName:"name",align:"left",width:"25",label:"Name"},{columnName:"country",width:"25",label:"Country"},{columnName:"state",width:"25",label:"State"},{columnName:"city",width:"25",label:"City"}],select:function(a,b){document.location.href=b.item.link;return false}});jQuery("#mycarousel").jcarousel({vertical:true,itemLoadCallback:mycarousel_itemLoadCallback,scroll:1,easing:"BounceEaseOut",animation:1000,wrap:"both",itemFirstInCallback:{onAfterAnimation:function(b,a,d,e){ecp_selected(a)}}})});function ecp_selected(a){$(".garbage_div").each(function(){$(this).parent().remove()});if(a.firstChild.src){allocate_border_grey();a.style.border="2px solid "+lu_stripColor;a.style.borderRadius="7px";load_ecp(a.firstChild.src.split("=")[1]);w.postMessage("select_ecp pic_id="+a.firstChild.src.split("=")[1]);w.onmessage=function(b){if(parseInt(b.data)!=1){alert("Error: failed to set your eyecandy picture")}}}}function mycarousel_itemLoadCallback(b,a){if(b.has(b.first,b.last)){return}jQuery.get("get_ecp_list.php",{first:b.first-1,last:b.last+2},function(c){mycarousel_itemAddCallback(b,b.first,b.last,c)},"xml")}function mycarousel_itemAddCallback(a,b,d,c){a.size(parseInt(jQuery("total",c).text()));jQuery("image",c).each(function(e){if(jQuery(this).text().split("=")[1]){a.add(b+e,mycarousel_getItemHTML(jQuery(this).text()))}else{a.add(b+e,'<div class="garbage_div"></div>')}})}function mycarousel_getItemHTML(a){pic_id=a.split("=")[1];return'<img src="'+a+'" width="75" height="75" class="carousel_item_image" alt="image" />'+append_remove_btn(pic_id)}jQuery(document).ready(function(){jQuery("#mycarousel").jcarousel({itemLoadCallback:mycarousel_itemLoadCallback})});function allocate_border_grey(){$(".carousel_item_image").each(function(){$(this).parent().css("border","2px solid #000")})}$(".carousel_item_image").live("click",function(){ecp_selected($(this).parent()[0])});function d_block(a){el(a).style.display="block"}function d_in(a){el(a).style.display="inline"}function d_none(a){el(a).style.display="none"}$(".carousel_item_image").live("mouseenter",function(){var a=$(this).attr("src").split("=")[1];d_block(a)}).live("mouseout",function(){var a=$(this).attr("src").split("=")[1];timer=setTimeout(function(){d_none(a)},1500)});$(".remove_ecp").live("click",function(){var b=$(this).attr("id");apprise("Proceed to removing this picture?",{verify:true},function(a){if(a){if(el("current_ecp").src.indexOf(no_pic)==-1){if(el("current_ecp").src.split("?")[1].split("&")[0].split("=")[1]==b){el("current_ecp").src=no_pic}}$("#"+b).parent().remove();w.postMessage("remove_ecp pic_id="+b);w.onmessage=function(c){if(parseInt(c.data)!=1){alert("Error: failed to delete eyecandy picture")}}}})});$("#vc_right").live("click",function(){$("#scroller_contanier").animate({width:"hide"},function(){v=0;set_scroller_visibility("0")});$(this).css("display","none");$("#vc_left").css("display","inline")});$("#vc_left").live("click",function(){$("#scroller_contanier").animate({width:"show"},function(){v=1;set_scroller_visibility("1")});$(this).css("display","none");$("#vc_right").css("display","inline")});function set_scroller_visibility(a){w.postMessage("update_boolean entity=ecp_scroller_enabled&value="+a);w.onmessage=function(b){if(parseInt(b.data)!=1){alert("Error: failed to update scroller visibility status");return false}else{return true}}}$("#add_ecp_btn").live("click",function(){$("#add_ecp_wrapper").css("display","block");$("#add_ecp_wrapper").slideDown("slow")});$("#ecp_url_btn").live("click",function(){hide_ecp_w();el("body").style.opacity=".2";el("uploading").innerHTML="<img src='picon1.gif' alt='loading'/>Setting your eyecandy picture";show("uploading");w.postMessage("set_eyecandy pic_url="+encodeURIComponent(trim(el("ecp_url").value))+"&vuid="+luid);w.onmessage=function(a){hide("uploading");if(a.data.indexOf("failed")!=-1){response_msg("Error: failed to set your eyecandy picture","red")}else{response_msg("Eyecandy picture successfully set");append_item(a.data);load_ecp(a.data)}}});function append_item(a){for(var c=0;c<el("mycarousel").childNodes.length;c++){if(el("mycarousel").childNodes[c].nodeName=="LI"){if(el("mycarousel").childNodes[c].firstChild.nodeName!="IMG"){var b=document.createElement("li");b.innerHTML="<img width='75' height='75' class='carousel_item_image' alt='image' src='get_ecp.php?pic_id="+a+"'/>"+append_remove_btn(a);el("mycarousel").childNodes[c].appendChild(b);break}}}}function append_remove_btn(a){return"<div id='"+a+"' title='Remove this picture' class='remove_ecp'><span>&#215;</span></div>"}function load_ecp(a){el("current_ecp").src="get_ecp.php?pic_id="+a+"&size=big";if(!el("current_ecp").complete){$("#current_ecp").hide();el("load_ecp").style.display="inline";$("#load_ecp").show();$("#current_ecp").load(function(){$("#load_ecp").hide();$("#current_ecp").show()})}}function hide_ecp_w(){$("#add_ecp_wrapper").hide("slow",function(){$(this).css("display","none")})}function ecp_upload(){if(!validpic(el("ecp_file").value)){alert("Please choose a valid image file");return false}hide_ecp_w();el("body").style.opacity=".2";show("uploading");el("uploading").innerHTML="<img src='picon1.gif'/>&nbsp;Uploading your picture.......";return true}function stop_ecp_Upload(a){hide("uploading");if(a.indexOf("failed")!=-1){response_msg("Error: failed to upload your picture","red")}else{response_msg("Picture successfully uploaded");append_item(a);load_ecp(a)}}$("#prof_url_btn").live("click",function(){el("uploading").innerHTML="<img src='picon1.gif' alt='loading'/>&nbsp;Setting your profile picture.....";show("uploading");el("body").style.opacity=".2";w.postMessage("set_prof_pic pic_url="+trim(el("prof_pic_url").value));w.onmessage=function(a){hide("uploading");if(a.data.indexOf("failed")!=-1){response_msg("Error: failed to set your profile picture","red")}else{response_msg("Profile picture successfully set");el("tab-1").checked=true;el("lu_prof_pic").src=a.data+"?"+new Date().getTime()}}});$("#lu_prof_pic").live("mouseenter",function(){if($(this).attr("src").indexOf(no_pic)==-1){$("#remove_lu_pic").css("display","block")}}).live("mouseout",function(){$("#remove_lu_pic").css("display","none")});$("#remove_lu_pic").live("mouseenter",function(){$(this).css("display","block")}).live("click",function(){if(confirm("Proceed to deleting your profile picture?")){el("body").style.opacity=".2";el("uploading").innerHTML="<img src='picon1.gif' alt='removing..' />Deleting your profile picture......";show("uploading");w.postMessage("remove_lu_pic ");w.onmessage=function(a){hide("uploading");if(parseInt(a.data)!=1){response_msg("Error: failed to delete your profile picture","red")}else{response_msg("Profile picture successfully deleted");el("lu_prof_pic").src=no_pic}}}});$(".tab_lable").live("click",function(){if(v){if($(this).attr("id")=="ecp_lable"){$("#scroller_contanier").css("display","block")}else{$("#scroller_contanier").css("display","none")}}switch($(this).attr("id")){case"ecp_lable":var a="ecp";break;case"upload_pic_lable":var a="upload_pic";break;default:var a="prof_pic";break}w.postMessage("update_entity entity=home_pic_view&value="+a);w.onmessage=function(b){if(parseInt(b.data)!=1){alert("Error: failed to set home picture view")}}});jQuery.easing.BounceEaseOut=function(f,e,a,h,g){if((e/=g)<(1/2.75)){return h*(7.5625*e*e)+a}else{if(e<(2/2.75)){return h*(7.5625*(e-=(1.5/2.75))*e+0.75)+a}else{if(e<(2.5/2.75)){return h*(7.5625*(e-=(2.25/2.75))*e+0.9375)+a}else{return h*(7.5625*(e-=(2.625/2.75))*e+0.984375)+a}}}};function get_now_ts(){return Math.round(+new Date()/1000)}var fr_l=fam_l=col_l=aqu_l=no_l=get_now_ts();function get_cor_var(d,c){switch(d){case"f":if(c){fr_l=get_now_ts()}else{return fr_l}break;case"fam":if(c){fam_l=get_now_ts()}else{return fam_l}break;case"col1":if(c){col_l=get_now_ts()}else{return col_l}break;case"aqu1":if(c){aqu_l=get_now_ts()}else{return aqu_l}break;case"no1":if(c){no_l=get_now_ts()}else{return no_l}break}}function refresh_rel_list(b){if(Math.round((get_now_ts()-get_cor_var(b))/60)>=2){return true}else{return false}}function get_list(i){var l=new Array("friend","family","col","aq","no");var g=new Array("f","fam","col1","aqu1","no1");var h=new Array("fimg","faimg","colimg","aqimg","noimg");for(var j=0;j<g.length;j++){if(g[j]==i.split("_")[1]){show(g[j]);$("#"+g[j]).animate({width:"show"});el(h[j]).src="left.png";el(i).setAttribute("onclick","hide_list('"+i+"','"+g[j]+"','"+h[j]+"')");if(refresh_rel_list(g[j])){el(g[j]+"_ul").innerHTML="<img src='picon1.gif'/>&nbsp;Refreshing....";var k=g[j]+"_ul";w.postMessage("get_status_list l="+g[j]);w.onmessage=function(a){el(k).innerHTML=a.data};get_cor_var(g[j],true)}}else{$("#"+g[j]).animate({width:"hide"});el(h[j]).src="right.png";el(l[j]+"_"+g[j]).setAttribute("onclick","get_list('"+l[j]+"_"+g[j]+"')")}}}function hide_list(f,e,d){$("#"+e).animate({width:"hide"});el(d).src="right.png";el(f).setAttribute("onclick","get_list('"+f+"')")};

function hp_nc(){
var els=new Array("total_news","total_req","total_atr_req","unviewed_nudges","total_msgs");
$.each(els, function(index, value) {
if(parseInt($("#"+value).html())>0){
if($("#"+value).parents(".nc_container:first").html().indexOf("(")!=-1){
$("#"+value).parents(".nc_container:first").html("<span id='"+value+"'>"+$("#"+value).html()+"</span>");
}
$("#"+value).addClass("hp_nc");
}
else{
$("#"+value).parents(".nc_container:first").html("(<span id='"+value+"'>0</span>)");
}
});
}
setInterval(hp_nc,1000);
function put_wait_msg(text)
{
el('body').style.opacity=".2";
el('uploading').innerHTML=text;
show('uploading');
}

function save_pv_conf()
{
hide_apprise();
var f=document.forms['post_conf_form'],public="n",pv_rel='';
if(f.cb_pv_public.checked)
{
public="y";
}
for(var i = 0; i < f.cb_pv.length; i++){
if(f.cb_pv[i].checked)
{
if(i!=(f.cb_pv.length-1))
pv_rel+=f.cb_pv[i].value+",";
else
pv_rel+=f.cb_pv[i].value;
}
}
remove_apprise();
put_wait_msg("<img src='picon1.gif'/>Updating visibility of this post....");
w.postMessage("update_pv_conf pv_public="+public+"&pv_rel="+pv_rel+"&p_id="+p_block_id);
w.onmessage=function(e){
hide('uploading');
if(parseInt(e.data)==1){response_msg("Visibility successfully updated");}
else{response_msg("Error: failed to update post visibility","red");}
};
}


$(".pv_edit").live("click",function(){
var id=$(this).parents('.hp_post_container:first').attr('id');p_block_id=id;
apprise("<div class='pv_wrapper'><h3><img src='images/post_visibility.png' align='middle'/>Edit post visibility configuration</h3><div align='left' id='epvc_div'>"+loading+"</div></div> ",{"confirm":true,"textOk": "Update","takeControl":"save_pv_conf"});
w.postMessage("get_pv p_id="+id);
w.onmessage=function(e){
el('epvc_div').innerHTML=e.data;
};

});

$(".edit_post").live("click",function(){
var id=$(this).parents('.hp_post_container:first').attr('id');
$("#pc_"+id).editable('update_post.php', { 
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'Update',
         indicator : '<img src="picon1.gif">Saving....',
cssclass : "post_edit_textarea",
cols:50 ,data: function(value, settings) {
           var retval = value.replace(/<br[\s\/]?>/gi, '\n');
      return retval;
    }	 
});
$("#pc_"+id).click();
});


$(".hp_post_container").live("mouseenter",function(){
$(this).find(".post_options").css("display","block");
}).live("mouseleave",function(){
$(this).find(".post_options").css("display","none");
});


$(".del_post").live("click",function(){
var id=$(this).parents('.hp_post_container:first').attr('id');
apprise("proceed to removing this post?",{"confirm":true},function(r){
if(r)
{
put_wait_msg("<img src='picon1.gif'/>Deleting your post.....");
w.postMessage("del_post p_id="+id);
w.onmessage=function(e){
hide('uploading');
if(parseInt(e.data)==1)
{

$("#"+id).slideUp("slow",function(){$("#"+id).remove();
if(el("display_post_div")){$("#display_post_div").remove();}

});
response_msg("Post successfully removed");

}
else
{
response_msg("Error: Failed to delete post","red");
}
};
}
});
});
/*$('.chatboxcontent').live("mouseenter",function(){$(this).niceScroll({cursorcolor:lu_stripColor});});*/
$(".flexible_textarea").live("focus",function(){$(this).flexible()});
$(".hp-main-view-btns").live("click",function(){
$('html, body').animate({scrollTop:0}, 'slow');
hp_views_RAC();
$(this).addClass($(this).attr("id")+"_active");
sh_me($(this).attr("relates-to"),"show")
set_main_page_view($(this).attr("page-view"));
if($(this).attr("callback")!=undefined)
window[$(this).attr("callback")]();
});
function mp_ini(){
if($("#lp_ads").css("display")=="none")
$("#lp-slider").click();
check_left_panel();
}
function check_left_panel(){

var original_id="lp-slider",
    temp_id=original_id+"-temp";

if($(".hp-mp-wrapper").css("display")!="none")
{
$("#"+original_id).attr('onclick',null);
}

else{
$("#"+original_id).attr('onclick','enable_left_panel()');

}

}


function hp_views_RAC(){
$(".hp-main-view-btns").each(function(){
var active_class=$(this).attr("id")+"_active";
if($(this).attr("class").indexOf(active_class)!=-1){
$(this).removeClass(active_class);
sh_me($(this).attr("relates-to"),"hide");
}
});


}

function sh_me(str,action){
var arr=str.split(" ");
for(var i=0;i<arr.length;i++){
if(action=="hide")
$("."+arr[i]).hide();
else 
$("."+arr[i]).animate({width:"show"});
}
}
function mp_createCookie(name, value) {
   var date = new Date();
   date.setTime(date.getTime()+(30*1000));
   var expires = "; expires="+date.toGMTString();

   document.cookie = name+"="+value+expires+"; path=/";
}

function mp_cookie(action){
var cookie="mp_playing";
if(action=="create"){
mp_createCookie(cookie,true);
}
else{
del_cookie(cookie);
}
}


$(".mp-start-btn img").live("click",function(){
$(".hp-mp-des").slideUp("slow",function(){
$(".hp-mp-content").slideDown("slow",function(){

   var 	elm_top="#hp-mp-top",
	elm_bottom="#hp-mp-bottom",
	p=$(elm_top).offset(),
	 counter='#mp-scounter',
	sec = mp_conf['time_limit'];

mp_cookie("create");

$(elm_bottom).css({"position":"absolute","top":(p.top+200)+"px"}).show();

$(".hp-mp-pic").draggable({ revert: function (v){

if(!v){
mp_conf['mp_wrong_drops']++;
if(mp_conf['mp_wrong_drops']==mp_conf['failed_attempts']){
mp_conf['mp_wrong_drops']=0;
mp_animate_callback($(this),"deduce");
}
}
return !v;
}
});
set_droppables();
mp_conf['timer'] = setInterval(function() { 
   $(counter).text(sec--);
   if (sec == -1) {
      	mp_clear_timer();	
   } 
}, 1000);
});
});
});


function mp_clear_timer(){
$('#mp-scounter').html("0");
$(".hp-mp-pic").draggable("destroy");
clearInterval(mp_conf['timer']);
enable_profile_visit();	
}

function enable_profile_visit(){
$(".mp-user-key-pic").each(function(){
var p=$(this).offset(),key=$(this).attr('key'),width=$(this).width(),par=$(this).parent(),
left=par.attr("class").indexOf("hp-mp-pic")!=-1?"left:0px":"";
par.append("<div style='height:0;width:0;'><div key='"+key+"' style='width:"+width+"px;"+left+"' class='hp-mp-vp pointer'><a href='enable_visit.php?k="+key+"'>Visit profile</a></div></div>");
});
mp_cookie("delete");
}
function set_droppables(){
$(".hp-mp-target").each(function(){
var acceptable="#"+$(this).attr('id').split("-")[0];
$(this).droppable({
accept:acceptable,
drop: function( event, ui ) {
ui.draggable.hide();
$(this).html(ui.draggable.html());
mp_animate_callback($(this),"add");
mp_conf['points_made']++;
}});
});
}
function mp_animate_callback(elm,action){
var p=elm.offset(),
top=p.top,
left=p.left,
increment_by=100,
left_to=left-increment_by,
sign="+",class_="green",
top_to=points=0;

if(action=="add"){
top_to=top-increment_by;
points=mp_conf['points_to_add'];
}
else{
top_to=top+increment_by;
points=mp_conf['points_to_deduce'];
sign="-";class_="red";
}
$(body).append("<div class='mp-point-count "+class_+"' style='top:"+top+"px;left:"+left+"px;'>"+sign+points+"</div>");
$(".mp-point-count").animate({
top:top_to+"px",
left:left_to+"px",
opacity:0
},1500,function(){
$(".mp-point-count").remove();
update_points(points,action,true);
if(mp_conf['points_made']==mp_conf['max_points']){
var t=$("#hp-mp-bottom").offset().top-300;
$("#hp-mp-bottom").animate({top:t+"px"},500);
mp_clear_timer();
}
});
}

/*
$("#main_view_vc_right").live("click",function(){
$("#lu_info_container").hide("fast",function(){
$("#lu_pic_wrapper").hide("slow",function(){
d_block("status_view_wrapper");
$("#status_view_wrapper").hide();
$("#status_view_wrapper").animate({width:"show"},function(){
$("#main_view_vc_right").addClass("main_view_vc_right_active");
$("#main_view_vc_left").removeClass("main_view_vc_left_active");
set_main_page_view("status_view");
});
});
});
});
$("#main_view_vc_left").live("click",function(){
$('html, body').animate({scrollTop:0}, 'slow',function(){
$("#status_view_wrapper").animate({width:"hide"},function(){
d_none("status_view_wrapper");
$("#lu_info_container").show("fast",function(){
$("#lu_pic_wrapper").show("slow",function(){
$("#main_view_vc_left").addClass("main_view_vc_left_active");
$("#main_view_vc_right").removeClass("main_view_vc_right_active");
set_main_page_view("pic_view");
});
});
});
});
});

*/

function set_main_page_view(view)
{
w.postMessage("update_entity entity=home_main_view&value="+view);
w.onmessage=function(e){
if(parseInt(e.data)!=1)alert("Error: failed to set home page's main view");
};
}
function enable_TE()
{
$('#status_textarea').removeClass('status_textarea');

$('#status_textarea').rte({
                css: ['default.css'],width:600,height:100,
                controls_rte: rte_toolbar,
                controls_html: html_toolbar
});

el("enable_status_TE").innerHTML="<img src='crossmark.gif' height='10' width='10' />&nbsp;Disable text editor";
el("enable_status_TE").onclick=function(){disable_TE()};

}
function post_status()
{
hide_apprise();

el('body').style.opacity=".2";
el("uploading").innerHTML="<img src='picon1.gif'/>Setting your post.....";
show('uploading');
var f=document.forms['post_conf_form'],public="n",pv_rel='',pv_excluded='',save_pv_conf="n";
if(f.cb_pv_public.checked)
{
public="y";
}
for(var i = 0; i < f.cb_pv.length; i++){
if(f.cb_pv[i].checked)
{
if(i!=(f.cb_pv.length-1))
pv_rel+=f.cb_pv[i].value+",";
else
pv_rel+=f.cb_pv[i].value;
}
}
pv_excluded=excluded_ids.join(",");

if(f.save_pv_conf.checked)
{
save_pv_conf="y";
}

w.postMessage("set_post public="+public+"&save_pv_conf="+save_pv_conf+"&pv_rel="+encodeURIComponent(pv_rel)+"&pv_excluded="+encodeURIComponent(pv_excluded)+"&post_content="+encodeURIComponent(get_post_content())+"&post_pic_id="+post_pic_id+"&post_news_id="+post_news_id+"&post_movie_id="+post_movie_id+"&post_video_id="+post_video_id);
w.onmessage=function(e){
hide('uploading');
if(e.data.indexOf("failed")==-1)
{

//checking if this post contains picture
if(post_pic_id){
var post_img_content="<img src='get_post_pic.php?pic_id="+post_pic_id+"'/>";
}
else{
var post_img_content='';
}

//checking if this post contains news
if(post_news_id){
var elm=get_attachment_news();
var post_news_content="<div class='"+elm.attr('class')+"'>"+elm.html()+"</div>";
}
else{
var post_news_content='';
}

//checking if this post contains a movie
if(post_movie_id){
var elm=get_attachment_movie();
var post_movie_content="<div class='"+elm.attr('class')+"'>"+elm.html()+"</div>";
}
else{
var post_movie_content='';
}

//checking if this post contains a video
if(post_video_id){
var elm=get_attachment_video();
var post_video_content="<div class='"+elm.attr('class')+"'>"+elm.html()+"</div>";
}
else{
var post_video_content='';
}

//putting post text into web page

el('body').style.opacity="1";
$("<div id='"+e.data+"' class='hp_post_container'><div><div class='fl'><span onclick='post_get_clist(this);' title='Change the background color of post blocks' class='pointer red_onhover post_get_clist'>&#916;</span><div class='colorlist'></div><div class='clear'></div></div><div class='fr'><div class='post_options none'><img class='pv_edit' src='images/post_visibility.png' width='15'>|<img class='edit_post' src='images/red_pencil_icon.png' width='15'>|<img class='del_post' src='images/crossmark.gif' width='15'></div></div><div class='clear'></div></div><div><div class='fl post_user_pic'><span><a href='visit.php?id="+luid+"'><b>"+lu_name+"</b></a></span><br/><img class='post_owner_pic' src='"+el('lu_prof_pic').src+"'/><br/></div><div class='fr post_content'><div id='pc_"+e.data+"' class='post_content_text'>"+autolink(htmlEntities(trim(get_post_content())).replace(/\n/g,'<br />'))+"</div>"+post_news_content+post_movie_content+post_video_content+"<div class='post_content_img'>"+post_img_content+"</div></div><div class='clear'></div></div><div class='p_block_bottom'><div class='p_fback_oc'></div><div class='post_features_div'><span class='light_text' title='"+current_date()+"'>Just now</span> | <span class='fback_tp pointer'>No feedback from you</span>| <a class='pbar4posts_anchor' href='percentagebar4posts.php?p_id="+e.data+"' target='fback_statistic'>Feedback</a> from <span class='underline_onHover pointer fback_fromothers'>0 others</span> | <span class='pointer underline_onHover comnts_to_posts'><span class='post_cmnt_count_main'>0</span> comments</span></div></div><div class='cmnts_to_post_container none'></div></div>").insertAfter("#status_container");
$("#"+e.data).hide();
$("#"+e.data).slideDown("slow");
//$("#"+e.data).find(".post_content").niceScroll({cursorcolor:"grey"});
remove_post_pic();
remove_api_news();
remove_api_movie();
remove_api_video();
vacate_post_textarea(); 
$(".hp_post_container").each(function(){
if($(this).find('.colorlist').attr("class").indexOf("post_cl_visible")!=-1)
{
$(this).find('.colorlist').prev().click();
}
});
hide_fback_popups();				
}
else
{
response_msg("Error: failed to set your post","red");
}
};
remove_apprise();
}

function vacate_post_textarea()
{
el("status_textarea").value='';
}

function hide_fback_popups(){
$(".hp_post_container").each(function(){
if($(this).find('.p_fback_oc').attr("class").indexOf("fboc_visible")!=-1)
close_pfoc($(this).find('.p_fback_oc').attr("id"));
});
}
function add_attachment(text){
$("#post-attachments").append(text);
}

function remove_attachment(el){
$("#post-attachments").find("."+el).remove();
}

function post_get_clist(el)
{
$(el).html("&#x2207;");
var p=$(el).position();
$(el).next().css("top",p.top+"px");
$(el).next().css("left",(p.left-140)+"px");
$(el).next().addClass("post_cl_visible");
if(!$(el).next().html())
{
$(el).next().html(loading);
$(el).next().css("background","#fff");
w.postMessage("get_postblock_clist id="+luid);
w.onmessage=function(e){
$(el).next().css("background","none");
$(el).next().html(e.data);
$(el).next().hide();
$(el).next().slideDown("slow");
};
}

else
{
$(el).next().slideDown("slow");
}
el.onclick=function(){post_hide_clist(el);};
}


function post_hide_clist(el)
{
$(el).html("&#916;");
$(el).next().slideUp("slow");
$(el).next().removeClass("post_cl_visible");
el.onclick=function(){post_get_clist(el);};
}

function update_pbb_value(el,cv)
{
el.onmouseout=function(){changecss(1,'.hp_post_container','background',cv);};
$(el).parent().prev().click();
w.postMessage("update_entity entity=post_block_back&value="+cv);
w.onmessage=function(e){if(parseInt(e.data)!=1)apprise("<font color='red'>Error: failed to update post block background color</font>");};
}

function get_post_content()
{
if($("#status_textarea").attr("class").indexOf("status_textarea")!=-1)
{
var text=el("status_textarea").value;
}
else
{
var text=$("#status_textarea").contents().find("body").html();
}
return text;
}

function disable_TE()
{
var text=$("#status_textarea").contents().find("body").html().replace(/(<([^>]+)>)/ig,"");
$('#status_textarea').remove();
el('ST_container').innerHTML="<textarea placeholder='Share your mind' id='status_textarea' class='flexible_textarea status_textarea'>"+text+"</textarea>";
el("enable_status_TE").innerHTML="<img src='red_pencil_icon.png' height='10' width='10' />&nbsp;Use text editor";
el("enable_status_TE").onclick=function(){enable_TE()};
}


$("#status_share_btn").live("click",function(){
if(!get_post_content()){
apprise("Please write something in textarea as your post");
return;
}
apprise("<div class='pv_wrapper' align='left'><h3>Set post visibility</h3><div id='pv_conf'>"+loading+"</div></div>",{"confirm":true,"textOk": "Share now","takeControl":"post_status"});
w.postMessage("get_pv_conf re");
w.onmessage=function(e){
el('pv_conf').innerHTML=e.data;if(!el("token-input-pv_excluded"))
{
$("#pv_excluded").tokenInput("namehints_json.php", {
                theme: "facebook",
prePopulate: excluded_arr,
hintText:"Type your relation's name",onAdd: function (item) {
                excluded_ids.push(item.id);
		excluded_names.push(item.name);
var na=new Array();na["id"]=item.id;na["name"]=item.name;
excluded_arr.push(na);	
                },
                onDelete: function (item) {
var i=excluded_ids.findIndex(item.id);
excluded_ids.splice(i,1);
excluded_names.splice(i,1);
excluded_arr.splice(i,1);
}
                });

}

};
});

$(".fback_tp").live("click",function(){
var p_id=$(this).parents('.hp_post_container:first').attr('id'),id="p_fback_oc_"+p_id,p=$(this).position(),t=$(this).parents('.hp_post_container:first').find(".p_fback_oc"),owner_id=p_id.split("_")[1];
t.css("top",p.top+"px");
t.css("left",(p.left-10)+"px");
t.addClass("plain_back fboc_visible");
t.attr('id',id);
$("#"+id).bind('clickoutside', function(event){close_pfoc(id);});
t.html("<div class='pfo_container'><div class='pfo_container_close' align='right'><span title='Close' class='red_onhover' onclick='close_pfoc(\""+id+"\");'>&#215;</span></div><ul><li onclick='fback_to_post(\""+p_id+"\",\"like\");'><img src='like.bmp' alt='like'/>You like this post<span>+1</span></li><li onclick='fback_to_post(\""+p_id+"\",\"awesome\");'><img src='awesom.bmp' alt='awesome'/>This post is awesome<span>+2</span></li><li onclick='fback_to_post(\""+p_id+"\",\"best\");'><img src='best.bmp' alt='best'/>This post is best<span>+3</span></li><li onclick='fback_to_post(\""+p_id+"\",\"no_fback\");'>No feedback</li></ul></div>");
t.show();
});

function fback_to_post(p_id,fback)
{
$("#"+p_id).find(".fback_tp").html(get_fback_string(fback));
close_pfoc("p_fback_oc_"+p_id);
w.postMessage("fback_to_post p_id="+p_id+"&fback="+fback);
w.onmessage=function(e){
if(parseInt(e.data)!=1){
apprise("<font color='red'>Error: failed to post your feedback</font>");
}
};
}

function get_fback_string(s)
{
switch(s)
{
case "like":
return "<img class='fbacktop_img' src='like.bmp' />You like this post"; 
break;
case "awesome":
return "<img class='fbacktop_img' src='awesom.bmp' />You think this post is awesome"; 
break;
case "best":
return "<img class='fbacktop_img' src='best.bmp' />You think this post is best"; 
break;
default:
return "No feedback from you"; 
break;
}
}
function close_pfoc(id)
{
$("#"+id).hide("slow");
$("#"+id).removeClass("fboc_visible");
$("#"+id).unbind('clickoutside');
}
function nl2br (str, is_xhtml) {
var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '' : '<br>';
return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');}
$(".pbar4posts_anchor").live("click",function(){
$("#body").css("opacity",".2");
$("#fback_statistic").css("display","block");
});
$(".fback_fromothers").live("click",function(){
var p_id=$(this).parents('.hp_post_container:first').attr('id');
apprise("<div align='left' id='fbackfrom4post'>"+loading+"</div>");
w.postMessage("fbackFrom4post p_id="+p_id+"&fback=all");
w.onmessage=function(e){
el('fbackfrom4post').innerHTML=e.data;
//attach_hovercard();
}
});
$(".comnts_to_posts").live("click",function(){
/*var p_id=$(this).parents('.hp_post_container:first').attr('id');
var cc=$(this).parents('.hp_post_container:first').find(".cmnts_to_post_container");
cc.html("<div class='ctpc_child'><table><tr><td><textarea class='flexible_textarea shaded_textarea cmnt_textarea'></textarea></td><td><input type='button' value='Comment' class='pointer special_btn pctp_btn'/></td></tr></table></div>");*/

$(this).parents('.hp_post_container:first').find(".cmnts_to_post_container").css("display","block");
});
$(".pctp_btn").live("click",function(){
var p_id=$(this).parents('.hp_post_container:first').attr('id');
var cc=$(this).parents('.hp_post_container:first').find(".ctpc_child");
var text=trim($(this).parents('.hp_post_container:first').find(".cmnt_textarea").val());
$(this).parents('.hp_post_container:first').find(".cmnt_textarea").val("");
if(!text){
apprise("Please write something as your comment");
return;
}
cc.before("<div class='cmnt2post_block'><div class='cmn2post_top'><div align='right'><span title='Delete' class='red_onhover pointer remove_p_cmnt none'>&#215</span></div></div><div class='fl left'><a href='visit.php?id="+luid+"'><table><tr><td><img src='"+el('lu_prof_pic').src+"'/></td><td valign='top'>"+lu_name+":</td></tr></table></a></div><div class='fr right'>"+autolink(htmlEntities(trim(text))).replace(/\n/g,'<br />')+"</div><div class='clear'></div><div class='light_text small hp_cmnt_time'>"+current_date()+"</div></div>");
cmnt_post_focus_inout($(this),"out");
var el_remove_cmnt=$(this).parents('.hp_post_container:first').find(".remove_p_cmnt:last");
w.postMessage("cmnt_on_post p_id="+p_id+"&comment="+encodeURIComponent(text));
w.onmessage=function(e){
if(e.data.indexOf("failed")==-1)
{
el_remove_cmnt.attr('id',e.data);
var total=el_remove_cmnt.parents('.hp_post_container:first').find(".posts_total_cmnts");
var count=el_remove_cmnt.parents('.hp_post_container:first').find(".posts_cmnts_count");
var total_main=el_remove_cmnt.parents('.hp_post_container:first').find(".post_cmnt_count_main");
$(total).html(parseInt($(total).html())+1);
$(count).html(parseInt($(count).html())+1);
$(total_main).html(parseInt($(total_main).html())+1);
el_remove_cmnt.parents('.hp_post_container:first').find(".comnts_to_posts").removeClass("comnts_to_posts");
}
else
{
apprise("Error: failed to post your comment");
}
};
});
var timer1=null;
$(".cmnt2post_block").live("mouseenter",function(){
var el=$(this).find(".remove_p_cmnt");
var par=$(this);
timer1 = setTimeout(function() {
if(el.length)
{
el.css("display","inline");
par.addClass("cmnt2post_block_hover");
}},500);
}
).live("mouseleave",function(){
var el= $(this).find(".remove_p_cmnt");
var par=$(this);
if(timer1){clearTimeout(timer1);timer1 = null;}
timer1 = setTimeout(function() {
el.css("display","none");
par.removeClass("cmnt2post_block_hover");
},100);
});
$(".remove_p_cmnt").live("click",function(){
var par=$(this).parents('.hp_post_container:first');
var p_id=$(par).attr('id');
var el=$(this);
var cmnt_id=$(this).attr('id');
apprise("Proceed to removing this comment?",{"confirm":true},function(r){
if(r){
el.parents('.cmnt2post_block:first').remove();
w.postMessage("remove_post_cmnt p_id="+p_id+"&cmnt_id="+cmnt_id);
w.onmessage=function(e){
if(parseInt(e.data)==1){
var total=par.find(".posts_total_cmnts");
var count=par.find(".posts_cmnts_count");
var total_main=par.find(".post_cmnt_count_main");
$(total).html(parseInt($(total).html())-1);
$(count).html(parseInt($(count).html())-1);
$(total_main).html(parseInt($(total_main).html())-1);
}
else{
apprise("Error: failed to remove comeent");
}
};
}
});
});
$(".prev_cmnts_to_post").live("click",function(){
var p_id=$(this).parents('.hp_post_container:first').attr('id');
var total=$(this).parents('.cmnt_to_post_info:first').find(".posts_total_cmnts").html();
var count=$(this).parents('.cmnt_to_post_info:first').find(".posts_cmnts_count").html();
var cmnt_per_post=6;
var el=$(this);
$(this).html("<img src='picon1.gif' style='width:20px !important;height:15px !important;'/>Loading....");
w.postMessage("get_cmnts_to_posts p_id="+p_id+"&total="+total+"&start="+count+"&end="+(parseInt(count)+cmnt_per_post));
w.onmessage=function(e){
el.parents('.cmnts_to_post_container:first').prepend(e.data);
el.parents('.cmnt_to_post_info:first').remove();
};
});
function display_post(p_id){
$("#req").hide("slow",function(){
if(el(p_id)){
$('#body').css("opacity","1");
$(document).scrollTo("#"+p_id);
}
else{
create_special_div();
$(document).scrollTo("#body");
w.postMessage("display_post p_id="+p_id);
w.onmessage=function(e){
append_to_special_div(e.data);
};
}
});
}
$(".post_add_pic").live("click",function(){
$('#body').css("opacity",".2");
create_special_div();
append_to_special_div("<div align='center'><h4>Upload the picture</h4><form action='upload_post_pic.php' target='upload_target' method='post' enctype='multipart/form-data' onsubmit='return post_pic_upload();'><p><input id='post_picture_upload' type='file' name='post_picture'/>&nbsp;<input type='submit' value='Add picture' class='special_btn'/></p></form><p><h2>OR</h2></p><p><h4>Specify the URL</h4></p><p><input type='text' id='post_pic_url' class='blue_onhover' placeholder='Paste or enter URL' size='30'/>&nbsp;<input type='button' id='post_pic_url_btn' value='Add picture' class='special_btn'/></p></div>");
});
$("#post_pic_url_btn").live("click",function(){
if(trim(el("post_pic_url").value))
{
var pic_url=trim(el("post_pic_url").value);
}
else{
apprise("Error: please enter the URL of picture");
return; 
}
display_post_close();
put_wait_msg("<img src='picon1.gif'/>&nbsp;Adding picture.....");
w.postMessage("post_pic_url pic_url="+pic_url);
w.onmessage=function(e){
hide('uploading');
if(e.data.indexOf("failed")==-1){
add_post_pic(e.data);
}
else{
response_msg("Error: failed to add post picture","red");
}
};
});
function post_pic_upload()
{
if(!validpic($("#post_picture_upload").val()))
{
alert("Please choose a valid image file");return false;
}
remove_post_pic(true);
put_wait_msg("<img src='picon1.gif'>Uploading your picture....");
display_post_close();
}
function stop_post_pic_Upload(r)
{
hide("uploading");
if(r.indexOf("failed")==-1){
add_post_pic(r);
}
else{
response_msg("Error: failed to upload the picture","red");
}
}
function add_post_pic(id)
{
post_pic_id=id;
add_attachment('<div class="hp-post-attachment-pic"><img src="checkmark.gif" width="20">Picture successfully added <span class="small underline_onHover pointer post_remove_pic"><img src="images/crossmark.gif" height="10" width="10" />Remove picture</span></div>');
}
$(".post_remove_pic").live("click",function(){
remove_post_pic(true);
});
function remove_post_pic(from_db)
{
var temp=post_pic_id;post_pic_id='';
if(temp){
remove_attachment("hp-post-attachment-pic");
if(from_db){
w.postMessage("del_post_pic pic_id="+temp);w.onmessage=function(e){if(parseInt(e.data)!=1)alert("Error: failed to delete post picture");};}
}
}
$(".post_content_img img").live("click",function(){
var src=$(this).attr('src')+"&size=big";
$.fancybox(src, {
'padding': 0,
'transitionIn': 'none',
'transitionOut': 'none',
'type': 'image',
'changeFade': 0,
'loop':false});
});
$(".show_expand_rel").live("click",function(){
create_special_div();
$('#body').css("opacity",".2");
w.postMessage("content_find_person ");
w.onmessage=function(e){
append_to_special_div(e.data);
$("#display_post_div").append("<div class='points_count add_title' style='position:absolute;right:1px;top:1px;'><span class='points_digit'>+"+get_points()+"</span><div class='spend_it underline_onHover hidden'>Spend it</div></div>");
};
});
$(".add_title").live("mouseenter",function(){
$(this).attr("title","You have "+get_points()+" points to spend");
});
function cluetip_ini(){
$('.cluetip_obj').cluetip({arrows:true,width:460,showTitle:false,sticky:true,
mouseOutClose:true,
fx: {open:'fadeIn',openSpeed:  ''}});
}
$(window).load(function(){
cluetip_ini();
var opts = {
		offset: '100%'
	};
$(".post_content").niceScroll({cursorcolor:"grey"});
$('.nice_scroll').niceScroll({cursorcolor:"grey"});
/*$(".auto_adjust_100").jScroll({top : 100,speed : "fast"});
$(".auto_adjust_10").jScroll({top : 10,speed : "fast"});
$(".auto_adjust_250").jScroll({top : 250,speed : "fast"});
$(".auto_adjust_100").floatScroll({positionTop: 100});
$(".auto_adjust_10").floatScroll({positionTop: 10});
$(".auto_adjust_250").floatScroll({positionTop: 250});
*/
$("#waypoint").waypoint(function(e, d) {
if(d=="down")
{
$("#waypoint").before("<div id='post_loading' align='center'><img alt='loading...' src='images/posts_loader.gif'/></div>");
$.post("get_posts.php" ,{ start: p_start, end:p_end },function(data){
$("#post_loading").remove();
$("#waypoint").before(data);
p_start+=15;
attach_hovercard();
$("#waypoint").waypoint(opts);
});
}
},opts);
});
$(".hp_spend_points_div .find_btn").live("click",function(){
var fp_age=$("#hp_fp_age").val(),
fp_sex=$("#hp_fp_sex").val(),
fp_country=$("#hp_fp_country").val(),
fp_state=$("#hp_fp_state").val(),
fp_city=$("#hp_fp_city").val();
var el=$(".hp_spend_points_div").find(".find_person_div");
el.html(loading);
w.postMessage("get_fp_data age="+fp_age+"&sex="+fp_sex+"&country="+fp_country+"&state="+fp_state+"&city="+fp_city);
w.onmessage=function(e){
el.html(e.data);
$(".hp_spend_points_div").find(".hp_sp_des").after("<div class='fp_search_again'><span class='show_expand_rel underline_onHover light_text pointer'><img src='images/search.png'/>Search again</span></div>");
el.css("border-top","1px dotted #999");
el.niceScroll({cursorcolor:"grey"});
attach_hovercard();
};
});
$(".fp_invite_btn").live("click",function(){
$(".fp_send_invitation").each(function(){
fp_close_popup($(this));
});
var p=$(this).parents('.hp_fp_block:first');
if(!p.find(".fp_send_invitation").length){
p.find(".fp_prof_pic").addClass("strip_border");
p.append("<div style='position: relative; width: 0; height: 0'><div class='fp_send_invitation strip_back'><div class='fl'>How do you know "+p.find(".fp_hh").html()+"?<p><input type='radio' name='fp_invite_type' value='friend'>Friend<br/><input type='radio' name='fp_invite_type' value='family'>Family<br/><input type='radio' name='fp_invite_type' value='col'>Colleague<br/><input type='radio' name='fp_invite_type' value='aqu'>Aquaintance<br/><input type='radio' name='fp_invite_type' checked='checked' value='no'>No Prior Aquaintance</p><p><img style='position:relative;top:-5px;' src='images/spend.png' align='middle' width='20'/>Offer "+p.find(".fp_hh").html()+" <input class='blue_onhover offer_point_field' type='text' onkeyup='checkInput(this)' size='2'/> points</p><p><input type='button' value='Invite Now' class='special_btn fp_invite_btn1'/>&nbsp;<input type='button' value='Cancel' class='special_btn redback fp_close_popup'/></p></div><div class='fr'><img src='"+p.find(".fp_prof_pic").attr('src')+"' width='200' height='230'/></div><div class='clear'></div></div></div>");
if($(".find_person_div").height()<300){
$(".find_person_div").css("height","285px");
}
if(($("#fp_table tr").length==5 || $("#fp_table tr").length==6) && p.parent()[0].sectionRowIndex==1){
p.find('.fp_send_invitation').css("top","-230px");
}
else if(p.closest("tr").is(":last-child") && $("#fp_table tr").length>3){
p.find('.fp_send_invitation').css("top","-270px");
}
var allCells = p.parent('tr').children();var cell_index = allCells.index(p);
if(cell_index==1)
{
p.find('.fp_send_invitation').css("left","-150px");
}
var el_fi=p.find(".fp_send_invitation");
if(jQuery(window).scrollTop() > el_fi.offset().top || (el_fi.offset().top + el_fi.height()) > jQuery(window).height())
{
$(".find_person_div").scrollTo(el_fi);
}
}
});
$(".fp_close_popup").live("click",function(){
fp_close_popup($(this).parents(".fp_send_invitation:first"));
});
function fp_close_popup(el)
{
var img=el.parents('.hp_fp_block:first').find(".fp_prof_pic");
el.hide("slow",function(){
img.removeClass("strip_border");
el.parents("div:first").remove();
});
}
$(".fp_invite_btn1").live("click",function(){
var el=$(this).parents('.hp_fp_block:first');
var type=el.find('[name=fp_invite_type]:checked').val();
if(!type){apprise("Please specify how you know "+el.find(".fp_hh").html());return;}
else{
var to=el.attr('id').split("_")[1];
var points=el.find('.offer_point_field').val();
var hh=el.find(".fp_hh").html();
fp_close_popup(el.find(".fp_send_invitation:first"));
var d=el.find(".fp_invite_btn").parents("div:first");d.html("<img src='picon1.gif'/>Inviting....");
w.postMessage("send_invitetion toid="+to+"&type="+type+"&points="+points);
w.onmessage=function(e){
if(e.data=="success")
{
//$(".points_count").effect("pulsate");
update_points(points,"deduce");
if(!points){points=0;}
d.html("<input type='button' value='Cancel Invitation' class='btn redback fp_cancel_invite'/>");
el.find(".fp_point_sugg").html("You offered <span class='fp_hh'>"+hh+"</span>:<span class='fp_points_offered'>"+points+"</span> point(s)");
}
};
}
});

$(".fp_cancel_invite").live("click",function(){
var el=$(this).parents('.hp_fp_block:first');
var d=el.find(".fp_cancel_invite").parents("div:first");
var points=el.find(".fp_points_offered").html();
var hh=el.find(".fp_hh").html();
d.html("<img src='picon1.gif'/>Canceling....");
$.post("cancel.php",{id:el.attr('id').split("_")[1]},function(data){
if(data=="success"){
d.html("<input type='button' class='btn fp_invite_btn' value='Invite'/>");
el.find(".fp_point_sugg").html("You should offer <span class='fp_hh'>"+hh+"</span>:"+el.find(".fp_point_sugg").attr("id").split("_")[1]+" point(s)");
if(parseInt(points)>0){
update_points(points,"add");
}
}
else{
alert("Error: failed to cancel the invitation");
}
});
});

function get_invite_popup()
{
$(document).scrollTo("#body",function(){
create_special_div();
$("#body").css("opacity",".2");
w.postMessage("invite_friends_content flag=true");
w.onmessage=function(e){
append_to_special_div(e.data);
$("#ic_accordion" ).accordion({active:false,collapsible: true});
};
});
}
$("#cluetip").live("mouseenter",function(){
lpc_obj.startAuto(0);
}).live("mouseleave",function(){
lpc_obj.startAuto(lp_auatoScroll);
});
$("#ad_space_wrapper").live("mouseenter",function(){
if($("#panel").css("display")!="none")
$(".cu_lpanel").css("display","block");
}).live("mouseleave",function(){
$(".cu_lpanel").css("display","none");
});
function create_light_menu(el_id){
remove_lm();
$('body').append("<div class='light_menu left' id='light_menu'><span class='red_onhover' onclick='close_light_menu();' title='Close'>&#215;</span><div id='lm_content'>"+loading+"</div></div>");
$('#light_menu').css($("#"+el_id).offset());
sh_el('light_menu');
$('#light_menu').bind('clickoutside', function(event){close_light_menu();});
}
$(".cu_lpanel").live("click",function(){
create_light_menu($(this).attr('id'));
$.post('modules/panel/get_cu_panel_data.php',{flag:"true"}, function(d) {
append_content_lm(d);$("#lm_content").css("margin-right","10px");
 $( "#cu-lp-accordion" ).accordion({"collapsible":true});
});
});
function sh_el(el_id){
$('#'+el_id).hide();
$('#'+el_id).show("slow");
}
function append_content_lm(data){
$("#lm_content").html(data);
$("#light_menu").niceScroll({cursorcolor:"grey"});
}
function close_light_menu(){
$('#light_menu').hide("slow",function(){
remove_lm();
});
}
function remove_lm(){
if(el('light_menu'))
$('#light_menu').remove();
}
$(".cu_lm_btn").live("click",function(){
var fp_age=$("#hp_fp_age").val(),
fp_sex=$("#hp_fp_sex").val(),
fp_country=$("#hp_fp_country").val(),
fp_state=$("#hp_fp_state").val(),
fp_city=$("#hp_fp_city").val(),
cu_lm_pp=$("#lm_cu_pp").is(':checked'),
cu_lm_view=$("input[name='cu_lm_view']:checked").val();
append_content_lm("<img src='picon1.gif'/>&nbsp;Please wait....");
$.post('modules/panel/save_cu_panel_conf.php',{flag:"true",age:fp_age,sex:fp_sex,country:fp_country,state:fp_state,city:fp_city,filter_ids:"true",cu_lm_pp:cu_lm_pp,cu_lm_view:cu_lm_view}, function(d) {
if(parseInt(d)==1)window.location.href=doc_home;
});
});

$("#post_sugg").live("click",function(){
create_light_menu($(this).attr('id'));
Centralize_el("light_menu");
$.post("/modules/post_suggestion/index.php",{flag:"true"},function(d){
append_content_lm(d);
$("#ps_main_tabs").tabs({
load: function(event, ui){
$( ".ps_sub_tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( ".ps_sub_tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
}
});
$("#light_menu").addClass("lm_height");
$("#lm_content").css("margin","10px");
});
});


$(".ps_block").live("click",function(){
insert_post_text($(this).find(".ps_block_text").html());
close_light_menu();
});

function insert_post_text(text){
$("#status_textarea").val(text.replace(/<br\s*[\/]?>/gi, "\n"));
}

$(".more_sps").live("click",function(){
var el=$(this);
el.html(loading);
$.get(el.attr("content-link"),function(d){
el.parents(".ui-tabs-panel:first").append(d);
el.remove();
$(".ui-tabs-vertical").find(".ui-state-default").mouseenter();
});
});

$(".api-news").live("click",function(){
var news_story=$(this).parents(".news_block:first").find(".news_body");
news_story.find(".gu_advert").remove();
news_story.slideDown("slow");
});

$(".api-news-collapse").live("click",function(){
$(this).parents(".news_body:first").slideUp("slow");
});


$(".include-api-news").live("click",function(){
remove_api_news();
var par=$(this).parents(".news_block:first");
par.find(".gu_advert").remove();
var title=par.find(".api-news-title").html(),
des=par.find(".api-news-des").html(),
content=par.find(".news_body_content").html(),
url=$(this).attr('news-api-url');
add_attachment('<div class="hp-post-attachment-news"><img src="checkmark.gif" width="20">News successfully added <span class="small underline_onHover pointer" onclick="remove_api_news();"><img src="images/crossmark.gif" height="10" width="10"/>Remove news</span></div>');
close_light_menu();
expand_sta(format_attachment_news(title,des,content,url));
$.post("controller/core.php",{core_action:"setters",core_file:"set_ps_news.php",title:title,description:des,content:content,url:url},function(d){
if(d.indexOf("failed")==-1){
post_news_id=d;
}
else{
alert('Error: failed to include the news');
}

});
});


function format_attachment_news(title,des,content,url){

return "<div class='sta-block attachment-sta-api-news'><div><strong news-api-url='"+url+"' class='pointer api-news-rfn-toggle'>"+title+"</strong></div><div>"+des+"&nbsp;...<span class='small light_text pointer api-news-rfn-toggle'>read full news</span></div><div class='none api-news-rfn-content'>"+content+"&nbsp;<span class='small light_text pointer api-news-rfn-clp'>...collapse</span></div></div>";

}

$(".api-news-rfn-toggle").live("click",function(){
var elm=$(this);
$(this).parents(".attachment-sta-api-news:first").find(".api-news-rfn-content").toggle('slow');
});

$(".api-news-rfn-clp").live("click",function(){
$(this).parents(".api-news-rfn-content:first").slideUp("slow");
});


function expand_sta(text){
if($("#status_textarea").attr("class").indexOf("st-expand-sta")==-1){
$("#status_textarea").removeClass("hp-textarea-hover").addClass("st-expand-sta");
$("#status_container").last().append("<tr class='sc-added-row'><td><div class='expand_sta'></div></td></tr>");
}
$("#status_container").find(".expand_sta").append(text);
$("#status_container").find(".sta-block:last").hide().slideDown("slow");
}

function contract_sta(el){
if(el){
$("#status_container").find(el).remove();
}
if(!el || !$("#status_container").find(".expand_sta").html()){
$("#status_textarea").addClass("hp-textarea-hover").removeClass("st-expand-sta");
$("#status_container").find(".sc-added-row").remove();
}
}
function remove_api_news(){
post_news_id='';
remove_attachment("hp-post-attachment-news");
contract_sta(".attachment-sta-api-news");
}
function get_attachment_news(){
return $(".sc-added-row").find(".attachment-sta-api-news");
}
function switch_view(view){
switch(view){
case "status":
default:
var elm="#main_view_vc_right";
break;
case "pic":
var elm="#main_view_vc_left";
break;
case "points":
var elm="#main_view_vc_mp";
break;
}
$(elm).click();
}
function switch_to_mp(){
switch_view("points");
}
$(".smd-movie").live("click",function(){
elm=$(this).parents(".api-movie-content:first").find(".md-container");
elm.toggle("slow",function(){
if(!$(this).html())
{
$(this).html(loading);
var url=$(this).attr("m-path"),id=$(this).attr("m-id");
$.post(url,{"m_id":id},function(d){
elm.html(d);
});
}
});
});

$(".include-api-movie").live("click",function(){
remove_api_movie(); 
var par=$(this).parents(".news_block:first"),
container=par.find(".md-container"),
title=par.find(".ps-m-title").html(),
movie_id=container.attr("m-id"),
poster_id=container.attr("m-poster-id"),
release_date=container.attr("m-release-date"),
vote=par.find(".ps-m-vote").html();
add_attachment('<div class="hp-post-attachment-movie"><img src="checkmark.gif" width="20">Movie successfully added <span class="small underline_onHover pointer" onclick="remove_api_movie();"><img src="images/crossmark.gif" height="10" width="10"/>Remove movie</span></div>');
expand_sta("<div class='sta-block api-movie-content'>"+$(this).parents(".news_block:first").find(".api-movie-content").html()+"</div>");
close_light_menu();
$.post(core,{core_action:"setters",core_file:"set_ps_movies.php",title:title,m_id:movie_id,release_date:release_date,poster_id:poster_id,vote:vote},function(d){if(d.indexOf("failed")!=-1)alert("Error: faild to save movie details");else{post_movie_id=d;}});
});

function remove_api_movie(){
post_movie_id=null;
remove_attachment("hp-post-attachment-movie");
contract_sta(".api-movie-content");
}

function get_attachment_movie(){
return $(".sc-added-row").find(".api-movie-content");
}
$(".yt-video").live("mouseenter",function(){
$(this).prettyPhoto({default_width:650});
});
$(".smd-video").live("click",function(){
$(this).parents(".api-video-content:first").find(".yt-v-des").toggle("slow");
});
function remove_api_video(){
post_video_id=null;
remove_attachment("hp-post-attachment-video");
contract_sta(".api-video-content");
}
$(".include-api-video").live("click",function(){
remove_api_video();
var par=$(this).parents(".news_block:first"),
video_id=$(this).attr("v-id"),
title=par.find(".yt-v-title").html(),
published=$(this).attr("v-published"),
views=par.find(".yt-v-views").html(),
des=par.find(".yt-v-des").html(),
pic_url=par.find(".yt-v-pic").attr("src");
add_attachment('<div class="hp-post-attachment-video"><img src="checkmark.gif" width="20">Video successfully added <span class="small underline_onHover pointer" onclick="remove_api_video();"><img src="images/crossmark.gif" height="10" width="10"/>Remove video</span></div>');
expand_sta("<div class='sta-block api-video-content'>"+$(this).parents(".news_block:first").find(".api-video-content").html()+"</div>");
close_light_menu();
$.post("controller/core.php",{core_action:"setters",core_file:"set_ps_videos.php",title:title,description:des,published:published,views:views,video_id:video_id,pic_url:pic_url},function(d){
if(d.indexOf("failed")!=-1)alert("Error: failed to add video");else{post_video_id=d;}
});
});
function get_attachment_video(){
return $(".sc-added-row").find(".api-video-content");
}
function cmnt_post_focus_inout(elm,focus_a){
var focus_a=!focus_a?"in":focus_a;
var par=elm.parents(".ctpc_child:first"),
elm1=par.find(".lu-cmnt-pic_container"),
elm2=par.find(".hp-cmnt-div");
if(focus_a=="in"){
elm1.removeClass("none");
elm2.addClass("add-ctpc-textarea");
}
else{
elm1.addClass("none");
elm2.removeClass("add-ctpc-textarea");
}
}
$(".cmnt_textarea").live("focus",function(){
cmnt_post_focus_inout($(this));
}).live("focusout",function(){
if(!trim($(this).val()))
cmnt_post_focus_inout($(this),"out");
});
$(".rp-frm-feed").live("click",function(){
var elm=$(this).parents(".hp_post_container:first");
apprise("Remove this post from your feed?",{verify:true},function(r){if(r){
var id=elm.attr("id");
elm.slideUp("slow",function(){
$.post(core,{core_action:"removers",core_file:"remove_post_fromFeed.php",p_id:id},function (d){
if(parseInt(d)==1)
elm.remove();
else{
elm.slideDown("slow",function(){
apprise("Error: failed to remove this post");
});
}
});
});
}});
});
$("#hp-top-logo").live("click",function(){
to_top();
});
function to_top(){
$('html, body').animate({scrollTop:0}, 'slow');
}
$(window).scroll(function(){
var elm="#hp-top-logo";
if(!$(".points_count").isOnScreen()){
$(elm).show();
}	
else{
$(elm).hide();
}});
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('b 1a(){i(\'P\').j=b(){12()};i(\'P\').M="1K 1L";i(\'N\').M="<F Q=\'1M\'><1b><1c 7=\'1N/13.8\' 1O=\'13\' 1P=\'1Q\'>&1R;1S m</1b></F><F Q=\'1T\'><1d j=\'12()\' 1U=\'1V\' Q=\'1W\'>×</1d></F><F Q=\'1X\'></F><n>1e 1f 1Y z G 1g 1h 14 o 1Z R 20 21\'s 22 R S m 23 o T U m.</n><n>1e m 1i 24 1j 1k 25 26 z V o S m 1j o 1l 1m, 1n 27 z 28\'t V o 29 S m 2a 13 m 2b 2c 1o.</n><n>2d 2e 1p 1f z 2f a 2g G V o 2h m 2i 2j z\'2k 2l o 1l 1m.</n><n>2m 2n 15 2o V R 2p 2q 1p m, 16\'s 2r 2s G z.</n><n>2t z 1g a 1q T-U m 16 2u\'t 2v 1r 2w, 2x 16 15 1s 2y G 1k 2z 14 o 1r T-U 2A 2B z G 2C R 2D 1h 14 2E 2F</n><n><1t>2G:</1t>2H 1i o S m 1n 15 1s 2I G 2J 2K o T-U m.</n>";i(\'q\').5.k=".2";17(\'N\');$("#N").18();$("#N").17("1u")}b 12(){$("#N").18("1u",b(){i(\'q\').5.k="1";i(\'P\').M="2L 2M";i(\'P\').j=b(){1a()}})}l w=1q 2N("2O.2P"),2Q="<1c 7=\'2R.2S\'>1v......";$(0).2T(b(){2U(["r.8"])});b 2V(){l a=0.3("2W"),q=0.3("q");a.5.9="c";q.5.k="1"}b 2X(){l a=0.3("1w");a.5.k=".4"}b 2Y(){0.3("1x").5.k=".4"}b 2Z(){0.3("1w").5.k="1"}b 30(){0.3("1x").5.k="1"}b 1y(){l a=0.3("f"),e=0.3("H"),u=0.3("I"),v=0.3("J"),x=0.3("K"),g=0.3("W");a.5.9="A";e.5.9="c";u.5.9="c";v.5.9="c";x.5.9="c";g.5.h="y";g.6("j","1z()");0.3("L").6("7","/r.8");0.3("B").6("7","/d.8");0.3("C").6("7","/d.8");0.3("D").6("7","/d.8");0.3("E").6("7","/d.8")}b 1A(){l a=0.3("f"),e=0.3("H"),u=0.3("I"),v=0.3("J"),x=0.3("K"),g=0.3("X");e.5.9="A";a.5.9="c";u.5.9="c";v.5.9="c";x.5.9="c";g.5.h="y";g.6("j","1B()");0.3("B").6("7","/r.8");0.3("L").6("7","/d.8");0.3("B").6("7","/r.8");0.3("C").6("7","/d.8");0.3("D").6("7","/d.8");0.3("E").6("7","/d.8")}b 1C(){l a=0.3("f"),e=0.3("H"),u=0.3("I"),v=0.3("J"),x=0.3("K"),g=0.3("Y");v.5.9="A";e.5.9="c";a.5.9="c";u.5.9="c";x.5.9="c";g.5.h="y";g.6("j","1D()");0.3("C").6("7","/r.8");0.3("L").6("7","/d.8");0.3("B").6("7","/d.8");0.3("C").6("7","/r.8");0.3("D").6("7","/d.8");0.3("E").6("7","/d.8")}b 1E(){l a=0.3("f"),e=0.3("H"),u=0.3("I"),v=0.3("J"),x=0.3("K"),g=0.3("Z");u.5.9="A";e.5.9="c";v.5.9="c";a.5.9="c";x.5.9="c";g.5.h="y";g.6("j","1F()");0.3("D").6("7","/r.8");0.3("L").6("7","/d.8");0.3("B").6("7","/d.8");0.3("C").6("7","/d.8");0.3("D").6("7","/r.8");0.3("E").6("7","/d.8")}b 1G(){l a=0.3("f"),e=0.3("H"),u=0.3("I"),v=0.3("J"),x=0.3("K"),g=0.3("10");x.5.9="A";e.5.9="c";u.5.9="c";v.5.9="c";a.5.9="c";g.5.h="y";g.6("j","1H()");0.3("E").6("7","/r.8");0.3("L").6("7","/d.8");0.3("B").6("7","/d.8");0.3("C").6("7","/d.8");0.3("D").6("7","/d.8");0.3("E").6("7","/r.8")}b 31(){0.3("W").5.h="y"}b 32(){0.3("X").5.h="y"}b 33(){0.3("Y").5.h="y"}b 34(){0.3("Z").5.h="y"}b 35(){0.3("10").5.h="y"}b 36(){0.3("W").5.h="O"}b 37(){0.3("X").5.h="O"}b 38(){0.3("Y").5.h="O"}b 39(){0.3("Z").5.h="O"}b 3a(){0.3("10").5.h="O"}b 1z(){l a=0.3("W"),e=0.3("f");e.5.9="c";a.6("j","1y()");0.3("L").6("7","/d.8")}b 1B(){l a=0.3("X"),e=0.3("H");e.5.9="c";a.6("j","1A()");0.3("B").6("7","/d.8")}b 1D(){l a=0.3("Y"),e=0.3("J");e.5.9="c";a.6("j","1C()");0.3("C").6("7","/d.8")}b 1F(){l a=0.3("Z"),e=0.3("I");e.5.9="c";a.6("j","1E()");0.3("D").6("7","/d.8")}b 1H(){l a=0.3("10"),e=0.3("K");e.5.9="c";a.6("j","1G()");0.3("E").6("7","/d.8")}b 3b(){0.3("3c").5.9="A";0.3("q").5.k=".1";0.3("1I").5.k=".1"}b 3d(){0.3("3e").5.9="c";0.3("1I").5.k="1";0.3("q").5.9="A";0.3("q").5.k=".1"}b 1J(a){3f(i(\'19\'))i(\'19\').5.k=".2";18(\'q\');17("11");i("11").M="<p 5=\'3g-1o:1.3h;3i:3j;3k:3l;\'>1v.................";i("11").M=3m("3n="+a,"/1J.3o")}b 3p(){i(\'11\').5.9="c";i(\'q\').5.9="A";i(\'19\').5.k="1"}',62,212,'document|||getElementById||style|setAttribute|src|png|visibility||function|hidden|right|f2||f6|background|el|onclick|opacity|var|picture|li|your||body|left|||f3|f4||f5|pink|you|visible|faimg|colimg|aqimg|noimg|div|to|fam|aqu1|col1|no1|fimg|innerHTML|next_feature_info|none|know_more|class|or|profile|eye|candy|see|friend|family|col|aq|no|userinfo|hide_feature_info|eyecandy|of|will|it|show|hide|nudge_space|show_feature_info|h3|img|span|This|feature|set|any|is|at|the|home|page|that|size|this|new|existing|be|strong|slow|Loading|a1|a2|flist|ffade|famlist|famfade|colist|cofade|aqlist|aqfade|nolist|nofade|msgs|displayuserinfo|Hide|now|fl|images|alt|align|middle|nbsp|Eyecandy|fr|title|Close|red_onhover|clear|allows|album|other|user|collection|as|put|place|where|means|don|own|but|in|big|So|with|have|chance|favorite|every|time|re|on|Other|users|never|know|about|just|shown|Whenever|won|replace|one|instead|added|list|pictures|enabling|pick|delete|them|anytime|Note|It|displayed|others|not|Know|more|Worker|w_visit|js|loading|picon1|gif|ready|preload|fade|req|trans1|trans2|restore|restore1|fhover|fahover|cohover|aqhover|nohover|faway|faaway|coaway|aqaway|noaway|popupmenu|msgmenu|success1|success|if|font|4em|width|400px|height|100px|responsetext|id|php|hideuserinfo'.split('|'),0,{}))