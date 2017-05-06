vars['posts-container-id']="#posts-container";
vars['dp-post-block']=".dp-post-block";
vars['last_block_passed']=false;
vars['loaders_id']="dp-loading-more";

$(document).on("mouseenter",vars['dp-post-block'],function(){
$(this).find(".dp-show-post-btn").css("visibility","visible");
}).on("mouseleave",vars['dp-post-block'],function(){
$(this).find(".dp-show-post-btn").css("visibility","hidden");
});

$(document).scroll(function(e){

if(!vars['last_block_passed']){

if($(vars['dp-post-block']+":last").isOnScreen()){

vars['last_block_passed']=true;

var elm_=$(vars['dp-post-block']+":last"),
uid=elm_.attr("uid"),
block_width=elm_.css("width");

$("#body").append("<div id='"+vars['loaders_id']+"'><img alt='Loading More....' src='" + get_image("posts_loader.gif") + "'/></div>");

$.post(core,{core_file:"dp_get_posts.php",core_action:"getters",last_uid:uid},function(d){

$("#"+vars['loaders_id']).remove();

$(vars['posts-container-id']).append(d);

attach_hovercard();

dp_fix_blocks_width();

refresh_masonry();

vars['last_block_passed']=false;

});

}

}
       


});

$(document).ready(

function(){

init();

//$(vars['posts-container-id']).css("width",$(document).width()+"px");

dp_fix_blocks_width();


$(vars['posts-container-id']).masonry({
        itemSelector: vars['dp-post-block'],
        gutter: 20,
	columnWidth:1,
	isAnimated: true,
   });

}

);

function dp_fix_blocks_width(){

$(vars['dp-post-block']).css("width",($(vars['posts-container-id']).width()/3.5)+"px");

}


function init(){
fix_bricks_init();
attach_hovercard();
$(".hp_post_container").die("mouseenter");
}


function fix_bricks_init(){

window.setInterval(function(){refresh_masonry()},500);

}

function refresh_masonry(){

 $(vars['posts-container-id']).masonry('reloadItems').masonry('layout');

}

function dp_display_post(elm_,post_id){
	
	var $this=$(elm_),
	par=$this.parents(vars['dp-post-block']+":first");
	fade_bg();
	create_special_div({"top": ($this.offset().top -50) + "px"},$this);
	$(vars['display_post_div']).center();
        $.post(core,{p_id:post_id,core_action:"getters",core_file:"dp_get_single_post.php"},function(d){
	append_to_special_div(d);
	
	$(vars['display_post_div']).center();
	
	
	});

}