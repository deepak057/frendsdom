var w=new Worker("w_visit.js"),loading="<img src='picon1.gif'>Loading......";preload(["like.bmp", "hate.bmp", "dislike.bmp","love.bmp","awesom.bmp","alterd.bmp","best.bmp","stupid.bmp","likeminded.bmp","picon1.gif"]);

function show_fback_option(div_id)
{

if(!el('fback_options'))
{

var d=document.createElement("div");

d.setAttribute('style',"position:relative;top:-40px;");
d.setAttribute('class','plain_back');
d.id='fback_options';
var arg1='"'+div_id+'","like"',arg2='"'+div_id+'","dislike"',arg3='"'+div_id+'","love"',arg4='"'+div_id+'","hate"',arg5='"'+div_id+'","stupid"',arg6='"'+div_id+'","awesom"',arg7='"'+div_id+'","best"',arg8='"'+div_id+'","no"';
d.innerHTML="<span class='red_onhover' style='float:right;' title='Close' onclick='close_feedback();'>&#215;</span><ul class='f_options'><li onclick='get_feedback("+arg1+");'><img src='like.bmp' height='20' width='20'>You liked this website</li><li onclick='get_feedback("+arg2+");'><img src='dislike.bmp' height='20' width='20'>You disliked this website</li><li onclick='get_feedback("+arg3+");'><img src='love.bmp' height='20' width='20'>You loved this website</li><li onclick='get_feedback("+arg4+");'><img src='hate.bmp' height='20' width='20'>You hated this website</li><li onclick='get_feedback("+arg5+");'><img src='stupid.bmp' height='20' width='20'>You think the whole idea of this website is stupid</li><li onclick='get_feedback("+arg6+");'><img src='awesom.bmp' height='20' width='20'>You think the idea of this website is awesome</li><li onclick='get_feedback("+arg7+");'><img src='best.bmp' height='20' width='20'>You think this website is best</li><li style='margin-top:10px;' onclick='get_feedback("+arg8+");'><font color='red'> No feedback</font></li>";

el(div_id).appendChild(d);
$('#fback_options').hide();
$('#fback_options').show('slow');}
else {$('#fback_options').show('slow');}


}

function get_feedback(div_id,fback)
{
close_feedback();
el('lu_feedback').innerHTML=get_feedback_string(fback);

if(fback!='no'){if(!el('fback_pic')){var img1=document.createElement("img");img1.setAttribute("id","fback_pic");img1.setAttribute('style','position:relative;top:8;right:-5;');el('response_h').appendChild(img1);}

el('fback_pic').src=fback+".bmp";show('fback_pic');}else{hide('fback_pic');}

w.postMessage("fback_onWebsite fback="+fback);
w.onmessage=function(e){if(parseInt(e.data)!=1){el('lu_feedback').innerHTML="<font color='red'>Failed to save your feedback</font>";}else apprise(get_alertText(fback),{"animate":true});};

}

function get_alertText(fback)
{
switch(fback)
{
case "like":
return "Thank you a lot for liking this website! \n Feedback like this keeps us motivated";
break;
case "dislike":
return "Well you may dislike this website. It will grow and get mature. We are working hard to get it up to your expectations";
break;
case "love":
return "It's quite natural for us to love those who love this website. We are working hard to make you love it even more.Thank you!!";
break;
case "hate":
return "Thank you for your feedback !!\nPlease let us know what made you hate this website and we'll surely look into it .";
break;
case "stupid":
return "Thank you for your feedback !!\nPeople think differently, what is great for you may be stupid for others...Right??";
break;
case "awesom":
return "Thank you very much for your feedback! If you liked it this much then there must be something special about this website";
break;
case "best":
return "Thank you a lot for making us proud by calling it best.";
break;
default:
return "No feedback from you";
break;
}
}

function fback_from(id,fback){if(fback=="all"){el('fback_from').style.right="450px";el('fback_from').innerHTML=loading;show('fback_from');w.postMessage("fbackFrom4Website id="+id+"&fback="+fback);w.onmessage=function(e){el('fback_from').innerHTML=e.data;}}else alert("Invalid feedback value");}


$(function(){$(".fback_from1").live("mouseenter",function(){$(this).hovercard({showCustomCard: true ,customCardJSON:JSON.parse(responsetext("id="+$(this).attr('id'),"displayuserinfo2.php")),onHoverOut :function() {$(this).hovercard({detailsHTML:''});}});})});$(".fback_from1").live("mouseleave",function(){$(".fback_from1").die('mouseenter');$(".fback_from1").mouseenter(function(){$(this).hovercard({showCustomCard: true ,customCardJSON:JSON.parse(responsetext("id="+$(this).attr('id'),"displayuserinfo2.php")),onHoverOut :function() {$(this).hovercard({detailsHTML:''});}});});});
function hide_fbackfrom(){hide('fback_from');el('fback_statistic').style.opacity="1";}


sessionStorage.setItem('comment_count', '0');var cmnt = parseInt(sessionStorage.getItem('comment_count'));

function show_profileComments(id,refresh){
show('profile_comments');
el('profile_comments').innerHTML=loading;$('#profile_comments').show();
el('total_comments').title="refresh";
if(refresh)
{

var total=inner('total_comments').split(" ");

if(parseInt(total[0])>0)
cmnt=parseInt(total[0]);
else
cmnt='no_comment';
}

w.postMessage("get_websiteComments id="+id+"&n="+cmnt);w.onmessage=function(e){el('profile_comments').innerHTML=e.data;}}

function close_comment(){$('#profile_comments').hide("slow");if(el('comment_colorlistContainer'))hide('comment_colorlistContainer'); }

function colorlist4comment(id)
{

var p=$("#profile_comments").offset();
$("#comment_colorlistContainer").css({"top":p.top+"px","left":(p.left-124)+"px"});
if(el('comment_colorlistContainer'))
show('comment_colorlistContainer');
if(id)
{
el('comment_colorlistContainer').innerHTML=loading;
w.postMessage("getcolor4profileComments id="+id);
w.onmessage=function(e){
el('comment_colorlistContainer').innerHTML=e.data;
}

}

else 
{
$('#comment_colorlistContainer').slideDown("slow");
}

el('comment_clist').innerHTML="&#8711";
el('comment_clist').setAttribute("onclick","hide_colorlist4comment();");

}

function hide_colorlist4comment()
{
$('#comment_colorlistContainer').slideUp("slow");
el('comment_clist').innerHTML="&#916;";
el('comment_clist').setAttribute("onclick","colorlist4comment();");

}

function update_cm(default_color,color)
{
el("cm"+color).setAttribute("onmouseout","");
hide_colorlist4comment();
el('profile_comments').style.background=color;
w.postMessage("update_entity entity=comments_backg&value="+color);
w.onmessage=function(e){if(parseInt(e.data)!=1)el('profile_comments').style.background=default_color;
else changecss(1,'.comment','background',color);
}
}

$('.remove_cmt').live("mouseenter",function(){
show($(this).attr('id'));


});

$('.remove_cmt').live("mouseleave",function(){hide($(this).attr('id'));});


$('.bottom_border1').live("mouseenter",function(){

show("remove_"+$(this).attr('id'));

});

function get_profilecomments(direction,id)
{
if(direction=='prev')
cmnt-=15;
else cmnt+=15;
show_profileComments(id,false);
}


function post_comment(id,fromid,fromname,prof_picPath)
{

if(trim(document.getElementById('txt_comment').value).length>0)
{
var table=el("profile_comments");

var row=table.insertRow(getRowIndex("profile_comments","postcomment_tr"));
row.setAttribute("class","bottom_border");
var cell1=row.insertCell(0);
cell1.setAttribute("colspan","2");
cell1.innerHTML="<img src='"+prof_picPath+"' align='middle'>&nbsp;<a class='fback_from1' id='"+fromid+"' href='visit.php?id="+fromid+"'><b>"+fromname+":</b></a>&nbsp;"+splitLine(autolink(htmlEntities(trim(document.getElementById('txt_comment').value))),56).replace(/\n/g,'<br />');
var arg="post_commentonwebsite id="+id+"&comment="+encodeURIComponent(document.getElementById('txt_comment').value);
document.getElementById('txt_comment').value='';document.getElementById('txt_comment').setAttribute("style","height:25px;width:450px;");document.getElementById('txt_comment').setAttribute("placeholder","Your comment");

w.postMessage(arg);
w.onmessage=function(e)
{
if(parseInt(e.data)!=1)
{
alert("Error: Failed to post the last comment");
}
else
{
el('total_comments').innerHTML=parseInt(inner('total_comments'))+1+" comments";
}
}
}

else
 alert("Your comment can not be empty");

}



function remove_cmt(table1,index)
{
var r=confirm("Proceed to removing comment?");
if(r)
{
el("profile_comments").deleteRow(getRowIndex("profile_comments","cmt"+index)) ;
el("profile_comments").deleteRow(getRowIndex("profile_comments","remove_cmt"+index)) ;
w.postMessage("remove_website_cmt table="+table1+"&index="+index);
w.onmessage=function(e){
if(parseInt(e.data)!=1)alert("Error: Failed to delete comment");
else
el('total_comments').innerHTML=parseInt(inner('total_comments'))-1+" comments";
}
}
}

function comments_from(id){
el('fback_from').innerHTML=loading;
show('fback_from');
w.postMessage("comments_from4website id="+id);w.onmessage=function(e){el('fback_from').innerHTML=e.data;}}

function close_feedback(){$('#fback_options').hide('slow');}
function get_feedback_string(fback){switch(fback){case "like":case "dislike":case "hate":case "love":return "You "+fback+" this website";break;case "stupid":case "awesom":return "You think the idea of this website is "+fback;break;case "best":return "You think this is the best website";break;default:return "No feedback from you";break;}}