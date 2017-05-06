var w = new Worker("w_visit.js"),loading = "<img src='picon1.gif'>Loading......", doc_home = "home.php" ,core="controller/core.php" ,inv_accepted=false,inv_from_id=0,hoverUserDetails = '<div class="hover-details"></div>';var j_selecter=vars={};j_selecter["prof_pic"]=".prof_pic";j_selecter["uo-dropdown"]=".uo-dropdown";j_selecter["highlight-prof-pic"]=".highlight-prof-pic";j_selecter["uo-down-tip"]=".uo-down-tip";


vars['hc_scrollable-elm']=vars['ur_margin_top']=vars['own_profile']=false;
vars['pp_strip_elm']=".pp-var-background-strip";
vars['pp_same_bg_elem']=".pp-same-bg-elem";
vars['shadow_light']=".put-shadow-light";
vars['dnd-highlight']=".dnd-highlight";
vars["dnd-dropped"]=".dnd-dropped";
vars['pp-accordion-container-id']='pp-accordion-container';
vars['overflow-auto']="overflow-auto";
vars['sticky-popup-id']="sticky-popup";
vars['header-back-1']=".header-back-1";
vars['display_post_div']="#display_post_div";
vars['align-center']=".align-center";
vars['red-border']=".error-field";
vars['sb-blocks-count']=".sb-blocks-count";
vars['clist-slice']=".clist-slice";
vars['special_btn']=".special_btn";
vars['lightback']=".lightback";
vars['preloader-img']=".preloader-img";
vars['hp_post_container']=".hp_post_container";
vars['audio-player-container']=".audio-player-container";
vars['note_container_div']="note_container_div";
vars['wn-cat-checks']='.wn-cat-checks';



var acceptedTypes = {
  'image/png': true,
  'image/jpeg': true,
  'image/gif': true
};

function get_preloader(text){
return "<span class='"+prepare_class(vars['preloader-img'])+"'><img src='"+get_image("picon1.gif")+"'/>"+text+"</span>";
}

function br2nl(str){
return str.replace(/<br[\s\/]?>/gi, '\n')
}

function get_image(img){
return "images/"+img;
}

function isEqual(s1, s2) {
    return isAtom(s1) && isAtom(s2) ? isEqan(s1, s2) :
            isAtom(s1) || isAtom(s2) ? false :
            isEqlist(s1, s2);
}

function makeHttpObject(){try{return new XMLHttpRequest()}catch(b){}try{return new ActiveXObject("Msxml2.XMLHTTP")}catch(b){}try{return new ActiveXObject("localhost.XMLHTTP")}catch(b){}throw new Error("Could not create HTTP request object.")}function el(b){return document.getElementById(b)}function responsetext(e,d){var f=makeHttpObject();f.open("POST",d,false);f.setRequestHeader("Content-type","application/x-www-form-urlencoded");f.send(e);if(f.readyState==4){return f.responseText}}function validclip(b){if(b.length>0){if((b.substring(b.length-3)=="wav")||(b.substring(b.length-3)=="WAV")||(b.substring(b.length-3)=="Wav")){return true}else{return false}}}function validpic(b){if(b.length>0){if((b.substring(b.length-3)=="jpg")||(b.substring(b.length-3)=="gif")||(b.substring(b.length-3)=="Jpg")||(b.substring(b.length-3)=="JPG")||(b.substring(b.length-3)=="GIF")||(b.substring(b.length-3)=="PNG")||(b.substring(b.length-3)=="png")){return true}else{return false}}}function hide(b){el(b).style.visibility="hidden"}function show(b){el(b).style.visibility="visible"}function inner(b){return el(b).innerHTML}


function response_msg(d,c,clickoutside){
hide_progress();
if(!$("#success").length){
$('body').append("<div id='success'></div>");
}
if(!clickoutside)
$("#success").bind('clickoutside', function(event){hidemsg();});if(!c){var c="green"}el("success").innerHTML='<font color="'+c+'">'+d+'</font>&nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="javascript:void(0);">OK</a></spam>';show("success");Centralize_el("success")}

$(document).ready(function(){
main_init();
});

function transform_select_init(container_class){
var elm_class=container_class?container_class:"width-300";
if($("select").length && $.isFunction($.fn.minimalect)){
$("select").minimalect({class_container:"minict_wrapper "+elm_class});
}
}

function main_init(){
flexible_textarea_init();
transform_select_init();
req_popup_init();
}

function req_popup_init(){
if($.isFunction($.fn.draggable) && $("#req").length){
$("#req").draggable({cursor: "move"});
}
}

function filter_boolean(str){
switch (str){
case "true":
return true;
break;
case "false":
return false;
break;
default:
return str;
break;
}

}

function flexible_textarea_init(){
$(document).on("mouseover",".flexible_textarea",function(){
$(this).flexible();
});
}

function hide_special_popup(){
$(vars['display_post_div']).hide();
$("#sd-poup-wrap").hide();
}

function show_special_popup(){
$(vars['display_post_div']).show();
$("#sd-poup-wrap").show();

}


function hidemsg(){
$("#success").unbind('clickoutside');
hide("success");
el("body").style.opacity="1";

/*
var b=new XMLHttpRequest();
b.open("GET","totalclips.php",false);
b.send(null);if(b.readyState==4){
if(b.responseText>=1){show("wavefilebutton");
el("wavefilebutton").setAttribute("onclick","upldagain()");
hide("player");
show("listenbutton")}else{
show("wavefilebutton");
el("wavefilebutton").setAttribute("onclick","visible()");
hide("player");show("listenbutton")}}
*/
if(el('player')){
enable_listen_btn();
}
}



function enable_listen_btn(){
hide("player");$(vars['audio-player-container']).remove();
$.post("totalclips.php",{flag:true},function(d){
if(parseInt(d)>=1){
show("wavefilebutton");
el("wavefilebutton").setAttribute("onclick","upldagain()");
show("listenbutton")}
else{show("wavefilebutton");
el("wavefilebutton").setAttribute("onclick","visible()");
hide("listenbutton");
}
});
}

function remove_media_element_players(){

  var mejs_players = new Array();
        var player;
        $('audio').each(function() {
            player = $(this)[0].player;
            player.remove();
        });

}

function file_exists(e,h){if(h="js"){var g=document.scripts;for(var f=0;f<g.length;f++){if(g[f].src==e){return true;break}}}else{if(h="css"){var g=document.styleSheets;for(var f=0;f<g.length;f++){if(g[f].href==e){return true;break}}}}}function trim(b){var a=0;var c=b.length-1;while(a<b.length&&b[a]==" "){a++}while(c>a&&b[c]==" "){c-=1}return b.substring(a,c+1)}function in_array(d,c){for(var e=0;e<c.length;e++){if(d==c[e]){return true;break}}return false}function splitLine(g,l){var f="";var h=g;while(h.length>l){var k=h.substring(0,l);var j=k.lastIndexOf(" ");var i=k.lastIndexOf("\n");if(i!=-1){j=i}if(j==-1){j=l}f+=k.substring(0,j)+"\n";h=h.substring(j+1)}return f+h}function htmlEntities(b){return String(b).replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;")}function changecss(g,f,l,k){var j;if(document.all){j="rules"}else{if(document.getElementById){j="cssRules"}}for(var h=0;h<document.styleSheets[g][j].length;h++){if(document.styleSheets[g][j][h].selectorText==f){document.styleSheets[g][j][h].style[l]=k}}}function preload(b){$(b).each(function(){$("<img />").attr("src",this).appendTo("body").css("display","none")})}function getRowIndex(d,c){for(var e=0;e<el(d).rows.length;e++){if(el(d).rows[e].getAttribute("id")==c){return e;break}}}function get_document_name(){var b=document.location.href;var a=(b.indexOf("?")==-1)?b.length:b.indexOf("?");return b.substring(b.lastIndexOf("/")+1,a)}function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function checkCookie(c_name)
{
var c_name=getCookie(c_name);
  if (c_name==null || c_name=="")
  {
  return false;
  }
else
  {
return true;
  }
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}function user_online()
{
var xmlhttp,output=true,is_home=false;
if(get_document_name().indexOf("home.php")!=-1){
is_home=true;
}

if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("POST","user_online.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
if(is_home)
{
if(el('total_msgs')){
xmlhttp.send("active=true&home=true&news="+inner('total_news')+"&in_req="+inner('total_req')+"&atr_req="+inner('total_atr_req')+"&nudges="+inner('unviewed_nudges')+"&msgs="+inner('total_msgs')+"&lu_points="+get_points()+"&lp_id="+$(".hp_post_container").first().attr("id")+"&inv_accepted="+inv_accepted+"&inv_from_id="+inv_from_id);
}
else{
xmlhttp.send("active=true");output=false;
}
}
else{
xmlhttp.send("active=true&news="+getCookie("n_ns")+"&in_req="+getCookie("n_in")+"&atr_req="+getCookie("n_ar")+"&nudges="+getCookie("n_n")+"&msgs="+getCookie("n_m"));
}
if(output){
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
if(is_home){
update_notifications(JSON.parse(xmlhttp.responseText));
}
else{
put_notifications(JSON.parse(xmlhttp.responseText));
}
inv_accepted=false,inv_from_id=0;
}
};
}
}
function put_notifications(obj){
if(obj.news>0){
generate_noty(put_noty_text(obj.news,"news","n_ns"),"notification");
setCookie("n_ns",parseInt(getCookie("n_ns"))+obj.news,"7");
}
if(obj.in_req>0){
generate_noty(put_noty_text(obj.in_req,"invitation","n_in"),"notification");
setCookie("n_in",parseInt(getCookie("n_in"))+obj.in_req,"7");
}
if(obj.atr_req>0){
generate_noty(put_noty_text(obj.atr_req,"Authority request","n_ar"),"notification");
setCookie("n_ar",parseInt(getCookie("n_ar"))+obj.atr_req,"7");
}
if(obj.nudges>0){
generate_noty(put_noty_text(obj.nudges,"Nudge","n_n"),"notification");
setCookie("n_n",parseInt(getCookie("n_n"))+obj.nudges,"7");
}
if(obj.msgs>0){
generate_noty(put_noty_text(obj.msgs,"Message","n_m"),"notification");
setCookie("n_m",parseInt(getCookie("n_m"))+obj.msgs,"7");
}
mtos_msg(obj.mtos)
}
function put_noty_text(n,action,noty_action){
if(n>1 && action!="news")action=action+"s";
return "<p>You have got "+n+" new "+action+"</p><p class='right' ><input type='button' value='View' class='special_btn rd_2_home' onclick='rd_2_home(this);' home-action='"+noty_action+"'/>";
}

function rd_2_home(obj){
window.location.href=doc_home+"?noty_action="+$(obj).attr('home-action');
close_noty($(obj));
}

function close_noty(obj){
obj.parents('.i-am-new:first').slideDown("slow",function(){
$(this).remove();
});
}


function generate_noty(text,type,layout,timeout){
if(!layout)layout="bottomLeft";
if(!timeout)timeout=10000;

var n = noty({
  		text: text,
  		type: type,
      dismissQueue: true,
      	layout: layout,
  		theme: 'defaultTheme',
closeWith:['button'],timeout:timeout
});
}
function mtos_msg(obj){
var mcookie="mtos_msg";
if(!checkCookie(mcookie) && parseInt(obj)!=0)
{
apprise(obj);
setCookie(mcookie,Math.round(+new Date()/1000),"1");
}
}

function update_notifications(a){



var total_news=parseInt(inner("total_news"))+parseInt(a.news),
total_reqs=parseInt(inner("total_req"))+parseInt(a.in_req),
total_ar=parseInt(inner("total_atr_req"))+parseInt(a.atr_req),
total_nudges=parseInt(inner("unviewed_nudges"))+parseInt(a.nudges),
total_msgs=parseInt(inner("total_msgs"))+parseInt(a.msgs),
total_notis=total_news+total_reqs+total_ar+total_nudges+total_msgs;
update_total_noti_count(total_notis);
$("#total_news").html(total_news);setCookie("n_ns",$("#total_news").html(),"7");
if(parseInt(a.news)>0){highlight_el($("#total_news").parents("p:first"))}$("#total_req").html(total_reqs);setCookie("n_in",$("#total_req").html(),"7");
if(parseInt(a.in_req)>0){$("#req_count").html(parseInt(inner("req_count"))+parseInt(a.in_req));if(el("invitation").onclick==null||$("#invitation").attr("onClick")==undefined||$("#invitation").attr("onClick")==""){el("invitation").setAttribute("onclick","receive_invitetionFiles();")}highlight_el($("#total_req").parents("p:first"))}$("#total_atr_req").html(total_ar);setCookie("n_ar",$("#total_atr_req").html(),"7");
if(parseInt(a.atr_req)>0){atr_count+=parseInt(a.atr_req);if(el("atr_rqst").onclick==null||$("#atr_rqst").attr("onClick")==undefined||$("#atr_rqst").attr("onClick")==""){el("atr_rqst").setAttribute("onclick","receive_atr_req();")}highlight_el($("#total_atr_req").parents("p:first"))}$("#unviewed_nudges").html(total_nudges);setCookie("n_n",$("#unviewed_nudges").html(),"7");
if(parseInt(a.nudges)>0){highlight_el($("#unviewed_nudges").parents("p:first"))}$("#total_msgs").html(total_msgs);setCookie("n_m",$("#total_msgs").html(),"7");
if(parseInt(a.msgs)>0){$("#unviewed_msgs").html(parseInt(inner("unviewed_msgs"))+parseInt(a.msgs));$("#msgcount").html(a.msgs);if(el("mbox").onclick==null||$("#mbox").attr("onClick")==undefined||$("#mbox").attr("onClick")==""){el("mbox").setAttribute("onclick","receive_msg();")}highlight_el($("#total_msgs").parents("p:first"))}if(parseInt(a.lu_points)>0){update_points(a.lu_points)}if(parseInt(a.lp_limit.l2)>0){
$.post("get_posts.php" ,{ start: a.lp_limit.l1, end:a.lp_limit.l2,order_filter:"true"},function(data){

if($.trim(data).length){

p_start+=a.lp_limit.l2;

var d=process_posts2insert(data);

if(d){
d=$(d);
$("#hp-sv-tabs-1").prepend(d);
$(vars['hp_post_container']).first().hide().slideDown("slow");
d.effect("highlight");
attach_hovercard();

}


}

});
}
mtos_msg(a.mtos)
}

function process_posts2insert(posts){

var output="",
first_post_elm=$(vars['hp_post_container']+":first"),
first_post_ts=first_post_elm.length?parseInt(first_post_elm.attr('ts')):0;

$(wrap_in_div(posts)).find(vars['hp_post_container']).each(function(){

var $this=$(this);

if(!$("#"+$this.attr("id")).length && parseInt($this.attr("ts"))>first_post_ts){

output+=elm_whole_html($this);

}

});

return output.length?output:false;

}

function elm_whole_html(elm_){

return $("<div />").append(elm_.clone()).html()
}

function wrap_in_div(content_){

return "<div>"+content_+"</div>";

}

function highlight_el(a){a.addClass("gold").effect("pulsate", { times:3 }, 2000,function(){a.removeClass("gold")});}setInterval(user_online,60000);Array.prototype.findIndex=function(d){var c="";for(var e=0;e<this.length;e++){if(this[e]==d){return e}}return c};function autolink(f,e){e=e||{};var h="";for(name in e){h+=" "+name+'="'+e[name]+'"'}var g=new RegExp("(\\s?)((http|https|ftp)://[^\\s<]+[^\\s<.)])","gim");f=f.toString().replace(g,'$1<a target="_blank" href="$2"'+h+">$2</a>");return f}function current_date(){var n=new Date(),j=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"),g=j[n.getDay()],k=new Array("th","st","nd","rd","th","th","th","th","th","th"),o=l+(n.getDate()<10)?"0"+n.getDate()+k[n.getDate()]:n.getDate()+k[parseFloat((""+n.getDate()).substr((""+n.getDate()).length-1))],e=new Array("January","February","March","April","May","June","July","August","September","October","November","December"),d=e[n.getMonth()],m=n.getFullYear(),i=n.getHours()>12?n.getHours()-12:(n.getHours()<10?"0"+n.getHours():n.getHours()),c=n.getMinutes()<10?"0"+n.getMinutes():n.getMinutes(),h=n.getSeconds()<10?"0"+n.getSeconds():n.getSeconds(),f=n.getHours()>12?"PM":"AM";var l=i+":"+c+"."+h+f+" "+g+" "+o+" of "+d+", "+m;return l}function get_points(){return $("#points_digit").html().replace("+","")}function checkInput(d){var c=/[^0-9]/gi;if(c.test(d.value)){d.value=d.value.replace(c,"")}if(d.value>parseInt(get_points())){d.value=parseInt(get_points())}}function update_points(c,d,e){if(c){c=parseInt(c);if(!d){d="add"}$(".points_count").effect("pulsate", { times:3 }, 1000);if(d=="add"){$(".points_digit").html("+"+(parseInt(get_points())+c))}else{$(".points_digit").html("+"+(parseInt(get_points())-c))}}if(e){
$.post(core,{core_action:"setters",core_file:"update_points.php",points:c,action:d},function (d){if(parseInt(d)!=1)alert("Error: failed to update points");});}}

function update_total_noti_count(total_){
var elm_=$(".noti-title");

elm_.attr("total",total_);

pop_section_show_total(elm_);
}

function create_special_div(css,origin){

gritter_opacity(".2");
var id_="display_post_div";
if($("#"+id_).length){
remove_special_div();
}
$('body').append("<div id='sd-poup-wrap'><div id='sd-popup-overlay' class='native-overlay'></div><div id='"+id_+"'><div class='loading2'>"+loading+"</div></div></div>");
$("#sd-popup-overlay").click(function(){display_post_close();}).css("height",$(document).height()+"px");
var d=document.createElement("img");
d.onclick=function(){
display_post_close()};
d.src=get_image("close.png");
d.title="Close";
d.setAttribute("class","display_post_close pointer");
$("#"+id_).append(d);Centralize_el(id_);
if(css){
$("#"+id_).css(css);
}

if($.isFunction($.fn.draggable)){
$("#"+id_).draggable({cursor: "move"});
}

if(origin){
animate_special_div(origin);
}
}


function animate_special_div(origin_elm){
var popup=$(vars['display_post_div']),
pos=origin_elm.offset(),
popup_width=popup.css("width"),
popup_height=popup.css("min-height"),
popup_pos=popup.offset(),
popup_top=popup_pos.top,
popup_left=popup_pos.left;
popup.css({top:pos.top+"px",left:pos.left+"px",width:"0px","min-height":"0px"})
.animate({
top:popup_top,
left:popup_left,
width:popup_width,
minHeight:popup_height,
});
}


function fade_bg(){
if($("#body").length){
$("#body").css("opacity",".2");
}
}

function check_jeditable_field(d){
var l=$.trim(d.find('textarea[name="value"]').val()).length;
if(!l){alert("Please don't leave it blank")};
return !l?false:true;
}

function put_progress(msg){
fade_bg();
if(!$("#uploading").length){
$('body').append("<div id='uploading'></div>");
}
$("#uploading").css("visibility","visible").show().html("<img src='picon1.gif'>"+msg);
Centralize_el("uploading");
}
function hide_progress(){
if($("#uploading").length){
$("#uploading").css("visibility","hidden");
}
}

function append_to_special_div(b){$("#display_post_div").find(".loading2").remove();$("#display_post_div").prepend(b);Centralize_el("display_post_div");}$(".display_post_close").live("click",function(){display_post_close()});
function display_post_close(animation_speed){
if($("#display_post_div").length){
$("#display_post_div").hide((animation_speed?animation_speed:"slow"),function(){
remove_special_div();
})
}
}

function remove_special_div(){
$("#sd-poup-wrap").remove();
$("#body").css("opacity","1");
vars['hc_scrollable-elm']=false;gritter_opacity("1");
}


function Centralize_el(id,hor,ver){
if(!hor)var hor=true;
if(!ver)var ver=false;
var $loading = $("#"+id);
var windowH = $(window).height();
var windowW = $(window).width();
if(hor)
$loading.css({
 left: ((windowW - $loading.outerWidth())/2 + $(document).scrollLeft())
});
if(ver){
$loading.css({
 left: ((windowW - $loading.outerHeight())/2 + $(document).scrollTop())
});
}
}function close_cluetip(){
$("#cluetip").css("display","none");
}

function gritter_opacity(opacity){
var elm=".sticky_notice";
if($(elm).length){
$(elm).css("opacity",opacity);
}
}


function attach_hovercard(){
$(".dui").each(function(){

if($(this).attr('class').indexOf('hc-name')==-1){

$(this).hovercard({
        
detailsHTML: hoverUserDetails,
        width: 480,
        onHoverIn: function () {$(".hover-details").empty();

           $.ajax({
  url: "displayuserinfo.php",
 data:{id:$(this).children('a').attr('data-hovercard-id')},
                type: 'POST',
                beforeSend: function () {
                    $(".hover-details").prepend('<p class="loading-text">'+loading+'</p>');
                },
                
success: function (data) {
 
                   $(".hover-details").empty();
 
                   $(data).appendTo(".hover-details");



adjust_hc();


	
                },
               
 complete: function () {
                    
$('.loading-text').remove();
              
  }
            });
        }
    });
}

});
}




function adjust_hc(){

if(vars['hc_scrollable-elm'] && vars['hc_scrollable-elm'].hasHorizontalScrollBar()){
$(".hc-details").each(function(){
if($(this).css("display")!="none"){
var hc_name=$(this).parents(".hc-preview:first").find(".hc-name");
hc_name.css("min-width","100px");
$(this).css("left",(parseInt($(this).css("left").split("px")[0])-$(this).width()+hc_name.width())+"px");
return;
}
});
}
}
function manipulate_hc_content(el,action){
if(!action)var action="basic";
var par=$(el).parents('.hc-details:first');
par.addClass("shv_loading");
par.html(loading);
if(action=="basic"){var url="displayuserinfo.php";par.css("min-width","450px");}else {var url="sbox_content.php";par.css("min-width","680px");}
$.post(url,{id:$(el).attr('user-id'),hover_view:"true"},function(d){par.removeClass("shv_loading");par.html(d);});
}


function check_in(el,vuid,vu_gen){
el.style.background="red";
el.value="Cancel notification";
el.onclick=function(){check_out(el,vuid,vu_gen);};
$.post("post_check_in_out.php",{action:"notify",id:vuid},function(d){if(parseInt(d)!=1)alert("Error:failed to send notification");});
}

function check_out(el,vuid,vu_gen){
if(vu_gen=="female"){var h='her';}else {var h='him';}
el.style.background="green";
el.value="Notify "+h+" about this visit";
el.onclick=function(){check_in(el,vuid,vu_gen);};
$.post("post_check_in_out.php",{action:"cancel",id:vuid},function(d){if(parseInt(d)!=1)alert("Error:failed to cancel notification");});
}
function del_cookie(name){document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';}
function drop_pic_menu()
{
	var elm = $(document).find('.menu_profile li[class!=unhide]');
	elm.each(
	function(){
	if($(this).css('display')=='none')
	{
		$(this).show();
	}
	else
	{
		$(this).hide();
	}
	}
	);
}function hide_drop_down(elm_){
$(j_selecter["uo-dropdown"]+" div").hide();
$(j_selecter["uo-down-tip"]).show();
elm_.removeClass(prepare_class(j_selecter["highlight-prof-pic"]));
}
function prepare_class(c_name){
return c_name.replace(".","");
}function hp_views_RAC(){
$(".hp-main-view-btns").each(function(){
var active_class=$(this).attr("id")+"_active";
if($(this).attr("class").indexOf(active_class)!=-1){
$(this).removeClass(active_class);
sh_me($(this).attr("relates-to"),"hide");
}
});
}function sh_me(str,action){
var arr=str.split(" ");
for(var i=0;i<arr.length;i++){
if(action=="hide"){
$("."+arr[i]).hide();
}
else {
$("."+arr[i]).animate({width:"show"});
}
}
}function set_main_page_view(view)
{
w.postMessage("update_entity entity=home_main_view&value="+view);
w.onmessage=function(e){
if(parseInt(e.data)!=1)alert("Error: failed to set home page's main view");
};
}
function check_blue_hover(){

$(".blue-hover").removeClass("active");

$(".blue-hover").each(function(){

if($(this).attr("class").indexOf("active")!=-1){

$(this).addClass("active");

}

else {

$("."+$(this).attr("relates-to")).hide();

}


});

}

function unique_number(){

	return new Date().getUTCMilliseconds();
}
$(".show_expand_rel").live("click",function(){
to_top();
create_special_div({},$(this));
$('#body').css("opacity",".2");

w.postMessage("content_find_person ");
w.onmessage=function(e){

append_to_special_div(e.data);

put_point_box();
};
});
function put_point_box(){
append_to_sd(get_points_box());
}
function to_top(){
$('html, body').animate({scrollTop:0}, 'slow');
}
function get_points_box(){
return "<div class='points_count add_title' style='position:absolute;right:1px;top:1px;'><span class='points_digit'>+"+get_points()+"</span><div class='spend_it underline_onHover hidden'>Spend it</div></div>";
}
function append_to_sd(content){
$("#display_post_div").append(content);
}




$(document).on("click",".hp_spend_points_div .find_btn",function(){




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

vars['hc_scrollable-elm']=$(".find_person_div");

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
p.append("<div style='position: relative; width: 0; height: 0'><div class='fp_send_invitation strip_back'><div class='fl'><b>How do you know "+p.find(".fp_hh").html()+"?</b><p><input type='radio' name='fp_invite_type' value='friend'>Friend<br/><input type='radio' name='fp_invite_type' value='family'>Family<br/><input type='radio' name='fp_invite_type' value='col'>Colleague<br/><input type='radio' name='fp_invite_type' value='aqu'>Aquaintance<br/><input type='radio' name='fp_invite_type' checked='checked' value='no'>No Prior Aquaintance</p><p><img style='position:relative;top:-5px;' src='images/spend.png' align='middle' width='20'/>Offer "+p.find(".fp_hh").html()+" <input class='blue_onhover offer_point_field' type='text' onkeyup='checkInput(this)' size='2'/> points</p><p><input type='button' value='Invite Now' class='special_btn fp_invite_btn1'/>&nbsp;<input type='button' value='Cancel' class='special_btn redback fp_close_popup'/></p></div><div class='fr'><img src='"+p.find(".fp_prof_pic").attr('src')+"' width='200' height='230'/></div><div class='clear'></div></div></div>");
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
d.html("<input type='button' value='Cancel Invitation' class='bttn redback fp_cancel_invite'/>");
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
d.html("<input type='button' class='bttn fp_invite_btn' value='Invite'/>");
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

//function to check if DnD is supported by client's browser

function is_dnd_supported(){
var div = document.createElement('div');
  return ('draggable' in div) || ('ondragstart' in div && 'ondrop' in div);
}


function create_sticky_popup(){
var id=vars['sticky-popup-id'];
if(!$("#"+id).length){
$('body').append("<div id='"+id+"'><div class='spp-top'><div class='fl spp-title'></div><div class='fr'><img title='Close' class='pointer spp-close-icon' onclick='close_sticky_popup()' src='"+get_image("close_black.gif")+"'/></div><div class='clear'></div></div><div class='spp-content'>"+loading+"</div></div>");
}
$("#"+id).hide().slideDown("slow");
}

function stick_popup_title(title){
$("#"+vars['sticky-popup-id']).find(".spp-title").html("<strong>"+title+"</strong>");
}

function close_sticky_popup(){
if($("#"+vars['sticky-popup-id']).length)$("#"+vars['sticky-popup-id']).remove();
}

function sticky_popup_onclose_function(funct_name){
$("#"+vars['sticky-popup-id']).find(".spp-close-icon").attr("onclick",funct_name+"()");
}

function sticky_popup_content(content){
$("#"+vars['sticky-popup-id']).find(".spp-content").html(content);
}

//function to check if an element is visible in view port

$.fn.isOnScreen = function(){
     
    var win = $(window);
     
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
     
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
     
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
     
};


//custome code and functions placed in global context

var hc_to_show='';

$(".share_pic").live("click",function(){if(!el('big_pic'))$('body').append("<div id='big_pic' class='hidden'></div>");
if($(this).attr("show-image")!=undefined && $(this).attr("show-image").length){
var img_src=$(this).attr("show-image");
}
else {
var img_src=$(this).attr("src");
}
el("big_pic").innerHTML="<img src='"+img_src+"'>";
show("big_pic");$("#big_pic").hide();$("#big_pic").show("slow");el("big_pic").title="Click to scale it back down";
if($(this).parents('.hc-details:first').length){
hc_to_show=$(this).parents('.hc-details:first');
}});$("#big_pic").live("click",function(){$("#big_pic").hide("slow",function(){hide("big_pic");if(hc_to_show){hc_to_show.css("display","block");hc_to_show.mouseenter();}})});$(document).on("mouseenter",j_selecter["prof_pic"],function(){
$(j_selecter["uo-dropdown"]+" div").show();
$(j_selecter["uo-down-tip"]).hide();
$(this).addClass(prepare_class(j_selecter["highlight-prof-pic"]));
}).on("mouseleave",j_selecter["prof_pic"],function(){
var elm_this=$(this);
setTimeout(function(){
if(!$(j_selecter["uo-dropdown"]).is(':hover')){
hide_drop_down(elm_this);
}
},200);
}).on("mouseleave",j_selecter["uo-dropdown"],function(){
setTimeout(function(){hide_drop_down($(j_selecter["prof_pic"]));
},500);
}).on("mouseenter",j_selecter["uo-down-tip"],function(){
$(j_selecter["prof_pic"]).mouseenter();
}).on("click",".hp-main-view-btns",function(){
$('html, body').animate({scrollTop:0}, 'slow');
hp_views_RAC();
$(this).addClass($(this).attr("id")+"_active");
sh_me($(this).attr("relates-to"),"show")
if($(this).attr("page-view")!=undefined && $(this).attr("page-view")!="none")
set_main_page_view($(this).attr("page-view"));
if($(this).attr("callback")!=undefined)
window[$(this).attr("callback")]();
}).on("click",".click-anchor",function(){
window.location.assign($(this).find("a").attr('href'));
});$(".smd-movie").live("click",function(){
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
$.fn.HasScrollBar = function() {
    var _elm = $(this)[0];
    var _hasScrollBar = false; 
    if ((_elm.clientHeight < _elm.scrollHeight) || (_elm.clientWidth < _elm.scrollWidth)) {
        _hasScrollBar = true;
    }
    return _hasScrollBar;
}
$.fn.hasVerticalScrollBar = function () {
  if (this[0].clientHeight < this[0].scrollHeight) {
    return true
  } else {
    return false
  }
} 

$.fn.hasHorizontalScrollBar = function() {
  if (this[0].clientWidth < this[0].scrollWidth) {
    return true
  } else {
    return false
  }
} 

$(document).on("click",".click-anchor",function(){
window.location.assign($(this).find("a").attr('href'));
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

function close_pfoc(id)
{
$("#"+id).hide("slow");
$("#"+id).removeClass("fboc_visible");
$("#"+id).unbind('clickoutside');
}
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
$(".comnts_to_posts").live("click",function(){
/*var p_id=$(this).parents('.hp_post_container:first').attr('id');
var cc=$(this).parents('.hp_post_container:first').find(".cmnts_to_post_container");
cc.html("<div class='ctpc_child'><table><tr><td><textarea class='flexible_textarea shaded_textarea cmnt_textarea'></textarea></td><td><input type='button' value='Comment' class='pointer special_btn pctp_btn'/></td></tr></table></div>");*/
$(this).parents('.hp_post_container:first').find(".cmnts_to_post_container").css("display","block");
});
$(".cmnt_textarea").live("focus",function(){
cmnt_post_focus_inout($(this));
}).live("focusout",function(){
if(!trim($(this).val()))
cmnt_post_focus_inout($(this),"out");
});
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

$(".pctp_btn").live("click",function(){
var p_id=$(this).parents('.hp_post_container:first').attr('id');
var cc=$(this).parents('.hp_post_container:first').find(".ctpc_child");
var text=trim($(this).parents('.hp_post_container:first').find(".cmnt_textarea").val());
$(this).parents('.hp_post_container:first').find(".cmnt_textarea").val("");
if(!text){
apprise("Please write something as your comment");
return;
}

cc.before("<div class='cmnt2post_block'><div class='cmn2post_top'><div align='right'><span title='Delete' class='red_onhover pointer remove_p_cmnt none'>&#215</span></div></div><div class='fl left'><a href='"+vars['lu_profile']+"'><table><tr><td><img src='"+vars['lu_dp']+"'/></td><td valign='top'>"+vars['lu_name']+":</td></tr></table></a></div><div class='fr right'>"+autolink(htmlEntities(trim(text))).replace(/\n/g,'<br />')+"</div><div class='clear'></div><div class='light_text small hp_cmnt_time'>"+current_date()+"</div></div>");
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
$(".pbar4posts_anchor").live("click",function(){
$("#body").css("opacity",".2");
$("#fback_statistic_post").css({"display":"block","visibility":"visible"});
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
function d_none(a){el(a).style.display="none"}function d_in(a){el(a).style.display="inline"}function d_block(a){el(a).style.display="block"}
$(".pv_edit").live("click",function(){



var id=$(this).parents('.hp_post_container:first').attr('id');
p_block_id=id;

apprise("<div class='pv_wrapper pvw-edit'><h3><img src='"+get_image('post_visibility.png')+"' align='middle'/>Edit post visibility configuration</h3><div align='left' id='epvc_div'>"+loading+"</div></div> ",{"confirm":true,"textOk": "Update","takeControl":"save_pv_conf"});
w.postMessage("get_pv p_id="+id);
w.onmessage=function(e){
el('epvc_div').innerHTML=e.data;


format_checkbox($(".pvw-edit input[type='checkbox']"));



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
$(".yt-video").live("mouseenter",function(){
$(this).prettyPhoto({default_width:650});
});
$(".api-news-rfn-toggle").live("click",function(){
var elm=$(this);
$(this).parents(".attachment-sta-api-news:first").find(".api-news-rfn-content").toggle('slow');
});

$(".api-news-rfn-clp").live("click",function(){
$(this).parents(".api-news-rfn-content:first").slideUp("slow");
});

$(".smd-video").live("click",function(){
$(this).parents(".api-video-content:first").find(".yt-v-des").toggle("slow");
});

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
el.onmouseout=function(){changecss(0,'.hp_post_container','background',cv);};
$(el).parent().prev().click();
w.postMessage("update_entity entity=post_block_back&value="+cv);
w.onmessage=function(e){if(parseInt(e.data)!=1)apprise("<font color='red'>Error: failed to update post block background color</font>");};
}
function show_post(post_id){

	create_special_div();
        $(document).scrollTo("body");
        $.post("display_post.php",{p_id:post_id},function(d){
	append_to_special_div(d);
	});

}
$(document).on("click", ".promote-post-btn", function () {

    var post_id = get_post_container($(this), true),
        content_container = ".pp-content";

    $.scrollTo("#" + post_id, {
        offset: {
            top: -110
        }
    });

    fade_bg();

    create_special_div({
        "top": ($(this).offset().top - 70) + "px"
    });


    $.post("modules/post_promotion/index.php", {
        "post_id": post_id
    }, function (d) {

        append_to_special_div(d);

        put_point_box();

        $("#pp-tabs").tabs({
		
	    cache:true,

            load: function (event, ui) {

                $(content_container).niceScroll({
                    cursorcolor: "grey"
                });

                vars['hc_scrollable-elm'] = $(ui.panel).find(content_container);

                attach_hovercard();

            }

        });

    });



}).on("click",".pp-choose-user-btn",function(){

pp_choose_user($(this),true);

}).on("click",".pp-choose-all",function(){

var checkbox=$(this).find("input[type=checkbox]"),points=0;

$(this).parents(".pp-content:first").find(".pp-choose-user-btn").each(function(){

points+=pp_choose_user($(this));

});


if(checkbox.is(":checked")){

checkbox.prop('checked',false);

update_points(points);

}

else {

checkbox.prop('checked',true);

update_points(points,"deduce");

}


});

function get_post_container(elm_, id) {

    var par = elm_.parents('.hp_post_container:first');

    return id ? par.attr('id') : par;

}

function pp_choose_user(elm,updatePoints){


var $this=elm,
par =$this.parents(".pp-user-block:first"),
points=parseInt(par.find(".pp-user-rp").html()),
post_id=$this.attr("post-id"),
uid=$this.attr("uid");

if($this.text()=="Choose"){
if(get_points()<points){
apprise("Sorry, you don't have enough points to choose this user.");
return points;
}
var label_text="Chosen",
btn_text="Cancel",
action="add";
if(updatePoints)update_points(points,"deduce");
}

else {

var label_text="Choose",
btn_text="Choose",
action="deduce";
if(updatePoints)update_points(points);

}
$this.toggleClass("red_bg");
par.find(".pp-chosen-label").html(label_text);
$this.text(btn_text);

$.post(core,{

core_action:"setters",
core_file:"pp_set_post.php",
post_id:post_id,
uid:uid,
points:points,
action:action

},function(d){
if(parseInt(d)!=1)alert("Error: failed to promote post");
});

return points;

}

function image_tag(image_,style_){

if(!style_){
var style_="height:20px;width:20px";
}

return "<img style='"+style_+"' src='"+get_image(image_)+"'/>";

}

function is_json(obj){
return typeof obj =='object';
}

function dis_en(elm_,enable){

if(enable){
     elm_.removeAttr('disabled');
}

else {
elm_.attr('disabled','disabled');

}

}

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
}



function progress_status(elm_,content_){
var class_="progress-status";if(!$("."+class_).length){elm_.after("<div class='no_wh inline'><span class='"+class_+"'></span></div>");}
$("."+class_).html(content_);}

function loading_(style_){return img_tag("picon1.gif",style_);}
function tick_mark(style_){return img_tag(get_image("checkmark.gif",style_));}
function img_tag(src_,style_){var style_=style_?style_:"height:20px;width:20px";return "<img src='"+src_+"' style='"+style_+"'>";}

function create_welcome_div(welcome_note){

var id_="welcome_div";

$('body').append("<div id='welcome-popup-container'><div id='wpc-overlay'></div><div id='"+id_+"'></div></div> ");

$("#"+id_).addClass("background2").html("<div align='right'><span class='red_onhover' onclick='close_welcome("+welcome_note+");' title='Close'>&#215;</span></div><div class='welcome-note' id='"+vars['note_container_div']+"'><h3>"+loading+"</h3></div>");Centralize_el(id_);

if($.isFunction($.fn.draggable)){
$("#"+id_).draggable({cursor:"move"})}
$("#wpc-overlay").bind("click",function(){
close_welcome(welcome_note)
}).css("height",$(document).height()+"px");

}

$(document).on("click",".wn-save-cats-btn",function(){

var cats=new Array(),elm_=$(this);

$(vars['wn-cat-checks']).each(function(){

var $this=$(this);

if($this.is(":checked")){

cats.push($this.val());

}

});

progress_status(elm_,loading_()+" &nbsp;Saving...");

$.post(core,{core_file:"set_cats.php",core_action:"setters",cats:cats.join(",")},function(d){

if(parseInt(d)==1){

progress_status(elm_,tick_mark()+" Saved");


}


else {

elm_.html("Try again");

}

});

}).on("click",".wn-cat-select-box",function(){

icheck_uncheck($(this).find("input[type=checkbox]"));

});

function load_cats(put_next){

$.post(core,{core_file:"get_post_cats.php",core_action:"getters",put_next:(put_next?true:"")},function(d){

$("#"+vars['note_container_div']).hide().html(d).show("slow");

    format_checkbox($(vars['wn-cat-checks']));
});
}

function load_hobbies(){

var par_=$("#"+vars['note_container_div']);

  $.post(core,{core_file:"get_hobbies.php",core_action:"getters"},function(d){

par_.html(d);

format_checkbox(par_.find("input[type=checkbox]"));

load_more_hobbies_init();

});  

}

function format_checkbox(elm_){

elm_.iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-red',});

}

function close_welcome(welcome_note){
$("#welcome-popup-container").hide("slow",function(){
el("body").style.opacity="1";
$(this).remove();
if(welcome_note){
$("#joyRideTipContent").joyride({
postRideCallback:function(){
if(!vc_clicked){highlight_vc()}
get_invite_popup()}})
}
})
}
function check_image_file(file_elm_id){
if(!validpic($("#"+file_elm_id).val())){
apprise("Please choose a valid image file to upload");
return false;
}
return true;
}

function icheck_uncheck(in_){

if(in_.is(":checked")){
in_.iCheck('uncheck');
}

else {
in_.iCheck('check');
}


}

function create_native_popup(){

$('body').append("<div id='native-popup-wrap'><div id='native-popup-overlay'></div><div id='native-popup' class='native-popup left'><div class='top-section'><div class='fl title'>Loading</div><div class='fr'><span title='Close' class='close-native-popup pointer'>&#10060</span></div><div class='clear'></div></div><div class='content'>"+loading+"</div></div></div>").addClass("no-scroll");

Centralize_el("native-popup");

if($.isFunction($.fn.draggable)){
$("#native-popup").draggable({cursor:"move"})}

}

$(document).on('click','.close-native-popup,#native-popup-overlay',function(){

close_native_popup();

}).on('click','.trigger-click',function(){

if(document.URL.indexOf("home.php")!=-1){

var elm_=$("#"+$(this).attr('id-to-click'));
if(elm_.length)elm_.click();

return false;

}

});


function native_popup_content(title,content_){

var par_=$("#native-popup");

par_.find(".title").html(title);

par_.find(".content").html(content_);

Centralize_el("native-popup");
}


function close_native_popup(){

$("#native-popup-wrap").fadeOut("fast",function(){

$(this).remove();

});

$("body").removeClass("no-scroll");

}