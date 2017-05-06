<?php

include("environment.php");

//compressing HTML content 
//ob_start("ob_gzhandler");

//verifying log-in
check_log_in($_SERVER["REQUEST_URI"]);

//checking the id supplied
$_GET['id']=intval($_GET['id']);
if(!if_exists("userdata","id",$_GET['id']) || !account_status($_GET['id']))
die("User with this id doesn't exists");    

if($_SESSION['userid']==$_GET['id'])
header('location:collection.php');

include('class_lib.php');
$lu=new user($_SESSION['userid']);
$vu=new user($_GET['id']);
?>
<!doctype html>
<html>
<head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en">
<link rel='icon' href='<?php echo get_image("favicon.ico"); ?>'><title>Picture collections of <?php echo $vu->get_name();?>-Frendsdom.com</title>
<script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script src="jquery.hovercard.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><script type="text/javascript" src="resources/jquery/jquery-ui-1.9.2.custom.min.js"></script><script src="js/jquery.outside.events.js"></script>
<script type="text/javascript" src="resources/jquery/js.js"></script><script type="text/javascript" src="resources/plugin/jquery.ui.combogrid-1.6.2.js"></script><script type="text/javascript" src="fancyBox_source/jquery.fancybox.js"></script><script type="text/javascript" src="jquery.flexibleArea.js"></script><script type="text/javascript" src="noty/js/jquery.noty.js"></script><script type="text/javascript" src="noty/js/layouts/bottomLeft.js"></script><script src="apprise/apprise.min.js" type="text/javascript"></script><script type="text/javascript" src="noty/js/themes/default.js"></script><link rel="stylesheet" type="text/css" href="css8.css"/><link rel="stylesheet" type="text/css" href="collection_styleSheet.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery.ui.combogrid.css"/><link rel="stylesheet" type="text/css" media="screen" href="resources/css/smoothness/jquery-ui-1.8.9.custom.css"/>
<link rel="stylesheet" type="text/css" href="fancyBox_source/jquery.fancybox.css" media="screen" /><link type="text/css" rel="stylesheet" media="all" href="apprise/apprise.min.css" />
<script>user_online();var SITE_URL="<?php echo SITE_URL; ?>/";
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

var luid=<?php echo $_SESSION['userid']; ?>,vuid=<?php echo $_GET['id'];?>,lu_gen="<?php echo $lu->get_sex();?>",lu_name="<?php echo $lu->get_name();?>",lu_pic="<?php echo $lu->prof_pic();?>",cmnt_backg='<?php echo $vu->get_comment_backg(); ?>';<?php if(!empty($_GET['col_id']) && !empty($_GET['pic_id'])) echo "var col_id='{$_GET['col_id']}',pic_id='{$_GET['pic_id']}';";?>
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
<li ><a href="friends3.php"><img src="1.gif"  title="logout"></a></li><li><a href='msgbox.php' title='Go to your message box'><img src="msgbox.gif"></a></li>
<li><a href='collection.php' title='Manage your pictures'><img src="collection.gif"></a></li>
<li ><a href="home.php"><img src="home.gif"  title="Home: <?php echo $_SESSION['userfulname'];?>"></a></li><li><a href="<?php echo get_profile_url($_SESSION['userid']);?>"><img src="profile.gif" title="Go to your profile"></a></li>
<li ><form method="post" action="search.php">
<input type="text" id="search_field" class="shaded_fields" name="query" title="Search a user by name,email,country,state,city"  placeholder="Search user">
<input type="submit" class="ss-submit" value="Search">
</form>
</li>
</ul>
</div>
<div class="clearboth"></div><?php if(!in_array($_GET['id'],return_array("user{$_SESSION['userid']}","listid"))){if($vu->get_sex()=="female")$h='her';else $h='his';die(unpriviledged_msg("Sorry! you are unprivileged","You must be in any of {$h} relation lists to be able to view </br>this page.</br></br><a href='".get_profile_url($_GET['id'])."' title='".$vu->get_name()."'><b>Go back</b></a>",$vu->get_name(),$vu->prof_pic(),true));}
?>
<table class="collection_list" id='collection_list'>
<tr style='padding-bottom:10px;' id='table_title'><td style='background:none;border:none;box-shadow:none;'>
<?php
$t=total_entries("piccollection4user{$_GET['id']}","collection_name",$pic_collection_record_db);
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

if($result=$mysqli->query("select DATE_FORMAT(created,'%d %M %Y'),UNIX_TIMESTAMP(created),DATE_FORMAT(created,'%r'),collection_index,collection_name,collection_id from piccollection4user{$_GET['id']} order by created DESC"))
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
</table>
<div id='pic_space'>( No picture collection selected yet )</div></div><div id='uploading'></div><div id='success'></div><div style='position:fixed;top:200px;left:600px;' id='loading' class='hidden'></div><iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
<script>
var w=new Worker("w_visit.js"),loading="<img src='picon1.gif'>Loading......";eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2E(0,\'.L\',\'D\',2F);M.1n(\'f\',\'1\');u f=M.1o(\'f\');M.1n(\'d\',\'\');u d=M.1o(\'d\');M.1n(\'l\',15);u l=M.1o(\'l\');4 2G(){3(\'1p\').5="<N 8=\'D:1P;16:1P;\'><1Q 8=\'16:2H 2I 17;16-1R:1S;1T:V;D:1q;1U-1V:V V 1W 17;\'><1r><N><1X 1Y=\'1Z\' 6=\'1Z\' 2J=\'20: 2K(9.6);\' 2L=\'20: 1s(9.6);\' 8=\'1t:21; 22: 2M;\' 2N=\'2O 1Y\'></1X></N><N><2P  2Q=\'2R\' W=\'1p\' 6=\'2S\' 18=\'2T\'></N></1r></1Q></N>"}$(".2U").h("m",4(){$(\'#O 1r\').2V(4(){c($(9).E(\'6\')!=\'1p\'&&$(9).E(\'6\')!=\'2W\'){$(9).1u(":1v").1w("D","23")}});$(9).1u(":1v").1w("D","1q");3(\'o\').5="<19>"+o+"</19>";q(\'o\');3(\'P\').8.y=\'.2\';w.r("24 k="+$(9).E(\'6\')+"&z="+z);w.v=4(e){d=\'\';f=\'1\';s(\'o\');3(\'P\').8.y=\'1\';3("P").5=e.x;w.r("25 k="+F());w.v=4(e){d=e.x.A(",");X()}}});4 F(){2X(u i=0;i<3(\'O\').Y.G;i++){c(3(\'O\').Y[i].1x[0].8.1y!="23"&&3(\'O\').Y[i].1x[0].8.1y!="2Y"&&3(\'O\').Y[i].1x[0].8.1y!="2Z"){1z 3(\'O\').Y[i].6;31}}}$("7").h("m",4(){q(\'Q\');3(\'1a\').8.y=\'.2\';3(\'Q\').1A("8",\'26:32;1s:1S;33:21;1U-1V:V V 1W 17;34:35;D:17;1T:36;16-1R:37;\');3(\'Q\').5="<1b 6=\'38\' 39=\'3a R 3b 3c 3d 3e\' j=\'"+3(\'7\').j+"\' 8=\'26:3f;1s:-3g;22:3h;1t:3i;\'>"});$("#Q").h("m",4(){3(\'Q\').5=\'\';s(\'Q\');3(\'1a\').8.y=\'1\'});4 X(){l=15;c(3(\'7\')){1c(\'3j\',1d)}3(\'3k\').5=B(f)+"/"+d.G;c(B(f)<=1)s(\'1B\');t q(\'1B\');c(B(f)>=d.G)s(\'1C\');t q(\'1C\')}$("#1C").h("m",4(){c(f>=(d.G-1))f=d.G-1;3(\'7\').j="1e.H?k="+F()+"&I="+d[f];f++;X()});$("#1B").h("m",4(){u a=B(f)-2;f=a+1;3(\'7\').j="1e.H?k="+F()+"&I="+d[a];X()});$("#27").h("m",4(){3(\'1a\').8.y=\'.2\';3(\'S\').5="<1b j=\'28.29\'>&1f;2a J 1D 7";q(\'S\');w.r("27 "+3(\'7\').j.A("?")[1]);w.v=4(e){s(\'S\');c(B(e.x)==1)1g("2b 1h Z J 1D 7");t 1g("1i: 11 R 1h 9 2c Z J 1D 7","2d")}});$("#3l").h("m",4(){c(1E(3(\'1j\').W).G>0){u a=3(\'C\').3m(1F("C","3n"));a.1A("18","3o");u b=a.3p(0);b.1A("3q","2");b.5="<1b j=\'"+3r+"\' 3s=\'3t\'>&1f;<a 18=\'13\' 6=\'"+3u+"\' 3v=\'3w.H?6="+z+"\'><b>"+3x+"</b></a>&1f;"+3y(3z(1E(3A.3B(\'1j\').W)),30).3C(/\\n/g,\'<2e />\')+"</2e><2f 18=\'3D\'>"+2g()+"</2f>";w.r("3E "+3(\'7\').j.A("?")[1]+"&L="+2h(1E(3(\'1j\').W))+"&6="+z);w.v=4(e){c(B(e.x)!=1)1G("1i :11 R 3F 3G L");t{3(\'14\').5=++3(\'14\').5}};3(\'1j\').W=\'\'}t{1G("3H 3I 3J Z J L");1z}});4 1c(a,b){c(b){3(a).5=o;w.r("2i "+3(\'7\').j.A("?")[1]+"&n="+l+"&3K=1d")}t{3(a).5="<p 8=\'1t:3L;\'>"+o+"</p>";w.r("2i "+3(\'7\').j.A("?")[1]+"&n="+l)}w.v=4(e){3(a).5=e.x;c(l<=15)s(\'1H\');t q(\'1H\');c(l<B(3M(\'14\')))q(\'1I\');t s(\'1I\')}}$("#1I").h("m",4(){l+=15;1c(\'C\')});$("#1H").h("m",4(){l-=15;1c(\'C\')});$(\'.3N\').h("1k",4(){q("3O"+$(9).E(\'6\'))});$(\'.1J\').h("2j",4(){s($(9).E(\'6\'))});4 1J(a){c(3P("3Q R 3R L")){3(\'C\').2k(1F("C","3S"+a));3(\'C\').2k(1F("C","1J"+a));w.r("3T "+3(\'7\').j.A("?")[1].A("&")[1]+"&3U="+a);w.v=4(e){c(B(e.x)==1)3(\'14\').5=--3(\'14\').5;t 1G("1i :11 R 3V L")}}}4 2g(){u a=1l 3W(),2l=1l 1K(\'3X\',\'3Y\',\'3Z\',\'40\',\'41\',\'42\',\'43\'),2m=2l[a.44()],1L=1l 1K(\'K\',\'45\',\'46\',\'47\',\'K\',\'K\',\'K\',\'K\',\'K\',\'K\'),2n=b+(a.T()<10)?\'0\'+a.T()+1L[a.T()]:a.T()+1L[48((""+a.T()).49((""+a.T()).G-1))],2o=1l 1K(\'4a\',\'4b\',\'4c\',\'4d\',\'4e\',\'4f\',\'4g\',\'4h\',\'4i\',\'4j\',\'4k\',\'4l\'),2p=2o[a.4m()],2q=a.4n(),2r=a.U()>12?a.U()-12:(a.U()<10?"0"+a.U():a.U()),2s=a.1M()<10?"0"+a.1M():a.1M(),2t=a.1N()<10?"0"+a.1N():a.1N(),2u=a.U()>12?"4o":"4p";u b=2r+":"+2s+"."+2t+2u+" "+2m+" "+2n+" 4q "+2p+", "+2q;1z b}$("#4r").h("m",4(){3(\'1a\').8.y=\'.2\';3(\'S\').5="<1b j=\'28.29\'>&1f;2a J 1O 7";q(\'S\');w.r("4s z="+z+"&4t="+2h(4u+"1e.H?k="+F()+"&I="+d[f-1]));w.v=4(e){s(\'S\');c(e.x.4v("11")==-1)1g("2b 1h Z J 1O 7");t 1g("1i: 11 R 1h 9 2c Z J 1O 7","2d")}});$(4(){$(".13").h("1k",4(){$(9).1m({2v:1d,2w:2x.2y(2z("6="+$(9).E(\'6\'),"2A.H")),2B:4(){$(9).1m({2C:\'\'})}})})});$(".13").h("2j",4(){$(".13").4w(\'1k\');$(".13").1k(4(){$(9).1m({2v:1d,2w:2x.2y(2z("6="+$(9).E(\'6\'),"2A.H")),2B:4(){$(9).1m({2C:\'\'})}})})});c(k&&I){c(3(k)){$("#"+k).1u(":1v").1w("D","1q");3(\'o\').5="<19>"+o+"</19>";q(\'o\');3(\'P\').8.y=\'.2\';w.r("24 k="+k+"&z="+z);w.v=4(e){s(\'o\');3(\'P\').8.y=\'1\';3("P").5=e.x;3(\'7\').j=\'\';w.r("25 k="+F());w.v=4(e){d=e.x.A(",");3(\'7\').j="1e.H?k="+F()+"&I="+d[d.2D(I)];f=d.2D(I)+1;X()}}}}',62,281,'|||el|function|innerHTML|id|picture|style|this|||if|pic_array||pic_count||live||src|col_id|comment_count|click||loading||show|postMessage|hide|else|var|onmessage||data|opacity|vuid|split|parseInt|pic_comment_table|background|attr|get_col_id|length|php|pic_id|your|th|comment|sessionStorage|td|collection_list|pic_space|big_pic|to|uploading|getDate|getHours|5px|value|prev_next_pic|rows|as||failed||fback_from1|total_cmnt||border|black|class|h1|body|img|fetch_cmnt|true|get_pic|nbsp|response_msg|set|Error|txt_comment|mouseenter|new|hovercard|setItem|getItem|create|pink|tr|top|width|children|first|css|cells|backgroundColor|return|setAttribute|prev_pic|next_pic|profile|trim|getRowIndex|alert|prev_comments|next_comments|remove_cmt|Array|domEnder|getMinutes|getSeconds|eyecandy|none|table|radius|10px|padding|box|shadow|2px|textarea|name|new_collection|javascript|150px|height|grey|get_col_pic|get_pic_array|position|set_pic|picon1|gif|Setting|Picture|one|red|br|span|current_date|encodeURIComponent|get_pic_comments|mouseleave|deleteRow|weekday|dayOfWeek|dayOfMonth|months|curMonth|curYear|curHour|curMinute|curSeconds|curMeridiem|showCustomCard|customCardJSON|JSON|parse|responsetext|displayuserinfo2|onHoverOut|detailsHTML|findIndex|changecss|cmnt_backg|setvisible|1px|solid|onkeyup|haut|onfocus|20px|placeholder|collection|input|type|button|create_btn|btn|col_bottom|each|table_title|for|transparent|initial||break|absolute|left|cursor|pointer|100px|15px|enlarged_img|title|Click|scale|it|back|down|relative|90px|670px|800px|pic_comment|show_piccount|post_comment|insertRow|postcomment_tr|bottom_border|insertCell|colspan|lu_pic|align|middle|luid|href|visit|lu_name|splitLine|htmlEntities|document|getElementById|replace|light_text|post_cmnt_on_pic|post|last|Please|write|something|refresh|400px|inner|bottom_border1|remove_|confirm|Proceed|removing|cmt|del_pic_comment|cmt_index|remove|Date|Sunday|Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|getDay|st|nd|rd|parseFloat|substr|January|February|March|April|May|June|July|August|September|October|November|December|getMonth|getFullYear|PM|AM|of|set_eyecandy_pic|set_eyecandy|pic_url|SITE_URL|indexOf|die'.split('|'),0,{}))</script>
</body>
</html>