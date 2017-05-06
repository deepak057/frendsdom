<?php

include("environment.php");

//verifying log-in
check_log_in($_SERVER["REQUEST_URI"]);

//compressing HTML content 
//ob_start("ob_gzhandler");

include('class_lib.php');
$lu=new user($_SESSION['userid']);

?>
<!doctype html>
<html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en">
<link rel="icon" href="<?php echo get_image("favicon.ico"); ?>"><title>Your picture collection - Frendsdom.com</title><script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script src="jquery.hovercard.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script><script src="js/jquery.outside.events.js"></script><script src="apprise/apprise.min.js" type="text/javascript"></script>
<script type="text/javascript" src="resources/jquery/js.js"></script><script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script><script type="text/javascript" src="fancyBox_source/jquery.fancybox.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="chat/chat.js"></script><script type="text/javascript" src="noty/js/jquery.noty.js"></script><script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script><script type="text/javascript" src="noty/js/themes/default.js"></script>
<link rel="stylesheet" type="text/css" href="css8.css"/><link rel="stylesheet" type="text/css" href="collection_styleSheet.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
<link rel="stylesheet" type="text/css" href="fancyBox_source/jquery.fancybox.css" media="screen" /><link rel="stylesheet" type="text/css" href="chat/chat.css"/><link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
<script>
user_online();var SITE_URL="<?php echo SITE_URL; ?>/";
jQuery(document).ready(function(){
$(".flexible_textarea").live("focus",function(){$(this).flexible();});
	$('#switcher').themeswitcher({
		loadTheme:"Smoothness"
	});
		$( "#search_field" ).combogrid({
		url: 'search_autocomplete.php',
		debug:true,
		sidx: "id",
		sord: "asc",
		rows: 10,
                addClass:"combogrid_class",
                alternate:true,
                draggable: true,
                rememberDrag: true,
                //replaceNull: true,
		colModel: [{'columnName':'name','align':'left','width':'25','label':'Name'}, {'columnName':'country','width':'25','label':'Country'},{'columnName':'state','width':'25','label':'State'}, {'columnName':'city','width':'25','label':'City'}],
		select: function( event, ui ){
			//$( "#search_field" ).val( ui.item.name );
			document.location.href=ui.item.link;
			return false;
		}
	});});

$(document).ready(function() {
			$("#picture").live("click",function() {
var fancy_pic_array=new Array(),fancy_pic_index;
for(var i=0;i<pic_array.length;i++)
{
fancy_pic_array[i]="get_pic.php?col_id="+get_col_id()+"&pic_id="+pic_array[i];
if(fancy_pic_array[i]==el('picture').src.replace(SITE_URL,""))
{
fancy_pic_index=i;
}
}
$.fancybox(fancy_pic_array, {
			'padding'	: 0,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'type'          : 'image',
			'changeFade'    : 0,
			'index':fancy_pic_index,
			'loop':false,
			
afterLoad: function() {
            this.title = parseInt(pic_count)+"/"+pic_array.length;
        }

			});});});

$(".fancybox-next").live("click",function(){el("next_pic").click();});
$(".fancybox-prev").live("click",function(){el("prev_pic").click();});

var luid=<?php echo $_SESSION['userid']; ?>,lu_gen="<?php echo $lu->get_sex();?>",lu_name="<?php echo $lu->get_name();?>",lu_pic="<?php echo $lu->prof_pic();?>",cmnt_backg='<?php echo $lu->get_comment_backg(); ?>';<?php if(!empty($_GET['col_id']) && !empty($_GET['pic_id'])) echo "var col_id='{$_GET['col_id']}',pic_id='{$_GET['pic_id']}';";?>
</script>
</head>
<body>
<?php 

//insert google analytic code
include($ga_file); 

?>

<div id='body'>
<div class="strip clickeffect"><?php echo top_bar_logo(); ?>
<ul >
<li ><a href="friends3.php"><img src="1.gif"  title="logout"></a></li><li><a href='update.php' title='Edit/Update your profile'><img src="update.gif"></a></li><li><a href='msgbox.php' title='Go to your message box'><img src="msgbox.gif"></a></li>
<li ><a href="home.php"><img src="home.gif"  title="Home: <?php echo $_SESSION['userfulname'];?>"></a></li><li><a href="<?php echo get_profile_url( $_SESSION['userid']);?>"><img src="profile.gif" title="Go to your profile"></a></li>
<li ><form method="post" action="search.php">
<input type="text" id="search_field" class="shaded_fields" name="query" title="Search a user by name,email,country,state,city"  placeholder="Search user">
<input type="submit" class="ss-submit" value="Search">
</form>
</li>
</ul>
</div>
<div class="clearboth"></div>
<table  class="collection_list" id='collection_list'>
<tr style='padding-bottom:10px;' id='table_title'><td style='background:none;border:none;box-shadow:none;'>
<?php
$t=total_entries("piccollection4user{$_SESSION['userid']}","collection_name",$pic_collection_record_db);
if(intval($t)>1)
echo "<span id='total_col'>{$t}</span> picture collections";
else echo "<span id='total_col'>{$t}</span> picture collection";
?></td></tr>
<?php
$mysqli=new mysqli($host,$db_user,$db_passwd,$pic_collection_record_db);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}

if($result=$mysqli->query("select DATE_FORMAT(created,'%d %M %Y'),UNIX_TIMESTAMP(created),DATE_FORMAT(created,'%r'),collection_index,collection_name,collection_id from piccollection4user{$_SESSION['userid']} order by created DESC"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['collection_name']))
{
?>
<tr class="col_bottom" id="<?php echo $row['collection_id']; ?>">
<td title="<?php echo "Created about ".ago($row[1])." (on {$row[0]} at {$row[2]})";  ?>">
<?php echo $row['collection_name']; ?>
</td>
</tr>

<?php
}

}
}
}
?>

<tr id='create'>
<td>
<input id="collection" type="button" value="create a new picture collection"  onclick="setvisible();">
</td>
</tr>

</table>
<div id='pic_space'>( No picture collection selected yet )</div></div><div id='uploading'></div><div id='success'></div><div id='loading' class='hidden'></div><iframe id="upload_target" name="upload_target" src="#"></iframe>
<?php
pop_up_msg($_SESSION['userid']);
?>
<script>
var w=new Worker("w_visit.js"),loading="<img src='picon1.gif'>Loading......";changecss(0,'.comment','background','<?php echo $lu->get_comment_backg(); ?>');eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('1m.2i(\'j\',\'1\');K j=1m.2j(\'j\');1m.2i(\'h\',\'\');K h=1m.2j(\'h\');1m.2i(\'S\',15);K S=1m.2j(\'S\');4 2R(){3(\'1n\').7="<k 9=\'P:1o;17:1o;\'><1p 9=\'17:2S 2T 1q;17-2k:1S;1T:18;P:2l;1U-1V:18 18 2m 1q;\'><D><k><2U T=\'1f\' 8=\'1f\' 3M=\'2V: 3N(c.8);\' 3O=\'2V: 10(c.8);\' 9=\'1r:2W; 1F: 3P;\' 2X=\'y T\'></2U></k><k><U  V=\'1s\' l=\'1n\' 8=\'2Y\' E=\'3Q\'></k></D></1p></k>"}$("#2Y").o("u",4(){d(3(\'1f\').l.1t>0&&19(3(\'1f\').l)!=\'\'){3(\'s\').7="<B f=\'1u.1a\'>&F;3R 1v y";z(\'s\');3(\'11\').9.G=".2";w.C("3S 3T="+1W(19(3(\'1f\').l)));w.H=4(e){A(\'s\');d(e.v.1X(\'y\')==-1||e.v.1X(\'L\')!=-1)M("12: L q 1n 1v y","1w");t{K a=3(\'W\').2Z(m(1G("W","31"))+1);a.1g("E","32");a.8=e.v;K b=a.33(0);b.I="3U 3V "+34();b.7=1W(19(3(\'1f\').l));3(\'1f\').l=\'\';3(\'1n\').7="<k 9=\'P:1o;17:1o;1U-1V:1o;\'><U 8=\'y\' V=\'1s\' l=\'1n a 1v 6 y\'  1H=\'2R();\'></k>";3(\'11\').9.G=\'1\';3(\'1Y\').7=++3(\'1Y\').7}}}t{1h(\'1Z 35 a T 20 N 1v y\')}});$(".32").o("u",4(){$(\'#W D\').3W(4(){d($(c).1i(\'8\')!=\'1n\'&&$(c).1i(\'8\')!=\'31\'){$(c).2n(":21").2o("P","2p")}});$(c).2n(":21").2o("P","2l");3(\'X\').7="<22>"+X+"</22>";z(\'X\');3(\'1b\').9.G=\'.2\';w.C("36 x="+$(c).1i(\'8\'));w.H=4(e){h=\'\';j=\'1\';A(\'X\');3(\'1b\').9.G=\'1\';3("1b").7=e.v;w.C("37 x="+Q());w.H=4(e){h=e.v.J(",");1j()}}});4 Q(){20(K i=0;i<3(\'W\').1I.1t;i++){d(3(\'W\').1I[i].2q[0].9.2r!="2p"&&3(\'W\').1I[i].2q[0].9.2r!="3X"&&3(\'W\').1I[i].2q[0].9.2r!="3Y"){1x 3(\'W\').1I[i].8;38}}}$("#2s").o("u",4(){3(\'1c\').1g("9","13:1k;1y:3Z;10:41;P:2t;1T:1S;17-2k:1S;1U-1V:18 18 2m 1q;");3(\'1c\').7="<D><k>42 1J 6</k><k 2u=\'43\' 44=\'10\'><1z 9=\'13:1k;10:-45;\' E=\'46\' I=\'47\' 1H=\'2v();\'>&#48;</1z></k></D><D><k 39=\'2\'><2w 49=\'3a\' 8=\'4a\' 4b=\'1c.Y\' 4c=\'4d/2w-v\' 4e=\'4f\' 4g=\'3b();\'><U V=\'3c\' 8=\'23\' T=\'23\'/><U V=\'2x\' T=\'x\' l=\'"+Q()+"\'>&F;<U V=\'4h\' l=\'2y\' E=\'2z\' 9=\'P:2p;\'></2w></k></D>"});4 2v(){$("#1c").A("3d",4(){3(\'1c\').1g("9","13:1k;1y:3e;10:4i;");3(\'1c\').7="<D><k></1l><U V=\'1s\' l=\'2y a 6\' E=\'2z\' 9=\'P:2t;\' 8=\'2s\'></k></D>";$("#1c").z("3d")})}4 3b(){d(!4j(24.25(\'23\').l)){1h(\'1Z 4k 4l 4m 3c 4n 4o,4p 4q 4r 4s\');24.25(\'23\').l=\'\';1x 4t}2v();3(\'11\').9.G=".2";3(\'s\').7="<B f=\'1u.1a\'>&F;4u 1J 6......";z(\'s\');1x 1K}4 4v(r){A(\'s\');d(r.1X(\'L\')==-1){M("1A 26 4w");3(\'2A\').7="<B f=\'4x.2B\' 1F=\'30\' 1r=\'30\' 9=\'27:28;\' I=\'4y 6\' 8=\'29\' E=\'2x\'>&F;<B 8=\'6\' I=\'1B q 4z c 6\' f=\'1C.Y?x="+Q()+"&14="+r+"\' 1F=\'4A\' 1r=\'4B\'>&F;<B f=\'4C.2B\' 1F=\'30\' 1r=\'30\' 9=\'27:28;13:1k;1y:18;\' I=\'4D 2C\' 8=\'2a\' E=\'2x\'>";d(!3(\'2D\')){3(\'2A\').7+="<3f E=\'3g\' 8=\'3g\' 9=\'13:3h;10:4E;1y:4F;\'><1d 9=\'17:1o;\'><3i 8=\'2D\'></3i></1d><1d 8=\'2E\' I=\'1B q 1L c 6\'>3j c 6</1d><1d 8=\'2F\' I=\'1B q 1D c 6 16 N 1M 6\'>3k 16 N 1M 2C</1d><1d 8=\'3l\' I=\'1B q 1D c 6 16 N 1v 1N 6\'>3k 16 N 1N 2C</1d></3f>"}3(\'O\').7=m(Z(\'O\'))+1;j=m(Z(\'O\'));h.4G(r);h=h.3m(4(a){1x!(a===""||3n a=="3o"||a===3p)});1j()}t M("12: L q 4H 6","1w")}$("#2G").o("u",4(){d(2H("2I q 3q c y?")){3(\'11\').9.G=\'.2\';3(\'s\').7="<B f=\'1u.1a\'>&F;3r y.......";z(\'s\');K a=Q();w.C("2G x="+a);w.H=4(e){A(\'s\');d(m(e.v)==1){3(\'W\').2J(1G("W",a));3(\'1Y\').7=--3(\'1Y\').7;3(\'1b\').7="( 3s 6 y 4I )";M("1A y 26 2K")}t{M("12 :L q 1L c y","1w")}}}});$("6").o("u",4(){z(\'1E\');3(\'11\').9.G=\'.2\';3(\'1E\').1g("9",\'13:3h;10:1S;1y:2W;1U-1V:18 18 2m 1q;27:28;P:1q;1T:4J;17-2k:4K;\');3(\'1E\').7="<B 8=\'4L\' I=\'1B q 4M 4N 4O 4P\' f=\'"+3(\'6\').f+"\' 9=\'13:1k;10:-4Q;1F:4R;1r:4S;\'>"});$("#1E").o("u",4(){3(\'1E\').7=\'\';A(\'1E\');3(\'11\').9.G=\'1\'});4 1j(){S=15;d(m(Z(\'O\'))>0){2b(\'3t\',1K)}2L();3(\'2D\').7=m(j)+"/"+h.1t;d(m(j)<=1)A(\'29\');t z(\'29\');d(m(j)>=m(Z(\'O\')))A(\'2a\');t z(\'2a\')}$("#2a").o("u",4(){d(j>=(m(Z(\'O\'))-1))j=m(Z(\'O\'))-1;3(\'6\').f="1C.Y?x="+Q()+"&14="+h[j];j++;1j()});$("#29").o("u",4(){K a=m(j)-2;j=a+1;3(\'6\').f="1C.Y?x="+Q()+"&14="+h[a];1j()});$(\'#2E\').o("u",4(){d(2H("2I q 3q c 6")){3(\'11\').9.G=\'.2\';3(\'s\').7="<B f=\'1u.1a\'>&F;3r c 6........";z(\'s\');w.C("2E "+3(\'6\').f.J("?")[1]);w.H=4(e){A(\'s\');d(m(e.v)==1){M("1A 26 2K");3(\'O\').7=--3(\'O\').7;d(m(Z(\'O\'))<=0){3(\'1b\').7="<1p 4T=\'5\' E=\'4U\'><D><k><B f=\'4V.1a\'>4W 3u:<1z 8=\'O\'>0</1z></k><k I=\'u q 1L c 6 y\' 8=\'2G\'><B f=\'1L.1a\'>3j c y</k></D></1p><2c 8=\'2A\' 9=\'13:1k;10:4X;\'><B f=\'4Y.2B\' 2u=\'3v\'>3s 3u 4Z c y 50</2c><1l/><1l/><1p 8=\'1c\' 9=\'13:1k;1y:3e;\'><D><k></1l><U V=\'1s\' l=\'2y a 6\' E=\'2z\' 9=\'P:2t;\' 8=\'2s\'></k></D></1p><2c 8=\'3t\'></2c>";h=\'\';j=\'1\'}t{20(K i=0;i<h.1t;i++){d(h[i]==3(\'6\').f.J("?")[1].J("&")[1].J("=")[1]){h[i]=\'\';38}}h=h.3m(4(a){1x!(a===""||3n a=="3o"||a===3p)});d((m(j)-1)==m(Z(\'O\')))j=0;t j--;3(\'6\').f="1C.Y?x="+Q()+"&14="+h[j];j++;1j()}M("1A 26 2K")}t{M("12 :L q 1L 1J 6","1w")}}}});$("#2F").o("u",4(){3(\'11\').9.G=\'.2\';3(\'s\').7="<B f=\'1u.1a\'>&F;3w N 1M 6";z(\'s\');w.C("2F "+3(\'6\').f.J("?")[1]);w.H=4(e){A(\'s\');d(m(e.v)==1)M("1A 1D 16 N 1M 6");t M("12: L q 1D c 3x 16 N 1M 6","1w")}});$("#51").o("u",4(){d(19(3(\'2d\').l).1t>0){K a=3(\'1e\').2Z(1G("1e","52"));a.1g("E","53");K b=a.33(0);b.1g("39","2");b.7="<B f=\'"+54+"\' 2u=\'3v\'>&F;<a E=\'1O\' 8=\'"+2e+"\' 55=\'56.Y?8="+2e+"\'><b>"+57+"</b></a>&F;"+58(1W(19(24.25(\'2d\').l)),30).59(/\\n/g,\'<1l />\')+"</1l><1z E=\'5a\'>"+34()+"</1z>";w.C("5b "+3(\'6\').f.J("?")[1]+"&1P="+2M(19(3(\'2d\').l))+"&8="+2e);w.H=4(e){d(m(e.v)!=1)1h("12 :L q 3a 5c 1P");t{3(\'1Q\').7=++3(\'1Q\').7}};3(\'2d\').l=\'\'}t{1h("1Z 5d 5e 16 N 1P");1x}});4 2L(){$("#R").o("1R",4(){3(\'R\').9.27=\'28\';3(\'R\').I=\'1B q 3y 1J T 3z c 6\';3(\'R\').1H=4(){2f()}})}4 2f(){3(\'R\').5f("I");$("#R").3A();3(\'R\').1H=4(){};K a=Z(\'R\');3(\'R\').1g("9","1T:5g;");3(\'R\').7="5h T:"+a+"</1l><U 9=\'17:2S 2T 1q;\' V=\'5i\' 8=\'2g\' 2X=\'5j T\' 5k=\'40\'>&F;<U V=\'1s\' l=\'5l\' 8=\'2f\'>&F;<U V=\'1s\' l=\'5m\' 1H=\'2N(\\""+a+"\\")\'>"}$("#2f").o("u",4(){d(19(3(\'2g\').l).1t>0){w.C("5n "+3(\'6\').f.J("?")[1]+"&5o="+2M(3(\'2g\').l));2N(1W(19(24.25(\'2g\').l)));w.H=4(e){d(m(e.v!=1))1h("12 :L q 3y 1J T 3z c 6")}}t{1h("1Z 35 a 1v T 20 c 6 21")}});4 2b(a,b){d(b){3(a).7=X;w.C("3B "+3(\'6\').f.J("?")[1]+"&n="+S+"&5p=1K")}t{3(a).7="<p 9=\'1r:5q;\'>"+X+"</p>";w.C("3B "+3(\'6\').f.J("?")[1]+"&n="+S)}w.H=4(e){3(a).7=e.v;d(S<=15)A(\'2O\');t z(\'2O\');d(S<m(Z(\'1Q\')))z(\'2P\');t A(\'2P\')}}4 2N(a){3(\'R\').7=a;2L()}$("#2P").o("u",4(){S+=15;2b(\'1e\')});$("#2O").o("u",4(){S-=15;2b(\'1e\')});$(\'.5r\').o("1R",4(){z("5s"+$(c).1i(\'8\'))});$(\'.2Q\').o("3C",4(){A($(c).1i(\'8\'))});4 2Q(a){d(2H("2I q 5t 1P")){3(\'1e\').2J(1G("1e","5u"+a));3(\'1e\').2J(1G("1e","2Q"+a));w.C("5v "+3(\'6\').f.J("?")[1].J("&")[1]+"&5w="+a);w.H=4(e){d(m(e.v)==1)3(\'1Q\').7=--3(\'1Q\').7;t 1h("12 :L q 5x 1P")}}}$(4(){$(\'*[I]\').5y()});$("#3l").o("u",4(){3(\'11\').9.G=\'.2\';3(\'s\').7="<B f=\'1u.1a\'>&F;3w N 1N 6";z(\'s\');w.C("5z 5A="+2e+"&5B="+2M(5C+"1C.Y?x="+Q()+"&14="+h[j-1]));w.H=4(e){A(\'s\');d(e.v.1X("L")==-1)M("1A 1D 16 N 1N 6");t M("12: L q 1D c 3x 16 N 1N 6","1w")}});$(4(){$(".1O").o("1R",4(){$(c).2h({3D:1K,3E:3F.3G(3H("8="+$(c).1i(\'8\'),"3I.Y")),3J:4(){$(c).2h({3K:\'\'})}})})});$(".1O").o("3C",4(){$(".1O").3A(\'1R\');$(".1O").1R(4(){$(c).2h({3D:1K,3E:3F.3G(3H("8="+$(c).1i(\'8\'),"3I.Y")),3J:4(){$(c).2h({3K:\'\'})}})})});d(x&&14){d(3(x)){$("#"+x).2n(":21").2o("P","2l");3(\'X\').7="<22>"+X+"</22>";z(\'X\');3(\'1b\').9.G=\'.2\';w.C("36 x="+x);w.H=4(e){A(\'X\');3(\'1b\').9.G=\'1\';3("1b").7=e.v;3(\'6\').f=\'\';w.C("37 x="+Q());w.H=4(e){h=e.v.J(",");3(\'6\').f="1C.Y?x="+Q()+"&14="+h[h.3L(14)];j=h.3L(14)+1;1j()}}}}',62,349,'|||el|function||picture|innerHTML|id|style|||this|if||src||pic_array||pic_count|td|value|parseInt||live||to||uploading|else|click|data||col_id|collection|show|hide|img|postMessage|tr|class|nbsp|opacity|onmessage|title|split|var|failed|response_msg|your|total_pic|background|get_col_id|pic_name|comment_count|name|input|type|collection_list|loading|php|inner|top|body|Error|position|pic_id||as|border|5px|trim|gif|pic_space|upload_pic|li|pic_comment_table|new_collection|setAttribute|alert|attr|prev_next_pic|relative|br|sessionStorage|create|none|table|black|width|button|length|picon1|new|red|return|left|span|Picture|Click|get_pic|set|big_pic|height|getRowIndex|onclick|rows|the|true|delete|profile|eyecandy|fback_from1|comment|total_cmnt|mouseenter|10px|padding|box|shadow|htmlEntities|indexOf|total_col|Please|for|first|h1|new_pic|document|getElementById|successfully|cursor|pointer|prev_pic|next_pic|fetch_cmnt|div|txt_comment|luid|change_name|new_pic_name|hovercard|setItem|getItem|radius|pink|2px|children|css|grey|cells|backgroundColor|upload_pic_btn|blue|align|hideUpldMenu|form|hidden|Upload|special_btn|image_container|png|pic|show_piccount|del_pic|set_pic|del_col|confirm|Proceed|deleteRow|deleted|attach_mevent|encodeURIComponent|cancel_change|prev_comments|next_comments|remove_cmt|setvisible|1px|solid|textarea|javascript|150px|placeholder|create_btn|insertRow||table_title|col_bottom|insertCell|current_date|specify|get_col_pic|get_pic_array|break|colspan|post|startUpload|file|slow|580px|ul|li_options|absolute|h2|Delete|Set|set_eyecandy_pic|filter|typeof|undefined|null|deleting|Deleting|No|pic_comment|pictures|middle|Setting|one|change|of|die|get_pic_comments|mouseleave|showCustomCard|customCardJSON|JSON|parse|responsetext|displayuserinfo2|onHoverOut|detailsHTML|findIndex|onkeyup|haut|onfocus|20px|btn|Creating|create_collection|col_name|Created|on|each|transparent|initial|470px||60px|Choose|right|valign|7px|red_onhover|Close|215|method|upload_form|action|enctype|multipart|target|upload_target|onsubmit|submit|50px|validpic|choose|an|image|with|JPG|GIF|or|PNG|extension|false|Uploading|stopUpload|uploaded|leftm|Previous|enlarge|450|350|rightm|Next|110px|250px|push|upload|selected|100px|15px|enlarged_img|scale|it|back|down|90px|670px|800px|cellspacing|pic_collection_operations|total|Total|30px|empty|in|yet|post_comment|postcomment_tr|bottom_border|lu_pic|href|visit|lu_name|splitLine|replace|light_text|post_cmnt_on_pic|last|write|something|removeAttribute|4px|Old|text|New|maxlength|Change|Cancel|change_pic_name|new_name|refresh|400px|bottom_border1|remove_|removing|cmt|del_pic_comment|cmt_index|remove|monnaTip|set_eyecandy|vuid|pic_url|SITE_URL'.split('|'),0,{}))</script>
</body>
</html>