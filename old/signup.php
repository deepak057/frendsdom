<?php

include('/home/frendryg/FunctionList.php');
set_error_handler('ErrorHandler');   

if(!get_client_browser("Chrome") && !get_client_browser("Firefox") && !(get_client_browser("Opera") && (get_browser()->version>=10.6)) && !(get_client_browser("Safari") && (get_browser()->version>=4)) && !(get_client_browser("IE") && (get_browser()->version>=10)))
{
header("location:signup2.php");
}

//compressing HTML content 
ob_start("ob_gzhandler"); 

?>
<html><head><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><META HTTP-EQUIV="Content-Language" Content="en"><link rel="icon" href="awesom.bmp"><title>Sign up with Frendsdom.com</title><script src="script.js" type="text/javascript"></script><script src="jquery-1.4.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script><link rel="stylesheet" type="text/css" href="/css8.css"/></style><style type="text/css">body{-moz-background-size:100% 100%;background:url("/vp_backgrounds/try.jpg");}
.signup_form{border:1px solid black;background:url(background_textures/greybackg.jpg);font-size:1.1em;padding:20px;box-shadow: 5px 5px 2px black;border-radius:15px;}.signup_form input,.signup_form select {height:30px;border:1px solid black;}.signup_form input:hover, .signup_form input:focus{background:grey;border:1px solid black;}.signup_form select:hover,.signup_form select:focus{background:grey;border:1px solid black;}.signup_form td li{list-style-type:none;float:right;}.greentext{color:#0000FF;}.bluetext{color:blue;font-size:.8em;}.creation_report{box-shadow:10px 10px 5px black;position:fixed;top:200px;left:300px;padding:50px 50px 20px 50px;visibility:hidden;border-radius:15px;background-color: #E6E6FA;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#E6E6FA', endColorstr='#999');
background: -webkit-gradient(linear, left top, left bottom, from(#E6E6FA), to(#999));
background: -moz-linear-gradient(top,  #E6E6FA,  #999);	
}#pop_action{position:absolute;top:10px;right:5px;background:pink;padding:10px;box-shadow:10px 10px 5px black;border:1px solid black;visibility:hidden;}#pop_up{position:fixed;top:1px;background:pink;padding:5px;border:1px solid black;text-align:left;height:100px;}
</style><script type="text/javascript">
$(function(){$('*[title]').monnaTip()});eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('G 2L(){1j(\'Y\');1J(0);u(\'25\').I.26="1"}G Y(){1j(\'1t\');1p(\'Y\');u(\'Y\').B="<N><y><27 28=\'1K.1L\' 2a=\'O 1M...\'></y><y x=\'2M\'><b>2N 2O.......</b></y></N><N><y></y><y x=\'2P\'>&z;  2Q 2R 2S 2b.</y></N><N><y></y><y></T></T><2c 2d=\'2e\' D=\'2T\' x=\'2U\' Q=\'2f\' 1u=\'1N();\'></y></N>";w.1O("Y "+1v.P.D);w.1P=G(e){u(\'Y\').B=e.1Q}}G 1J(a){7 b=["U","R","Z","M","C","J","P","V","1d","1e","1f","1g","10"];W(7 i=0;i<b.K;i++){u(b[i]).2V=a}}G 1N(){1j(\'Y\');1p(\'1t\');7 a=2g.2W.1v,U=14(a.2h.U.D),R=14(a.2h.R.D);W(7 i=0;i<a.Z.K;i++){8(a.Z[i].2X)7 b=a.Z[i].D}7 c=a.M.D,C=a.C.D,J=a.J.D,V=14(a.V.D),1d=14(a.1d.D),P=14(a.P.D),1e=14(a.1e.D),1f=14(a.1f.D),1g=14(a.1g.D);8(2i(C+"/"+c+"/"+J)){1J(1);u(\'25\').I.26=".2";u(\'1t\').B="<N><y><27 28=\'1K.1L\' 2a=\'O 1M...\'></y><y x=\'2Y\'><b>O 1M.......</b></y></N><N><y></y><y x=\'2Z\'>&z;  30 2b 1k 32 33 34.</y></N><N><y></y><y></T></T><2c 2d=\'2e\' D=\'35\' x=\'36\' Q=\'2f\' 1u=\'Y();\'></y></N>";7 d="U="+U+"&R="+R+"&Z="+b+"&M="+c+"&C="+C+"&J="+J+"&P="+P+"&V="+V+"&1d="+1d+"&1e="+1e+"&1f="+1f+"&1g="+1g;w.1O("1R "+d);w.1P=G(e){u(\'1t\').B=e.1Q}}}G 37(a,b){8(b.K>0){u(a).I.15="1h 16 2j";8(a=="U"||a=="R"){8(!u(\'2k\')){7 c=u("H");7 d=c.17(0);d.v("x","2k");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);7 h=d.A(2);7 i=d.A(3);g.v("x","38");i.v("18","3");i.v("x","39")}8(a=="U")7 j="3a 1q";8(a=="R")7 j="R 1q 1k 2l";u(a+"E").B="&#19;&z;"+j;1a(a)}8(a=="Z"){8(!u("2m")){7 c=u("H");7 d=c.17(1b("H","3b"));d.v("x","2m");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);g.v("x","3c");g.v("18","5")}7 j="3d 1w";u(a+"E").B="&#19;&z;"+j;1a(a)}8(a=="M"||a=="C"||a=="J"){8(!u("2n")){7 c=u("H");7 d=c.17(1b("H","3e"));d.v("x","2n");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);7 h=d.A(2);7 i=d.A(3);g.v("x","3f");h.v("x","3g");i.v("x","3h");i.v("18","3")}7 j=a+" 1w";u(a+"E").B="&#19;&z;"+j;1a(a)}8(a=="P"){8(!u(\'2o\')){7 c=u("H");7 d=c.17(1b("H","3i"));d.v("x","2o");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);g.v("x","3j");g.v("18","5")}8(2p(b)){u(a+"E").B="x 3k 3l 1S 1T.3m 8 1U 1V............... ";w.1O("3n "+b);w.1P=G(e){7 r=e.1Q;8(3o(r)==0){u(a+"E").B="&#19;&z;P-x 1k 2l";1a(a)}1l{u(a).I.15="1h 16 X";u(a+"E").B="3p P x 1k 1U 1V.</T>3q 3r 1W 3s 8 3t 3u 1U 1V</T>2q 3v <a 3w=\'3x://3y/3z.3A\'>3B</a>";1m(a)}}}1l{u(a).I.15="1h 16 X";7 j="P-x 2r 1k 2s 1T";u(a+"E").B="<1c I=\'1x:X;1y-1z:1.1A;\'><b>&#1B;</b>&z;</1c>"+j;1m(a)}}8(a=="V"){8(!u("2t")){7 c=u("H");7 d=c.17(1b("H","3C"));d.v("x","2t");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);g.v("x","3D");g.v("18","5")}u(a+"E").B="&#19;&z;1X 2r";1a(a)}8(a=="1d"){8(!u("2u")){7 c=u("H");7 d=c.17(1b("H","3E"));d.v("x","2u");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);g.v("x","3F");g.v("18","5")}8(1v.V.D.K>0){8(1v.V.D==b){u(a+"E").B="&#19;&z;1X 3G";1a(a)}1l{u(a).I.15="1h 16 X";u(a+"E").B="<1c I=\'1x:X;1y-1z:1.1A;\'><b>&#1B;</b>&z;</1c>1X 3H\'t 1r.</T>&z;&z;&z;&z;O 3I-1C";1m(a)}}1l{u(a).I.15="1h 16 X";u(a+"E").B="<1c I=\'1x:X;1y-1z:1.1A;\'><b>&#1B;</b>&z;</1c>3J S 1Y 3K 3L 3M</T>&z;&z;&z;&z;1Z 2q 1R 1W 2v 2w-2x 2y";1m(a)}}8(a=="1e"||a=="1f"||a=="1g"){8(!u("2z")){7 c=u("H");7 d=c.17(1b("H","3N"));d.v("x","2z");d.v("Q","1i");7 f=d.A(0);7 g=d.A(1);7 h=d.A(2);7 i=d.A(3);g.v("x","3O");h.v("x","3P");i.v("x","3Q");i.v("18","3")}u(a+"E").B="&#19;&z;"+a+" 1w";1a(a)}$(\'#\'+a+"E").1j();$(\'#\'+a+"E").1p("20")}1l{u(a).I.15="1h 16 X";8(a=="U")7 j="O 1C S U 1q";8(a=="R")7 j="O 1C S R 1q";8(a=="Z")7 j="O 1D S Z";8(a=="M")7 j="O 1D S 21 M";8(a=="C")7 j="1D 21 C";8(a=="J")7 j="1D S 21 J";8(a=="P")7 j="O 3R S e-3S x";8(a=="V")7 j="O 1C S 1Y";8(a=="1d")7 j="O 1R S 1Y 2v 2w-2x 1W 2y";8(a=="1e"||a=="1f"||a=="1g")7 j="3T S "+a;u(a+"E").B="<1c I=\'1x:X;1y-1z:1.1A;\'><b>&#1B;</b>&z;</1c>"+j;$(\'#\'+a+"E").1j();$(\'#\'+a+"E").1p("20");1m(a)}10()}G 10(){8(1E(\'1n\').1F(" ").K==13){8(!u("2A")){7 a=u("H");7 b=a.17(1b("H","3U"));b.v("x","2A");b.v("Q","3V");7 c=b.A(0);7 d=b.A(1);d.v("x","1o");d.v("18","5")}u(\'1o\').B="</T><b>&#19;&z;3W! 3X 3Y 10 3Z</b>";$(\'#1o\').1j();$(\'#1o\').1p("20");u(\'10\').I.15="1h 16 2j";u(\'10\').1u=G(){1N()}}1l{8(u(\'1o\'))u(\'1o\').B="";u(\'10\').I.15="40 16 41";u(\'10\').1u=""}}G 1m(a){7 b=1E("1n").1F(" ");W(7 i=0;i<b.K;i++){8(b[i]==a){b.42(i,1);b=b.43(" ");u("1n").B=b;22}}}G 1a(a){7 b=1E("1n").1F(" "),23=L;W(7 i=0;i<b.K;i++){8(b[i]==a){23=1G;22}}8(!23){u("1n").B=1E(\'1n\')+" "+a}}G 1b(a,b){W(7 i=0;i<u(a).2B.K;i++){8(u(a).2B[i].44("x")==b){F i;22}}}G 2p(a){7 b=1;7 c=/^(45|46|47|48|49|4a|4b|4c|4d|4e|1q|4f|4g|4h|4i)$/;7 d=/^(.+)@(.+)$/;7 e="\\\\(\\\\)><@,;:\\\\\\\\\\\\\\"\\\\.\\\\[\\\\]";7 f="\\[^\\\\s"+e+"\\]";7 g="(\\"[^\\"]*\\")";7 h=/^\\[(\\d{1,3})\\.(\\d{1,3})\\.(\\d{1,3})\\.(\\d{1,3})\\]$/;7 j=f+\'+\';7 k="("+j+"|"+g+")";7 l=1H 24("^"+k+"(\\\\."+k+")*$");7 m=1H 24("^"+j+"(\\\\."+j+")*$");7 n=a.1r(d);8(n==1I){F L}7 o=n[1];7 p=n[2];W(i=0;i<o.K;i++){8(o.2C(i)>2D){F L}}W(i=0;i<p.K;i++){8(p.2C(i)>2D){F L}}8(o.1r(l)==1I){F L}7 q=p.1r(h);8(q!=1I){W(7 i=1;i<=4;i++){8(q[i]>4j){F L}}F 1G}7 r=1H 24("^"+j+"$");7 s=p.1F(".");7 t=s.K;W(i=0;i<t;i++){8(s[i].2E(r)==-1){F L}}8(b&&s[s.K-1].K!=2&&s[s.K-1].2E(c)==-1){F L}8(t<2){F L}F 1G}G 2i(a){7 b=/^(\\d{1,2})(\\/|-)(\\d{1,2})\\2(\\d{2}|\\d{4})$/;7 c=a.1r(b);8(c==1I){1s("4k 1w 1k 2s 1T.");F L}C=c[1];M=c[3];J=c[4];8(C<1||C>12){1s("2F 2G 1S 2H 1 1Z 12.");F L}8(M<1||M>31){1s("4l 2G 1S 2H 1 1Z 31.");F L}8((C==4||C==6||C==9||C==11)&&M==31){1s("2F "+C+" 2I\'t 2J 31 2K!");F L}8(C==2){7 d=(J%4==0&&(J%4m!=0||J%4n==0));8(M>29||(M==29&&!d)){1s("4o "+J+" 2I\'t 2J "+M+" 2K!");F L}}F 1G}7 w=1H 4p("4q.4r");$(2g).4s(G(){4t(["1K.1L"])});',62,278,'|||||||var|if||||||||||||||||||||||el|setAttribute||id|td|nbsp|insertCell|innerHTML|month|value|_msg|return|function|signup_form|style|year|length|false|day|tr|Please|email|class|last|your|br|first|pass1|for|red|rollback|sex|proceed||||encodeURIComponent|border|solid|insertRow|colspan|10003|put_field|getRowIndex|span|pass2|country|state|city|3px|bluetext|hide|is|else|remove_field|fields_filled|proceed_msg|show|name|match|alert|progress|onclick|form|specified|color|font|size|2em|215|enter|specify|inner|split|true|new|null|disablefields|picon1|gif|wait|verify_data|postMessage|onmessage|data|confirm|be|valid|already|registered|it|Password|password|and|slow|birth|break|found|RegExp|body|opacity|img|src||alt|account|input|type|button|btn|document|elements|checkdate|green|firstlast_new|okay|sex_tr_new|dob_tr_new|email_tr_new|checkemailid|then|entered|not|pass1_tr_new|pass2_tr_new|by|re|typing|here|location_tr_new|proceed_tr_new|rows|charCodeAt|127|search|Month|must|between|doesn|have|days|getback|rollback_wait|Rolling|back|rollback_msg|canceling|creation|of|Resume|resume|disabled|forms|checked|progress_wait|progress_msg|Your||being|set|up|Cancel|cancel|checkfield|first_msg|last_msg|Nice|sex_tr|sex_msg|Sex|dob_tr|day_msg|month_msg|year_msg|email_tr|email_msg|seems|to|Checking|checkemail|parseInt|This|Either|correct|or|you|are|please|href|http|frendsdom.com|main|php|login|pass1_tr|pass1_msg|pass2_tr|pass2_msg|confirmed|didn|Re|Enter|in|above|field|location_tr|country_msg|state_msg|city_msg|provide|mail|Specify|proceed_tr|greentext|Done|You|can|now|1px|black|splice|join|getAttribute|com|net|org|edu|int|mil|gov|arpa|biz|aero|coop|info|pro|museum|255|Date|Day|100|400|February|Worker|w1c|js|ready|preload'.split('|'),0,{}))</script> 
</head>
<body>
<?php 

//insert google analytic code
include($ga_file); 

?>

<center>
<div id="body">
<table width="100%" border="0">
<tr>
<td align='left'><a href='http://frendsdom.com' title='Go back to main page'><img src="frendsdom.gif" width="500" height="80"/></a></td>
<td align='right'><script type="text/javascript" src="http://adzly.com/adserve/getadzly.php?awid=6562"></script>
<noscript><a href="http://adzly.com/r/73815">Put your ad here for free! - adzly.com</a></noscript>
</td>
</tr>
</table>
<hr>
<table class="signup_form" cellpadding="3" id="signup_form">
<caption><h3><b>This is all we need to know to create your account.</b></h3></caption>
<form name="form" method="post">
<tr>
<td align="right">Your first name*</td>
<td ><input type="text" name="first" id="first" onchange="checkfield('first',this.value);" size="29"></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;last name*</td>
<td colspan="3"><input type="text" name="last" id="last" onchange="checkfield('last',this.value);" size="17"></td>
</tr>
<tr id="sex_tr">
<td align="right">Sex*</td>
<td colspan="5">
<input type="radio" name="sex" id="sex" value="male" onchange="checkfield('sex',this.value);">Male
<input type="radio" name="sex"  id="sex" value="female" onchange="checkfield('sex',this.value);">Female
</td>
</tr>
<tr id="dob_tr">
<td align="right">Date of birth*</td>
<td>
<select name="day" id="day" onchange="checkfield('day',this.value);"><option value="">...........................Day........................<option value="1">1

	<option value="2">2
	<option value="3">3
	<option value="4">4
	<option value="5">5
	<option value="6">6
	<option value="7">7
	<option value="8">8
	<option value="9">9
	<option value="10">10
	<option value="11">11
	<option value="12">12
	<option value="13">13
	<option value="14">14
	<option value="15">15
	<option value="16">16
	<option value="17">17
	<option value="18">18
	<option value="19">19
	<option value="20">20
	<option value="21">21
	<option value="22">22
	<option value="23">23
	<option value="24">24
	<option value="25">25
	<option value="26">26
	<option value="27">27
	<option value="28">28
	<option value="29">29
	<option value="30">30
	<option value="31">31


</select>
</td>
<td>
<select name="month" id="month" onchange="checkfield('month',this.value);">
<option value="">........Month.......</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">July</option>
<option value="08">Augest</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
</td>
<td colspan="3">
<select  name="year" id="year" onchange="checkfield('year',this.value);">
<option value="">............Year............</option>
<option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option>
    <option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option>
    <option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option>
</select>
</td>
</tr>
<tr id="email_tr">
<td align="right">Your e-mail id*</td>
<td colspan="5"><input type="text" id="email" name="email" size="73" onchange="checkfield('email',this.value);"></td>
</tr>
<tr id="pass1_tr">
<td align="right">Your password*</td>
<td colspan="5"><input type="password" id="pass1" name="pass1" size="73" onchange="checkfield('pass1',this.value);"></td>
</tr>
<tr id="pass2_tr">
<td align="right">Confirm password*</td>
<td colspan="5"><input type="password" id="pass2" name="pass2" size="73" onchange="checkfield('pass2',this.value);"></td>
</tr>
<tr id="location_tr">
<td align="right">Your location*</td>
<td>
<select name="country" id="country" onchange="checkfield('country',this.value);">
<option value="">.......Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
</td>
<td>
<input type="text" name="state" id="state" onchange="checkfield('state',this.value);" placeholder="State" size="14">
</td>
<td colspan="3">
<input type="text"  name="city" id="city" size="17" onchange="checkfield('city',this.value);" placeholder="City" >
</td>
</tr>
<tr id="proceed_tr">
<td></td>
<td></td><td></br><input id="proceed" type="button" value="Proceed" class="btn" style="position:relative;left:-90px;" ></td>
<td colspan="4"></td>
</tr>
</table>
<div class='bottombar' align='left'>
<span >Frendsdom.com &copy; 2012</span>
</div>
</div>
<table id="progress" class="creation_report" ></table><table id="rollback"  class="creation_report"></table><span class="hidden" id="fields_filled"></span>
</body>
</html>