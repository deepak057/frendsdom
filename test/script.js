var loading="<img src='picon1.gif'>Loading......",doc_home="/home.php",core="controller/core.php" ,inv_accepted=false,inv_from_id=0,hoverUserDetails = '<div class="hover-details"></div>',global_agent=null;

/***************new ****************/
$(document).on('click','.menu_profile',function(){
	drop_pic_menu();
});
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
}

/************new**************/
function get_document_name() {
        var file_name = document.location.href;
        var end = (file_name.indexOf("?") == -1) ? file_name.length : file_name.indexOf("?");
        return file_name.substring(file_name.lastIndexOf("/")+1, end);
    }

function makeHttpObject(){try{return new XMLHttpRequest();}catch(a){}try{return new ActiveXObject("Msxml2.XMLHTTP");}catch(a){}try{return new ActiveXObject("localhost.XMLHTTP");}catch(a){}throw new Error("Could not create HTTP request object.");}function el(a){return document.getElementById(a);}function responsetext(a,b){


var c=makeHttpObject();
c.open("POST",b,false);
c.setRequestHeader("Content-type","application/x-www-form-urlencoded");
c.send(a);


  if (c.readyState==4)
    {
    return c.responseText;
    }

}function validclip(a){if(a.length>0){if((a.substring(a.length-3)=="wav")||(a.substring(a.length-3)=="WAV")||(a.substring(a.length-3)=="Wav")){return true;}else{return false;}}}function validpic(a){if(a.length>0){if((a.substring(a.length-3)=="jpg")||(a.substring(a.length-3)=="gif")||(a.substring(a.length-3)=="Jpg")||(a.substring(a.length-3)=="JPG")||(a.substring(a.length-3)=="GIF")||(a.substring(a.length-3)=="PNG")||(a.substring(a.length-3)=="png")){return true;}else{return false;}}}function hide(a){el(a).style.visibility="hidden";}function show(a){el(a).style.visibility="visible";}function inner(a){return el(a).innerHTML;}function file_exists(b,c){if(c="js"){var d=document.scripts;for(var a=0;a<d.length;a++){if(d[a].src==b){return true;break;}}}else{if(c="css"){var d=document.styleSheets;for(var a=0;a<d.length;a++){if(d[a].href==b){return true;break;}}}}};function 

trim(s){var l=0; var r=s.length -1;while(l < s.length && s[l] == ' '){l++; }while(r > l && s[r] == ' '){r-=1;	}return s.substring(l, r+1);}function in_array(element,arr){for(var i=0;i<arr.length;i++){if(element==arr[i]){return true;break;}}return false;}function splitLine(st,n) {var b =''; var s = st;while (s.length > n) {var c = s.substring(0,n);var d = c.lastIndexOf(' ');var e =c.lastIndexOf('\n');if (e != -1) d = e; if (d == -1) d = n; b += c.substring(0,d) + '\n';s = s.substring(d+1);}return b+s;}function htmlEntities(str) {return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');}

function response_msg(str,color){
$("#success").bind('clickoutside', function(event){hidemsg();});
if(!color){ var color="green";}
el("success").innerHTML='<font color='+color+'>'+str+'</font>&nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="#">OK</a></spam>';
show('success');
}

function hidemsg(){$("#success").unbind('clickoutside');
hide("success");el("body").style.opacity="1";var request = new XMLHttpRequest();request.open("GET", "http://localhost/totalclips.php", false);request.send(null);if(request.readyState==4){if(request.responseText>=1){show("wavefilebutton");el("wavefilebutton").setAttribute("onclick","upldagain()");hide("player");show("listenbutton");}else{show("wavefilebutton");el("wavefilebutton").setAttribute("onclick","visible()");hide("player");show("listenbutton");}}}

function getRowIndex(tableid,rowid){for(var i=0;i<el(tableid).rows.length;i++){if(el(tableid).rows[i].getAttribute("id")==rowid){return i;break;}}}

function changecss(sheet_index,myclass,element,value) {var CSSRules; if (document.all) {CSSRules = 'rules'}else if (document.getElementById) {CSSRules = 'cssRules'}for (var i = 0; i < document.styleSheets[sheet_index][CSSRules].length; i++) {if (document.styleSheets[sheet_index][CSSRules][i].selectorText == myclass) {document.styleSheets[sheet_index][CSSRules][i].style[element] = value}}}

function setCookie(c_name,value,exdays)
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
}
function del_cookie(name)
{
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}



function create_ntf_cookies(n_ns,n_in,n_ar,n_n,n_m){
setCookie("n_ns",n_ns,"7");
setCookie("n_in",n_in,"7");
setCookie("n_ar",n_ar,"7");
setCookie("n_n",n_n,"7");
setCookie("n_m",n_m,"7");
}


function user_online()
{
var xmlhttp,$output=true,is_home=false;
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
xmlhttp.send("active=true");$output=false;
}
}
else{
xmlhttp.send("active=true&news="+getCookie("n_ns")+"&in_req="+getCookie("n_in")+"&atr_req="+getCookie("n_ar")+"&nudges="+getCookie("n_n")+"&msgs="+getCookie("n_m"));
}
if($output){
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
setInterval(user_online,6000);

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

function update_notifications(obj){
$("#total_news").html(parseInt(inner('total_news'))+parseInt(obj.news));
setCookie("n_ns",$("#total_news").html(),"7");
if(parseInt(obj.news)>0)highlight_el($("#total_news").parents('p:first'));
$("#total_req").html(parseInt(inner('total_req'))+parseInt(obj.in_req));
setCookie("n_in",$("#total_req").html(),"7");
if(parseInt(obj.in_req)>0){
$("#req_count").html(parseInt(inner('req_count'))+parseInt(obj.in_req));
if(el("invitation").onclick == null || $("#invitation").attr("onClick")==undefined || $("#invitation").attr("onClick")=="")
el("invitation").setAttribute("onclick","receive_invitetionFiles();");
highlight_el($("#total_req").parents('p:first'));}
$("#total_atr_req").html(parseInt(inner('total_atr_req'))+parseInt(obj.atr_req));
setCookie("n_ar",$("#total_atr_req").html(),"7");
if(parseInt(obj.atr_req)>0){
atr_count+=parseInt(obj.atr_req);
if(el("atr_rqst").onclick == null || $("#atr_rqst").attr("onClick")==undefined || $("#atr_rqst").attr("onClick")=="")
el("atr_rqst").setAttribute("onclick","receive_atr_req();");
highlight_el($("#total_atr_req").parents('p:first'));}
$("#unviewed_nudges").html(parseInt(inner('unviewed_nudges'))+parseInt(obj.nudges));
setCookie("n_n",$("#unviewed_nudges").html(),"7");
if(parseInt(obj.nudges)>0)highlight_el($("#unviewed_nudges").parents('p:first'));
$("#total_msgs").html(parseInt(inner('total_msgs'))+parseInt(obj.msgs));
setCookie("n_m",$("#total_msgs").html(),"7");
if(parseInt(obj.msgs)>0){
$("#unviewed_msgs").html(parseInt(inner('unviewed_msgs'))+parseInt(obj.msgs));
$('#msgcount').html(obj.msgs);
if(el("mbox").onclick == null || $("#mbox").attr("onClick")==undefined || $("#mbox").attr("onClick")=="")
el("mbox").setAttribute("onclick","receive_msg();");
highlight_el($("#total_msgs").parents('p:first'));
}
if(parseInt(obj.lu_points)>0)
update_points(obj.lu_points);
if(parseInt(obj.lp_limit.l2)>0){
$.post("get_posts.php" ,{ start: obj.lp_limit.l1, end:obj.lp_limit.l2,order_filter:"true"},function(data){
p_start+=obj.lp_limit.l2;
$("#status_container").after(data);
$(".hp_post_container").first().hide();
$(".hp_post_container").first().slideDown("slow");
});
}
}


function highlight_el(el){
el.addClass("gold").effect("highlight").effect("pulsate",function(){
el.removeClass("gold");
});
}


function preload(arrayOfImages) {$(arrayOfImages).each(function () {$('<img />').attr('src',this).appendTo('body').css('display','none');});}

Array.prototype.findIndex = function(value){var ctr = "";for (var i=0; i < this.length; i++) {if (this[i] == value) {return i;}}return ctr;};function autolink(str, attributes)
{
attributes = attributes || {};
var attrs = "";
for(name in attributes)
	attrs += " "+ name +'="'+ attributes[name] +'"';
var reg = new RegExp("(\\s?)((http|https|ftp)://[^\\s<]+[^\\s<\.)])", "gim");
str = str.toString().replace(reg, '$1<a href="$2"'+ attrs +'>$2</a>');
return str;
}




function current_date(){var objToday = new Date(),weekday = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),dayOfWeek = weekday[objToday.getDay()],domEnder = new Array( 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th' ),dayOfMonth = today + (objToday.getDate() < 10) ? '0' + objToday.getDate() + domEnder[objToday.getDate()] : objToday.getDate() + domEnder[parseFloat(("" + objToday.getDate()).substr(("" + objToday.getDate()).length - 1))],months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),curMonth = months[objToday.getMonth()],curYear = objToday.getFullYear(),curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes(),curSeconds = objToday.getSeconds() < 10 ? "0" + objToday.getSeconds() : objToday.getSeconds(),curMeridiem = objToday.getHours() > 12 ? "PM" : "AM";var today = curHour + ":" + curMinute + "." + curSeconds + curMeridiem + " " + dayOfWeek + " " + dayOfMonth + " of " + curMonth + ", " + curYear;return today;}

function get_points()
{
return $("#points_digit").html().replace("+","");
}
function checkInput(ob) {
var invalidChars = /[^0-9]/gi
if(invalidChars.test(ob.value)) {
ob.value = ob.value.replace(invalidChars,"");}
if(ob.value>parseInt(get_points())){
ob.value=parseInt(get_points());
}
}

function update_points(p,action,update_db){
if(p){
p=parseInt(p);
if(!action){
action="add";
}
$(".points_count").effect("highlight");
$(".points_count").effect("pulsate");
if(action=="add"){
$(".points_digit").html("+"+(parseInt(get_points())+p));
}
else{
$(".points_digit").html("+"+(parseInt(get_points())-p));
}  
}
if(update_db){
$.post(core,{core_action:"setters",core_file:"update_points.php",points:p,action:action},function (d){if(parseInt(d)!=1)alert("Error: failed to update points");});
}
}

function create_special_div()
{
if($("#display_post_div")){
$("#display_post_div").remove();
}
var d=document.createElement("div");
d.id="display_post_div";
d.innerHTML="<div class='loading2'>"+loading+"</div>";
document.getElementsByTagName('body')[0].appendChild(d);
var img=document.createElement("img");
img.onclick=function(){display_post_close()};
img.src="/close.png";img.title="Close";
img.setAttribute("class","display_post_close pointer");
d.appendChild(img);
}
function append_to_special_div(data)
{
$("#display_post_div").find(".loading2").remove();
$("#display_post_div").prepend(data);
}
function display_post_close()
{
$("#display_post_div").hide("slow",function(){
$(this).remove();
$('#body').css("opacity","1");
});
}

function close_cluetip(obj){
$("#cluetip").css("display","none");
}
function attach_hovercard(){
$(".dui").each(function(){
if($(this).attr('class').indexOf('hc-name')==-1){
$(this).hovercard({
        detailsHTML: hoverUserDetails,
        onHoverIn: function () {$(".hover-details").empty();
            $.ajax({
                url: "/displayuserinfo.php",
                data:{id:$(this).children('a').attr('data-hovercard-id')},
                type: 'POST',
                beforeSend: function () {
                    $(".hover-details").prepend('<p class="loading-text">'+loading+'</p>');
                },
                success: function (data) {
                    $(".hover-details").empty();
                    $(data).appendTo(".hover-details");
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


function manipulate_hc_content(el,action){
if(!action)var action="basic";
var par=$(el).parents('.hc-details:first');
par.addClass("shv_loading");
par.html(loading);
if(action=="basic")var url="displayuserinfo.php";else var url="sbox_content.php";
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

function create_light_menu(el_id,clickoutside){
   clickoutside = typeof clickoutside !== 'undefined' ? clickoutside : true;remove_lm();
$('body').append("<div class='light_menu left' id='light_menu'><span class='red_onhover' onclick='close_light_menu();' title='Close'>&#215;</span><div id='lm_content'>"+loading+"</div></div>");
$('#light_menu').css($("#"+el_id).offset());
sh_el('light_menu');
if(clickoutside)
$('#light_menu').bind('clickoutside', function(event){close_light_menu();});
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

function Centralize_el(id,hor,ver){
if(!hor)var hor=true;
if(!ver)var ver=false;
var $loading = $("#"+id);
var windowH = $(window).height();
var windowW = $(window).width();
if(hor)
$loading.css("left",((windowW - $loading.outerWidth())/2 + $(document).scrollLeft())+"px");
if(ver){
$loading.css({
 left: ((windowW - $loading.outerHeight())/2 + $(document).scrollTop())
});
}
}

function open_in_new_tab(url )
{
  window.open(url, '_blank').focus();
}



function get_assistants(){

$("#body").css("opacity",".2");

create_special_div();

$.post(core,{core_action:"getters",core_file:"get_assistants.php"},function(d){

append_to_special_div(d);

});
 

}

function update_entity(field,value){
$.post(core,{core_action:"setters",core_file:"update_entity.php",field:field,value:value},function(d){});
}

function load_assistant(char){

clippy.load(char, function(agent) {
        

	//global_agent=agent;
	
	agent.show();
	
	//var animations=agent.animations();

	/*for (a in animations){
	agent.speak(animations[a]);
	agent.play(animations[a]);
	}
	
	//agent.animate();

	agent.speak("Finished");
	agent.moveTo("100","100");
	//agent.play("Writing");
	//agent.gestureAt(1000,770);
*/
		
	call_agent(char,agent);

    	});



}

function get_agent(){

return global_agent?global_agent:false;

}

