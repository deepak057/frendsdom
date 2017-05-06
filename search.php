<?php

include("environment.php");


//compressing HTML content 
//ob_start("ob_gzhandler"); 
?>
<!doctype html>
<html lang="en">
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application" /><meta name="description" content="social web application,search user" />
<link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
<title>Search Users-Frendsdom</title>
<link rel="stylesheet" type="text/css" href="css8.css"/>
<link rel="stylesheet" type="text/css" href="search_stylesheet.css"/>
<script src="jquery-1.4.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
<script type="text/javascript" src="resources/jquery/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="jquery.monnaTip.js"></script><script type="text/javascript" src="noty/js/jquery.noty.js"></script><script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script><script type="text/javascript" src="noty/js/themes/default.js"></script>
<script>user_online();
$(document).ready(function () {
    $(function () {
        $('*[title]').monnaTip();
    });

    function loading_show() {
        $('#loading').html("<img src='images/preloader.gif'/>").fadeIn('fast');
    }

    function loading_hide() {
        $('#loading').fadeOut('fast');
    }

    function loadData(page) {
        loading_show();
        $.ajax({
            type: "POST",
            url: "get_search_data.php",
            data: "page=" + page + "&q=<?php echo $_POST['query']; ?>",
            success: function (msg) {
                $("#container").ajaxComplete(function (event, request, settings) {
                    loading_hide();
                    $("#container").html(msg);
                    $(".sr-user-pic").each(function () {

                        $(this).load(function () {
                            $(this).show("slow");

                        }).hide()

                    });
                });
            }
        });
    }
    loadData(1); // For first time page load default results
    $('#container .pagination li.active').live('click', function () {
        var page = $(this).attr('p');
        loadData(page);

    });
    $('#go_btn').live('click', function () {
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if (page != 0 && page <= no_of_pages) {
            loadData(page);
        } else {
            alert('Enter a PAGE between 1 and ' + no_of_pages);
            $('.goto').val("").focus();
            return false;
        }

    });
});
</script>
</head>
<body>
<div id="body">
<?php 

//insert google analytic code
include($ga_file); 

?>

<?php


if(is_logged_in()){

include("class_lib.php");

            //put navigation
            include(get_module_path("nav/nav.php"));
            $nav=new nav();
            $nav->get_nav_3(new user(uid()));
}


else {

?>
<div class="strip clickeffect"><?php echo top_bar_logo(); ?>
<ul> 
<li><a href='update.php' title='Edit/Update your profile'><img src="update.gif"></a></li><li><a href='msgbox.php' title='Go to your message box'><img src="msgbox.gif"></a></li>
<li><a href='collection.php' title='Manage your pictures'><img src="collection.gif"></a></li>
<li ><a href=home.php><img src="home.gif"  title="Home: <?php session_start();error_reporting(E_ERROR|E_WARNING); echo $_SESSION['userfulname'];?>"></a></li><li><a href="<?php echo get_profile_url($_SESSION['userid']);?>"><img src="profile.gif" title="Go to your profile"></a></li>
<li><form method="post" action="search.php">
<input type="text" class="shaded_fields" name="query" id="search_field" title="Search a user by name,email,country,state,city" placeholder="Search user">
<input type="submit" class="ss-submit" value="Search">
</form></li>
</ul>
</div>
<div class="clearboth"></div>
<?php
}
            ?>

<center>
<div id="loading"></div>
        <div id="container" <?php if(is_logged_in()){echo "style='margin-top:130px;'";} ?>>
            <div class="data"></div>
            <div class="pagination"></div>
        </div>
</center>
</div>
</body>
</html>