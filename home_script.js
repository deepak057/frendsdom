var no_pic = "nopic.png",
    p_start = 15,
    p_end = 15,
    timer;

vars['hp_tabs'] = "#hp-status-tabs";
vars['pic_view_content_height_offset'] = 102;
vars['hp_pv_main_content_wrap'] = ".hp_pv_main_content_wrap";
vars['hobbies_popup_content']=false;

jQuery(document).ready(function () {
    $("*[title]").monnaTip();
    cluetip_ini();

    adjust_main_pic_container_init();

load_sections_init();
    attach_hovercard();
home_init();

    $(".flexible_textarea").live("focus", function () {
        $(this).flexible()
    });
    $("#switcher").themeswitcher({
        loadTheme: "Smoothness"
    });
    $("#search_field").combogrid({
        url: "search_autocomplete.php",
        debug: true,
        sidx: "id",
        sord: "asc",
        rows: 10,
        addClass: "combogrid_class",
        alternate: true,
        draggable: true,
        rememberDrag: true,
        colModel: [{
            columnName: "name",
            align: "left",
            width: "25",
            label: "Name"
        }, {
            columnName: "country",
            width: "25",
            label: "Country"
        }, {
            columnName: "state",
            width: "25",
            label: "State"
        }, {
            columnName: "city",
            width: "25",
            label: "City"
        }],
        select: function (a, b) {
            document.location.href = b.item.link;
            return false
        }
    });
    jQuery("#mycarousel").jcarousel({
        vertical: true,
        itemLoadCallback: mycarousel_itemLoadCallback,
        scroll: 1,
        easing: "BounceEaseOut",
        animation: 1000,
        wrap: "both",
        itemFirstInCallback: {
            onAfterAnimation: function (b, a, d, e) {
                ecp_selected(a)
            }
        }
    })
});


var App_={


	FixNotiCount:function(){


		setInterval(function(){


		var noti_elm=$("#pop-section-notification");

		if(noti_elm.length && Helpers.HasAttribute(noti_elm,"total")){

			var total_=noti_elm.attr("total");

			if(!parseInt(total_)){

				var noti_count_elm=noti_elm.find(".ps-total-count");

				if(noti_count_elm.length){

					noti_count_elm.addClass("none");

				}

			}


		}



		},100);


	}


};



var Helpers={


	HasAttribute:function(elm_,attr_){

		var attr = elm_.attr(attr_);

		return typeof attr !== typeof undefined && attr !== false;


	},


};


function hp_tabs_init(){

$(vars['hp_tabs']).tabs({
        select: function (event, ui) {
            if (ui.index == 1) {
                var noti_count = $(ui.tab).find(".hp_nc");
                if (noti_count.length) {
                    noti_count.remove();
                    var pp_posts_seen = new Array();
                    $("#hp-sv-tabs-2 .hp_post_container").each(
                        function () {
                            pp_posts_seen.push($(this).attr("id"));
                        });
                    $.post(core, {
                        core_file: "pp_update_seen_posts.php",
                        core_action: "setters",
                        post_ids: JSON.stringify(pp_posts_seen)
                    }, function (d) {
                        if (parseInt(d) != 1) {
                            alert("Error: failed to update your points");
                        }
                    });
                }
            }
        }
    });
}


function check_profile_image_file(file_elm_id,form_){
if(check_image_file(file_elm_id)){
$(form_).find("input[type=submit]").val("Uploading....");
return true;
}
return false;
}

$(document).on("click",".pop_title",function(){

var $this=$(this),
section_=$this.attr('section');
$this.next().toggle();
$this.toggleClass('up');
$.post(core,{core_file:"set_pop_sections.php",core_action:"setters",section:section_},function(d){});
pop_section_show_total($this);
});

function pop_section_show_total(elm_){

var class_="ps-total-count",
type_=elm_.attr("section"),
total=elm_.attr('total'),
noti_="notification",
html=type_!=noti_?"("+total+")":(total>0?total:"");
//class_=type_==noti_ && parseInt(total)==0?(class_+" none "):class_;

if(type_==noti_ && parseInt(total)==0){
remove_noti_count_elm(elm_,class_);
class_+=" none ";
}

if(elm_.next().is(':hidden')){
remove_noti_count_elm(elm_,class_);
elm_.append("<span class='"+class_+"'>"+html+"</span>");

}

else {

remove_noti_count_elm(elm_,class_);

}
}

$(document).on("click","#trigger-cats-popup",function(){
trigger_cats();
});

function trigger_cats(){
to_top();
create_welcome_div();
load_cats();
}

function remove_noti_count_elm(elm_,class_){
if(elm_.find("."+class_).length){
elm_.find("."+class_).remove();
}
}

function home_init(){

App_.FixNotiCount();

//pop_accordion_init()

}

function load_sections_init(){

load_slide_panel();
load_status_view();
}

function load_status_view(){
var status_view=$("#hp-sv-tabs-1");
if(status_view.length){
status_view.html("<p class='plain-box'>"+loading+"</p>");
$.post(core,{core_file:"get_status_view.php",core_action:"getters"},function(d){
status_view.html(d);
attach_hovercard();
load_more_posts_init();
});
}
}

function load_slide_panel(){
var panel_=$("#panel");
panel_.html("<p class='plain-box'>"+loading+"</p>");
$.post(core,{core_file:"get_panel_content.php",core_action:"getters",flag:true},function(d){
panel_.html(d);
});
}


function pop_accordion_init(){

$("#pop").accordion();

}

function ecp_selected(a) {
    $(".garbage_div").each(function () {
        $(this).parent().remove()
    });
    if (a.firstChild!=null && a.firstChild.src) {
        allocate_border_grey();
        a.style.border = "2px solid " + lu_stripColor;
        a.style.borderRadius = "7px";
        load_ecp(a.firstChild.src.split("=")[1]);
        w.postMessage("select_ecp pic_id=" + a.firstChild.src.split("=")[1]);
        w.onmessage = function (b) {
            if (parseInt(b.data) != 1) {
                alert("Error: failed to set your eyecandy picture")
            }
        }
    }
}

function mycarousel_itemLoadCallback(b, a) {
    if (b.has(b.first, b.last)) {
        return
    }
    jQuery.get("get_ecp_list.php", {
        first: b.first - 1,
        last: b.last + 2
    }, function (c) {
        mycarousel_itemAddCallback(b, b.first, b.last, c)
    }, "xml")
}

function mycarousel_itemAddCallback(a, b, d, c) {
    a.size(parseInt(jQuery("total", c).text()));
    jQuery("image", c).each(function (e) {
        if (jQuery(this).text().split("=")[1]) {
            a.add(b + e, mycarousel_getItemHTML(jQuery(this).text()))
        } else {
            a.add(b + e, '<div class="garbage_div"></div>')
        }
    })
}

function mycarousel_getItemHTML(a) {
    pic_id = a.split("=")[1];
    return '<img src="' + a + '" width="75" height="75" class="carousel_item_image" alt="image" />' + append_remove_btn(pic_id)
}
jQuery(document).ready(function () {
    jQuery("#mycarousel").jcarousel({
        itemLoadCallback: mycarousel_itemLoadCallback
    })
});

function allocate_border_grey() {
    $(".carousel_item_image").each(function () {
        $(this).parent().css("border", "2px solid #000")
    })
}
$(".carousel_item_image").live("click", function () {
    ecp_selected($(this).parent()[0])
});
$(".carousel_item_image").live("mouseenter", function () {
    var a = $(this).attr("src").split("=")[1];
    d_block(a)
}).live("mouseout", function () {
    var a = $(this).attr("src").split("=")[1];
    timer = setTimeout(function () {
        d_none(a)
    }, 1500)
});
$(".remove_ecp").live("click", function () {
    var b = $(this).attr("id");
    apprise("Proceed to removing this picture?", {
        verify: true
    }, function (a) {
        if (a) {
            if (el("current_ecp").src.indexOf(no_pic) == -1) {
                if (el("current_ecp").src.split("?")[1].split("&")[0].split("=")[1] == b) {
                    el("current_ecp").src = no_pic
                }
            }
            $("#" + b).parent().remove();
            w.postMessage("remove_ecp pic_id=" + b);
            w.onmessage = function (c) {
                if (parseInt(c.data) != 1) {
                    alert("Error: failed to delete eyecandy picture")
                }
            }
        }
    })
});
$("#vc_right").live("click", function () {
    $("#scroller_contanier").animate({
        width: "hide"
    }, function () {
        v = 0;
        set_scroller_visibility("0")
    });
    $(this).css("display", "none");
    $("#vc_left").css("display", "inline")
});
$("#vc_left").live("click", function () {
    $("#scroller_contanier").animate({
        width: "show"
    }, function () {
        v = 1;
        set_scroller_visibility("1")
    });
    $(this).css("display", "none");
    $("#vc_right").css("display", "inline")
});

function set_scroller_visibility(a) {
    w.postMessage("update_boolean entity=ecp_scroller_enabled&value=" + a);
    w.onmessage = function (b) {
        if (parseInt(b.data) != 1) {
            alert("Error: failed to update scroller visibility status");
            return false
        } else {
            return true
        }
    }
}
$("#add_ecp_btn").live("click", function () {
    $("#add_ecp_wrapper").css("display", "block");
    $("#add_ecp_wrapper").slideDown("slow")
});
$("#ecp_url_btn").live("click", function () {
if(!trim(el("ecp_url").value).length){apprise("Please enter a valid URL");return false;}
    hide_ecp_w();
    el("body").style.opacity = ".2";
    el("uploading").innerHTML = "<img src='picon1.gif' alt='loading'/>Setting your eyecandy picture";
    show("uploading");
    w.postMessage("set_eyecandy pic_url=" + encodeURIComponent(trim(el("ecp_url").value)) + "&vuid=" + luid);
    w.onmessage = function (a) {
        hide("uploading");
        if (a.data.indexOf("failed") != -1) {
            response_msg("Error: failed to set your eyecandy picture", "red")
        } else {
            response_msg("Eyecandy picture successfully set");
            append_item(a.data);
            load_ecp(a.data)
        }
    }
});

function append_item(a) {
    for (var c = 0; c < el("mycarousel").childNodes.length; c++) {
        if (el("mycarousel").childNodes[c].nodeName == "LI") {
            if (el("mycarousel").childNodes[c].firstChild.nodeName != "IMG") {
                var b = document.createElement("li");
                b.innerHTML = "<img width='75' height='75' class='carousel_item_image' alt='image' src='get_ecp.php?pic_id=" + a + "'/>" + append_remove_btn(a);
                el("mycarousel").childNodes[c].appendChild(b);
                break
            }
        }
    }
}

function append_remove_btn(a) {
    return "<div id='" + a + "' title='Remove this picture' class='remove_ecp'><span>&#215;</span></div>"
}

function load_ecp(a) {
    el("current_ecp").src = "get_ecp.php?pic_id=" + a + "&size=big";
    if (!el("current_ecp").complete) {
        $("#current_ecp").hide();
        el("load_ecp").style.display = "inline";
        $("#load_ecp").show();
        $("#current_ecp").load(function () {
            $("#load_ecp").hide();
            $("#current_ecp").show()
        })
    }
}

function hide_ecp_w() {
    $("#add_ecp_wrapper").hide("slow", function () {
        $(this).css("display", "none")
    })
}

function ecp_upload() {
    if (!validpic(el("ecp_file").value)) {
        alert("Please choose a valid image file");
        return false
    }
    hide_ecp_w();
    el("body").style.opacity = ".2";
    show("uploading");
    el("uploading").innerHTML = "<img src='picon1.gif'/>&nbsp;Uploading your picture.......";
    return true
}

function stop_ecp_Upload(a) {
    hide("uploading");
    if (a.indexOf("failed") != -1) {
        response_msg("Error: failed to upload your picture", "red")
    } else {
        response_msg("Picture successfully uploaded");
        append_item(a);
        load_ecp(a)
    }
}
$("#prof_url_btn").live("click", function () {
	
	if(!trim(el("prof_pic_url").value).length){apprise("Please enter a valid URL");return false;}
    el("uploading").innerHTML = "<img src='picon1.gif' alt='loading'/>&nbsp;Setting your profile picture.....";
    show("uploading");
    el("body").style.opacity = ".2";
    w.postMessage("set_prof_pic pic_url=" + trim(el("prof_pic_url").value));
    w.onmessage = function (a) {
        hide("uploading");
        if (a.data.indexOf("failed") != -1) {
            response_msg("Error: failed to set your profile picture", "red")
        } else {
            response_msg("Profile picture successfully set");
            el("tab-1").checked = true;
            el("lu_prof_pic").src = a.data + "?" + new Date().getTime()
        }
    }
});
$("#lu_prof_pic").live("mouseenter", function () {
    if ($(this).attr("src").indexOf(no_pic) == -1) {


        var $this = $(this);


        $("#remove_lu_pic").css({
            "display": "block",
            "top": "-" + $this.height() + "px"
        })
    }
}).live("mouseout", function () {
    $("#remove_lu_pic").css("display", "none")
});
$("#remove_lu_pic").live("mouseenter", function () {
    $(this).css("display", "block")
}).live("click", function () {
    if (confirm("Proceed to deleting your profile picture?")) {
        el("body").style.opacity = ".2";
        el("uploading").innerHTML = "<img src='picon1.gif' alt='removing..' />Deleting your profile picture......";
        show("uploading");
        w.postMessage("remove_lu_pic ");
        w.onmessage = function (a) {
            hide("uploading");
            if (parseInt(a.data) != 1) {
                response_msg("Error: failed to delete your profile picture", "red")
            } else {
                response_msg("Profile picture successfully deleted");
                el("lu_prof_pic").src = no_pic
            }
        }
    }
});


$(document).on("click", "#tab-1", function () {

    adjust_profpic_tab();

}).on("click", "#tab-2", function () {

    adjust_upload_pic_tab();

}).on("click", "#tab-3", function () {

    adjust_ecp_tab();

});

function adjust_main_pic_container_init() {

    $('input[name=radio-set]:radio:checked').click();
}

function adjust_upload_pic_tab() {
    set_pic_wrap_height($(".hp-upload-pic-container").height());
}

function adjust_ecp_tab() {
    set_pic_wrap_height($("#current_ecp").height());
}


function set_pic_wrap_height(height_) {
    $(".hp_pv_main_content_wrap").css("height", (height_ + vars['pic_view_content_height_offset']) + "px");
}

function adjust_profpic_tab() {

    set_pic_wrap_height($("#lu_prof_pic").height());

}


$(".tab_lable").live("click", function () {
    if (v) {
        if ($(this).attr("id") == "ecp_lable") {
            $("#scroller_contanier").css("display", "block")
        } else {
            $("#scroller_contanier").css("display", "none")
        }
    }
    switch ($(this).attr("id")) {
    case "ecp_lable":
        var a = "ecp";
        break;
    case "upload_pic_lable":
        var a = "upload_pic";
        break;
    default:
        var a = "prof_pic";
        break
    }
    w.postMessage("update_entity entity=home_pic_view&value=" + a);
    w.onmessage = function (b) {
        if (parseInt(b.data) != 1) {
            alert("Error: failed to set home picture view")
        }
    }
});
jQuery.easing.BounceEaseOut = function (f, e, a, h, g) {
    if ((e /= g) < (1 / 2.75)) {
        return h * (7.5625 * e * e) + a
    } else {
        if (e < (2 / 2.75)) {
            return h * (7.5625 * (e -= (1.5 / 2.75)) * e + 0.75) + a
        } else {
            if (e < (2.5 / 2.75)) {
                return h * (7.5625 * (e -= (2.25 / 2.75)) * e + 0.9375) + a
            } else {
                return h * (7.5625 * (e -= (2.625 / 2.75)) * e + 0.984375) + a
            }
        }
    }
};

function get_now_ts() {
    return Math.round(+new Date() / 1000)
}
var fr_l = fam_l = col_l = aqu_l = no_l = get_now_ts();

function get_cor_var(d, c) {
    switch (d) {
    case "f":
        if (c) {
            fr_l = get_now_ts()
        } else {
            return fr_l
        }
        break;
    case "fam":
        if (c) {
            fam_l = get_now_ts()
        } else {
            return fam_l
        }
        break;
    case "col1":
        if (c) {
            col_l = get_now_ts()
        } else {
            return col_l
        }
        break;
    case "aqu1":
        if (c) {
            aqu_l = get_now_ts()
        } else {
            return aqu_l
        }
        break;
    case "no1":
        if (c) {
            no_l = get_now_ts()
        } else {
            return no_l
        }
        break
    }
}

function refresh_rel_list(b) {
    return Math.round((get_now_ts() - get_cor_var(b)) / 60) >= 2 || !$.trim($("#"+b+"_ul").html()).length;
        
}

function get_list(i) {
    var l = new Array("friend", "family", "col", "aq", "no");
    var g = new Array("f", "fam", "col1", "aqu1", "no1");
    var h = new Array("fimg", "faimg", "colimg", "aqimg", "noimg");
    for (var j = 0; j < g.length; j++) {
        if (g[j] == i.split("_")[1]) {
            show(g[j]);
            $("#" + g[j]).animate({
                width: "show"
            });
            el(h[j]).src = "left.png";
            el(i).setAttribute("onclick", "hide_list('" + i + "','" + g[j] + "','" + h[j] + "')");
            if (refresh_rel_list(g[j])) {
                el(g[j] + "_ul").innerHTML = "<img src='picon1.gif'/>&nbsp;Refreshing....";
                var k = g[j] + "_ul";
                w.postMessage("get_status_list l=" + g[j]);
                w.onmessage = function (a) {
                    el(k).innerHTML = a.data
                };
                get_cor_var(g[j], true)
            }
        } else {
            $("#" + g[j]).animate({
                width: "hide"
            });
            el(h[j]).src = "right.png";
            el(l[j] + "_" + g[j]).setAttribute("onclick", "get_list('" + l[j] + "_" + g[j] + "')")
        }
    }
}

function hide_list(f, e, d) {
    $("#" + e).animate({
        width: "hide"
    });
    el(d).src = "right.png";
    el(f).setAttribute("onclick", "get_list('" + f + "')")
};

function hp_nc() {
    var els = new Array("total_news", "total_req", "total_atr_req", "unviewed_nudges", "total_msgs");
    $.each(els, function (index, value) {
        if (parseInt($("#" + value).html()) > 0) {
            if ($("#" + value).parents(".nc_container:first").html().indexOf("(") != -1) {
                $("#" + value).parents(".nc_container:first").html("<span id='" + value + "'>" + $("#" + value).html() + "</span>");
            }
            $("#" + value).addClass("hp_nc");
        } else {
            $("#" + value).parents(".nc_container:first").html("(<span id='" + value + "'>0</span>)");
        }
    });
}
setInterval(hp_nc, 1000);


/*$('.chatboxcontent').live("mouseenter",function(){$(this).niceScroll({cursorcolor:lu_stripColor});});*/
$(".flexible_textarea").live("focus", function () {
    $(this).flexible()
});

function mp_ini() {
    if ($("#lp_ads").css("display") == "none")
        $("#lp-slider").click();
    check_left_panel();
}

function check_left_panel() {

    var original_id = "lp-slider",
        temp_id = original_id + "-temp";

    if ($(".hp-mp-wrapper").css("display") != "none") {
        $("#" + original_id).attr('onclick', null);
    } else {
        $("#" + original_id).attr('onclick', 'enable_left_panel()');

    }

}

function mp_createCookie(name, value) {
    var date = new Date();
    date.setTime(date.getTime() + (30 * 1000));
    var expires = "; expires=" + date.toGMTString();

    document.cookie = name + "=" + value + expires + "; path=/";
}

function mp_cookie(action) {
    var cookie = "mp_playing";
    if (action == "create") {
        mp_createCookie(cookie, true);
    } else {
        del_cookie(cookie);
    }
}


$(".mp-start-btn img").live("click", function () {
    $(".hp-mp-des").slideUp("slow", function () {
        $(".hp-mp-content").slideDown("slow", function () {

            var elm_top = "#hp-mp-top",
                elm_bottom = "#hp-mp-bottom",
                p = $(elm_top).offset(),
                counter = '#mp-scounter',
                sec = mp_conf['time_limit'];

            mp_cookie("create");

            $(elm_bottom).css({
                "position": "absolute",
                "top": (p.top + 200) + "px"
            }).show();

            $(".hp-mp-pic").draggable({
                revert: function (v) {

                    if (!v) {
                        mp_conf['mp_wrong_drops']++;
                        if (mp_conf['mp_wrong_drops'] == mp_conf['failed_attempts']) {
                            mp_conf['mp_wrong_drops'] = 0;
                            mp_animate_callback($(this), "deduce");
                        }
                    }
                    return !v;
                }
            });
            set_droppables();
            mp_conf['timer'] = setInterval(function () {
                $(counter).text(sec--);
                if (sec == -1) {
                    mp_clear_timer();
                }
            }, 1000);
        });
    });
});


function mp_clear_timer() {
    $('#mp-scounter').html("0");
    $(".hp-mp-pic").draggable("destroy");
    clearInterval(mp_conf['timer']);
    enable_profile_visit();
}

function enable_profile_visit() {
    $(".mp-user-key-pic").each(function () {
        var p = $(this).offset(),
            key = $(this).attr('key'),
            width = $(this).width(),
            par = $(this).parent(),
            left = par.attr("class").indexOf("hp-mp-pic") != -1 ? "left:0px" : "";
        par.append("<div style='height:0;width:0;'><div key='" + key + "' style='width:" + width + "px;" + left + "' class='hp-mp-vp pointer'><a href='enable_visit.php?k=" + key + "'>Visit profile</a></div></div>");
    });
    mp_cookie("delete");
}

function set_droppables() {
    $(".hp-mp-target").each(function () {
        var acceptable = "#" + $(this).attr('id').split("-")[0];
        $(this).droppable({
            accept: acceptable,
            drop: function (event, ui) {
                ui.draggable.hide();
                $(this).html(ui.draggable.html());
                mp_animate_callback($(this), "add");
                mp_conf['points_made']++;
            }
        });
    });
}

function mp_animate_callback(elm, action) {
    var p = elm.offset(),
        top = p.top,
        left = p.left,
        increment_by = 100,
        left_to = left - increment_by,
        sign = "+",
        class_ = "green",
        top_to = points = 0;

    if (action == "add") {
        top_to = top - increment_by;
        points = mp_conf['points_to_add'];
    } else {
        top_to = top + increment_by;
        points = mp_conf['points_to_deduce'];
        sign = "-";
        class_ = "red";
    }
    $(body).append("<div class='mp-point-count " + class_ + "' style='top:" + top + "px;left:" + left + "px;'>" + sign + points + "</div>");
    $(".mp-point-count").animate({
        top: top_to + "px",
        left: left_to + "px",
        opacity: 0
    }, 1500, function () {
        $(".mp-point-count").remove();
        update_points(points, action, true);
        if (mp_conf['points_made'] == mp_conf['max_points']) {
            var t = $("#hp-mp-bottom").offset().top - 300;
            $("#hp-mp-bottom").animate({
                top: t + "px"
            }, 500);
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

function enable_TE() {
    $('#status_textarea').removeClass('status_textarea');

    $('#status_textarea').rte({
        css: ['default.css'],
        width: 600,
        height: 100,
        controls_rte: rte_toolbar,
        controls_html: html_toolbar
    });

    el("enable_status_TE").innerHTML = "<img src='crossmark.gif' height='10' width='10' />&nbsp;Disable text editor";
    el("enable_status_TE").onclick = function () {
        disable_TE()
    };

}



function post_status() {
    hide_apprise();

    el('body').style.opacity = ".2";
    el("uploading").innerHTML = "<img src='picon1.gif'/>Setting your post.....";
    show('uploading');
    var f = document.forms['post_conf_form'],
        public = "n",
        pv_rel = '',
        pv_excluded = '',
        save_pv_conf = "n";
    if (f.cb_pv_public.checked) {
        public = "y";
    }
    for (var i = 0; i < f.cb_pv.length; i++) {
        if (f.cb_pv[i].checked) {
            if (i != (f.cb_pv.length - 1))
                pv_rel += f.cb_pv[i].value + ",";
            else
                pv_rel += f.cb_pv[i].value;
        }
    }
    pv_excluded = excluded_ids.join(",");

    if (f.save_pv_conf.checked) {
        save_pv_conf = "y";
    }

    w.postMessage("set_post public=" + public + "&save_pv_conf=" + save_pv_conf + "&pv_rel=" + encodeURIComponent(pv_rel) + "&pv_excluded=" + encodeURIComponent(pv_excluded) + "&post_content=" + encodeURIComponent(get_post_content()) + "&post_pic_id=" + post_pic_id + "&post_news_id=" + post_news_id + "&post_movie_id=" + post_movie_id + "&post_video_id=" + post_video_id+ "&cat=" + f.post_cat.value);
    w.onmessage = function (e) {
        if (e.data.indexOf("failed") == -1) {
            $.post("display_post.php", {
                p_id: e.data
            }, function (d) {
                hide('uploading');
                el('body').style.opacity = "1";
                var elm_ = $(d);
                // elm_.insertAfter("#status_container")
                select_hp_tab(0);
                $("#hp-sv-tabs-1").prepend(elm_);

                elm_.hide().slideDown("slow", function () {
                    $(this).effect("highlight", "slow")
                });
                remove_post_pic();
                remove_api_news();
                remove_api_movie();
                remove_api_video();
                vacate_post_textarea();
                $(".hp_post_container").each(function () {
                    if ($(this).find('.colorlist').attr("class").indexOf("post_cl_visible") != -1) {
                        $(this).find('.colorlist').prev().click();
                    }
                });
                hide_fback_popups();
            });
            //$("#"+e.data).find(".post_content").niceScroll({cursorcolor:"grey"});
        } else {
            response_msg("Error: failed to set your post", "red");
        }
    };
    remove_apprise();
}

function select_hp_tab(index_) {
    $(vars['hp_tabs']).tabs('select', index_);
}


function vacate_post_textarea() {
    el("status_textarea").value = '';
}

function hide_fback_popups() {
    $(".hp_post_container").each(function () {
        if ($(this).find('.p_fback_oc').attr("class").indexOf("fboc_visible") != -1)
            close_pfoc($(this).find('.p_fback_oc').attr("id"));
    });
}

function add_attachment(text) {
    $("#post-attachments").append(text);
}

function remove_attachment(el) {
    $("#post-attachments").find("." + el).remove();
}


function get_post_content() {
    if ($("#status_textarea").attr("class").indexOf("status_textarea") != -1) {
        var text = el("status_textarea").value;
    } else {
        var text = $("#status_textarea").contents().find("body").html();
    }
    return text;
}

function disable_TE() {
    var text = $("#status_textarea").contents().find("body").html().replace(/(<([^>]+)>)/ig, "");
    $('#status_textarea').remove();
    el('ST_container').innerHTML = "<textarea placeholder='Share your mind' id='status_textarea' class='flexible_textarea status_textarea'>" + text + "</textarea>";
    el("enable_status_TE").innerHTML = "<img src='red_pencil_icon.png' height='10' width='10' />&nbsp;Use text editor";
    el("enable_status_TE").onclick = function () {
        enable_TE()
    };
}


$("#status_share_btn").live("click", function () {
    if (!get_post_content()) {
        apprise("Please write something in textarea as your post");
        return;
    }
    apprise("<div class='pv_wrapper' align='left'><h3>Set post visibility</h3><div id='pv_conf'>" + loading + "</div></div>", {
        "confirm": true,
        "textOk": "Share now",
        "takeControl": "post_status"
    });
    w.postMessage("get_pv_conf re");
    w.onmessage = function (e) {
        el('pv_conf').innerHTML = e.data;

format_checkbox($("#pv_conf input[type='checkbox']"));


//transform_select_init("width-200");

        if (!el("token-input-pv_excluded")) {
            $("#pv_excluded").tokenInput("namehints_json.php", {
                theme: "facebook",
                prePopulate: excluded_arr,
                hintText: "Type your relation's name",
                onAdd: function (item) {
                    excluded_ids.push(item.id);
                    excluded_names.push(item.name);
                    var na = new Array();
                    na["id"] = item.id;
                    na["name"] = item.name;
                    excluded_arr.push(na);
                },
                onDelete: function (item) {
                    var i = excluded_ids.findIndex(item.id);
                    excluded_ids.splice(i, 1);
                    excluded_names.splice(i, 1);
                    excluded_arr.splice(i, 1);
                }
            });

        }

    };
});



function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function display_post(p_id) {
    $("#req").hide("slow", function () {
        if (el(p_id)) {
	if(!$("#hp-sv-tabs-1").is(":visible"))switch_view();select_hp_tab(0);
            $('#body').css("opacity", "1");
            $(document).scrollTo("#" + p_id,"slow",{offset:-90,onAfter:function(){$("#" + p_id).effect("highlight")}});
        } else {
            create_special_div();
            $(document).scrollTo("#body");
            w.postMessage("display_post p_id=" + p_id);
            w.onmessage = function (e) {
                append_to_special_div(e.data);
            };
        }
    });
}
$(".post_add_pic").live("click", function () {
    $('#body').css("opacity", ".2");
    create_special_div();
    append_to_special_div("<div class='post-add-pic-wrap' align='center'><h4>Upload the picture</h4><form action='upload_post_pic.php' target='upload_target' method='post' enctype='multipart/form-data' onsubmit='return post_pic_upload();'><p><input id='post_picture_upload' type='file' name='post_picture'/>&nbsp;<input type='submit' value='Add picture' class='special_btn'/></p></form><p><h2>OR</h2></p><p><h4>Specify the URL</h4></p><p><input type='text' id='post_pic_url' class='blue_onhover' placeholder='Paste or enter URL' size='30'/>&nbsp;<input type='button' id='post_pic_url_btn' value='Add picture' class='special_btn'/></p></div>");
});
$("#post_pic_url_btn").live("click", function () {
    if (trim(el("post_pic_url").value)) {
        var pic_url = trim(el("post_pic_url").value);
    } else {
        apprise("Error: please enter the URL of picture");
        return;
    }
    display_post_close();
    put_wait_msg("<img src='picon1.gif'/>&nbsp;Adding picture.....");
    w.postMessage("post_pic_url pic_url=" + pic_url);
    w.onmessage = function (e) {
        hide('uploading');
        if (e.data.indexOf("failed") == -1) {
            add_post_pic(e.data);
        } else {
            response_msg("Error: failed to add post picture", "red");
        }
    };
});

function post_pic_upload() {
    if (!validpic($("#post_picture_upload").val())) {
        alert("Please choose a valid image file");
        return false;
    }
    remove_post_pic(true);
    put_wait_msg("<img src='picon1.gif'>Uploading your picture....");
    display_post_close();
}

function stop_post_pic_Upload(r) {
    hide("uploading");
    if (r.indexOf("failed") == -1) {
        add_post_pic(r);
    } else {
        response_msg("Error: failed to upload the picture", "red");
    }
}

function add_post_pic(id) {
    post_pic_id = id;
    add_attachment('<div class="hp-post-attachment-pic"><img src="checkmark.gif" width="20">Picture successfully added <span class="small underline_onHover pointer post_remove_pic"><img src="images/crossmark.gif" height="10" width="10" />Remove picture</span></div>');
}
$(".post_remove_pic").live("click", function () {
    remove_post_pic(true);
});

function remove_post_pic(from_db) {
    var temp = post_pic_id;
    post_pic_id = '';
    if (temp) {
        remove_attachment("hp-post-attachment-pic");
        if (from_db) {
            w.postMessage("del_post_pic pic_id=" + temp);
            w.onmessage = function (e) {
                if (parseInt(e.data) != 1) alert("Error: failed to delete post picture");
            };
        }
    }
}

$(".add_title").live("mouseenter", function () {
    $(this).attr("title", "You have " + get_points() + " points to spend");
});

function cluetip_ini() {
    $('.cluetip_obj').cluetip({
        arrows: true,
        width: 460,
        showTitle: false,
        sticky: true,
        mouseOutClose: true,
        fx: {
            open: 'fadeIn',
            openSpeed: ''
        }
    });
}
$(window).load(function () {
    cluetip_ini();
    $(".post_content").niceScroll({
        cursorcolor: "grey"
    });
    $('.nice_scroll').niceScroll({
        cursorcolor: "grey"
    });
    /*$(".auto_adjust_100").jScroll({top : 100,speed : "fast"});
$(".auto_adjust_10").jScroll({top : 10,speed : "fast"});
$(".auto_adjust_250").jScroll({top : 250,speed : "fast"});
$(".auto_adjust_100").floatScroll({positionTop: 100});
$(".auto_adjust_10").floatScroll({positionTop: 10});
$(".auto_adjust_250").floatScroll({positionTop: 250});
*/
    
});


function load_more_posts_init(){

 var opts = {
        offset: '100%'
    };
$("#waypoint").waypoint(function (e, d) {
        if (d == "down") {
            $("#waypoint").before("<div id='post_loading' align='center'><img alt='loading...' src='images/posts_loader.gif'/></div>");
            $.post("get_posts.php", {
                start: p_start,
                end: p_end
            }, function (data) {
                $("#post_loading").remove();
                $("#waypoint").before(data);
                p_start += 15;
                attach_hovercard();
                $("#waypoint").waypoint(opts);
            });
        }
    }, opts);


}


function get_invite_popup() {
    $(document).scrollTo("#body", function () {
        create_special_div();
        $("#body").css("opacity", ".2");
        w.postMessage("invite_friends_content flag=true");
        w.onmessage = function (e) {
            append_to_special_div(e.data);
            $("#ic_accordion").accordion({
                active: false,
                collapsible: true
            });
        };
    });
}
$("#cluetip").live("mouseenter", function () {
    lpc_obj.startAuto(0);
}).live("mouseleave", function () {
    lpc_obj.startAuto(lp_auatoScroll);
});
$("#ad_space_wrapper").live("mouseenter", function () {
    if ($("#panel").css("display") != "none")
        $(".cu_lpanel").css("display", "block");
}).live("mouseleave", function () {
    $(".cu_lpanel").css("display", "none");
});

function create_light_menu(el_id) {
    remove_lm();
    $('body').append("<div class='light_menu left' id='light_menu'><span class='red_onhover' onclick='close_light_menu();' title='Close'>&#215;</span><div id='lm_content'>" + loading + "</div></div>");
    $('#light_menu').css($("#" + el_id).offset());
    sh_el('light_menu');
    $('#light_menu').bind('clickoutside', function (event) {
        close_light_menu();
    });
    if ($.isFunction($.fn.draggable)) {
        $("#light_menu").draggable({
            cursor: "move"
        });
    }
}
$(".cu_lpanel").live("click", function () {
    create_light_menu($(this).attr('id'));
    $.post('modules/panel/get_cu_panel_data.php', {
        flag: "true"
    }, function (d) {
        append_content_lm(d);
        $("#lm_content").css("margin-right", "10px");
        $("#cu-lp-accordion").accordion({
            "collapsible": true,"active":false,
        });
    });
});

function sh_el(el_id) {
    $('#' + el_id).hide();
    $('#' + el_id).show("slow");
}

function append_content_lm(data) {
    $("#lm_content").html(data);
    $("#light_menu").niceScroll({
        cursorcolor: "grey"
    });
}

function close_light_menu() {
    $('#light_menu').hide("slow", function () {
        remove_lm();
    });
}

function remove_lm() {
    if (el('light_menu'))
        $('#light_menu').remove();
}
$(".cu_lm_btn").live("click", function () {
    var fp_age = $("#hp_fp_age").val(),
        fp_sex = $("#hp_fp_sex").val(),
        fp_country = $("#hp_fp_country").val(),
        fp_state = $("#hp_fp_state").val(),
        fp_city = $("#hp_fp_city").val(),
        cu_lm_pp = $("#lm_cu_pp").is(':checked'),
        cu_lm_view = $("input[name='cu_lm_view']:checked").val();
    append_content_lm("<img src='picon1.gif'/>&nbsp;Please wait....");
    $.post('modules/panel/save_cu_panel_conf.php', {
        flag: "true",
        age: fp_age,
        sex: fp_sex,
        country: fp_country,
        state: fp_state,
        city: fp_city,
        filter_ids: "true",
        cu_lm_pp: cu_lm_pp,
        cu_lm_view: cu_lm_view
    }, function (d) {
        if (parseInt(d) == 1) window.location.href = doc_home;
    });
});

$("#post_sugg").live("click", function () {
    create_light_menu($(this).attr('id'));
    Centralize_el("light_menu");
    $.post("/modules/post_suggestion/index.php", {
        flag: "true"
    }, function (d) {
        append_content_lm(d);
        $("#ps_main_tabs").tabs({
            load: function (event, ui) {
                $(".ps_sub_tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
                $(".ps_sub_tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
            }
        });
        $("#light_menu").addClass("lm_height");
        $("#lm_content").css("margin", "10px");
    });
});


$(".ps_block").live("click", function () {
    insert_post_text($(this).find(".ps_block_text").html());
    close_light_menu();
});


$(document).on("click","#trigger-hobbies",function(){  
trigger_hobbies();
});

function trigger_hobbies(){
to_top();
create_welcome_div();
load_hobbies();
}

function load_more_hobbies_init(){
var load_more_hobbies=true,
more_hobbies_offset=0;
$(".hobbies-wrap").scroll(function(){
var par_=$(this).find(".hobbies-container");
if(load_more_hobbies && par_.find("p:last").isOnScreen()){
load_more_hobbies=false;
var temp_id="loading-more-hobbies-temp";
par_.append("<p id='"+temp_id+"'>"+loading_()+"</p>");
more_hobbies_offset++;
$.post(core,{core_file:"get_more_hobbies.php",core_action:"getters",offset:more_hobbies_offset},function(d){
$("#"+temp_id).remove();
if($.trim(d).length){
load_more_hobbies=true;
par_.append(d);
format_checkbox(par_.find("input[type=checkbox]"));
}
});
}
});
}

$(document).on("click",".hobby-row",function(){

var index_=$(this).index(),
par=$(".pp-similar-hobbies-wrap"),
hobby_id=$(this).attr("hobby-id");

icheck_uncheck($(this).find("input[type=checkbox]"))

for (var i=0;i<=index_;i++){

if(!par.find("p").eq(i).length){

par.append("<p></p>");

}

}

load_hobby_subscribers(par.find("p").eq(index_),hobby_id);

});

$(document).on("click","#save-hobbies-btn",function(){
var $this=$(this);
progress_status($this,loading_()+" Saving...");
$.post(core,{core_file:"save_hobbies.php",core_action:"setters",hobbies:JSON.stringify(get_selected_hobbies())},function(d){
progress_status($this,tick_mark()+" Saved");
});
});

function get_selected_hobbies(){
var hobbies=new Array();
$('.hobbies-container').find('input[type="checkbox"]:checked').each(
function(){
hobbies.push($(this).val());
}
);

return hobbies;
}

function load_hobby_subscribers(target_,hobby_id){

if(!$.trim(target_.html()).length){
target_.html(loading);
$.post(core,{core_action:"getters",
core_file:"get_hobby_subscribers.php",
h_id:hobby_id
},function(d){
target_.html(d);
});
}
}

$(document).on("click",".all-subscribers-trigger",function(){

var hobby_id=$(this).attr("h-id");

create_native_popup();

$.post(core,{
core_file:"get_all_subscribers.php",
core_action:"getters",
h_id:hobby_id
},function(d){

var obj=JSON.parse(d);
native_popup_content(obj.title,obj.content);
attach_hovercard();

});
});


function insert_post_text(text) {
    $("#status_textarea").val(text.replace(/<br\s*[\/]?>/gi, "\n"));
}

$(".more_sps").live("click", function () {
    var el = $(this);
    el.html(loading);
    $.get(el.attr("content-link"), function (d) {
        el.parents(".ui-tabs-panel:first").append(d);
        el.remove();
        $(".ui-tabs-vertical").find(".ui-state-default").mouseenter();
    });
});

$(".api-news").live("click", function () {
    var news_story = $(this).parents(".news_block:first").find(".news_body");
    news_story.find(".gu_advert").remove();
    news_story.slideDown("slow");
});

$(".api-news-collapse").live("click", function () {
    $(this).parents(".news_body:first").slideUp("slow");
});


$(".include-api-news").live("click", function () {
    remove_api_news();
    var par = $(this).parents(".news_block:first");
    par.find(".gu_advert").remove();
    var title = par.find(".api-news-title").html(),
        des = par.find(".api-news-des").html(),
        content = par.find(".news_body_content").html(),
        url = $(this).attr('news-api-url');
    add_attachment('<div class="hp-post-attachment-news"><img src="checkmark.gif" width="20">News successfully added <span class="small underline_onHover pointer" onclick="remove_api_news();"><img src="images/crossmark.gif" height="10" width="10"/>Remove news</span></div>');
    close_light_menu();
    expand_sta(format_attachment_news(title, des, content, url));
    $.post("controller/core.php", {
        core_action: "setters",
        core_file: "set_ps_news.php",
        title: title,
        description: des,
        content: content,
        url: url
    }, function (d) {
        if (d.indexOf("failed") == -1) {
            post_news_id = d;
        } else {
            alert('Error: failed to include the news');
        }

    });
});


function format_attachment_news(title, des, content, url) {

    return "<div class='sta-block attachment-sta-api-news'><div><strong news-api-url='" + url + "' class='pointer api-news-rfn-toggle'>" + title + "</strong></div><div>" + des + "&nbsp;...<span class='small light_text pointer api-news-rfn-toggle'>read full news</span></div><div class='none api-news-rfn-content'>" + content + "&nbsp;<span class='small light_text pointer api-news-rfn-clp'>...collapse</span></div></div>";

}


function expand_sta(text) {
    if ($("#status_textarea").attr("class").indexOf("st-expand-sta") == -1) {
        $("#status_textarea").removeClass("hp-textarea-hover").addClass("st-expand-sta");
        $("#status_container").last().append("<tr class='sc-added-row'><td><div class='expand_sta'></div></td></tr>");
    }
    $("#status_container").find(".expand_sta").append(text);
    $("#status_container").find(".sta-block:last").hide().slideDown("slow");
}

function contract_sta(el) {
    if (el) {
        $("#status_container").find(el).remove();
    }
    if (!el || !$("#status_container").find(".expand_sta").html()) {
        $("#status_textarea").addClass("hp-textarea-hover").removeClass("st-expand-sta");
        $("#status_container").find(".sc-added-row").remove();
    }
}

function remove_api_news() {
    post_news_id = '';
    remove_attachment("hp-post-attachment-news");
    contract_sta(".attachment-sta-api-news");
}

function get_attachment_news() {
    return $(".sc-added-row").find(".attachment-sta-api-news");
}

function switch_view(view) {
    switch (view) {
    case "status":
    default:
        var elm = "#main_view_vc_right";
        break;
    case "pic":
        var elm = "#main_view_vc_left";
        break;
    case "points":
        var elm = "#main_view_vc_mp";
        break;
    }
    $(elm).click();
}

function switch_to_mp() {
    switch_view("points");
}
$(".include-api-movie").live("click", function () {
    remove_api_movie();
    var par = $(this).parents(".news_block:first"),
        container = par.find(".md-container"),
        title = par.find(".ps-m-title").html(),
        movie_id = container.attr("m-id"),
        poster_id = container.attr("m-poster-id"),
        release_date = container.attr("m-release-date"),
        vote = par.find(".ps-m-vote").html();
    add_attachment('<div class="hp-post-attachment-movie"><img src="checkmark.gif" width="20">Movie successfully added <span class="small underline_onHover pointer" onclick="remove_api_movie();"><img src="images/crossmark.gif" height="10" width="10"/>Remove movie</span></div>');
    expand_sta("<div class='sta-block api-movie-content'>" + $(this).parents(".news_block:first").find(".api-movie-content").html() + "</div>");
    close_light_menu();
    $.post(core, {
        core_action: "setters",
        core_file: "set_ps_movies.php",
        title: title,
        m_id: movie_id,
        release_date: release_date,
        poster_id: poster_id,
        vote: vote
    }, function (d) {
        if (d.indexOf("failed") != -1) alert("Error: faild to save movie details");
        else {
            post_movie_id = d;
        }
    });
});

function remove_api_movie() {
    post_movie_id = null;
    remove_attachment("hp-post-attachment-movie");
    contract_sta(".api-movie-content");
}

function get_attachment_movie() {
    return $(".sc-added-row").find(".api-movie-content");
}

function remove_api_video() {
    post_video_id = null;
    remove_attachment("hp-post-attachment-video");
    contract_sta(".api-video-content");
}
$(".include-api-video").live("click", function () {
    remove_api_video();
    var par = $(this).parents(".news_block:first"),
        video_id = $(this).attr("v-id"),
        title = par.find(".yt-v-title").html(),
        published = $(this).attr("v-published"),
        views = par.find(".yt-v-views").html(),
        des = par.find(".yt-v-des").html(),
        pic_url = par.find(".yt-v-pic").attr("src");
    add_attachment('<div class="hp-post-attachment-video"><img src="checkmark.gif" width="20">Video successfully added <span class="small underline_onHover pointer" onclick="remove_api_video();"><img src="images/crossmark.gif" height="10" width="10"/>Remove video</span></div>');
    expand_sta("<div class='sta-block api-video-content'>" + $(this).parents(".news_block:first").find(".api-video-content").html() + "</div>");
    close_light_menu();
    $.post("controller/core.php", {
        core_action: "setters",
        core_file: "set_ps_videos.php",
        title: title,
        description: des,
        published: published,
        views: views,
        video_id: video_id,
        pic_url: pic_url
    }, function (d) {
        if (d.indexOf("failed") != -1) alert("Error: failed to add video");
        else {
            post_video_id = d;
        }
    });
});

function get_attachment_video() {
    return $(".sc-added-row").find(".api-video-content");
}
$(".rp-frm-feed").live("click", function () {
    var elm = $(this).parents(".hp_post_container:first");
    apprise("Remove this post from your feed?", {
        verify: true
    }, function (r) {
        if (r) {
            var id = elm.attr("id");
            elm.slideUp("slow", function () {
                $.post(core, {
                    core_action: "removers",
                    core_file: "remove_post_fromFeed.php",
                    p_id: id
                }, function (d) {
                    if (parseInt(d) == 1)
                        elm.remove();
                    else {
                        elm.slideDown("slow", function () {
                            apprise("Error: failed to remove this post");
                        });
                    }
                });
            });
        }
    });
});
$("#hp-top-logo").live("click", function () {
    to_top();
});
/*$(window).scroll(function(){
var elm="#hp-top-logo";
if(!$(".points_count").isOnScreen()){
$(elm).show();
}	
else{
$(elm).hide();
}});*/




function fade_bg() {

    $("#body").css("opacity", ".2");

}



function show_feature_info() {
    el('know_more').onclick = function () {
        hide_feature_info()
    };
    el('know_more').innerHTML = "Hide now";
    el('next_feature_info').innerHTML = "<div class='fl'><h3><img src='images/eyecandy.png' alt='eyecandy' align='middle'>&nbsp;Eyecandy picture</h3></div><div class='fr'><span onclick='hide_feature_info()' title='Close' class='red_onhover'>×</span></div><div class='clear'></div><li>This feature allows you to set any of your album or other user's collection or profile picture as your eye candy picture.</li><li>This picture is put at the place where you see your profile picture at your home page, that means you don't see your own profile picture but eyecandy picture in big size.</li><li>So with this feature you have a chance to see your favorite picture every time you're on your home page.</li><li>Other users will never see or know about this picture, it's just shown to you.</li><li>Whenever you set a new eye-candy picture it won't replace existing one, instead it will be added to the list of your existing eye-candy pictures enabling you to pick or delete any of them anytime</li><li><strong>Note:</strong>It is your profile picture that will be displayed to others not your eye-candy picture.</li>";
    el('body').style.opacity = ".2";
    show('next_feature_info');
    $("#next_feature_info").hide();
    $("#next_feature_info").show("slow")
}

function hide_feature_info() {
    $("#next_feature_info").hide("slow", function () {
        el('body').style.opacity = "1";
        el('know_more').innerHTML = "Know more";
        el('know_more').onclick = function () {
            show_feature_info()
        }
    })
}
var w = new Worker("w_visit.js"),
    loading = "<img src='picon1.gif'>Loading......";
$(document).ready(function () {
    preload(["left.png"])
});

function fade() {
    var a = document.getElementById("req"),
        body = document.getElementById("body");
    a.style.visibility = "hidden";
    body.style.opacity = "1"
}

function trans1() {
    var a = document.getElementById("a1");
    a.style.opacity = ".4"
}

function trans2() {
    document.getElementById("a2").style.opacity = ".4"
}

function restore() {
    document.getElementById("a1").style.opacity = "1"
}

function restore1() {
    document.getElementById("a2").style.opacity = "1"
}

function flist() {
    var a = document.getElementById("f"),
        f2 = document.getElementById("fam"),
        f3 = document.getElementById("aqu1"),
        f4 = document.getElementById("col1"),
        f5 = document.getElementById("no1"),
        f6 = document.getElementById("friend");
    a.style.visibility = "visible";
    f2.style.visibility = "hidden";
    f3.style.visibility = "hidden";
    f4.style.visibility = "hidden";
    f5.style.visibility = "hidden";
    f6.style.background = "pink";
    f6.setAttribute("onclick", "ffade()");
    document.getElementById("fimg").setAttribute("src", "/left.png");
    document.getElementById("faimg").setAttribute("src", "/right.png");
    document.getElementById("colimg").setAttribute("src", "/right.png");
    document.getElementById("aqimg").setAttribute("src", "/right.png");
    document.getElementById("noimg").setAttribute("src", "/right.png")
}

function famlist() {
    var a = document.getElementById("f"),
        f2 = document.getElementById("fam"),
        f3 = document.getElementById("aqu1"),
        f4 = document.getElementById("col1"),
        f5 = document.getElementById("no1"),
        f6 = document.getElementById("family");
    f2.style.visibility = "visible";
    a.style.visibility = "hidden";
    f3.style.visibility = "hidden";
    f4.style.visibility = "hidden";
    f5.style.visibility = "hidden";
    f6.style.background = "pink";
    f6.setAttribute("onclick", "famfade()");
    document.getElementById("faimg").setAttribute("src", "/left.png");
    document.getElementById("fimg").setAttribute("src", "/right.png");
    document.getElementById("faimg").setAttribute("src", "/left.png");
    document.getElementById("colimg").setAttribute("src", "/right.png");
    document.getElementById("aqimg").setAttribute("src", "/right.png");
    document.getElementById("noimg").setAttribute("src", "/right.png")
}

function colist() {
    var a = document.getElementById("f"),
        f2 = document.getElementById("fam"),
        f3 = document.getElementById("aqu1"),
        f4 = document.getElementById("col1"),
        f5 = document.getElementById("no1"),
        f6 = document.getElementById("col");
    f4.style.visibility = "visible";
    f2.style.visibility = "hidden";
    a.style.visibility = "hidden";
    f3.style.visibility = "hidden";
    f5.style.visibility = "hidden";
    f6.style.background = "pink";
    f6.setAttribute("onclick", "cofade()");
    document.getElementById("colimg").setAttribute("src", "/left.png");
    document.getElementById("fimg").setAttribute("src", "/right.png");
    document.getElementById("faimg").setAttribute("src", "/right.png");
    document.getElementById("colimg").setAttribute("src", "/left.png");
    document.getElementById("aqimg").setAttribute("src", "/right.png");
    document.getElementById("noimg").setAttribute("src", "/right.png")
}

function aqlist() {
    var a = document.getElementById("f"),
        f2 = document.getElementById("fam"),
        f3 = document.getElementById("aqu1"),
        f4 = document.getElementById("col1"),
        f5 = document.getElementById("no1"),
        f6 = document.getElementById("aq");
    f3.style.visibility = "visible";
    f2.style.visibility = "hidden";
    f4.style.visibility = "hidden";
    a.style.visibility = "hidden";
    f5.style.visibility = "hidden";
    f6.style.background = "pink";
    f6.setAttribute("onclick", "aqfade()");
    document.getElementById("aqimg").setAttribute("src", "/left.png");
    document.getElementById("fimg").setAttribute("src", "/right.png");
    document.getElementById("faimg").setAttribute("src", "/right.png");
    document.getElementById("colimg").setAttribute("src", "/right.png");
    document.getElementById("aqimg").setAttribute("src", "/left.png");
    document.getElementById("noimg").setAttribute("src", "/right.png")
}

function nolist() {
    var a = document.getElementById("f"),
        f2 = document.getElementById("fam"),
        f3 = document.getElementById("aqu1"),
        f4 = document.getElementById("col1"),
        f5 = document.getElementById("no1"),
        f6 = document.getElementById("no");
    f5.style.visibility = "visible";
    f2.style.visibility = "hidden";
    f3.style.visibility = "hidden";
    f4.style.visibility = "hidden";
    a.style.visibility = "hidden";
    f6.style.background = "pink";
    f6.setAttribute("onclick", "nofade()");
    document.getElementById("noimg").setAttribute("src", "/left.png");
    document.getElementById("fimg").setAttribute("src", "/right.png");
    document.getElementById("faimg").setAttribute("src", "/right.png");
    document.getElementById("colimg").setAttribute("src", "/right.png");
    document.getElementById("aqimg").setAttribute("src", "/right.png");
    document.getElementById("noimg").setAttribute("src", "/left.png")
}

function fhover() {
    document.getElementById("friend").style.background = "pink"
}

function fahover() {
    document.getElementById("family").style.background = "pink"
}

function cohover() {
    document.getElementById("col").style.background = "pink"
}

function aqhover() {
    document.getElementById("aq").style.background = "pink"
}

function nohover() {
    document.getElementById("no").style.background = "pink"
}

function faway() {
    document.getElementById("friend").style.background = "none"
}

function faaway() {
    document.getElementById("family").style.background = "none"
}

function coaway() {
    document.getElementById("col").style.background = "none"
}

function aqaway() {
    document.getElementById("aq").style.background = "none"
}

function noaway() {
    document.getElementById("no").style.background = "none"
}

function ffade() {
    var a = document.getElementById("friend"),
        f2 = document.getElementById("f");
    f2.style.visibility = "hidden";
    a.setAttribute("onclick", "flist()");
    document.getElementById("fimg").setAttribute("src", "/right.png")
}

function famfade() {
    var a = document.getElementById("family"),
        f2 = document.getElementById("fam");
    f2.style.visibility = "hidden";
    a.setAttribute("onclick", "famlist()");
    document.getElementById("faimg").setAttribute("src", "/right.png")
}

function cofade() {
    var a = document.getElementById("col"),
        f2 = document.getElementById("col1");
    f2.style.visibility = "hidden";
    a.setAttribute("onclick", "colist()");
    document.getElementById("colimg").setAttribute("src", "/right.png")
}

function aqfade() {
    var a = document.getElementById("aq"),
        f2 = document.getElementById("aqu1");
    f2.style.visibility = "hidden";
    a.setAttribute("onclick", "aqlist()");
    document.getElementById("aqimg").setAttribute("src", "/right.png")
}

function nofade() {
    var a = document.getElementById("no"),
        f2 = document.getElementById("no1");
    f2.style.visibility = "hidden";
    a.setAttribute("onclick", "nolist()");
    document.getElementById("noimg").setAttribute("src", "/right.png")
}

function popupmenu() {
    document.getElementById("msgmenu").style.visibility = "visible";
    document.getElementById("body").style.opacity = ".1";
    document.getElementById("msgs").style.opacity = ".1"
}

function success1() {
    document.getElementById("success").style.visibility = "hidden";
    document.getElementById("msgs").style.opacity = "1";
    document.getElementById("body").style.visibility = "visible";
    document.getElementById("body").style.opacity = ".1"
}

function displayuserinfo(a) {
    if (el('nudge_space')) el('nudge_space').style.opacity = ".2";
    hide('body');
    show("userinfo");
    el("userinfo").innerHTML = "<p style='font-size:1.4em;width:400px;height:100px;'>Loading.................";
    el("userinfo").innerHTML = responsetext("id=" + a, "/displayuserinfo.php")
}

function hideuserinfo() {
    el('userinfo').style.visibility = "hidden";
    el('body').style.visibility = "visible";
    el('nudge_space').style.opacity = "1"
}