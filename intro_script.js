var note_counter=0,intID,vc_clicked=false,pp;
$("#main_view_vc_right").live("click",function(){
vc_clicked=true;clearInterval(intID);$(this).fadeIn(100);
pp.destroyPointPoint()});
function RepeatCall(){
$("#main_view_vc_right").fadeIn(100).fadeOut(300)}
function highlight_vc(){intID=setInterval(RepeatCall,400);pp=$("#main_view_vc_right").pointPoint()}
$(document).on("click",".wn-continue-btn",function(){
$(this).html("Loading....");
load_cats(true);
});
$(".note_main_pic").live("click",function(){var b=document.createElement("div");b.id="big_pic_container";el("welcome_div").appendChild(b);b.innerHTML="<img src='"+$(this).attr("src")+"'>";b.title="Click to scale it back down";$("#big_pic_container").hide();$("#big_pic_container").show("slow")});
$("#big_pic_container").live("click",function(){
$("#big_pic_container").hide("slow",function(){
$(this).remove()})});
$(document).on("click",".load-hobbies",function(){
$(this).html("loading...");
load_hobbies();
});function intro_init(){
create_welcome_div(true);
var elm_=$("#"+vars['note_container_div']);
elm_.html(loading)
$.post(core,{core_file:"get_intro_data.php",core_action:"getters"},function(d){
elm_.html(d);
});
}intro_init();