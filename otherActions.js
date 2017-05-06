function show_oa() {

    show("other_actions");
    $("#other_actions").show();
    el("other_actions").innerHTML = loading;
    el("body").style.opacity = ".2";
    Centralize_el('other_actions');
}

function hide_otherAction() {
    $("#other_actions").hide("slow");
    el("body").style.opacity = "1"
}

function control_autor() {
    el("e_ar_button").setAttribute("onclick", "dis_autor()");
    el("e_ar_button").value = "Disable";
    el("e_ar_button").style.background = "red";
    $(".autor_text").attr("disabled", false);
    el("save_autor").disabled = false;
    ar_status = "on";
    w.postMessage("control_autor state=on");
    w.onmessage = function (b) {
        if (parseInt(b.data) != 1) {
            alert("Error: failed to enable auto responses")
        }
    }
}

function dis_autor() {
    el("e_ar_button").setAttribute("onclick", "control_autor();");
    el("e_ar_button").value = "Enable";
    el("e_ar_button").style.background = "green";
    $(".autor_text").attr("disabled", true);
    el("save_autor").disabled = true;
    ar_status = "off";
    w.postMessage("control_autor state=off");
    w.onmessage = function (b) {
        if (parseInt(b.data) != 1) {
            alert("Error: failed to disable auto responses")
        }
    }
}


function hide_actionmenu() {
    $("#menu_container").remove();
    $("#action_menu").removeClass(prepare_class(vars['lightback']));
}

function atr_request(b) {
    el(b).value = "Cancel request";
    el(b).style.background = "red";
    el(b).onclick = function () {
        cancel_atr_request(b)
    };
    el("atr_sent").innerHTML = "Authority request sent";
    send_atr_req(vuid, "request")
}

function cancel_atr_request(b) {
    el(b).value = "Send request";
    el(b).style.background = "green";
    el(b).onclick = function () {
        atr_request(b)
    };
    el("atr_sent").innerHTML = "Authority request cancled";
    send_atr_req(vuid, "cancel")
}

function send_atr_req(e, c) {
    w.postMessage("send_atr_req id=" + e + "&action=" + c);
    w.onmessage = function (a) {
        if (parseInt(a.data) != 1) {
            alert("Error :failed to send authority request")
        }
    }
}



function handle_AtrReq(b) {
    put_progress("&nbspPlease wait........");
    w.postMessage("art_action id=" + vuid + "&action=" + b);
    w.onmessage = function (a) {
        if (parseInt(a.data) == 1) {
            if (b == "allow") {
                var e = "granted";
                art_reqst = "granted"
            } else {
                var e = "request rejected";
                art_reqst = "false"
            }
            response_msg("Authority successfully  " + e, "green");
        } else {
            if (b == "allow") {
                var e = "Failed to grant authority"
            } else {
                e = "Failed to reject request"
            }
            response_msg("Error: " + e, "red");
        }
    }
}



function pa_showClist(b) {
    el("btn_" + b).src = "down.png";
    el("btn_" + b).onclick = function () {
        pa_hideClist(b)
    };
    el(b).style.background = "green";
    el(b).style.padding = "10px";
    if (inner("clist_btn_" + b).length <= 0) {
        el("clist_btn_" + b).innerHTML = loading;
        w.postMessage(b + " vuid=" + vuid);
        w.onmessage = function (a) {
            el("clist_btn_" + b).innerHTML = a.data
        }
    } else {
        $("#clist_btn_" + b).slideDown("slow")
    }
}

function pa_hideClist(b) {
    el("btn_" + b).src = "up.png";
    el(b).style.background = "none";
    el(b).style.padding = "0px";
    el("btn_" + b).onclick = function () {
        pa_showClist(b)
    };
    $("#clist_btn_" + b).hide()
}

function pa_updateColor(k, i, j, m) {
    el(m).onmouseout = function () {};
    pa_hideClist(j);
    var g = m.split("_");
    g.pop();
    g = g.join("_");
    if (c2beupdated.length == 0) {
        c2beupdated = g + "=" + i
    } else {
        if (c2beupdated.indexOf(g) != -1) {
            if (c2beupdated.indexOf("&") != -1) {
                c2beupdated = c2beupdated.split("&");
                for (var l = 0; l < c2beupdated.length; l++) {
                    if (c2beupdated[l].indexOf(g) != -1) {
                        c2beupdated[l] = "";
                        c2beupdated = c2beupdated.filter(function (a) {
                            return !(a === "" || typeof a == "undefined" || a === null)
                        });
                        break
                    }
                }
                if (c2beupdated.length > 1) {
                    c2beupdated = c2beupdated.join("&")
                } else {
                    c2beupdated = c2beupdated[0]
                }
                c2beupdated += "&" + g + "=" + i
            } else {
                c2beupdated = g + "=" + i
            }
        } else {
            c2beupdated += "&" + g + "=" + i
        }
    }
}

function save_pa() {
    el("uploading").innerHTML = "<img src='picon1.gif'> Saving changes......";
    el("body").style.opacity = ".2";
    show("uploading");
    w.postMessage("save_pa vuid=" + vuid + "&" + c2beupdated);
    w.onmessage = function (b) {
        hide("uploading");
        if (b.data.indexOf("failed") != -1) {
            response_msg("Error :failed to save changes", "red")
        } else {
            c2beupdated = "";
            response_msg("Profile appearance successfully changed")
        }
    }
}

function post_share() {
    var b = document.share_form;
    if (trim(b.share_title.value).length < 1) {
        alert("Please specify a title for this share");
        return false
    }
    if (trim(b.share_content.value).length < 1) {
        alert("Please enter content of this share");
        return false
    }
    if (trim(b.share_pic.value).length > 0 && !validpic(b.share_pic.value)) {
        alert("Invalid picture type! please choose a valid picture");
        b.share_pic.value = "";
        return false
    }
    el("uploading").innerHTML = "<img src='picon1.gif'> Creating new share.....";
    show("uploading");
    return true
}

function share_posted(f) {
    hide("uploading");
    el("other_actions").style.opacity = "1";
    if (f.indexOf("failed") == -1) {
        var e = document.share_form;
        if (el("no_share_tr")) {
            el("sbox_table").deleteRow(getRowIndex("sbox_table", "create_share_tr") - 1)
        }
        if (parseInt(el("sbox_table").rows[getRowIndex("sbox_table", "create_share_tr") - 1].cells.length) == 3 || el('sbox_table').rows.length == 2) {
            var i = el("sbox_table").insertRow(getRowIndex("sbox_table", "create_share_tr"));
            i.setAttribute("class", getRowIndex("sbox_table", "create_share_tr"))
        }
        var g = el("sbox_table").rows[getRowIndex("sbox_table", "create_share_tr") - 1].insertCell(-1);
        g.setAttribute("style", "width:250px;");
        g.id = f;
        g.setAttribute("class", "background2");
        g.innerHTML = "<span class='remove_share' id='" + (getRowIndex("sbox_table", "create_share_tr") - 1) + "_" + f + "'><span  class='red_onhover' style='float:right;' title='Remove this share'>&#215;</span></span><table><tr>";
        if (trim(e.share_pic.value).length > 0 && validpic(e.share_pic.value)) {
            g.innerHTML = g.innerHTML + "<td valign='top'><img id='img_" + f + "' class='share_pic' title='Click to enlarge this picture' src='get_share_pic.php?id=" + vuid + "&share_id=" + f + "' height='40' width='50' align='middle'></td>"
        }
        g.innerHTML = g.innerHTML + "<td><b>" + autolink(trim(e.share_title.value)) + "</b></td></tr></table><div class='sbox-block-content'>" + autolink(trim(e.share_content.value)) + "</div>";
        close_create();
        Centralize_el('other_actions');
    } else {
        response_msg("Error: failed to create share", "red")
    }
}

function close_create() {
    $("#create_share_tr").hide("slow", function () {
        el("create_share_tr").innerHTML = "<td colspan='2'></br><input type='button' value='Create a share' id='create_share' class='special_btn' style='background:blue;'></td>";
        $("#create_share_tr").show()
    })
}
var w = new Worker("w_visit.js"),
    loading = "<img src='picon1.gif'>Loading......";
if (vu_gen == "female") {
    var h = "She",
        hh = "her"
} else {
    var h = "He",
        hh = "him"
}
$(function () {
    var b;
    $("#action_menu").live("mouseenter", function () {
        var elm_ = $(this),
            m_id = "menu_container",
            pos = elm_.offset();
        if (b) {
            clearTimeout(b);
            b = null
        }
        b = setTimeout(function () {
            if (!el(m_id)) {
                $('body').append("<ul class='menu_container plain_back ' id='" + m_id + "'></ul>");
                if (luid == vuid) {
                    el("menu_container").innerHTML = "<li id='li_eyecandy'><img src='images/eyecandy.png' alt='eyecandy'  align='middle'>&nbsp;Set eyecandy picture</li><li id='li_autor'><img src='response.png' align='middle'> Set auto responses</li><li class='pp-customize-popup-trigger'><img align='middle' src='"+get_image("pref.png")+"'/>Customize Slider</li><li><a href='update.php'><img src='"+get_image("settings_icon.gif")+"' align='middle'> Settings</a></li></ul>"
                } else {
                    if (art_reqst == "granted") {
                        el("menu_container").innerHTML = "<li id='li_atr_use'><img src='authority.png'  align='middle'> Use your authority</li><li id='li_donate'><img style='position:relative;top:3px;' src='images/spend.png'/><span class='fix-pos'>&nbsp;Donate points</span></li><li id='li_eyecandy'><img src='images/eyecandy.png' alt='eyecandy'  align='middle'><span class='fix-pos'>&nbsp;Set eyecandy picture</span></li><li id='li_move'><img src='move.png'  align='middle'> Move to other list</li><li id='li_remove'><img src='remove.png'  align='middle'> Remove </li>"
                    } else {
                        if (art_reqst == "true") {
                            el("menu_container").innerHTML = "<li id='li_eyecandy'><img src='images/eyecandy.png' alt='eyecandy'  align='middle'>&nbsp;Set eyecandy picture</li><li id='li_donate'><img style='position:relative;top:3px;' src='images/spend.png'/><span class='fix-pos'>&nbsp;Donate points</span></li><li id='li_move'><img src='move.png'  align='middle'> Move to other list</li><li id='li_remove'><img src='remove.png'  align='middle'> Remove </li></ul>"
                        } else {
                            el("menu_container").innerHTML = "<li id='li_authority'><img src='authority.png'  align='middle'> Request for authority</li><li id='li_donate'><img style='position:relative;top:3px;' src='images/spend.png'/><span class='fix-pos'>&nbsp;Donate points</span></li><li id='li_eyecandy'><img src='images/eyecandy.png' alt='eyecandy'  align='middle'><span class='fix-pos'>&nbsp;Set eyecandy picture</span></li><li id='li_move'><img src='move.png'  align='middle'> Move to other list</li><li id='li_remove'><img src='remove.png'  align='middle'> Remove </li>"
                        }
                    }
                }
                $("#menu_container").css({
                    "left": (pos.left - ($("#menu_container").width() - 29)) + "px",
                    "top": (pos.top + 15) + "px"
                })
                    .show();
                elm_.addClass(prepare_class(vars['lightback']))
            }
        }, 500)
    });
    $("#action_menu, #menu_container").live("mouseleave", function () {
        if (b) {
            var elm_ = $(this);
            clearTimeout(b);
            b = null
        }
        b = setTimeout(function () {
            if (el("menu_container")) {
                if (!$("#menu_container").is(':hover')) {
                    hide_actionmenu()
                }
            }
        }, 500)
    })
});
$(".menu_container li").live("click", function () {
    if (el("action_menu")) {
        hide_actionmenu()
    }
    switch ($(this).attr("id")) {
    case "li_authority":
        show_oa();
        w.postMessage("athourity_content id=" + vuid);
        w.onmessage = function (b) {
            el("other_actions").innerHTML = b.data;
            Centralize_el('other_actions');
        };
        break;
    case "li_autor":
        show_oa();
        w.postMessage("get_autor id=" + luid);
        w.onmessage = function (b) {
            el("other_actions").innerHTML = b.data;
            Centralize_el('other_actions');
        };
        break;
    case "li_move":
        show_oa();
        w.postMessage("move_content action=move&id=" + vuid);
        w.onmessage = function (b) {
            el("other_actions").innerHTML = b.data;
            Centralize_el('other_actions');
        };
        break;
    case "li_remove":
        show_oa();
        w.postMessage("move_content action=remove&id=" + vuid);
        w.onmessage = function (b) {
            el("other_actions").innerHTML = b.data;
            Centralize_el('other_actions');
        };
        break;
    case "li_sbox":
        show_sbox();
        break;
    case "li_pref":
        show_oa();
        w.postMessage("preference_content id=" + vuid);
        w.onmessage = function (b) {
            el("other_actions").innerHTML = b.data;
            Centralize_el('other_actions');
        };
        break;
    case "li_eyecandy":
        show_oa();
        if (vu_prof_pic) {
            el("other_actions").innerHTML = "<div class='fr'><span class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span></div><div class='clear'></div><table cellspacing='2'><tr><td align='left' valign='top'><h2><img src='images/eyecandy.png' align='middle' />&nbsp;Set eyecandy picture</h2>You are about to add this user's profile picture as<br/> your eyecandy picture.<br/><br/>This picture will be added to the current list of<br/> eyecandy pictures.<br/><br/><input type='button' class='special_btn' value='Proceed' id='set_eyecandy_pic'/><input type='button' value='Cancel' onclick='hide_otherAction();' class='btn'/></td><td><img height='230' width='230' src='" + el("vu_prof_pic").src + "'/></td></tr></table>"
        } else {
            el("other_actions").innerHTML = "<div class='fr'><span class='red_onhover' onclick='hide_otherAction();' title='Close'>&#215;</span></div><div class='clear'></div><h2><img src='alert.gif' align='middle'/>Sorry, no picture to set</h2>This user doesn't have any profile picture uploaded yet that can be set as your new eyecandy picture.<br/><br/><input type='button' value='Okay' onclick='hide_otherAction();' class='special_btn plain_greybackg'>";
        }
        Centralize_el('other_actions');
        break;
    
    case "li_donate":
        show_oa();
        w.postMessage("get_donate_content id=" + vuid);
        w.onmessage = function (a) {
            el("other_actions").innerHTML = a.data;
            Centralize_el('other_actions');
        };
        break
    }
});
$("#donate_points").live("click", function () {
    var a = $(".offer_point_field").val();
    if (!a) {
        apprise("Please enter the points you want to donate");
        return
    }
    update_points(a, "deduce");
    setTimeout(function () {
        hide_otherAction();
        show("uploading");
        el("uploading").innerHTML = "<img src='picon1.gif' alt='loading..'/>Donating points.....";
        w.postMessage("donate_points id=" + vuid + "&p=" + a);
        w.onmessage = function (b) {
            hide("uploading");
            if (parseInt(b.data) == 1) {
                response_msg("Points successfully donated")
            } else {
                response_msg("Error: failed to donate points", "red")
            }
        }
    }, 2000)
});


$("#save_autor").live("click", function () {
    $("#other_actions").hide("slow");
    el("uploading").innerHTML = "<img src='picon1.gif'>Saving changes......";
    show("uploading");
    var e = 0,
        c = [""];
    $(".autor_text").each(function () {
        c[e] = this.id + "=" + encodeURIComponent(this.value.substring(0, 200));
        e++
    });
    w.postMessage("post_autor id=" + luid + "&" + c.join("&"));
    w.onmessage = function (a) {
        hide("uploading");
        if (parseInt(a.data) != 1) {
            response_msg("Error: Failed to save auto responses ", "red")
        } else {
            response_msg("Auto responses successfully saved")
        }
    }
});
var timer1 = null;
$("#li_atr_use").live("mouseenter", function () {

    if (timer1) {
        clearTimeout(timer1);
        timer1 = null
    }
    timer1 = setTimeout(function () {
        if (el("li_atr_use").lastChild.nodeName != "LI") {
            var b = document.createElement("li");
            b.id = "change_pa_option_container";
            b.innerHTML = "<li id='change_pa'>Change profile appearance</li><li id='revoke_atr'>Revoke authority</li>";
            el("li_atr_use").appendChild(b)
        }
    }, 100)
});
$("#li_atr_use").live("mouseleave", function () {
    if (timer1) {
        clearTimeout(timer1);
        timer1 = null
    }
    timer1 = setTimeout(function () {
        if (el("li_atr_use").lastChild.nodeName == "LI") {
            el("li_atr_use").removeChild(el("li_atr_use").lastChild)
        }
    }, 300)
});
$("#revoke_atr").live("click", function () {
    if (vu_gen == "female") {
        var b = "her"
    } else {
        var b = "his"
    }
    show_oa();
    el("other_actions").innerHTML = "<table><tr><td><h3><img src='alert.gif' align='middle'>Revoke authority</h3></td></tr><tr><td><b>Are you sure you want to revoke authority?</br>You too will loose the authority to change the appearance of " + b + " profile.</b></td></tr><tr><td></br><input type='button' class='special_btn' id='revoke_atr_btn' style='background:red;' value='Proceed'><input type='button' class='btn' value='Cancel' onclick='hide_otherAction();'></td></tr></table>";
    Centralize_el('other_actions');
});
$("#revoke_atr_btn").live("click", function () {
    $("#other_actions").hide("slow", function () {
        el("uploading").innerHTML = "<img src='picon1.gif'> Saving changes.......";
        show("uploading");
        w.postMessage("revoke_atr id=" + vuid);
        w.onmessage = function (b) {
            hide("uploading");
            if (parseInt(b.data) == 1) {
                response_msg("Authority successfully revoked");
                art_reqst = "false";
                if (el("atr_req_div")) {
                    el("atr_req_div").innerHTML = ""
                }
            } else {
                response_msg("Error:Failed to revoke authority", "red")
            }
        }
    })
});
$("#change_pa").live("click", function () {
    show_oa();
    el("body").style.opacity = "1";
    w.postMessage("change_pa_content id=" + vuid);
    w.onmessage = function (b) {
        el("other_actions").innerHTML = b.data;
        Centralize_el('other_actions');
    }
});
$(".pa_btn").live("mouseenter", function () {
    var b = $(this).attr("id");
    el("btn_" + b).onclick = function () {
        pa_showClist(b)
    }
});
sessionStorage.setItem("c2beupdated", "");
var c2beupdated = sessionStorage.getItem("c2beupdated");
$("#pa_save").live("click", function () {
    if (c2beupdated.length == 0) {
        alert("Please make changes before you save them");
        return
    }
    if (el("special_div").style.visibility == "hidden") {
        $("#other_actions").hide("slow", save_pa)
    } else {
        $("#special_div").hide("slow", function () {
            hide("special_div");
            save_pa()
        })
    }
});
$("#pa_preview").live("click", function () {
    $("#other_actions").hide("slow", function () {
        el("special_div").setAttribute("style", "position:absolute;top:10px;right:10px;");
        el("special_div").innerHTML = "<input type='button' value='Maximize' class='special_btn' style='background:grey;' id='pa_max'> <input type='button' value='Save changes' class='special_btn' id='pa_save'> <input type='button' value='Cancel' class='special_btn' style='background:red;' title='Restore original appearance' id='pa_restore'>";
        show("special_div")
    })
});
$("#pa_max").live("click", function () {
    $("#special_div").hide("slow", function () {
        hide("special_div");
        $("#other_actions").show("slow")
    })
});
$("#pa_restore").live("click", function () {
    $("#special_div").hide("slow", function () {
        hide("special_div");
        var e = vu_pa.split(",");
        set_vpb(vpb_dir + e[0]);
        cl_back(e[1]);
        for (var c = 0; c < el("visit_buttonset").rows[0].cells.length; c++) {
            el("visit_buttonset").rows[0].cells[c].style.background = e[2]
        }
        setRelColor(e[3]);
        el("profile_comments").style.background = e[4];
        c2beupdated = ""
    })
});
$("#m2list_btn").live("click", function () {
    if (el("m2list").options[el("m2list").selectedIndex].value.length == 0) {
        alert("Please choose a list where you want to move " + hh);
        return
    } else {
        var e = el("m2list").options[el("m2list").selectedIndex].text,
            c = el("m2list").options[el("m2list").selectedIndex].value;
        $("#other_actions").hide("slow", function () {
            el("uploading").innerHTML = "<img src='picon1.gif'> Moving " + hh + " to " + e + " list";
            show("uploading");
            w.postMessage("m2list m2list=" + c + "&id=" + vuid);
            w.onmessage = function (a) {
                hide("uploading");
                if (parseInt(a.data) == 1) {
                    response_msg("Successfully moved to " + e + " list");
                    el("inlist_msg").innerHTML = "<b style='color: green;'>" + h + "</b> <font color='red'>is in your</font> <font color='green'><b>" + e + "</b></font> <font color='red'> list</font>"
                } else {
                    response_msg("Error :failed to move " + hh + " to " + e + " list", "red")
                }
            }
        })
    }
});
$("#remove_btn").live("click", function () {
    $("#other_actions").hide("slow", function () {
        el("uploading").innerHTML = "<img src='picon1.gif'> Removing " + hh + ".......";
        show("uploading");
        w.postMessage("remove_rel id=" + vuid);
        w.onmessage = function (b) {
            hide("uploading");
            if (parseInt(b.data) == 1) {
                response_msg("Relation successfully removed");
                el("inlist_msg").innerHTML = "";
                art_reqst = "false"
            } else {
                response_msg("Error: failed to remove your relation", "red")
            }
        }
    })
});

function show_sbox() {
    show_oa();
    w.postMessage("sbox_content id=" + vuid);
    w.onmessage = function (b) {
        el("other_actions").innerHTML = b.data;
        Centralize_el('other_actions');
    };
}
$("#create_share").live("click", function () {
    el("create_share_tr").innerHTML = "<td class='background2' style='box-shadow:5px 5px 2px black;'><p><b>Create new share</b><span  class='red_onhover' style='float:right;'  title='Close' onclick='close_create();'>&#215;</span></p><p><form method='post' id='share_form' name='share_form' action='create_share.php' enctype='multipart/form-data' target='upload_target' onsubmit='return post_share();'><p><span style='margin-right:80px;'>Title</span><textarea placeholder='Maximum 30 characters' name='share_title' id='share_title' style='width:250px; height:25px;' maxlength='30' class='flexible_textarea'></textarea></p><p><span style='margin-right:58px;'>Content</span><textarea name='share_content' maxlength='100' id='share_content' style='width:250px; height:25px;' placeholder='Maximum 100 characters'  class='flexible_textarea'></textarea></p><p>Picture(optional) <input size='25' type='file' name='share_pic' id='share_pic' /></p><p><input type='submit' class='special_btn' value='Create'></p></form></td>"
});
$(".remove_share").live("click", function () {
    if (confirm("Proceed to removing share?")) {
        if (el($(this).attr("id").split("_")[0])) {
            var e = el("sbox_table").rows[getRowIndex("sbox_table", $(this).attr("id").split("_")[0]) - 1]
        } else {
            var e = el("sbox_table").rows[getRowIndex("sbox_table", parseInt($(this).attr("id").split("_")[0]) - 1)]
        }
        for (var c = 0; c < e.cells.length; c++) {
            if (e.cells[c].id == $(this).attr("id").split("_")[1] + "_" + $(this).attr("id").split("_")[2]) {
                e.deleteCell(c);
                break
            }
        }
        w.postMessage("remove_share share_id=" + $(this).attr("id").split("_")[1] + "_" + $(this).attr("id").split("_")[2]);
        Centralize_el('other_actions');
        w.onmessage = function (a) {
            if (parseInt(a.data) != 1) {
                alert("Error: failed to remove share")
            }
        }
    }
});
$("#save_pref").live("click", function () {
    $("#other_actions").hide("slow", function () {
        el("uploading").innerHTML = "<img src='picon1.gif'>&nbsp;Saving your preferences.......";
        show("uploading");
        var j = document.forms.pref_form,
            f = document.forms.popup_form,
            g = document.forms.email_visibility_form,
            l = document.forms.msg_pref_form;
        for (var c = 0; c < j.email_pref.length; c++) {
            if (j.email_pref[c].checked) {
                var k = j.email_pref[c].value;
                break
            }
        }
        for (var c = 0; c < f.popup_pref.length; c++) {
            if (f.popup_pref[c].checked) {
                var e = f.popup_pref[c].value;
                break
            }
        }
        for (var c = 0; c < g.email_visibility.length; c++) {
            if (g.email_visibility[c].checked) {
                var b = g.email_visibility[c].value;
                break
            }
        }
        for (var c = 0; c < l.msg_pref.length; c++) {
            if (l.msg_pref[c].checked) {
                var a = l.msg_pref[c].value;
                break
            }
        }
        w.postMessage("save_pref email_pref=" + k + "&popup_pref=" + e + "&email_visibility=" + b + "&msg_pref=" + a);
        w.onmessage = function (i) {
            hide("uploading");
            if (parseInt(i.data) != 1) {
                response_msg("Error :Failed to save preferences", "red")
            } else {
                response_msg("preferences successfully saved")
            }
        }
    })
});
$("#set_eyecandy_pic").live("click", function () {
    $("#other_actions").hide("slow", function () {
        el("uploading").innerHTML = "<img src='picon1.gif'/> Setting your eyecandy picture........";
        show("uploading");
        w.postMessage("set_eyecandy vuid=" + vuid + "&pic_url=" + encodeURIComponent(el("vu_prof_pic").src.replace("image", "original")));
        w.onmessage = function (a) {
            hide("uploading");
            if (a.data.indexOf("failed") != -1) {
                response_msg("Error: failed to set eyecandy picture", "red")
            } else {
                response_msg("Picture successfully set")
            }
        }
    })
});
if (art_reqst == "true" && vuid != luid) {

    var n = noty({
        text: h + " is asking you to grant " + hh + " the authority to be able to change appearance of your profile",
        type: 'confirm',
        dismissQueue: true,
        //modal: true,
        layout: 'top',
        theme: 'defaultTheme',
        buttons: [{
            addClass: 'special_btn',
            text: "Allow",
            onClick: function ($noty) {

                $noty.close();
                handle_AtrReq("allow");
            }
        }, {
            addClass: 'special_btn red_bg',
            text: 'Reject',
            onClick: function ($noty) {
                $noty.close();
                handle_AtrReq("reject");
            }
        }],
        closeWith: ['button']

    });




    var d = document.createElement("div");
    d.setAttribute("style", "position:absolute;top:305px;right:460px;text-align:center;width:30%;font-weight:bold;"); //d.innerHTML=h+" is asking you to grant "+hh+" the authority to be able to change your profile appearance</br><input type='button' value='Allow' //onclick='handle_AtrReq(\"allow\");'><input type='button' value='Reject' onclick='handle_AtrReq(\"reject\");'>";

    d.id = "atr_req_div";
    el("body").appendChild(d)
};