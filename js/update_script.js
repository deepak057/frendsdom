j_selecter['user-name-field']="#user-name-field";
vars['username_valid']=false;

$(document).on("click", ".pp_save_settings", function (e) {

    var confArray = {}, $this = $(this),
        par = $this.parents(".up-acc-content:first");

    remove_preloader(par);

    $("input[type='radio'][name^='pp_conf']:checked").each(function () {
        var name = $(this).prop('name').replace(/^pp_conf\[|\]$/g, '');
        confArray[name] = $(this).val();
    });

    $(this).after(get_preloader("Saving...."));

    $.post(core, {
        core_file: "set_preferences.php",
        core_action: "setters",
        "conf": JSON.stringify(confArray)
    }, function (d) {
        remove_preloader(par);

        if (parseInt(d) == 1) {
            $this.after("<span class='" + prepare_class(vars['preloader-img']) + "'><img width='20' src='" + get_image("checkmark.gif") + "'/>&nbsp;Saved</span>");

        } else {

            alert("Error: failed to save settings");

        }

    });


}).on("click", ".del-account-btn", function () {


    apprise("<div align='left'><h3><img src='alert.gif' align='middle'/>Delete your account</h3><p>Once you delete your account, no one will ever know of its existence.</p> <p><b>Delete my account</b></p><p><span title='You can be able to restore your account anytime later by simply loggin in with your email address and password. Please must remember your email and password if you want to restore your account in future'><input type='radio' name='ac_del_type' id='ac_del_type_temp' value='temp'/><label class='pointer' for='ac_del_type_temp'>Temporarily</label></span><br/><span title='You would not be able to restore your account by choosing this deletion option.'><input type='radio' id='ac_del_type_perm' name='ac_del_type' value='perm'/><label class='pointer' for='ac_del_type_perm'>Permanently</label></span></p></div>", {
        confirm: true,
        textOk: "Proceed",
        takeControl: "del_account"
    });

}).on("keyup",j_selecter['user-name-field'],function(){

var $this=$(this),val_=$.trim($this.val());

if(!val_){
put_status_msg($this,"");return;
}

put_status_msg($this,image_tag("picon1.gif")+" <span class='status-inner-text'>Checking...</span>");

$.post(core,{"core_file":"check_user_name.php","core_action":"getters","username":val_},function(d){

var obj=$.parseJSON(d);

if(is_json(obj)){

if(obj.success){
vars['username_valid']=true;
}

else {
vars['username_valid']=false;
}

put_status_msg($this,obj.message);

}

else {

alert("Error: An error occurred while checking your user name");
}

});

}).on("click","#un-choose-btn",function(d){

var $this=$(this);

if(!vars['username_valid']){
apprise("Please choose a valid user name first.");
return;
}

put_btn_status($this,image_tag("picon1.gif"));dis_en($this);

$.post(core,{"core_file":"set_user_name.php","core_action":"setters","username":$(j_selecter['user-name-field']).val()},function(d){

var obj=$.parseJSON(d);

if(!is_json(obj) || !obj.success){

alert("Error: failed to save user name");

put_btn_status($this,image_tag("picon1.gif"),true);

dis_en($this,true);
}

else {

$this.parents("div:first").html("<div class='big'>"+obj.message+"</div>").hide().slideDown("slow").effect("highlight","slow");

$(".un-hide-on-success").hide();

}

});

});


function put_btn_status(btn_,img_,remove_){

var img_class="btn-temp-img";

if(!btn_.next().is("img")){

btn_.after(img_);

}


if(remove_){

btn_.next().remove();

}


}

function put_status_msg(to_,msg){
var status_elm="user-name-status";
if(!$("#"+status_elm).length)
to_.after(progress_status_elm(status_elm,""));
$("#"+status_elm).html(msg);
}

function progress_status_elm(id_,msg){
return "<div class='no_wh inline'><span class='absolute left small' id='"+id_+"'>"+msg+"</span></div>";
}

function remove_preloader(elm_) {
    var preloader = elm_.find(vars['preloader-img']);
    if (preloader.length) preloader.remove();
}


function del_account() {
    hide_apprise();
    var b = null;
    if (el("ac_del_type_temp").checked) {
        b = "temp"
    } else {
        if (el("ac_del_type_perm").checked) {
            b = "perm"
        } else {
            alert("Please choose how you want to delete your account");
            show_apprise();
            return
        }
    }
    remove_apprise();
    apprise("<div align='left'><h3><img src='alert.gif' align='middle'/>Delete your account</h3><p>Please enter your password</p>", {
        input: true,
        type: "password",
        textOk: "Delete Account"
    }, function (a) {
        if (a) {

            put_progress("Deleting your account....");


            $.post("del_account.php", {
                del_type: b,
                pass: a
            }, function (d) {



                hide("uploading");
                if (parseInt(d) == 1) {
                    apprise("<div align='left'><h2><img src='" + get_image("checkmark.gif") + "' width='30' style='position:relative;top:5px;'/>Account successfully deleted</h2> <p>Your account has been successfull deleted. You are now being redirected to Frendsdom's welcome page</p>", {
                        okTetx: "Proceed"
                    }, function (c) {
                        location.href = "friends3.php"
                    })
                } else {
                    response_msg("Error: failed to delete your account", "red")
                }




            });



        }
    })
}
$(document).ready(function () {

    $(function () {
        $('*[title]').monnaTip()
    });
    $("#up-tabs").tabs();
    $("#up-accordion").accordion({
        clearStyle: true,
        heightStyle: "fill",
        collapsible: true,
        active: false
    });


    $('#switcher').themeswitcher({
        loadTheme: "Smoothness"
    });
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


function check_data() {
    var u = document.forms.form,
        first = trim(u.first.value),
        last = trim(u.last.value),
        day = u.day.value,
        month = u.month.value,
        year = u.year.value,
        email = u.email.value,
        pass1 = trim(u.pass1.value),
        pass2 = trim(u.pass2.value),
        country = u.country.value,
        state = trim(u.state.value),
        city = trim(u.city.value);
    for (var i = 0; i < u.sex.length; i++) {
        if (u.sex[i].checked) var v = u.sex[i].value
    }
    if (!first) {
        alert("Please provide your first name");
        return
    }
    if (!last) {
        alert("Please provide your last name");
        return
    }
    if (!v) {
        alert("Please specify your sex");
        return
    }
    if (!day) {
        alert("Please specify your birth day");
        return
    }
    if (!month) {
        alert("Please specify your birth month");
        return
    }
    if (!year) {
        alert("Please specify your birth year");
        return
    }
    if (!checkdate(month + "/" + day + "/" + year)) {
        return
    }
    if (!email) {
        alert("Please specify your email id");
        return
    }
    if (!checkemailid(email)) {
        alert("Please check the email provided");
        return
    }
    if (pass1 && !pass2) {
        alert("Please confirm new password by re-entering it");
        return
    }
    if (pass1 && pass2 && (pass1 != pass2)) {
        alert("Re-enterd password didn't match");
        return
    }
    if (!country) {
        alert("Please choose your country");
        return
    }
    if (!city) {
        alert("Please specify your city");
        return
    }
    if (!state) {
        alert("Please specify your state");
        return
    }
    show('progress');
    el('body').style.opacity = ".2";
    el('progress').innerHTML = "<img src='picon1.gif'> Updating your profile......";
    el('progress').innerHTML = responsetext("first=" + first + "&last=" + last + "&sex=" + v + "&day=" + day + "&month=" + month + "&year=" + year + "&email=" + email + "&pass1=" + pass1 + "&pass2=" + pass2 + "&country=" + country + "&state=" + state + "&city=" + city, "updated.php");

    function checkemailid(a) {
        var b = 1;
        var c = /^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
        var d = /^(.+)@(.+)$/;
        var e = "\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
        var f = "\[^\\s" + e + "\]";
        var g = "(\"[^\"]*\")";
        var h = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
        var j = f + '+';
        var k = "(" + j + "|" + g + ")";
        var l = new RegExp("^" + k + "(\\." + k + ")*$");
        var m = new RegExp("^" + j + "(\\." + j + ")*$");
        var n = a.match(d);
        if (n == null) {
            return false
        }
        var o = n[1];
        var p = n[2];
        for (i = 0; i < o.length; i++) {
            if (o.charCodeAt(i) > 127) {
                return false
            }
        }
        for (i = 0; i < p.length; i++) {
            if (p.charCodeAt(i) > 127) {
                return false
            }
        }
        if (o.match(l) == null) {
            return false
        }
        var q = p.match(h);
        if (q != null) {
            for (var i = 1; i <= 4; i++) {
                if (q[i] > 255) {
                    return false
                }
            }
            return true
        }
        var r = new RegExp("^" + j + "$");
        var s = p.split(".");
        var t = s.length;
        for (i = 0; i < t; i++) {
            if (s[i].search(r) == -1) {
                return false
            }
        }
        if (b && s[s.length - 1].length != 2 && s[s.length - 1].search(c) == -1) {
            return false
        }
        if (t < 2) {
            return false
        }
        return true
    }

    function checkdate(a) {
        var b = /^(\d{1,2})(\/|-)(\d{1,2})\2(\d{2}|\d{4})$/;
        var c = a.match(b);
        if (c == null) {
            alert("Date specified is not valid.");
            return false
        }
        month = c[1];
        day = c[3];
        year = c[4];
        if (month < 1 || month > 12) {
            alert("Month must be between 1 and 12.");
            return false
        }
        if (day < 1 || day > 31) {
            alert("Day must be between 1 and 31.");
            return false
        }
        if ((month == 4 || month == 6 || month == 9 || month == 11) && day == 31) {
            alert("Month " + month + " doesn't have 31 days!");
            return false
        }
        if (month == 2) {
            var d = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
            if (day > 29 || (day == 29 && !d)) {
                alert("February " + year + " doesn't have " + day + " days!");
                return false
            }
        }
        return true
    }
    var w = new Worker("w1c.js")
}

function go_back() {
    hide('progress');
    el('body').style.opacity = "1"
}