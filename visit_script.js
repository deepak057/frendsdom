function fade() {
    var a = document.getElementById("body"),
        menu = document.getElementById("menu");
    a.style.opacity = "1";
    $("#menu").hide("slow");
    show("wavefilebutton");
    $("#alreadyuploaded").hide("slow");
    $("#uploadwavefilemenu").slideUp("slow");
    $("#clipinfo").hide("slow")
}
/*



function hidemsg(){

hide("success");el("body").style.opacity="1";

if(el('player')){
var a=new XMLHttpRequest();
a.open("GET","totalclips.php",false);
a.send(null);
if(a.readyState==4){
if(a.responseText>=1){
show("wavefilebutton");
el("wavefilebutton").setAttribute("onclick","upldagain()");
hide("player");
show("listenbutton")}else{
show("wavefilebutton");
el("wavefilebutton").setAttribute("onclick","visible()");
hide("player");show("listenbutton")}}}}*/







function play() {

    w.postMessage("playclip ");

    w.onmessage = function (e) {

       
 try {
            var clip_obj = jQuery.parseJSON(e.data),
player_class=prepare_class(vars['audio-player-container']);


            hide('listenbutton');

      show("player");


if($("."+player_class).length){

$("."+player_class).remove();

}
$("#player").append("<div class='"+player_class+"' ><audio type='audio/"+clip_obj.type+"' src='"+clip_obj.clip+"'></audio></div>");

$("."+player_class).find("audio").mediaelementplayer();
              
 } 


catch (e) {
            
el("listenbutton").setAttribute("value", "Failed to play")

        }


    }
}





function destroy_jplayer() {
    $("#jquery_jplayer_1").jPlayer("destroy");
}

function displayuserinfo(a) {
    el("body").style.opacity = ".2";
    show('userinfo');
    el("userinfo").innerHTML = "<p style='font-size:1.4em;width:400px;height:100px;font-weight:normal;'>Loading.................";
    el("userinfo").innerHTML = responsetext("id=" + a, "displayuserinfo.php")
}

function checkclips() {
    w.postMessage("checkclip ");
    w.onmessage = function (e) {
        if (parseInt(e.data) >= 1) show("listenbutton")
    }
}

function show_colorlist(a, b) {
    switch (a) {
    case "nudgemenu_color":
        el('down_arrow').setAttribute("src", "leftnew.png");
        el('change_nudgemenucolor').setAttribute("onclick", "hide_colorlist('nudgemenu_color');");
        if (b) {
            show("nudgemenu_color");
            el('nudgemenu_color').innerHTML = loading;
            w.postMessage("get_nudgeMenuClist id=" + b);
            w.onmessage = function (e) {
                el('nudgemenu_color').innerHTML = e.data
            }
        } else $("#nudgemenu_color").slideDown("slow");
        break;
    case "backstrip_color":
        el('down_arrow').innerHTML = "&#8711;";
        el('change_stripcolor').setAttribute("href", "javascript:hide_colorlist('backstrip_color');");
        if (b) {
            show('backstrip_color');
            el('backstrip_color').innerHTML = loading;
            w.postMessage("get_backstripclist id=" + b);
            w.onmessage = function (e) {
                el('backstrip_color').innerHTML = e.data
            }
        } else $("#backstrip_color").slideDown("slow");
        break
    }
}

function hide_colorlist(a) {
    switch (a) {
    case "nudgemenu_color":
        $("#nudgemenu_color").slideUp("slow");
        el('down_arrow').setAttribute("src", "rightnew.png");
        el('change_nudgemenucolor').setAttribute("onclick", "show_colorlist('nudgemenu_color');");
        break;
    case "backstrip_color":
        el('down_arrow').innerHTML = "&#916;";
        el('change_stripcolor').setAttribute("href", "javascript:show_colorlist('backstrip_color');");
        $("#backstrip_color").slideUp("slow");
        break
    }
}

function update_value(a, b, c) {
    switch (a) {
    case "nudgemenu_color":
        $("#nudgemenu_color").hide("slow");
        el('down_arrow').setAttribute("src", "rightnew.png");
        el('change_nudgemenucolor').setAttribute("onclick", "show_colorlist('nudgemenu_color');");
        el(b).setAttribute("onmouseout", "el('nudgemenu').style.background=" + b + ";");
        w.postMessage("update_entity entity=" + a + "&value=" + b);
        w.onmessage = function (e) {
            if (parseInt(e.data) != 1) el('nudgemenu').style.background = c
        };
        break;
    case "back_strip_color":
        $('#backstrip_color').hide('slow');
        cl_back(b);
        el(b).setAttribute("onmouseout", "cl_back('" + b + "');");
        el('down_arrow').innerHTML = "&#916;";
        el('change_stripcolor').setAttribute("href", "javascript:show_colorlist('backstrip_color')");
        w.postMessage("update_entity entity=" + a + "&value=" + b);
        w.onmessage = function (e) {
            if (parseInt(e.data) != 1) el('layout').style.background = c
        };
        break
    }
}

function rel_hide() {
    if (el('rel_img')) {
        el('rel_img').src = "nupr.bmp";
        el('rel_img').title = "let others see your connections";
        el('rel_img').setAttribute("onclick", "show_hide_rel('show')")
    }
    el('rel_caption').style.opacity = ".4";
    el('rel_lock').src = "locked1.bmp";
    el('rel_lock').title = "Not visible or say 'locked'"
}

function rel_show() {
    if (el('rel_img')) {
        el('rel_img').src = "ndowng.bmp";
        el('rel_img').title = "hide your connections from others";
        el('rel_img').setAttribute("onclick", "show_hide_rel('hide')")
    }
    el('rel_caption').style.opacity = "1";
    el('rel_lock').src = "unlocked1.bmp";
    el('rel_lock').title = "Visible or say 'unlocked'"
}


function cl_back(color) {
    var end_color = "#eee";
    if (color.indexOf("#E6E6FA") != -1) end_color = "#999";
    $(vars['pp_strip_elm']).attr("style", "background:" + color + " !important;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='" + color + "',endColorstr='" + end_color + "') !important;background:-webkit-gradient(linear,left top,left bottom,from(" + color + "),to(" + end_color + ")) !important;background:-moz-linear-gradient(top," + color + "," + end_color + ")!important;background:-o-linear-gradient(top," + color + "," + end_color + ")!important");

}

function set_vpb(img) {


    //el('mother_body').style.background="url("+img+")";

    $(vars['pp_same_bg_elem'] + ",#mother_body").css("background", "url(" + img + ")")



}



$(document).ready(function () {
    $("#search_field").combogrid({
        url: 'search_autocomplete.php',
        debug: true,
        sidx: "id",
        sord: "asc",
        rows: 10,
        addClass: "combogrid_class",
        alternate: true,
        draggable: true,
        rememberDrag: true,
        //replaceNull: true,
        colModel: [{
            'columnName': 'name',
            'align': 'left',
            'width': '25',
            'label': 'Name'
        }, {
            'columnName': 'country',
            'width': '25',
            'label': 'Country'
        }, {
            'columnName': 'state',
            'width': '25',
            'label': 'State'
        }, {
            'columnName': 'city',
            'width': '25',
            'label': 'City'
        }],
        select: function (event, ui) {
            //$( "#search_field" ).val( ui.item.name );
            document.location.href = ui.item.link;
            return false;
        }
    });
});

vars['cover-pic-container'] = ".cover-pic-container";
vars['pp-cp-hover-icon-id'] = "pp-cp-hover-icon";
vars['pp-cp-hover-menu-id'] = "pp-cp-hover-menu";
vars['pp-cp-upload-trigger-id'] = "pp-cp-upload-trigger";
vars['cover-pic-dnd-area-id'] = "cover-pic-dnd-area";
vars['cp-file'] = false;
vars["ucp-files-content"] = ".ucp-files-content";
vars["cv-uploading-progress-id"] = "cv-uploading-progress";
vars['pp-cover-pic-id'] = "pp-cover-pic-img";
vars['pp-cp-delete-btn-id'] = 'pp-cp-delete-btn';
vars['pp-cp-edit-btn-id'] = 'pp-cp-edit-btn';
vars['img-selection-x1'] = vars['img-selection-y1'] = vars['img-selection-x2'] = vars['img-selection-y2'] = vars['img-selction-instance'] = false;
vars['pp-sbox-container'] = ".pp-sbox-container";
vars['pp-sbox-head'] = "#pp-sbox-head";
vars["pp-acd-sc-outer"] = ".pp-acd-sc-outer";
vars['cs-add-creation-block'] = ".cs-add-creation-block";
vars['cs-content-block'] = ".cs-content-block";
vars['cs-block'] = ".cs-block";
vars['cs-remove-block'] = ".cs-remove-block";
vars['cs-add-block'] = ".cs-add-block";
vars['cs-uplaod-pic-field'] = '.cs-uplaod-pic-field';
vars["cs-pic-preview"] = ".cs-pic-preview";
vars['share_form'] = ".share_form";
vars['cs_total_forms'] = vars['cs_form_count'] = 0;
vars['cs_blocks_arr'] = $();
vars['pp-remove-sb'] = ".pp-remove-sb";
vars['pp-sbox-block'] = '.pp-sbox-block';
vars['pp-remove-sb-trigger'] = ".pp-remove-sb-trigger";
vars['sb_clist'] = false;
vars['sb-clist-container'] = ".sb-clist-container";
vars['cs-clist-slice'] = ".cs-clist-slice";
vars['sb-db-attr'] = "original-back";
vars['sb-cl-trigger'] = ".cs-cl-trigger";
vars['sb-clist-target-block'] = ".sb-clist-target-block";
vars['sb-back-color-field'] = ".sb-back-color-field";
vars['sb-onhover-visible'] = ".sb-onhover-visible";
vars['sb-cl-trigger'] = ".sb-cl-trigger";
vars['pp-no-shares'] = "#pp-no-shares";
vars['pp-rs-wrapper'] = ".pp-rs-wrapper";
vars['rs-limit-start'] = 0;
vars['rs-limit-end'] = 15;
vars['rs-limit-increment-by'] = 15;
vars['pp-rs-container'] = ".pp-rs-container";
vars['pp-slider-cancel-conf-id'] = "pp-slider-cancel-conf";
vars['pp-slider-conf-max'] = "pp-slider-conf-max";

$(document).on("mouseover", vars['cover-pic-container'], function () {
    if (vars['own_profile']) {
        var elm_id = vars['pp-cp-hover-icon-id'];
        if (!$("#" + elm_id).length) {
            $(this).append("<div class='pointer' id='" + elm_id + "'><div class='" + elm_id + "'><img src='" + get_image("settings_icon.gif") + "'/></div><div class='clear'></div></div>");
        }
        $("#" + elm_id).show();
    }
})
    .on("mouseout", vars['cover-pic-container'], function () {
        if ($("#" + vars['pp-cp-hover-icon-id']).length) {
            $("#" + vars['pp-cp-hover-icon-id']).hide();
        }
    }).on("mouseover", "#" + vars['pp-cp-hover-icon-id'], function () {
        var elm_id = vars['pp-cp-hover-menu-id'];
        $(this).find("div:first").addClass(prepare_class(vars['shadow_light']));
        if (!$("#" + elm_id).length) {
            var content = [{
                id: vars['pp-cp-upload-trigger-id'],
                "label": "Upload Your Cover Picture",
                "icon": get_image("upload.gif")
            }, {
                id: vars['pp-cp-edit-btn-id'],
                "label": "Edit Your Picture",
                "icon": get_image("red_pencil_icon.png")
            }, {
                id: vars['pp-cp-delete-btn-id'],
                "label": "Delete Picture",
                "icon": get_image("crossmark.gif")
            }, ],
                html = "";
            for (a in content) {
                if (content[a]['label'] != undefined)
                    html += "<li id='" + content[a]['id'] + "'><img class='label-icon' src='" + content[a]['icon'] + "'/>" + content[a]['label'] + "</li>";
            }
            $(this).append("<div id='" + elm_id + "'><ul>" + html + "</ul></div>");
        }
        $("#" + elm_id).show().addClass(prepare_class(vars['shadow_light']));
    })
    .on("mouseout", "#" + vars['pp-cp-hover-icon-id'], function () {
        $("#" + vars['pp-cp-hover-menu-id']).hide();
        $(this).find("div:first").removeClass(prepare_class(vars['shadow_light']));
    }).on("click", "#" + vars['pp-cp-upload-trigger-id'], function () {

        fade_bg();
        create_special_div({}, $(this));
        $.post(core, {
            core_action: "getters",
            core_file: "get_cover_pic_upload_content.php",
            flag: true
        }, function (d) {
            append_to_special_div(d);
            init_cp_dnd();
        });
    }).on("click", "#" + vars['pp-cp-delete-btn-id'], function () {
        apprise("Delete cover picture?", {
            verify: true
        }, function (r) {
            if (r) {
                put_progress("Deleting picture.....");
                $.post(core, {
                    core_action: "removers",
                    core_file: "delete_cover_pic.php"
                }, function (d) {
                    try {
                        var r = $.parseJSON(d);
                        if (r.success) {
                            response_msg("Picture successfully deleted");
                            setup_cv_bg_from_src(r.pic_path + "?" + unique_number());
                        }
                    } catch (error) {
                        response_msg("Error: failed to delete picture", "red");
                    }
                });
            }
        });
    }).on("click", "#" + vars['pp-cp-edit-btn-id'], function () {
        cp_area_selection();
    }).on("click", "#cp-edit-done-btn", function () {
        cp_hide_sticky_popup();
        resize_cp();
        //set_cover_pic(vars['img-selection-y1']);
    }).on("click", ".pp-create-share-btn", function () {
        fade_bg();
        create_special_div({}, $(this));
        $.post(core, {
            core_action: "getters",
            core_file: "create_share_content.php"
        }, function (d) {
            append_to_special_div(d);
        });
    }).on("click", vars['cs-add-block'], function () {
        var par_block = $(this).parents(vars['cs-block'] + ":first"),
            new_block = par_block.clone();
        new_block.find("textarea").val("").css("height", "30px").removeClass(prepare_class(vars['red-border']));
        new_block.find(vars['cs-remove-block']).show();
        new_block.find(vars["cs-pic-preview"]).remove();
        new_block.find(vars['cs-uplaod-pic-field']).val("");
        new_block.find(vars['sb-cl-trigger']).removeAttr("relates-to");
        //new_block.find(vars['sb-back-color-field']).val("");
        $(vars['cs-content-block']).append(new_block);
        $(vars['cs-block'] + ":last").effect("highlight");
        $(vars['cs-block']).removeClass(prepare_class(vars['align-center'])).addClass("fl");
        $(vars['cs-add-block']).hide();
        $(vars['cs-add-block'] + ":last").show();
        $(vars['cs-remove-block'] + ":not(:first)").show();
    }).on("click", vars['cs-remove-block'], function () {
        $(this).parents(vars['cs-block'] + ":first").remove();
        $(vars['cs-add-block'] + ":last").show();
        if ($(vars['cs-block']).length == 1) {
            $(vars['cs-block']).addClass(prepare_class(vars['align-center'])).removeClass("fl");
        }
    }).on("change", vars['cs-uplaod-pic-field'], function () {
        var file = $(this).prop('files')[0],
            elm_ = $(this);
        if (acceptedTypes[file.type] !== true) {
            alert("Oops! Please choose a valid image file");
            $(this).val("");
            return;
        }
        var reader = new FileReader();
        reader.onload = function (event) {
            elm_.parents(vars['cs-block'] + ":first").
            find(vars["cs-pic-preview"]).remove();
            var image = new Image();
            image.src = event.target.result;
            image.className = prepare_class(vars["cs-pic-preview"]) + " share_pic pointer";
            elm_.before(image).hide().fadeIn("slow");
        };

        reader.readAsDataURL(file);
    }).on("click", ".create-shares-btn", function () {
        if (cs_check_forms()) {
            $(vars['cs-add-block']).remove();
            $(vars['cs-remove-block']).remove();
            $(vars['share_form']).each(function () {
                $(this).submit();
            });
        }
    }).on("submit", vars['share_form'], function () {
        var file_elem = get_cs_form_elemnt($(this), "file"),
            title = $.trim(get_cs_form_elemnt($(this), "title").val()),
            content = $.trim(get_cs_form_elemnt($(this), "content").val()),
            color = $.trim(get_cs_form_elemnt($(this), "color").val());
        /*Create an overlay over current block*/
        var cs_overlay = cs_put_overlay($(this)),
            f_data = new FormData();
        //append data
        if (file_elem.val().length) {
            f_data.append('share_pic', file_elem.prop('files')[0]);
        }
        f_data.append("share_title", title);
        f_data.append("share_content", content);
        f_data.append("background", color);
        // now post a new XHR request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "create_share.php");
        //keep track of uploading progress
        xhr.upload.onprogress = function (event) {
            if (event.lengthComputable) {
                var complete = (event.loaded / event.total * 100 | 0);
                cs_set_progress(cs_overlay, complete);

            }
        };
        xhr.onload = function () {
            vars['cs_form_count']++;
            handle_cs_response(cs_overlay, xhr.response);
        };
        xhr.send(f_data);
        return false;
    }).on("mouseenter", vars['pp-sbox-block'], function () {
        if (vars['own_profile']) {
            $(this).find(vars['sb-onhover-visible']).css({
                left: ($(this).width() - 50) + "px"
            }).show();
        }
    }).on("mouseleave", vars['pp-sbox-block'], function () {
        if (vars['own_profile']) {
            $(this).find(vars['sb-onhover-visible']).hide();
        }
    }).on("click", vars['pp-remove-sb-trigger'], function () {
        var elm = $(this),
            share_id = elm.attr("share-id");
        apprise("Delete this Share?", {
            verify: true
        }, function (r) {
            if (r) {
                elm.parents(vars['pp-sbox-block'] + ":first").remove();
                refresh_masonry();
                $.post(core, {
                    core_action: "removers",
                    core_file: "remove_share.php",
                    share_id: share_id
                }, function (d) {
                    if (parseInt(d) != 1) alert("Error: failed to remove share");
                    else {
                        update_share_count("decrement");
                    }
                });
            }
        });
    }).on("click", vars['sb-cl-trigger'], function () {
        if ($(this).attr("relates-to") == undefined) {
            $(this).attr("relates-to", "sb-clist-" + unique_number());
        }
        var clist_id = $(this).attr("relates-to");
        cs_create_clist(clist_id, $(this));
        $("#" + clist_id).show();
        $(this).addClass("rotate-180");
    }).on("mouseenter", vars['cs-clist-slice'], function () {
        var block = sb_get_triggering_block($(this));
        block.css("background", $(this).attr("color"));
    }).on("mouseleave", vars['cs-clist-slice'], function () {
        var block = sb_get_triggering_block($(this));
        block.css("background", block.attr(vars['sb-db-attr']));
    }).on("click", vars['cs-clist-slice'], function () {
        var block = sb_get_triggering_block($(this));
        block.attr(vars['sb-db-attr'], $(this).attr('color'));
        sb_hide_clist();
        if (block.attr("cl-callback") != undefined) {
            window[block.attr("cl-callback")]($(this).attr('color'), block);
        }
    })
/*.on("mouseover",vars['pp-rs-wrapper'],function(){
alter_accordion({containerHeight:"600",firstSlide:2});
}).on("mouseout",vars['pp-rs-wrapper'],function(){
alter_accordion({containerHeight:vars['cp_frame_height']});
})*/

.on("click", ".pp-customize-popup-trigger", function () {
    //fade_bg();
    create_special_div({}, $(this));
    $.post(core, {
        core_action: "getters",
        core_file: "get_pp_slider_conf_content.php"
    }, function (d) {
        append_to_special_div(d);
        transform_select_init("width-200");
    });
}).on("click", ".pp-slider-preview-btn", function () {
    hide_special_popup();
    pp_slider_init_with_conf(pp_slider_get_conf());
    create_sticky_popup();
    stick_popup_title("Customize Slider");
    sticky_popup_content(slider_conf_content());
}).on("click", "#" + vars['pp-slider-cancel-conf-id'], function () {
    alter_accordion();
    close_sticky_popup();
}).on("click", "#" + vars['pp-slider-conf-max'], function () {
    show_special_popup();
    close_sticky_popup();
});

function pp_slider_init_with_conf(conf) {
    init_pp_accordion(get_pp_slider_conf(filter_accordion_options(conf)));
}

function slider_conf_content() {
    return "<div><input onclick='pp_slider_save_conf()' value='Save' class='" + prepare_class(vars['special_btn']) + "' type='button'/>&nbsp;<input id='" + vars['pp-slider-conf-max'] + "' value='Maximize' class='" + prepare_class(vars['special_btn']) + " grey-back' type='button'/>&nbsp;<input value='Cancel' class='" + prepare_class(vars['special_btn']) + " red_bg' type='button' id='" + vars['pp-slider-cancel-conf-id'] + "'/></div>";
}

function pp_slider_save_conf() {
    var conf = pp_slider_get_conf();
    pp_slider_init_with_conf(conf);
    close_sticky_popup();
    display_post_close();
    fade_bg();
    put_progress("Saving......");
    $.post(core, {
        core_action: "setters",
        core_file: "set_pp_slider_conf.php",
        conf: JSON.stringify(conf)
    }, function (d) {

        if (parseInt(d) == 1) {
            response_msg("Configuration saved successfully");
            vars['pp_accordion_default'] = get_pp_slider_conf(conf);
        } else {
            response_msg("Error: failed to save configuration", "red");
        }
    });
}

function pp_slider_get_conf() {
    var new_ = {};
    $(".pp-slider-conf-elem").each(function () {
        new_[$(this).attr("name")] = $(this).val();
    });
    new_['autoPlay'] = filter_boolean($(".pp-slider-conf-elem-autoplay:checked").val());
    return new_;
}

function accordion_container_width() {
    return $(document).width() - 44;
}

function rs_scroll_init() {
    $(vars['pp-rs-wrapper']).scroll(function (e) {
        var elem = $(e.currentTarget);
        if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()) {
            var temp_img_id = "pp-rs-lm";
            if (!$("#" + temp_img_id).length) {
                $(vars['pp-rs-container']).append("<div id='" + temp_img_id + "' align='center'><img alt='Loading More....' src='" + get_image("posts_loader.gif") + "'/></div>");
                vars['rs-limit-start'] += vars['rs-limit-increment-by'];
                vars['rs-limit-end'] += vars['rs-limit-increment-by'];
                $.post("get_posts.php", {
                    start: vars['rs-limit-start'],
                    end: vars['rs-limit-end'],
                    uid: luid,
                    from_id: vuid
                }, function (d) {
                    $(vars['pp-rs-container']).append(d);
                    $("#" + temp_img_id).remove();
                });
            }
        }
    });
}

function cs_set_block_color(color, target_elm) {
    target_elm.find(vars['sb-back-color-field']).val(color);
}

function sb_update_bg_color(color, target_elm) {
    $.post(core, {
        core_action: "setters",
        core_file: "set_cblock_bg.php",
        color: color,
        share_id: target_elm.attr("share-id")
    }, function (d) {
        if (parseInt(d) != 1) alert("Error: failed to change color");
    });
}

function sb_get_triggering_block(elm) {
    return $("[relates-to=" + elm.parents(vars['sb-clist-container'] + ":first").attr("id") + "]")
        .parents(vars['sb-clist-target-block'] + ":first");
}

function cs_create_clist(id, triggerer) {
    if (!$("#" + id).length) {
        $('body').append("<div class='none sb-clist-container' id='" + id + "'>" + loading + "</div>");
        if (!vars['sb_clist']) {
            $.post(core, {
                core_action: "getters",
                core_file: "get_sbox_clist.php"
            }, function (d) {
                $("#" + id).html(d);
                vars['sb_clist'] = d;
            });
        } else {
            $("#" + id).html(vars['sb_clist']);
        }
    }
    var pos = triggerer.offset();
    $("#" + id).css({
        position: "absolute",
        top: (pos.top - 15) + "px",
        left: (pos.left - 170) + "px"
    })
        .bind('clickoutside', function (e) {
            sb_hide_clist($(this));
        });
}

function sb_hide_clist() {
    $(vars['sb-clist-container']).each(function () {
        var id = $(this).attr("id");
        if ($(this).is(":visible")) {
            $(this).hide().unbind("clickoutside");
            $("[relates-to=" + id + "]").removeClass("rotate-180");
        }
    });
}

function handle_cs_response(cs_overlay, d) {

    try {
        var obj = jQuery.parseJSON(d);
        if (obj.success) {
            cs_set_progress(cs_overlay, 100);
            vars['cs_blocks_arr'] = vars['cs_blocks_arr'].add(obj.share_html);
            update_share_count();
        }

    } catch (error) {
        cs_set_progress(cs_overlay, 100, true);
    }
    cs_check_if_all_done();
}

function update_share_count(action) {
    var act = action ? action : "increment",
        html = parseInt($(vars['sb-blocks-count']).html());
    if (act == "increment") {
        html++;
    } else {
        html--;
    }
    $(vars['sb-blocks-count']).html(html);
}

function cs_check_if_all_done() {
    if (vars['cs_form_count'] == vars['cs_total_forms']) {
        display_post_close();
        vars['cs_form_count'] = vars['cs_total_forms'] = 0;
        append_to_masonry(vars['cs_blocks_arr']);
        vars['cs_blocks_arr'] = $();
    }
}

function append_to_masonry(elems) {
    $(vars['pp-sbox-container']).append(elems).
    masonry('appended', elems, true);
    refresh_masonry();
    $(vars['pp-sbox-container']).animate({
        scrollTop: $(vars['pp-sbox-container'])[0].scrollHeight
    }, 1000);
}

function refresh_masonry() {
    if ($(vars['pp-no-shares']).length) $(vars['pp-no-shares']).remove();
    $(vars['pp-sbox-container']).masonry('reloadItems').masonry('layout');
    sb_edit_init();
}

function get_cs_form_elemnt(form_elm, elem) {
    switch (elem) {
    case "title":
        return form_elm.find("textarea[name=share_title]")
        break;
    case "content":
        return form_elm.find("textarea[name=share_content]")
        break;
    case "color":
        return form_elm.find(vars['sb-back-color-field'])
        break;
    default:
        return form_elm.find("input[type=file]");
        break;
    }
}

function cs_check_forms() {
    var forms_validated = 0;
    $(vars['share_form']).each(function () {
        var title_elm = get_cs_form_elemnt($(this), "title"),
            content_elem = get_cs_form_elemnt($(this), "content"),
            title = $.trim(title_elm.val()),
            content = $.trim(content_elem.val());
        if (!title) {
            title_elm.addClass(prepare_class(vars['red-border']))
                .attr("placeholder", "Fill out this field").effect("highlight").focus();
            return false;
        } else {
            title_elm.removeClass(prepare_class(vars['red-border']));
        }
        if (!content) {
            content_elem.addClass(prepare_class(vars['red-border']))
                .attr("placeholder", "Fill out this field").effect("highlight").focus();
            return false;
        } else {
            content_elem.removeClass(prepare_class(vars['red-border']));
        }
        forms_validated++;
    });
    vars['cs_total_forms'] = forms_validated;
    return $(vars['share_form']).length == forms_validated;
}

function cs_set_progress(obj, complete, error) {
    $("#" + obj.cs_progress_id).val(complete).html(complete);
    if (complete == 100) {
        var elem = $("#" + obj.cs_progress_id),
            style = "top:" + (elem.css("top")) + ";left:" + ((elem.width() / 2) - 20) + "px";
        elem.hide().after("<img class='cs-done-icon' style='" + style + "' src='" + (!error ? get_image('done.gif') : get_image("error.gif")) + "'/>");
    }
}

function cs_put_overlay(elem) {
    var cs_block = elem.parents(vars['cs-block'] + ":first"),
        ol_id = "cs-ol-" + unique_number(),
        cs_progress = "cs-progress-" + unique_number();
    cs_block.append("<div class='no_wh'><div id='" + ol_id + "' class='cs-overlay'>&nbsp;</div></div>");
    $("#" + ol_id).css({
        top: "-" + cs_block.height() + "px",
        width: cs_block.width() + "px",
        height: cs_block.height() + "px"
    });
    cs_block.append("<div class='no_wh'><progress class='cs-progress' id='" + cs_progress + "' value='0' max='100' min='0'></progress></div>");
    $("#" + cs_progress).css({
        top: "-" + ((cs_block.height() / 2) + 20) + "px",
        width: (cs_block.width() - 20) + "px",
        left: "7px"
    });
    return {
        ol_id: ol_id,
        cs_progress_id: cs_progress
    };
}

function resize_cp() {
    put_progress("Setting your cover picture....");
    $.post(core, {
        core_action: "setters",
        core_file: "set_cp_size.php",
        x1: vars['img-selection-x1'],
        x2: vars['img-selection-x2'],
        y1: vars['img-selection-y1'],
        y2: vars['img-selection-y1']
    }, function (d) {

        try {
            var obj = jQuery.parseJSON(d);
            if (obj.success) {
                setup_cv_bg_from_src(obj.pic_path + "?" + unique_number());
                response_msg("Picture successfully resized");
            }

        } catch (error) {
            response_msg("Error: failed to resize your picture", "red");

        }
    });
}

function cp_hide_sticky_popup() {
    close_sticky_popup();
    vars['img-selction-instance'].setOptions({
        disable: true,
        hide: true
    });
    reset_pp_accordion();
}

function init_cp_dnd() {
    var cp_dnd_js = el(vars['cover-pic-dnd-area-id']), //javascript's native object
        cp_dnd_jq = $("#" + vars['cover-pic-dnd-area-id']), //jquery's object
        original_text = false;

    //effects on dragover
    cp_dnd_js.ondragover = function () {
        cp_dnd_jq.addClass(prepare_class(vars['dnd-highlight']));
        if (!original_text) {
            original_text = cp_dnd_jq.html();
        }
        cp_dnd_jq.html("<p>Drop it now</p>");
        return false;
    };

    //effects on dragleave
    cp_dnd_js.ondragleave = function () {
        cp_dnd_jq.removeClass(prepare_class(vars['dnd-highlight']));
        cp_dnd_jq.html(original_text);
        return false
    };

    //on file dropped
    cp_dnd_js.ondrop = function (event) {
        event.preventDefault && event.preventDefault();

        cp_dnd_jq.removeClass(prepare_class(vars['dnd-highlight']))
            .addClass(prepare_class(vars["dnd-dropped"]));

        //get dropped files and upload
        upload_cp(event.dataTransfer.files);

        return false;

    };

    //or get files through File input field
    el('cp-file-field').onchange = function (event) {

        //get dropped files and upload
        upload_cp(this.files);

    };
}

function cp_put_preview(file) {
    $(vars["ucp-files-content"]).html("");
    var reader = new FileReader();
    reader.onload = function (event) {
        var image = new Image();
        image.src = event.target.result;
        image.className = "cp-preview share_pic pointer";
        $("#" + vars["cv-uploading-progress-id"]).after(image).hide().fadeIn("slow");
    };

    reader.readAsDataURL(file);

}

function upload_cp(files) {
    //get only first file if selected more than one
    var file = files[0];
    //check if selected file is an image
    if (acceptedTypes[file.type] !== true) {
        alert("Oops ! Please upload a valid image file");
        return;
    }
    //put file preview
    cp_put_preview(file)
    var f_data = new FormData();
    //append data
    f_data.append('cp', file);
    f_data.append("core_action", "uploaders");
    f_data.append("core_file", "upload_cover_pic.php");
    // now post a new XHR request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', core);
    //keep track of uploading progress
    xhr.upload.onprogress = function (event) {
        if (event.lengthComputable) {
            var complete = (event.loaded / event.total * 100 | 0);
            cp_set_progress(complete);

        }
    };

    xhr.onload = function () {

        //handle response
        cp_handle_response(xhr.response);

        // in case it gets stuck around 99%
        cp_set_progress(100);
    };

    xhr.send(f_data);

}

function cp_handle_response(response) {

    try {
        var obj = jQuery.parseJSON(response);
        if (obj.success) {
            setup_cv_bg_from_src(obj.pic_path + "?" + unique_number(), "cp_area_selection");
            display_post_close();
        }

    } catch (error) {
        alert(response);
        $("#" + vars['pp-cp-upload-trigger-id']).click();
    }

}

function setup_cv_bg_from_src(src, callback) {
    var img = $("#" + vars['pp-cover-pic-id']),
        preloader_id = "preloader-1";
    img.attr('src', src).hide()
        .unbind("load")
        .on("load", function () {
            $("#" + preloader_id).remove();
            img.show();
            if (callback) {
                window[callback]();
            }
        });
    $(vars['cover-pic-container']).append("<div class='preloader-1' id='" + preloader_id + "'></div>");
}


function cp_area_selection() {

    cp_setup_sticky_poup();
    var new_h = $(vars['cover-pic-container'])[0].scrollHeight + 50;
    alter_accordion({
        containerHeight: new_h,
        firstSlide: 3
    });
    vars['cp_frame_current_height'] = new_h;
    vars['img-selction-instance'] = $("#" + vars['pp-cover-pic-id']).imgAreaSelect({
        minHeight: vars['cp_frame_height'],
        minWidth: vars['cp_frame_width'],
        maxWidth: vars['cp_frame_width'],
        maxHeight: vars['cp_frame_height'],
        resizable: false,
        instance: true,
        show: true,
        enable: true,
        x1: 0,
        y1: vars['cp_frame_height'],
        x2: vars['cp_frame_width'],
        y2: 0,
        onSelectEnd: function (img, selection) {
            vars['img-selection-x1'] = selection.x1;
            vars['img-selection-y1'] = selection.y1;
            vars['img-selection-y2'] = selection.y2;
            vars['img-selection-x2'] = selection.x2;

        }
    })
}

function cp_setup_sticky_poup() {
    create_sticky_popup();
    stick_popup_title("Edit Cover Picture");
    sticky_popup_onclose_function("cp_hide_sticky_popup");
    $.post(core, {
        core_action: "getters",
        core_file: "cp_edit_content.php"
    }, function (d) {
        sticky_popup_content(d);
    });
}

function alter_accordion(options) {
    init_pp_accordion(alter_accordion_options(options));
}

function init_pp_accordion(options) {
    $("#" + vars['pp-accordion-container-id'])
        .liteAccordion('destroy')
        .liteAccordion(options ? options : vars['pp_accordion_default']);
}

function alter_accordion_options(new_options) {
    var default_options = vars['pp_accordion_default'];
    for (k in new_options) {
        default_options[k] = new_options[k];
    }
    return default_options;
}


function adjust_pp_slider_position(options) {
    var options = options ? options : vars['pp_accordion_default'];
    var left = 0;
    switch (options['theme']) {
    case "dark":
        left = 2;
        break;
    case "light":
        left = 3;
        break;
    }

    if (left)
        $("#" + vars['pp-accordion-container-id']).css("left", left + "px");

}

function filter_accordion_options(options) {
    options['containerWidth'] = vars['accordion_container_width'];
    options['containerHeight'] = vars['cp_frame_height'];
    return options;
}

function get_pp_slider_conf(options) {
    options['containerWidth'] = vars['accordion_container_width'];
    options['containerHeight'] = vars['cp_frame_height'];
    options['onTriggerSlide'] = function () {
        reset_pp_accordion();
    };
    adjust_pp_slider_position(options);
    return options;
}

function cp_set_progress(p) {
    $("#" + vars["cv-uploading-progress-id"]).val(p).html(p).show();
}

function enable_cp_img() {
    $("#" + vars['pp-cover-pic-id']).show();
    remove_cp_bg();
}

function remove_cp_bg() {
    $(vars['cover-pic-container']).removeAttr("style");
}

function set_cover_pic(top) {

    /*
var cp=$("#"+vars['pp-cover-pic-id']);
cp.hide();

$(vars['cover-pic-container']).css({
"background-image":"url("+cp.attr('src')+")",
"background-attachment":"fixed",
"background-position":"0px "+(top || 0)+"px" 
}
);
*/

}

function reset_pp_accordion() {
    set_cover_pic();
    if (vars['cp_frame_current_height'] != vars['cp_frame_height']) {
        alter_accordion({
            containerHeight: vars['cp_frame_height']
        });
        vars['cp_frame_current_height'] = vars['cp_frame_height'];
    }
}

function init() {
    tagline_edit_init();
    sbox_grid_init();
    sb_edit_init();
    rs_scroll_init();
    adjust_rt_cl_triggerer_init();
    check_recent_status_init();

    //sbox_header_init();
}

function adjust_rt_cl_triggerer_init() {

    var elm_ = $("#rel_listcontainer li:first");
    if (elm_.length) {

        var elm_pos = elm_.offset();

        $("#rel_color_div").css({
            "left": (elm_pos.left + 5) + "px",
            "top": (elm_pos.top - 27) + "px"
        });
    }
}

function tagline_edit_init() {

    if (vars['own_profile']) {

        $(".pp-tagline-content").editable(core, {
            submitdata: {
                core_action: "setters",
                core_file: "set_tagline.php"
            },

            type: 'textarea',
            cancel: 'Cancel',
            submit: 'Update',
            title: "Click to edit tagline",
            indicator: '<img src="picon1.gif">Saving....',
            cssclass: "post_tagline_textarea",
            data: function (value, settings) {
                return $.trim(br2nl(value));
            }
        });
    }
}

function sbox_grid_init() {
    vars['masonry_instance'] = $(vars['pp-sbox-container']).masonry({
        itemSelector: vars['pp-sbox-block'],
        gutter: 10
    });
}

function sbox_header_init() {
    var height = vars['cp_frame_height'] - ($(vars['pp-sbox-head']).height());
    $(vars['pp-sbox-container']).css({
        height: height + "px !important"
    });
}


function sb_edit_init() {
    if (vars['own_profile']) {
        sb_edit_title_init();
        sb_edit_des_init();
    }
}

function sb_edit_title_init() {

    $(".pp-sb-title").editable(core, {
        submitdata: {
            core_action: "setters",
            core_file: "set_share_title.php"
        },

        type: 'textarea',
        onsubmit: function (v, s) {


            return check_jeditable_field(this);

        },


        cancel: 'Cancel',
        submit: 'Update',
        title: "Click to edit tagline",
        indicator: '<img src="picon1.gif">Saving....',
        cssclass: "sb_edit_textarea",
        data: function (value, settings) {
            return $.trim(br2nl(value));
        },
        callback: function (value, settings) {

            refresh_masonry()


        }
    });

}


function sb_edit_des_init() {

    $(".pp-sb-des").editable(core, {
        submitdata: {
            core_action: "setters",
            core_file: "set_share_des.php"
        },

        type: 'textarea',
        cancel: 'Cancel',
        submit: 'Update',
        title: "Click to edit tagline",
        indicator: '<img src="picon1.gif">Saving....',
        cssclass: "sb_edit_textarea",
        data: function (value, settings) {
            return $.trim(br2nl(value));
        },
        callback: function (value, settings) {
            refresh_masonry()
        },
        onsubmit: function (v, s) {
            return check_jeditable_field(this);

        }
    });

}


function check_recent_status_init() {

    if (!if_posts_exist()) {

        $(vars['pp-rs-wrapper'])
        /*.removeClass(prepare_class(vars['pp_same_bg_elem']))
.addClass(prepare_class(vars['pp_strip_elm']))*/
        .html("<div class='pp-no-recent-status'><h3>No Recent Status Yet</h3></div>");

    }

}

function if_posts_exist() {

    return $(".hp_post_container").length;

}

$(window).load(function () {
    refresh_masonry()
});
/*
function sbox_header_init(){

var elm_=$(vars['pp-sbox-head']).clone(),
sbox_c=$(vars['pp-sbox-head']).parents(vars["pp-acd-sc-outer"]+":first"),
pos=sbox_c.offset();
id=$(vars['pp-sbox-head']).attr("id"),
left=(pos.left-vars['cp_frame_width'])+parseInt(sbox_c.css("padding-left").split("px")[0]);
$(vars['pp-sbox-head']).remove();
elm_.css({width:sbox_c.width()+"px","z-index":5,"position":"fixed",top:pos.top+"px",left:left+"px"})
.attr("id",id);
$('body').append(elm_);
$(vars['pp-sbox-container']).css({poition:"relative","top":(elm_.height()+10)+"px"});

}
*/