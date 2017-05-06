function msg1() {
    show("msgmenu");Centralize_el("msgmenu");
    $("#msgmenu").hide();
    $("#msgmenu").show("slow");
    el("body").style.opacity = ".2";
}

function sendmsg(c, b, a) {
    if (a.length < 1) {
        alert("Please enter the names of recipients");
        return
    }
    $("#msgmenu").hide("slow");
    text = encodeURIComponent(trim(b)), c = encodeURIComponent(trim(c));
    if (text) {
        el("body").style.opacity = ".2";
        el("uploading").innerHTML = "Sending your message........";
        show("uploading");
        if (Object.prototype.toString.call(a) === "[object Array]") {
            w.postMessage("send_msg_multipleRcp title=" + c + "&msg=" + text + "&toids=" + a.join("|"))
        } else {
            w.postMessage("send_msg title=" + c + "&msg=" + b + "toid=" + a)
        }
        w.onmessage = function (d) {
            hide("uploading");
            if (d.data == "success") {
                response_msg("Message successfully sent");
                $("#msg_title").val("No Title");
                $("#msg_text").val("");

            } else {
                response_msg("Error: failed to send message", "red")
            }
        }
    } else {
        $("#msgmenu").show("slow");
        alert("Please write something in text area")
    }
}

function offmsg() {
    $("#msgmenu").hide("slow");
    el("body").style.opacity = "1"
}

function namehints(a) {
    show("txtHint");
    el("txtHint").innerHTML = "Loading............";
    w.postMessage("namehints str=" + a);
    w.onmessage = function (b) {
        el("txtHint").innerHTML = b.data
    }
}

function addname(f, e) {
    el("txt1").value = " ";
    hide("userinfo");
    hide("txtHint");
    el("txtHint").innerHTML = "";
    var b = document.forms.nudgeform.elements.userlist.value,
        c = b.split(" "),
        d = false;
    for (i = 0; i < c.length; i++) {
        if (c[i] == f) {
            d = true;
            break
        }
    }
    if (!d) {
        document.forms.nudgeform.elements.userlist.value = b + " " + f;
        var a = '("' + e + '","' + f + '")';
        el("nudgenames").innerHTML = el("nudgenames").innerHTML + "<span id='id" + f + "' onmouseover='mover" + a + "' onmouseout='mout" + a + "' onclick='mclick" + a + "'></span>";
        el("id" + f).innerHTML = ",<b>" + e + "</b>"
    }
    if ((el("known").innerHTML == "") && (d == false)) {
        el("known").innerHTML = '</br><input  type="checkbox" name="known" value="yes">Let recepeints know who else you included';
        $("#known").hide();
        $("#known").show("slow")
    }
    var c = document.forms.nudgeform.elements.userlist.value.split(" ");
    if ((el("known").innerHTML != "") && (c.length < 2)) {
        $("#known").hide("slow")
    }
}

function mover(e, d) {
    el("id" + d).style.background = "grey";
    if (el("id" + d).lastChild.nodeName != "SPAN") {
        var c = document.createElement("span"),
            a = "('" + e + "','" + d + "')",
            b = "'none'";
        c.innerHTML = '<a href="#" onmouseover="this.style.background=' + b + ';"><span style="position:relative;top:-3px;margin-left:4px;font-weight:bold;color:red;" title="Exclude ' + e + '" onclick="deleteentry' + a + '">&#215;</span></a> ';
        el("id" + d).appendChild(c)
    }
}

function mclick(b, a) {
    el("id" + a).style.background = "none";
    if (el("id" + a).lastChild.nodeName == "SPAN") {
        el("id" + a).removeChild(el("id" + a).lastChild)
    }
}

function checked() {
    var b = document.nudgeform.elements.list,
        c = false;
    for (var a = 0; a < b.length; a++) {
        if (b[a].checked == true) {
            c = true;
            break
        }
    }
    if (c == false) {
        return false
    } else {
        return true
    }
}

function deleteentry(d, c) {
    el("nudgenames").removeChild(el("id" + c));
    var b = document.forms.nudgeform.elements.userlist.value.split(" "),
        a = 0;
    for (; a < b.length; a++) {
        if (b[a] == c) {
            break
        }
    }
    b.splice(a, 1);
    document.forms.nudgeform.elements.userlist.value = b.join(" ");
    var b = document.forms.nudgeform.elements.userlist.value.split(" ");
    if ((el("known").innerHTML != "") && (b.length < 2) && ((el("includelist").innerHTML == "") || (checked() == false))) {
        $("#known").hide("slow");
        el("known").innerHTML = ""
    }
}

function includelst() {
    if (el("includelist").innerHTML == "") {
        el("includelist").innerHTML = '<b>Include entire list</b><p><input type="checkbox" name="list" value="friend">Friend<input type="checkbox" name="list" value="col">Collegue<input type="checkbox" name="list" value="family">Family<input type="checkbox" name="list" value="Aqu">Acquaintance<input type="checkbox" name="list" value="no">No prior acquaintance</p><input type="button" style="position:relative;left:180px;font-size:.8em;" id="btn"  value="Include" onclick="hideincludelst()">'
    }
    el("includelist").style.border = "1px dotted black";
    $("#includelist").hide();
    $("#includelist").show("slow");
    $("#ieltext").hide("slow")
}

function hideincludelst() {
    $("#includelist").hide("slow");
    $("#ieltext").show("slow");
    if (checked()) {
        if (el("known").innerHTML == "") {
            el("known").innerHTML = '</br><input  type="checkbox" name="known" value="yes">Let recepeints know who else you included';
            $("#known").hide();
            $("#known").show("slow")
        }
    } else {
        var a = document.forms.nudgeform.elements.userlist.value.split(" ");
        if ((el("known").innerHTML != "") && (a.length < 2)) {
            $("#known").hide("slow");
            el("known").innerHTML = ""
        }
    }
}

function stopUpload1(a) {
    if (a == 1) {
        el("success").innerHTML = 'You have nudged &nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="javascript:void(0)">OK</a></spam>';
        el("success").style.color = "green";
        show("success")
    } else {
        el("success").style.color = "red";
        el("success").innerHTML = 'Failed to nudge &nbsp;&nbsp;<span id="okbutton" onclick="hidemsg()"><a href="javascript:void(0)">OK</a></span>';
        show("success")
    }
    hide("uploading");
    return true
}

function nudge() {
    $("#nudgemenu").hide("slow");
    var h = document.forms.nudgeform.elements.nudgetext.value,
        g = true;
    if (h) {
        if (h.length > 100) {
            alert("Breached: Your msg size has exceeded 100 characters.\nOnly first 100 characters would be taken as your nudge text")
        }
        var f = [],
            a = 0,
            e = document.forms.nudgeform.elements.list;
        if (e) {
            for (var d = 0; d < e.length; d++) {
                if (e[d].checked == true) {
                    f[a] = e[d].value;
                    a++
                }
            }
        }
        document.forms.nudgeform.elements.list1.value = f.join(" ");
        var c = document.forms.nudgeform.elements.nudgeclip.value,
            b = document.forms.nudgeform.elements.nudgepic.value;
        if ((c.length > 0) && (validclip(c) == false)) {
            alert("Invalid clip type. \nPlease choose a sound file with .WAV extension.");
            document.forms.nudgeform.elements.nudgeclip.value = "";
            $("#nudgemenu").show("slow");
            g = false;
            document.forms.nudgeform.elements.send.value = "no"
        }
        if ((b.length > 0) && (validpic(b) == false)) {
            alert("Invalid pic type. \nPlease choose an image file with .JPG or .GIF extension.");
            document.forms.nudgeform.elements.nudgepic.value = "";
            $("#nudgemenu").show("slow");
            g = false;
            document.forms.nudgeform.elements.send.value = "no"
        }
        if (g) {
            document.forms.nudgeform.elements.send.value = "yes";
            el("uploading").innerHTML = "Please wait for a while......";
            show("uploading");
            return true
        }
    } else {
        alert("You can't leave nudge textarea empty.\nPlease write something.");
        el("body").style.opacity = ".2";
        $("#nudgemenu").show("slow");
        return false
    }
}

function show_payAttention() {
    if (el("known").innerHTML != "") {
        el("beforeupload").style.top = "-235px"
    } else {
        el("beforeupload").style.top = "-180px"
    }
    show("beforeupload");
    $("#beforeupload").hide();
    $("#beforeupload").show("slow")
}

function hide_payAttention() {
    $("#beforeupload").hide("slow")
}

function show_hide_rel(a) {
    if (a == "hide") {
        $("#main_container").slideUp("slow");
        rel_hide();
        hide("rel_color_div")
    }
    if (a == "show") {
        $("#main_container").slideDown("slow");
        rel_show();
        show("rel_color_div")
    }
    w.postMessage("rel_status action=" + a)
}

function visible() {
    hide("wavefilebutton");
    el("body").style.opacity = ".2";
    show("uploadwavefilemenu");
    $("#uploadwavefilemenu").slideDown("slow");
    show("clipinfo");
    $("#clipinfo").show("slow")
}


function startUpload() {
    put_progress(" Uploading your clip...");
    hide("uploadwavefilemenu");
    hide("clipinfo");
    $("#alreadyuploaded").hide("slow");
    return true
}


function stopUpload(b) {
    var a = "";
    if (b == 1) {
        el("success").innerHTML = 'Your clip has been uploaded&nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="javascript:void(0)">OK</a></spam>';
        el("success").style.color = "green";
        show("success")
    } else {
        el("success").style.color = "red";
        el("success").innerHTML = 'Failed to upload file&nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="javascript:void(0)">OK</a></spam>';
        show("success")
    }
    hide("uploading");
    return true
}


function upldagain() {
    el("body").style.opacity = ".2";
    el("alreadyuploaded").innerHTML = "<span class='loading_big'>Loading.........";
    show("alreadyuploaded");
    $("#alreadyuploaded").show();
    Centralize_el("alreadyuploaded");
    $.post("cliplist.php", {
        flag: true
    }, function (d) {
        el("alreadyuploaded").innerHTML = d;
        transform_select_init("width-350");
    });
}


function changeclip(b) {

    var a = document.forms.selectclip.elements.clip.value;
    if (a != "select") {
        var d = null,
            c = null;
        if (b == "change") {
            d = "change";
            c = "changed"
        } else {
            d = "delete";
            c = "deleted"
        }
        $("#alreadyuploaded").hide("slow");

        w.postMessage("cOrd_clip clip=" + a + "&action=" + b);
        w.onmessage = function (f) {
            if (f.data == "success") {
                el("success").innerHTML = "Clip " + c + ' successfully &nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="javascript:void(0)">OK</a></spam>';
                show("success")
            } else {
                el("success").style.color = "red";
                el("success").innerHTML = "Failed to " + d + ' clip &nbsp;&nbsp;<spam id="okbutton" onclick="hidemsg()"><a href="javascript:void(0)">OK</a></spam>';
                show("success")
            }
        }
    } else {
        alert("Please make a selection ")
    }
}

function pp_change_btnset_color(color) {
    $("#wavefilebutton,#action_menu").css("background", color);
}


function hidecolorlist4btnset() {
    $("#visitbtnset_colorlist").slideUp("slow");
    el("getcolorlist4btnset").setAttribute("onclick", "showcolorlist4btnset();");
    el("getcolorlist4btnset").setAttribute("title", "get the colorlist");
    el("getcolorlist4btnset").innerHTML = "&#x21D2;"
}

function showcolorlist4btnset() {
    show("visitbtnset_colorlist");
    $("#visitbtnset_colorlist").slideDown("slow");
    el("getcolorlist4btnset").setAttribute("onclick", "hidecolorlist4btnset();");
    el("getcolorlist4btnset").setAttribute("title", "hide colorlist");
    el("getcolorlist4btnset").innerHTML = "&#8656;"
}

function getbtnsetfile(a) {
    show("customize_btnset");
    $("#customize_btnset").hide();
    $("#customize_btnset").show("slow");
    data = "id=" + a;
    w.postMessage("btnset " + data);
    w.onmessage = function (b) {
        el("visitbtnset_colorlist").innerHTML = b.data
    }
}

function changebtnsetcolor(a) {
    for (var b = 0; b < el("btnset").rows[0].cells.length; b++) {
        el("btnset").rows[0].cells[b].style.background = a
    }
}

function updatebtnsetcolor(b, a) {
    el("b" + a).setAttribute("onmouseout", "changebtnsetcolor('" + a + "');");
    hidecolorlist4btnset();
    w.postMessage("updatebtnsetcolor entity=visit_buttonset&value=" + a);
    w.onmessage = function (c) {
        if (c.data != 1) {
            changebtnsetcolor(b)
        } else {
            pp_change_btnset_color(a);
        }
    }
}

function getcolorlist4back(a) {
    a = typeof a !== "undefined" ? a : null;
    el("page_back_t").innerHTML = "&#x2207;";
    el("getcolorlist4back1").setAttribute("onclick", "hidecolorlist4back();");
    if (inner("backg_container").length <= 0) {
        el("backg_container").innerHTML = loading;
        w.postMessage("page_back id=" + a);
        w.onmessage = function (b) {
            el("backg_container").innerHTML = b.data
        }
    } else {
        $("#backg_container").slideDown("slow")
    }
}

function hidecolorlist4back() {
    el("page_back_t").innerHTML = "&#916;";
    el("getcolorlist4back1").setAttribute("onclick", "getcolorlist4back();");
    $("#backg_container").slideUp("slow")
}

function update_pb(b, a) {
    set_vpb(vpb_dir + a);
    el("pb" + a).setAttribute("onmouseout", "set_vpb('" + vpb_dir + a + "');");
    hidecolorlist4back();
    w.postMessage("update_vpb entity=visit_backg&value=" + a);
    w.onmessage = function (c) {
        if (parseInt(c.data) != 1) {
            set_vpb(vpb_dir + b);
        }
    }
}

function getcolor4rel(a) {
    a = typeof a !== "undefined" ? a : null;
    el("rel_color").innerHTML = "<h1>&#x2207;</h1>";
    el("rel_color").setAttribute("onclick", "hidecolor4rel()");
    if (inner("relc_container").length <= 0) {
        el("relc_container").innerHTML = loading;
        w.postMessage("rel_color id=" + a);
        w.onmessage = function (b) {
            el("relc_container").innerHTML = b.data
        }
    } else {
        $("#relc_container").slideDown("slow")
    }
}

function hidecolor4rel() {
    el("rel_color").innerHTML = "<h1>&#916;</h1>";
    el("rel_color").setAttribute("onclick", "getcolor4rel();");
    $("#relc_container").slideUp("slow")
}

function setRelColor(a) {
    for (var b = 0; b < el("rel_listcontainer").childNodes.length; b++) {
        if (el("rel_listcontainer").childNodes[b].nodeName == "LI") {
            el("rel_listcontainer").childNodes[b].setAttribute("style", "background-color:" + a + ";filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='" + a + "',endColorstr='#eee') !important;background:-webkit-gradient(linear,left top,left bottom,from(" + a + "),to(#eee)) !important;background:-moz-linear-gradient(top," + a + ",#fff)!important;background:-o-linear-gradient(top," + a + ",#fff)!important;");
        }
    }
}

function update_rel_color(b, a) {
    el("rel" + a).setAttribute("onmouseout", "");
    hidecolor4rel();
    setRelColor(a);
    w.postMessage("update_rel_color entity=rel_color&value=" + a);
    w.onmessage = function (c) {
        if (parseInt(c.data) != 1) {
            setRelColor(b)
        }
    }
};