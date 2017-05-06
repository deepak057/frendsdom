var w = new Worker("w_visit.js"),
    loading = "<img src='picon1.gif'>Loading......";



function show_fback_option(a) {


    //el("relation_status").style.opacity=".2";

    vars['ur_margin_top'] = $("#response_div").css("top");
    $("#response_div").css("top", "30px");
    if (!el("fback_options")) {
        if (a == "female") {
            var b = "she",
                c = "her"
        } else {
            var b = "he",
                c = "his"
        }


        var d = document.createElement("div"),
            e = '"' + a + '","like"',
            f = '"' + a + '","dislike"',
            g = '"' + a + '","love"',
            h = '"' + a + '","hate"',
            i = '"' + a + '","stupid"',
            j = '"' + a + '","awesom"',
            k = '"' + a + '","likeminded"',
            l = '"' + a + '","alterd"',
            m = '"' + a + '","best"',
            n = '"' + a + '","no"';
        d.setAttribute("class", "plain_back");
        d.id = "fback_options";
        d.innerHTML = "<span class='red_onhover' style='float:right;' title='Close' onclick='close_feedback();' >&#215;</span><ul class='f_options'><li onclick='get_feedback(" + e + ");'><img src='like.bmp' height='20' width='20'>You liked " + c + " profile</li><li onclick='get_feedback(" + f + ");'><img src='dislike.bmp' height='20' width='20'>You disliked " + c + " profile</li><li onclick='get_feedback(" + g + ");'><img src='love.bmp' height='20' width='20'>You loved " + c + " profile</li><li onclick='get_feedback(" + h + ");'><img src='hate.bmp' height='20' width='20'>You hated " + c + " profile</li><li onclick='get_feedback(" + i + ");'><img src='stupid.bmp' height='20' width='20'>You think color combination is stupid</li><li onclick='get_feedback(" + j + ");'><img src='awesom.bmp' height='20' width='20'>You think color combination is awesome</li><li onclick='get_feedback(" + k + ");'><img src='likeminded.bmp' height='20' width='20'>You think you two are like minded</li><li onclick='get_feedback(" + l + ");'><img src='alterd.bmp' height='20' width='20'>You think color combination should be altered</li><li onclick='get_feedback(" + m + ");'><img src='best.bmp' height='20' width='20'>You think this is the best " + b + " can do</li><li onclick='get_feedback(" + n + ");'><font color='red'> No feedback</font></li></ul>";
        el("response_div").appendChild(d);
        $("#fback_options").hide();
        $("#fback_options").show("slow")
    } else {
        $("#fback_options").show("slow")
    }
}

function get_feedback(a, b) {
    close_feedback();
    el("lu_feedback").innerHTML = get_feedback_string(a, b);
    if (b != "no") {
        if (!el("fback_pic")) {
            var c = document.createElement("img");
            c.setAttribute("id", "fback_pic");
            el("response_div").appendChild(c)
        }
        el("fback_pic").src = b + ".bmp";
        show("fback_pic")
    } else {
        hide("fback_pic")
    }
    w.postMessage("feedback fback=" + b);
    w.onmessage = function (a) {
        if (parseInt(a.data) != 1) {
            el("lu_feedback").innerHTML = "<font color='red'>Failed to save your feedback</font>"
        } else {
            if (ar_status == "on" && b != "no") {
                w.postMessage("get_ar_text fback=" + b);
                w.onmessage = function (a) {
                    if (a.data) apprise(a.data, {
                        "animate": true
                    });
                }
            }
        }
    }
}

function get_feedback_string(a, b) {
    if (a == "female") {
        var c = "she",
            d = "her"
    } else {
        var c = "he",
            d = "his"
    }
    switch (b) {
    case "like":
    case "dislike":
    case "hate":
    case "love":
        return "You " + b + " " + d + " profile";
        break;
    case "stupid":
    case "awesom":
        return "You think color combination is " + b;
        break;
    case "likeminded":
        return "You think you two are like minded";
        break;
    case "alterd":
        return "You think color combination should be altered";
        break;
    case "best":
        return "You think this is the best " + c + " can do";
        break;
    default:
        return "No feedback from you";
        break
    }
}

function close_feedback() {
    $("#fback_options").hide("slow", function () {
        $("#response_div").css("top", vars['ur_margin_top']);
    });


}

function hide_fbackfrom() {
    hide("fback_from");
    el("fback_statistic").style.opacity = "1"
}

function fback_from(a, b) {
    if (b == "all") {
        el("fback_from").style.right = "350px";
        el("fback_from").innerHTML = loading;
        show("fback_from");
        w.postMessage("fback_from id=" + a + "&fback=" + b);
        w.onmessage = function (a) {
            el("fback_from").innerHTML = a.data
        }
    } else alert("Invalid feedback value")
}

function comments_from(a) {
    el("fback_from").innerHTML = loading;
    show("fback_from");
    w.postMessage("comments_from id=" + a);
    w.onmessage = function (a) {
        el("fback_from").innerHTML = a.data
    }
}

function show_profileComments(a, b) {
    el("relation_status").style.opacity = ".2";
    show("profile_comments");

    var response_div = $("#response_div"),
        top = response_div.offset().top,
        left = response_div.offset().top,
        height = response_div.innerHeight();
    $("#profile_comments").show().css({
        top: (top + height + 5) + "px",
        left: (left - 10) + "px"
    });


    el("profile_comments").innerHTML = loading;
    el("total_comments").title = "refresh";
    if (b) {
        var c = inner("total_comments").split(" ");
        if (parseInt(c[0]) > 0) cmnt = parseInt(c[0]);
        else cmnt = "no_comment"
    }
    w.postMessage("get_profileComments id=" + a + "&n=" + cmnt);
    w.onmessage = function (a) {
        el("profile_comments").innerHTML = a.data;
    }
}

function get_profilecomments(a, b) {
    if (a == "prev") cmnt -= 15;
    else cmnt += 15;
    show_profileComments(b, false)
}

function close_comment() {
    $("#profile_comments").hide("slow");
    if (el("comment_colorlistContainer")) hide("comment_colorlistContainer");
    el("relation_status").style.opacity = "1"
}

function post_comment(a, b, c, d) {
    if (trim(document.getElementById("txt_comment").value).length > 0) {
        var e = el("profile_comments");
        var f = e.insertRow(getRowIndex("profile_comments", "postcomment_tr"));
        f.class = "remove_cmt";
        var g = "span_" + (new Date).getTime();
        f.innerHTML = "<td></td><td><span id='" + g + "' class='red_onhover' title='Remove this comment' style='position:relative;right:-60px;'>&#215</span></td>";
        var h = e.insertRow(getRowIndex("profile_comments", "postcomment_tr"));
        h.setAttribute("class", "bottom_border");
        var i = h.insertCell(0);
        i.setAttribute("colspan", "2");
        h.class = "bottom_border1";
        i.innerHTML = "<div style='width:540px;' class='comment_content'><div class='fl'><div class='image_part'><img src='" + d + "' align='middle'></div><div class='text_part'><a href='visit.php?id=" + b + "' class='fback_from1' id='" + b + "'><b>" + c.split(" ")[0] + ":</b></a></div><div class='clear'></div></div><div class='fr'>" + autolink(htmlEntities(trim(document.getElementById('txt_comment').value))).replace(/\n/g, '<br />') + "</div><div class='clear'></div><div class='bottom'><span class='light_text'> " + current_date() + "</span></div></div>";
        var j = "post_profilecomment id=" + a + "&comment=" + encodeURIComponent(document.getElementById("txt_comment").value);
        document.getElementById("txt_comment").value = "";
        document.getElementById("txt_comment").setAttribute("style", "height:25px;width:450px;");
        document.getElementById("txt_comment").setAttribute("placeholder", "Your comment");
        w.postMessage(j);
        w.onmessage = function (a) {
            if (a.data.indexOf("failed") != -1) {
                alert("failed to post the comment")
            } else {
                h.id = "cmt" + a.data;
                f.id = "remove_cmt" + a.data;
                $("#" + g).live("click", function () {
                    remove_cmt("profilecomments4user" + vuid, a.data)
                });
                el("total_comments").innerHTML = parseInt(inner("total_comments")) + 1 + " comments"
            }
        }
    } else alert("Your comment can not be empty")
}


function colorlist4comment(a) {

    if (!$("#comment_colorlistContainer").length) {
        $("#body").append("<div id='comment_colorlistContainer'></div>");
    }

    var offset = $("#profile_comments").offset();
    $("#comment_colorlistContainer").css({
        top: offset.top + "px",
        left: (offset.left - 120) + "px"
    }).addClass("colorlist");

    if (el("comment_colorlistContainer")) show("comment_colorlistContainer");
    if (a) {
        el("comment_colorlistContainer").innerHTML = loading;
        w.postMessage("getcolor4profileComments id=" + a);
        w.onmessage = function (a) {
            el("comment_colorlistContainer").innerHTML = a.data
        }
    } else {
        $("#comment_colorlistContainer").slideDown("slow")
    }
    el("comment_clist").innerHTML = "&#8711";
    el("comment_clist").setAttribute("onclick", "hide_colorlist4comment();")
}

function hide_colorlist4comment() {
    $("#comment_colorlistContainer").slideUp("slow");
    el("comment_clist").innerHTML = "&#916;";
    el("comment_clist").setAttribute("onclick", "colorlist4comment();")
}

function update_cm(a, b) {
    el("cm" + b).setAttribute("onmouseout", "");
    hide_colorlist4comment();
    el("profile_comments").style.background = b;
    w.postMessage("update_entity entity=comments_backg&value=" + b);
    w.onmessage = function (c) {
        if (parseInt(c.data) != 1) el("profile_comments").style.background = a;
        else changecss(1, ".comment", "background", b)
    }
}

function remove_cmt(a, b) {
    var c = confirm("Proceed to removing comment?");
    if (c) {
        el("profile_comments").deleteRow(getRowIndex("profile_comments", "cmt" + b));
        el("profile_comments").deleteRow(getRowIndex("profile_comments", "remove_cmt" + b));
        w.postMessage("remove_cmt table=" + a + "&index=" + b);
        w.onmessage = function (a) {
            if (parseInt(a.data) != 1) alert("Error: Failed to delete comment");
            else el("total_comments").innerHTML = parseInt(inner("total_comments")) - 1 + " comments"
        }
    }
}
preload(["like.bmp", "hate.bmp", "dislike.bmp", "love.bmp", "awesom.bmp", "alterd.bmp", "best.bmp", "stupid.bmp", "likeminded.bmp"]);
$(function () {
    $(".fback_from1").live("mouseenter", function () {
        $(this).hovercard({
            showCustomCard: true,
            customCardJSON: JSON.parse(responsetext("id=" + $(this).attr("id"), "displayuserinfo2.php")),
            onHoverOut: function () {
                $(this).hovercard({
                    detailsHTML: ""
                })
            }
        })
    })
});
$(".fback_from1").live("mouseleave", function () {
    $(".fback_from1").die("mouseenter");
    $(".fback_from1").mouseenter(function () {
        $(this).hovercard({
            showCustomCard: true,
            customCardJSON: JSON.parse(responsetext("id=" + $(this).attr("id"), "displayuserinfo2.php")),
            onHoverOut: function () {
                $(this).hovercard({
                    detailsHTML: ""
                })
            }
        })
    })
});
sessionStorage.setItem("comment_count", "0");
var cmnt = parseInt(sessionStorage.getItem("comment_count"));
$(".remove_cmt").live("mouseenter", function () {
    show($(this).attr("id"))
});
$(".remove_cmt").live("mouseleave", function () {
    hide($(this).attr("id"))
});
$(".bottom_border1").live("mouseenter", function () {
    show("remove_" + $(this).attr("id"))
})