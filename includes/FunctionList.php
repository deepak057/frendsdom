<?php

//start session
@session_start();

//report no error
error_reporting(0);

//file containing constants
require('constants.php');

//file containing global variables
require('global_vars.php');

//ADO DB library
require('adodb5/adodb.inc.php');

//function for creating user_data directory ,if not already exists

function CreateUserDir()
{
if(!file_exists('user_data'))   
{
if(!mkdir('user_data'))
die("failed");
}
}

//function for handling warnings and fatal errors

function errorHandler($type,$msg,$file,$line,$context)        
{
$message='<p>Seems that something went wrong.<p><a href="'.SITE_URL.'"/home.php">You can try again</a> ';
if(($type==E_WARNING) ||($type== E_ERROR))
{
die($message);
}
}

//function for appropriate database entry

function entryfordatabase($string)         
{
$single=0;
$double=0;
$usernamefordatabase=null;
for($i=0;$i<strlen($string);$i++)
{
if($string[$i]=="'")
{
$single++;
}
else if($string[$i]=='"')
{
$double++;
}
}
if($single>=1)
{
$usernamefordatabase='"'.$string.'"';
return $usernamefordatabase;
}
else if($double>=1)
{
$usernamefordatabase="'".$string."'";
return $usernamefordatabase;
}
else
{
return "'".$string."'";
}
}

//function to delete junk entries from database

function DeleteJunk()
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="delete from userdata where password=''";
if($mysqli->query($sql)===true)
{
}
$mysqli->close();
}

//function to determine whether specified file is an image or not

function Isappropriate($path)
{
if(empty($path))
{
}
if(file_exists($path))
{
if(!is_file($path))
echo ("It is not an image file");
}
else
echo ("The file specified doesn't exists");

$path=explode('.',$path);
if($path[1]=="gif"||$path[1]=="jpg")
{
return("yes");
}
}

//function for removing directories along with its all children and contents

function removeDir($dir) {
if (file_exists($dir)) {

$dp = opendir($dir) or die ('ERROR: Cannot open directory');
while ($file = readdir($dp)) {
if ($file != '.' && $file != '..') {
if (is_file("$dir/$file")) {
unlink("$dir/$file");
} else if (is_dir("$dir/$file")) {
removeDir("$dir/$file");
}
}
}
closedir($dp);
if (rmdir($dir)) {
return true;
} else {
return false;
}
}
}
if (file_exists('mydir')) {
if (removeDir('mydir')) {
echo '';
} else {
echo 'ERROR: New account could not be created.';
}
} 

function totalfiles($dir)
{
$total=0;
$dit = new DirectoryIterator($dir);
while($dit->valid()) {
if (!$dit->isDot()) 
{
$total++;
}
$dit->next();
}
return($total);
}

//class definetion for encryption and decryption

class Jumbler 
{
public $key;
public function setKey($key) 
{
$this->key = $key;
}
public function getKey() 
{
return $this->key;
}
public function encrypt($plain) 
{
for ($x=0; $x<strlen($plain); $x++) 
{
$cipher[] = ord($plain[$x]) + $this->getKey() + ($x * $this->getKey());
}
return implode('/', $cipher);
}

public function decrypt($cipher) 
{
$data = explode('/', $cipher);
$plain = '';
for ($x=0; $x<count($data); $x++) {
$plain .= chr($data[$x] - $this->getKey() - ($x * $this->getKey()));
}
return $plain;
}
}

//function to split string into specified number of lines

function split_into_lines($str,$length)
{
if($length<strlen($str))
{
for($i=0;$i<strlen($str);$i++)
{
$newstr[$i]=$str[$i];
if($i==$length)
{
$newstr[$i]=$newstr[$i]."\n";
}
else if($i>$length)
{
if($i%$length==0)
$newstr[$i]=$newstr[$i]."\n";
}
}
return implode("",$newstr);
}

else return $str;
}


//function for retreiving user name for a specified user id

function user_name($id)
{
if(!empty($id))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("Error :could not connect ".mysqli_connect_error());
}
$sql="select first,last from userdata where id={$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
if(!empty($row['first'])&&!empty($row['last']))
return tunethename($row['first']." ".$row['last']);
else
return null;
}
}
else echo "Failed ";
}
}
return null;
}

//function for getting user's sex

function user_sex($id)
{
if(!empty($id))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from userdata where id={$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row['sex']))
return $row['sex'];
else return null;
}
}
else  echo "Failed";
}
}
else return null;
}

//function for getting user's date of birth

function user_dob($id)
{
if(!empty($id))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from userdata where id={$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if( (!empty($row['day'])) && (!empty($row['month'])) && (!empty($row['day']))  )
{
if($row['month']==1)
$row['month']="Jan";
if($row['month']==2)
$row['month']="Feb";
if($row['month']==3)
$row['month']="Mar";
if($row['month']==4)
$row['month']="Apr";
if($row['month']==5)
$row['month']="May";
if($row['month']==6)
$row['month']="Jun";
if($row['month']==7)
$row['month']="Jul";
if($row['month']==8)
$row['month']="Aug";
if($row['month']==9)
$row['month']="Sep";
if($row['month']==10)
$row['month']="Oct";
if($row['month']==11)
$row['month']="Nov";
if($row['month']==12)
$row['month']="Dec";

return $row['day']." ".$row['month']." ".$row['year'];
}
else return null;
}
}
else echo "Failed";
}
}
else return null;
}


//function for getting user's email id

function user_email($id)
{
if(!empty($id))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select* from userdata where id={$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row['user_id']))
return $row['user_id'];
}
}
else echo "Failed";
}
}
else return null;
}

function user_location($id,$l)
{
if(!empty($id))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select {$l} from userdata where id={$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row[$l]))
return $row[$l];
}
}
else echo "Failed";
}
}
else return null;
}





//function for determining whether profile pic exists or not

function user_pic($id)
{
if(!empty($id))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select picture from userdata where id={$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['picture']=="yes")
return true;
else return false;
}
}
else "Failed";
}
}
else return null;
}

//function for getting an entity's value for specified id

function entity_value($table,$entity,$id,$idvalue,$database=false)
{
if( (!empty($table)) && (!empty($id)) && (!empty($entity)) && (!empty($idvalue)))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select {$entity} from {$table} where {$id}='{$idvalue}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row[$entity]))
return $row[$entity];
else return null;

}
}
else return null;
}
}
else return null;
}

//function for updating the value of an entity

function update_entity($table,$id,$idvalue,$entity,$value,$database=false)
{
if((!empty($table))  && (!empty($id)) && (!empty($entity)))
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($mysqli===false)
{
die("Could not connect to database");
}
$sql2="update {$table} set {$entity}='{$value}' where {$id}='{$idvalue}'";
if($mysqli->query($sql2)===true)
return true;
else return false;
}
else return null;
}

//function for retreiving array of entries for a specified entity

function return_array($table,$entity,$id=null,$idvalue=null)
{
if( (!empty($table)) && (!empty($entity)))
{

$list=array();
$i=0;

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if(!empty($id) && !empty($idvalue))
{
$sql="select {$entity} from {$table} where {$id}='{$idvalue}'";
}
else
{
$sql="select {$entity} from {$table}";
}
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$list[$i]=$row[$entity];
$i++;
}
}
}



}
 return $list;
}

function return_array_tweaked($database,$table,$entity,$id=null,$idvalue=null)
{
if( (!empty($table)) && (!empty($entity)))
{

$list=array();
$i=0;

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$database);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
if(!empty($id) && !empty($idvalue))
{
$sql="select {$entity} from {$table} where {$id}='{$idvalue}'";
}
else
{
$sql="select {$entity} from {$table}";
}
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$list[$i]=$row[$entity];
$i++;
}
}
}

return $list;

}
else return null;
}


//function to determine whether specified value exists or not

function if_exists($table,$id,$idvalue,$database=false)
{
if((!empty($table)) && (!empty($idvalue)) && (!empty($id)))
{
$found=0;
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select {$id} from {$table} where {$id}='{$idvalue}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
$found++;
}
}
}
if($found>0)return true;
else return false;
}
else return null;
}


//function for determining whether an user is already there in one's lists

function if_alreadyexists($id,$userid)
{

if((!empty($id)) && (!empty($userid)))
{

$found=0;

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select listid from user{$id}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['listid']==$userid)
{
$found++;
break;
}
}
}
}
if($found>0)
return true;
else return false;
}
else return null;
}

//function for getting path of user's profile pic

function prof_pic($id,$type="small")
{

//get user's directory
$userdir=get_user_dir($id,true);

//first check user's directory and create one if doesn't already exists
if(!file_exists($userdir))                
{
mkdir($userdir);
}

$imagepathnew=SITE_URL."/user_data/".$id."/".$id."_image.gif";
$imagepathnew1=SITE_URL."/user_data/".$id."/".$id."_image.jpeg";
if(file_exists("{$userdir}/{$id}_image.gif"))
$realimagepath=$imagepathnew;
if(file_exists("{$userdir}/{$id}_image.jpeg"))
$realimagepath=$imagepathnew1;
if(!empty($realimagepath))
{
if($type!="small" && @fopen(str_replace("image","original",$realimagepath), "r"))
{
return str_replace("image","original",$realimagepath);
}
else
{
return $realimagepath;
}
}

else return SITE_URL."/nopic.png";
}

//function for checking whether the user-password combination is valid

function is_login_valid($id,$pass,$createCookies=false)
{

if((!empty($id)) && (!empty($id)))
{

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select user_id from userdata where user_id='{$id}' && password='{$pass}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{

if(entity_value("userdata","account_status","user_id",$id)!="open")
{
header("location:restore_account.php?id={$id}");exit;
}

/*if(entity_value("userdata","email_verified","user_id",$id)!=1)
{
header("location:verify_email.php?id={$id}");exit;
}
*/
if(update_entity("userdata","user_id",$id,"last_login",date('Y-m-d H:i:s')) && update_entity("userdata","user_id",$id,"last_login_ip",getRealIp()))
{
$_SESSION['userid']=entity_value("userdata","id","user_id",$id);$_SESSION["username"]=$id;$_SESSION['userfulname']=user_name($_SESSION['userid']);$_SESSION["userkey"]=$pass;$_SESSION["home"]="home";
if($createCookies)
{
$j = new Jumbler;$key="38475757"; $j->setKey($key);setcookie('usn',$j->encrypt($_SESSION['username']),mktime() + 664999, '/');setcookie('usk',$j->encrypt($_SESSION['userkey']),mktime() + 664999, '/');
}
prevent_hijacking("userid");
return true;
}
}
else return false;
}

}
else return false;
}

function check_if_exists($table,$id,$idvalue,$database=false)
{
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select * from {$table} where {$id}='{$idvalue}'";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
return true;
break;
}
}else return false;
}
}


//function to determine total entries in specified table for specified entity
function total_entries($table,$entity,$database=false)
{
$connect = mysql_connect($GLOBALS['host'], $GLOBALS['db_user'], $GLOBALS['db_passwd']) or die ("unable to connect");
mysql_select_db(database($database), $connect);
$result = mysql_query("SELECT COUNT(*) FROM {$table} where {$entity}!='' ") or die(mysql_error());
return mysql_result($result, 0);
}

//function to manipulate the user name 
function TuneTheName($n,$length=21){if(strlen($n)>$length){$ex=explode(" ",$n);$name=$ex[0]." ".$ex[str_word_count($n)-1];if(strlen($name)<=$length){return $name;}else{if(strlen($ex[0])>=$length){return substr($ex[0], 0, $length);}else {return $ex[0];}}}else{return $n;}}

//function to check whether a user is already requesting or not
function requesting($table,$id){$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}$sql="select type from $table where requestid='{$id}'";if($result=$mysqli->query($sql)){if($result->num_rows>0){while($row=$result->fetch_array()){if(!empty($row['type'])){return true;}}}else return false;}}

//function to return the number of occurances of a specified value in a specified array 
function findDuplicates($data,$dupval) {
$nb= 0;
foreach($data as $key => $val)
if ($val==$dupval) $nb++;
return $nb;
}


//function to get feedback statistics from a specified table
function get_feedback_statistics($table,$fback_field,$fback_array,$return_type="percent",$database=false)
{
$i=0;
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select {$fback_field},fromid from {$table}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(!empty($row[$fback_field]) && account_status($row['fromid']))
{
$td[$i]=$row[$fback_field];
$i++;
}
}
}
}

if($return_type=="percent")
{
for($j=0;$j<sizeof($fback_array);$j++)
{
echo round((findDuplicates($td,$fback_array[$j])/$i)*100);echo " ";
}
}

else if($return_type=="number")
{
for($j=0;$j<sizeof($fback_array);$j++)
{
echo findDuplicates($td,$fback_array[$j]);echo " ";
}
}
}

function _ago($tm,$rcs = 0) {   $cur_tm = time(); $dif = $cur_tm-$tm;   $pds = array('second','minute','hour','day','week','month','year','decade');   $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);   for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);   $no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);   if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);   return $x;}

//function to determine the time span between the time specified and now
function ago($time){ $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade"); $lengths = array("60","60","24","7","4.35","12","10"); $now = time();     $difference     = $now - $time;     $tense         = "ago"; for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {     $difference /= $lengths[$j]; } $difference = round($difference); if($difference != 1) {     $periods[$j].= "s"; } return "$difference $periods[$j] ago ";}

//function to delete a row from a specified table
function delete_row($table,$id,$idvalue,$database=false){if((!empty($table))  && (!empty($id)) ){$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($mysqli===false){die("Could not connect to database");}$sql2="delete from {$table} where {$id}='{$idvalue}'";if($mysqli->query($sql2)===true)return true;else return false;}else return false;}

//function to get real IP address of client 
function getRealIp(){if (!empty($_SERVER['HTTP_CLIENT_IP'])){$ip=$_SERVER['HTTP_CLIENT_IP'];}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}else{$ip=$_SERVER['REMOTE_ADDR'];}return $ip;}

//function to log the user out
function logout($id){if(update_entity("userdata","id",$id,"last_logout",date('Y-m-d H:i:s')) && update_entity("userdata","id",$id,"last_logout_ip",getRealIp())){remove_allCookies();session_destroy();}}

//function to remove all stored cookies from client's system
//function remove_allCookies(){if (isset($_SERVER['HTTP_COOKIE'])) {$cookies = explode(';', $_SERVER['HTTP_COOKIE']);foreach($cookies as $cookie) {$parts = //explode('=', $cookie);$name = trim($parts[0]);setcookie($name, '', time()-1000);setcookie($name, '', time()-1000, '/');}}}
function remove_allCookies(){setcookie("usk", '', time()-1000, '/');setcookie("usn", '', time()-1000, '/');}

//function to prevent session fixation and session hijacking
function prevent_hijacking($name){if (isset($_SESSION[$name])){  session_regenerate_id();}if (isset($_SESSION['HTTP_USER_AGENT'])){if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])){exit;}}else{ $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);}}

function get_client_browser($browser){if(isset($_SERVER['HTTP_USER_AGENT'])){if(strlen(strstr($_SERVER['HTTP_USER_AGENT'],$browser)) > 0 )return true;else return false;}else return false;}

function check_log_in($file){
if(!get_client_browser("Chrome") && !get_client_browser("Firefox") && !(get_client_browser("Safari")) && !(get_client_browser("Opera") && (get_browser()->version>=10.6)) && !(get_client_browser("IE") && (get_browser()->version>=10)) && !(get_client_browser("iOS Safari") && (get_browser()->version>=5)) && !(get_client_browser("Blackberry Browser") && (get_browser()->version>=7)) && !(get_client_browser("Opera Mobile") && (get_browser()->version>=11)) && !(get_client_browser("Chrome for Android") && (get_browser()->version>=18)) && !(get_client_browser("Firefox for Android") && (get_browser()->version>=14)))
{
echo "<!DOCTYPE html>
<html>
<head>
<title>Browser ".get_browser()->browser." ".get_browser()->version." incompatible with Frendsdom </title><script>function closewindow() {window.open('','_parent','');window.close();}</script></head><body><center><div style='background:grey;padding:10px 30px;width:50%;border:1px solid black;text-align:left;'><h3><img src='alert.gif' height='50' width='50' align='middle'>Incompatible browser</h3>The browser ( ".get_browser()->browser." ".get_browser()->version." ) you are using doesn't seem to be compatible with this website.We're working on cross browser compatibility and soon you'll be able to use it on any browser of your wish.For now, we're sorry for inconvenience but you must switch to any of <a href='http://www.mozilla.org/en-US/firefox/new/' title='Download Mozila firefox'>Mozila firefox</a>, <a href='http://www.opera.com/browser/download/' target='_blank' title='Download Opera web browser'>Opera</a>, <a href='http://www.apple.com/safari/' target='_blank' title='Download safari web browser'>Safari</a>, <a href='https://www.google.com/intl/en/chrome/browser/' title='Download Chrome web browser' target='_blank'>Chrome</a> web browsers to be able to view this website.</br></br><input type='button' onclick='closewindow();' Value='Okay' title='Close this browser tab' style='background:green;cursor:pointer;border:1px solid black;padding:3px;'> </div></center></body></html>";die("");}else{$file = Explode('/', $file);$file = $file[count($file) - 1]; if((empty($_SESSION["username"])) || (empty($_SESSION["userkey"])) || (empty($_SESSION["home"]))){if ((isset($_COOKIE['usn'])) && (isset($_COOKIE['usk']))){$j = new Jumbler;$key="38475757";$j->setKey($key);$userid=$j->decrypt($_COOKIE['usn']);$passwd=$j->decrypt($_COOKIE['usk']);if(is_login_valid($userid,$passwd,true)){header("location:{$file}");}else echo "Error: failed to login";}else{header("location:".SITE_URL."/targetPage.php?target={$file}");}}}}

//function to retreive the list in which the recpient of the news is
function get_list_status($userid,$wrt_lu=true){$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false){die("Error :could not connect ".mysqli_connect_error());}
if($wrt_lu)
{
$sql="select * from user{$_SESSION['userid']}";
}
else
{
$sql="select * from user{$userid}";
$userid=$_SESSION['userid'];
}
if($result=$mysqli->query($sql)){if($result->num_rows>0){while($row=$result->fetch_array()){if(!empty($row['familyid'])){if($row['familyid']==$userid){return "family";break;}}

if(!empty($row['friendid'])){if($row['friendid']==$userid){return "friend";break;}}if(!empty($row['colid'])){if($row['colid']==$userid){return "colleague";break;}}if(!empty($row['aquid'])){if($row['aquid']==$userid){return "aquantaince";break;}}if(!empty($row['noid'])){if($row['noid']==$userid){return "No prior aquaintance";break;}}}}}}


//function to count the occurances of a charcter or string in a string
function count_occurences($char_string, $haystack, $case_sensitive = true){if($case_sensitive === false){$char_string = strtolower($char_string);$haystack = strtolower($haystack);}$characters = str_split($char_string);$character_count = 0;foreach($characters as $character){$character_count = $character_count + substr_count($haystack, $character);}return $character_count;}
//function to return all text in a string up to the Nth occurrence of a character
function nsubstr($needle, $haystack, $n_occurrence){$arr = explode($needle,$haystack,$n_occurrence);$last = count($arr) - 1;$pos_in_last = strpos($arr[$last],$needle);if ($pos_in_last !== false)$arr[$last] = substr($arr[$last],0,$pos_in_last);return implode($needle,$arr);}
function unpriviledged_msg($heading,$text,$name,$img,$center=false){if($center){return "<center><table class='background2' cellspacing='10'><tr><td><h2><img src='alert.gif' align='middle'>{$heading}</h2>{$text}</td><td><img src='{$img}' height='160' width='160' title='{$name}'></td></tr></table></center>";}else {return "<table class='background2' cellspacing='10' style='position:relative;top:-40px;'><tr><td><h2><img src='alert.gif' align='middle'>{$heading}</h2>{$text}</td><td><img src='{$img}' height='160' width='160' title='{$name}'></td></tr></table>";}}

//function to send a message
function send_msg($fromid,$toid,$title,$msg){


/*
*before a message is sent, we check if the message is being sent to a stranger, lets make sure messages can not be sent to more n strangers in x hours
*/

if(!in_array($fromid,$GLOBALS['privileged_ids']))
{

$stranger=false;

//if there are more than one recipients
if(is_array($toid))
{

//if $toid was an array , that means we would have only one stranger
$stranger=reset(array_diff($toid,get_total_rel($fromid,true)));

}

else{

if(is_stranger($fromid,$toid))
{
$stranger=$toid;
}

}


//if a recipient is found to be stranger

if($stranger){

$count=conf_option_value($fromid,"msgs_to_strangers");

if(!$count){
$count=0;
$ts=mktime();
}

else {
$temp=explode(":",$count);
$count=$temp[0];
$ts=$temp[1];

//check if it's been x hours since the message was sent to first stranger and if so, sent count to 0
if(hours_old($ts)>=$GLOBALS['msgs_to_stangers_hours']){
$count=0;
$ts=mktime();
}

}


if(hours_old($ts)<$GLOBALS['msgs_to_stangers_hours'] && $count>=$GLOBALS['max_msgs_to_stangers'])
{

if(is_array($toid)){
$toid=array_values(array_diff($toid,array($stranger)));
if(sizeof($toid)<1)
return false;
}

else{
return false;
}

}

else{

$value=(++$count).":{$ts}";

update_conf_option_value($fromid,"msgs_to_strangers",$value);


}

}
}

/************ finished checking for stranger recpeints************/


$msgentry=addslashes(htmlentities($msg));$titleentry=addslashes(htmlentities($title));$msgid="msg".$fromid.mktime().rand();$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['msg_inbox']);
if($mysqli===false){die("Could not connect to database");}
if($mysqli->query("insert into msgboxofuser{$toid} (from1id,msg,title1,when1,read1,msgid) values ('{$fromid}','{$msgentry}','{$titleentry}','".date('Y-m-d H:i:s')."','no','".$msgid."')")){$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['msg_sentbox']);if($mysqli->query("insert into sentboxofuser{$fromid} (to1id,msg,title1,when1,msgid) values ('{$toid}','{$msgentry}','{$titleentry}','".date('Y-m-d H:i:s')."','".$msgid."')"))
{
require_once(HOME.'/class_lib.php');
$to_user=new user($toid);

if($to_user->get_msg_notification() && $to_user->get_email_verified()==1)
{
$from_user=new user($fromid);

$msg="
<html>
<head>
<title>Untitled Document</title>
</head>
<body>
<div style='text-align:justify;margin:0px auto;text-align:left;'>
<img src='".SITE_URL."/frendsdom.gif'/>
<h1 style='color:#666;'>New Text Message</h1>
<p style='color:#666;font-weight:bold;border-bottom:1px dotted #000;padding-bottom:20px;'>
Hi ".$to_user->get_first().",<br/>
".$from_user->get_name()." has sent you a text message on Frendsdom
</p>
<div style='color:#666;font-weight:bold;border-bottom:1px dotted #000;padding-bottom:20px;'><br/>
<b> {$title}</b><br/>
<b>Sent on:</b> ".date('d/m/y')."<br/>
<div><br/>".stripslashes($msg)."</div>
</div>
<p style='padding-top:20px;font-weight:bold;'>Please do not directly reply to this email. To be able to perform further actions on this text message, please go to your home page: <a href='".SITE_URL."/home.php' style='color:#666;'><b>Here</b></a></p><p><br/><b>To disable further email notification for new messages please go through following steps:
</b></p>
<ol>
<li>Go to Account Preferences page: <a href='".SITE_URL."/update.php' style='color:#666;'><b>Here</b></a></li>
<li>Click on Settings tab</li>
<li>Find 'Notifications' block</li>
<li>Select 'No' in receive messages via e-mail section</li>
</ol>
<p style='border-top:1px dotted #000;margin-top:20px;padding-top:20px;'>
Contact us at : <b style='color:#666;'>admin@frendsdom.com</b>
</p>
</div>
</body>
</html>";




$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";






mail($to_user->get_email(),"New text message from ".$from_user->get_first(),$msg,$headers);
}
return true;
}else return false;}else return false;}

//function to send invitation
function send_invitetion($fromid,$toid,$type,$points=0){$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);if($mysqli===false){die("<p>Error :".mysqli_connect_error());}if($mysqli->query("insert into user{$toid} (requestid) values('{$fromid}')") && $mysqli->query("update user{$toid} set type='{$type}' ,points='{$points}' where requestid='{$fromid}'"))return true;else return false;}

//function to manipulate the display of  news
function print_comment_news($cmnt){if(count_occurences($cmnt,"\n",false)>4 || strlen($cmnt)>160){return nsubstr("\n",split_into_lines(substr($cmnt,0,160),"60"),"4")."<span style='color:#ccc;' class='small'>....rest truncated</span>";}else {return split_into_lines($cmnt,60);}}

function selfURL() {$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; }function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
function keep_track(){if(!isset($_COOKIE['a_v'])){
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['visitors_record_db']);
if($mysqli===false){die("<p>Error :".mysqli_connect_error());}if(!isset($_SERVER['HTTP_REFERER']))$_SERVER['HTTP_REFERER']='';if($result=$mysqli->query("insert into visitors_table (visitor_ip,visitor_browser,visiting_time,visitor_refferer,visitor_page) values ('".getRealIp()."','".get_browser()->browser." ".get_browser()->version."','".date('Y-m-d H:i:s')."','{$_SERVER['HTTP_REFERER']}','".selfURL()."')")){setcookie("a_v",true, time()+60*60*24*6004, "/");return true;}}}

function send_verification_mail($to,$data)
{

$msg="<html>
<head>
<title>Untitled Document</title>
</head>
<body>
<div style='text-align:justify;margin:0px auto;text-align:left;'>
<img src='".SITE_URL."/frendsdom.gif'/>
<br/>
<h1 style='color:#666;'>Welcome to Frendsdom</h1>
<p>
Hi there, you are just one step away from becoming a part of our emerging network.
Below is the link to verify your e-mail address.If clicking it doesn't work, please copy and paste it into your browser's address bar.
</p>
<p><br/>
 Here's your link : <a style='color:#069;' href='".SITE_URL."/verify_email.php?{$data}'><b>".SITE_URL."/verify_email.php?{$data}</b></a>
</p>
<p><br/>
Thank you for being a part of our network!
</p>
<div style='margin-top:50px;text-align:center;border-top:1px dotted #d2d2d2;padding-top:10px'>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;".current_year()." &copy; Frendsdom.com</p>
</div>
</div>
</body>
</html>";
$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if (mail($to, "Welcome to Frendsdom-Please Verify your email address!", $msg,$headers)) {
return true;
}
else return false;
}   

function auto_link_text($text){$pattern = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';$callback = create_function('$matches', '$url= array_shift($matches);$url_parts = parse_url($url);$text = parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH);$text = preg_replace("/^www./", "", $text);$last = -(strlen(strrchr($text, "/"))) + 1;

if(strpos($url,"https://")!==false)$url=str_replace("https//","https://",$url);

else if(strpos($url,"http://")===false)$url="http://{$url}";if ($last < 0) {$text = substr($text, 0, $last) . "&hellip;";}return sprintf(\'<a target="_blank" href="%s"><b>%s</b></a>\', $url, $text);   ');   return preg_replace_callback($pattern, $callback, $text);}

//function to set user's profile picture
function set_prof_pic($type,$size,$name,$data,$is_upload=false){$filedir = "user_data/{$_SESSION['userid']}/";delete_all_images($filedir);$thumbdir = "user_data/{$_SESSION['userid']}/"; 
if(strpos($type,"jpg")!==false || strpos($type,"jpeg")!==false){$ext='jpeg';}else if(strpos($type,"gif")!==false)$ext='gif';else {$ext='png';}$maxfile = '2000000';
$mode = '0666';if(isset($name)) 
{
$prod_img = "{$filedir}{$_SESSION['userid']}_original.{$ext}";

$prod_img_thumb = "{$thumbdir}{$_SESSION['userid']}_image.{$ext}";if($is_upload){move_uploaded_file($data,$prod_img);}else {if(!fwrite(fopen($prod_img, 'w'), $data))die("Error :failed to create new file");}$sizes = getimagesize($prod_img);

$aspect_ratio = $sizes[1]/$sizes[0];
if ($sizes[1] <= $size){
$new_width=$sizes[0];
$new_height = $sizes[1];
}else{$new_height = $size;
$new_width = abs($new_height/$aspect_ratio);
}}

$destimg=ImageCreateTrueColor($new_width,$new_height)or die('Problem In Creating image');

if(strpos($type,"jpg")!==false || strpos($type,"jpeg")!==false){$srcimg=ImageCreateFromJPEG($prod_img)
	or die('Problem In opening Source Image');
}else if(strpos($type,"gif")!==false) {$srcimg=ImageCreateFromGIF($prod_img)
or die('Problem In opening Source Image');
	}else {$srcimg=ImageCreateFromPNG($prod_img)
	or die('Problem In opening Source Image');
}if(function_exists('imagecopyresampled'))
{
imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
or die('Problem In resizing');
}else{
Imagecopyresized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
or die('Problem In resizing');
}
	if(strpos($type,"jpg")!==false || strpos($type,"jpeg")!==false){ImageJPEG($destimg,$prod_img_thumb,90)
	or die('Problem In saving');}else if(strpos($type,"gif")!==false) {ImageGIF($destimg,$prod_img_thumb,90)
	or die('Problem In saving');}else {ImagePNG($destimg,$prod_img_thumb,90)
	or die('Problem In saving');}imagedestroy($destimg);
clearBrowserCache();
return true;}

function email_news($to,$news){
include('class_lib.php');
$u=new user($_SESSION['userid']);
$lu=new user($to);

if($lu->get_e_mail_notification() && $lu->get_email_verified()==1){

if($u->get_sex()=="female"){$h="her";$hh='she';}else {$h='his';$hh='he';}

switch($news){
case "atr_granted":
$t=$u->get_name()." has granted you the authority to change appearance of {$h} profile";
break;
case "atr_rejected":
$t=$u->get_name()." has rejected your authority request";
break;
case "pac":
$t=$u->get_name()." has changed appearance of your profile";
break;
case "atr_revoked":
$t=$u->get_name()." has revoked your authority to change appearance of {$h} profile";
break;
case "invitetion_accepted":
$t=$u->get_name()." has accepted your invitation.".ucwords($hh)." is now in your ".get_list_status($to)." list";
break;
case "invitetion_rejected":
$t=$u->get_name()." has rejected your invitation.";
break;
case "fback2profile":
$t=$u->get_name()." has given {$h} feedback to your profile.";
break;
case "check_in":
$t=$u->get_name()." has viewed your sharebox";
break;
case "commentOnProfile":
$t=$u->get_name()." has made a comment on your profile";
break;
case "commentOnpic":
$t=$u->get_name()." has made a comment on one of your collection pictures";
break;
case "nudge":
$t=$u->get_name()." has nudged you";
break;
case "fback2post":
$t=$u->get_name()." has given {$h} feedback to one of your posts";
break;
case "commentOnPost":
$t=$u->get_name()." has made a comment on one of your posts";
break;
}

//formatting email message
$msg="<html>
<head>
<title>Untitled Document</title>
</head>
<body>
<div style='text-align:justify;margin:0px auto;text-align:left;'>
<img src='".SITE_URL."/frendsdom.gif'/>
<h1 style='color:#666;'>News</h1>
<p style='color:#666;font-weight:bold;border-bottom:1px dotted #000;padding-bottom:20px;'>
Hi ".$lu->get_first().",<br/>{$t}
</p>
<p><br/>
To see full news please go to your home page: <a href='".SITE_URL."/home.php'><b style='color:#666;'>Here</b></a>
</p>
<p><br/><b>To disable further email notification please go through following steps:</b></p>
<ol>
<li>Go to Account Preferences page: <a href='".SITE_URL."/update.php' style='color:#666;'><b>Here</b></a></li>
<li>Click on Settings tab</li>
<li>Find 'Notification' block</li>
<li>Select 'No' in receive news via e-mail section</li>
</ol>
<div style='margin-top:50px;text-align:center;border-top:1px dotted #d2d2d2;padding-top:10px'>
<p>Visit <a href='http://blog.frendsdom.com'>Our Blog</a>&nbsp;|&nbsp;Feel free to contact us at: admin@frendsdom.com&nbsp;|&nbsp;".current_year()."&copy; Frendsdom.com</p>
</div>
</div>
</body>
</html>";
$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($lu->get_email(),"News",$msg,$headers);

return true;

}

}

function is_browser_compatible()
{
if(!get_client_browser("Firefox") && !(get_client_browser("Chrome")) && !(get_client_browser("Opera") && (get_browser()->version>=10.6)) && !(get_client_browser("Safari") && (get_browser()->version>=4)) && !(get_client_browser("IE") && (get_browser()->version>=10)))
{
return false ;
}
else 
{
return true;
}
}



function pop_up_msg($id){
if(!is_browser_compatible() && entity_value("userdata","pop_up","id",$id)){
?>
<script>
if(!file_exists("handle_pop_up.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "handle_pop_up.js");document.getElementsByTagName("head")[0].appendChild(script);}else {show_pop_up();}
</script>;
<?php
}
}

//function to handle introduction phase
function first_login_greeting($first,$page="home"){if($first){
if($page=="home")
update_entity("userdata","id",$_SESSION['userid'],"intro_enabled","NULL");
else 
update_entity("userdata","id",$_SESSION['userid'],"intro_enabled_visit","NULL");


if($page=="home"){
?>
<script>if(!file_exists("intro_script.js","js")){var script=document.createElement('script');script.setAttribute("type","text/javascript");script.setAttribute("src", "intro_script.js");document.getElementsByTagName("head")[0].appendChild(script);}</script>
<ol id="joyRideTipContent">
      <li data-id="main_view_vc" data-text="Next" class="custom left">
        <h3>Switch between views</h3>
        <p>Use the buttons above to switch between views</p>
      </li>
<li data-id="panel" data-text="Next" data-options="tipLocation:left;tipAnimation:fade" class="custom left">
        <h3>Sliding Panel</h3>
        <p>This panel shows you a list of random people from all around the world. You can select any of them and visit their profile to find out more.</p>
      </li>
      <li data-class="points_count" data-button="Next" data-options="tipLocation:top;tipAnimation:fade" class="left">
        <h3>Points Counter</h3>
        <p>Shows total sum of points you have. Click here to find people of your interest</p>
      </li>      

      <li data-id="pop-section-network" data-button="Next" data-options="tipLocation:right;tipAnimation:fade" class="left">
        <h3>Your Network</h3>
        <p>See people in your network. Check out who is online and start chatting</p>
      </li>

      <li data-id="pop-section-notification" data-button="Next" data-options="tipLocation:right;tipAnimation:fade" class="left">
        <h3>Notifications</h3>
        <p>Click to see notifications, new messages, invitations etc.</p>
      </li>

<li data-id="pop_section_others" data-options="tipLocation:right;tipAnimation:fade" class="left">
        <h3>Others</h3>
        <p>Click to find out other useful links. Discover people, invite friends and lot more.</p>
      </li>
      

  </ol>

<?php
}
else{

?>

<ol id="joyRideTipContent">

<li data-text="Next" class="left" postStepCallback="my_ffff">
<h3>Welcome to your profile</h3>
<p>This is your profile. Your profile page is lot more than just information about you...</p>
</li>

<li data-text="Next" class="left">
<h3>Customize the appearance</h3>
<p>You have full control over the appearance of your profile. You can personalize it and impress others with your creativity...</p>
</li>

<li data-id="getcolorlist4back1" data-text="Next" data-options="tipLocation:right;tipAnimation:fade" class="left">
        <h3>Change the background</h3>
        <p>Click this triangular button to view the list of colors, then choose a color to apply to your profile...</p>
      </li>

<li data-text="Next" class="left">
        <h3>Profile Appearance <b>&#916;</b> symbol</h3>
        <p>Not happy with how your profile looks? Continue with this tour by clicking Next and we’ll show you more!....</p>
      </li>


<li data-text="Next" class="left">
        <h3>Look for this <b>&#916;</b> symbol</h3>
        <p>You will find this triangle at various places on your profile page. Click the triangle symbol to change the color of the corresponding component....</p>
      </li>


<li data-text="Next" class="left">
        <h3>Look for this <b>&#916;</b> symbol</h3>
        <p>So, look for more of these <b>&#916;</b> symbols after you're done with this this tour and customize your profile to make it look the way you want.</p>
      </li>


<li data-id="action_menu" data-text="Next" data-options="tipLocation:right;tipAnimation:fade" class="left">
        <h3>Control your profile and account settings</h3>
        <p>Hover your cursor over this icon to see the menu of other actions you can take.</p>
      </li>

<li data-text="Next" class="left">
        <h3>Switch Between Slides</h3>
        <p>Your profile contains several slides. You can customize them under the “Basic Info” slide.</p>
      </li>


<li data-text="Done" class="left">
        <h3>Your Share Box</h3>
        <p>Don’t forget to populate your Share Box to update others about yourself. Keep it cool and have fun!</p>
      </li>


</ol>
<script>function my_ffff(){alert("ggg");}
$(document).ready(function(){$("#joyRideTipContent").joyride();});
</script>

<?php

}

?>
<link type="text/css" rel="stylesheet" media="all" href="joy-ride/joyride-2.0.2.css" />
<script type="text/javascript" src="joy-ride/jquery.joyride-2.0.2.js"></script><script src="point_point/transform.js"></script><script src="point_point/point_point.js"></script>
<?php }



}

//function to get type of a file

function get_file_type($file_name,$type="extension")
{
$file_extension = strtolower(substr(strrchr($file_name,"."),1));
if($type=="extension")
{
return $file_extension;
}
else
{
switch($file_extension) {
case "exe": $ctype="application/octet-stream"; break;
case "zip": $ctype="application/zip"; break;
case "mp3": $ctype="audio/mpeg"; break;
case "mpg":$ctype="video/mpeg"; break;
case "avi": $ctype="video/x-msvideo"; break;
case "jpg": $ctype="image/jpeg"; break;
case "jpeg": $ctype="image/jpeg"; break;
case "gif": $ctype="image/gif"; break;
case "png": $ctype="image/png"; break;
default:
$ctype="image/jpeg"; break;
}
return $ctype;
}
}

function isImage( $url )
  {
    $pos = strrpos( $url, ".");
        if ($pos === false)
          return false;
        $ext = strtolower(trim(substr( $url, $pos)));
        $imgExts = array(".gif", ".jpg", ".jpeg", ".png");
        if ( in_array($ext, $imgExts) )
          return true;
    return false;
  }

function remote_file_content_type($url)
{
	ob_start();
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
 
	$ok = curl_exec($ch);
	curl_close($ch);
	$head = ob_get_contents();
	@ob_end_clean();
 
	
	$regex = '/Content-Length:\s([0-9].+?)\s/';
	$count = preg_match($regex, $head, $matches);
 
	$remote_filesize = isset($matches[1]) ? $matches[1] : "";
 
	$regex = '/Content-Type:\s([a-z].+?)\s/';
	$count = preg_match($regex, $head, $matches);
 
	$remote_file_content_type = isset($matches[1]) ? $matches[1] : "";
 
	
	return $remote_file_content_type;

}


//function to delete all image files in a given directory
function delete_all_images($directory)
{

$imagePattern = "/\.(jpg|jpeg|png|gif|bmp|tiff)$/";
if (($handle = opendir($directory)) != false) {
    while (($file = readdir($handle)) != false) {
        $filename = "$directory/$file";
        if (preg_match($imagePattern, $filename)) {
            unlink($filename);
        }
    }

    closedir($handle);
}

}

//function to clear a browser's cache
function clearBrowserCache() {
    header("Pragma: no-cache");
    header("Cache: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    
}

//function to return the path of an eye-candy picture
function get_ecp($id)
{
$pic_id=entity_value("eyecandy_pics_of_user{$id}","pic_id","is_set",1,$GLOBALS['eyecandy_db']);
if(!$pic_id)
{
return "nopic.png";
}
else
{
return "get_ecp.php?pic_id={$pic_id}&size=big";
}
}

//function to check if a remote file being pointed to by an URL exists
function remoteFileExists($url) {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    //do request
    $result = curl_exec($curl);

    $ret = false;

    //if request did not fail
    if ($result !== false) {
        //if request was ok, check response code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  

        if ($statusCode == 200) {
            $ret = true;   
        }
    }

    curl_close($curl);

    return $ret;
}

function is_online($id)
{
if(round(abs(time()-strtotime(entity_value("userdata","last_active","id",$id)))/60)>=2)
{
return false;
}
else
{
return true;
}
}

function user_last_online($id)
{
$l=entity_value("userdata","last_active","id",$id);
if(!strtotime($l))
{
return entity_value("userdata","created","id",$id);
}
else
{
return $l;
}
}

//function to check the status of user's account
function account_status($id)
{
if(entity_value("userdata","account_status","id",$id)=="open")
return true;
else
return false;
}

//function to check if email given is already registered
function validemail($email){$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="select user_id from userdata where user_id='{$email}'";if($result=$mysqli->query($sql)){if($result->num_rows>0){while($row=$result->fetch_array()){if(!empty($row['user_id'])){return false;}}}else return true;}}

//method to determine total deleted/closed accounts in specified table for specified entity
function deleted_accounts($table,$entity,$database=false,$filter_unique=false)
{
$connect = mysql_connect($GLOBALS['host'], $GLOBALS['db_user'],$GLOBALS['db_passwd']) or die ("unable to connect");
mysql_select_db(database($database), $connect);

$result = mysql_query("SELECT {$entity} FROM {$table} where {$entity}!='' ") or die(mysql_error());
$i=0;$arr=array();
while($row=mysql_fetch_array($result))
{
if(!account_status($row[$entity])){
$arr[$i]=$row[$entity];$i++;}
}

if(!$filter_unique)
return sizeof($arr);
else
return sizeof(array_unique($arr));
}


/*

get array of all the categories that given user has subscribed to

*/

function user_cats($uid=false){

$cats=entity_value("userdata","subscribed_cats","id",uid($uid));

if(!empty($cats)){

return explode(",",$cats);

}

else return array();

}


/*
*function to return Posts for given array of category ids
*
*/

function get_posts_by_cat_ids($cat_ids){

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['cats_post_records_db']);

//form query
$query="select * from cats_post_records where ".SQL_not_in($cat_ids,'cat_id',false);

if($result=$mysqli->query($query))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

$return[]=array(

"post_id"=>$row['post_id'],
"from_id"=>$row['from_id'],
"date"=>$row['date']


);

}
}
}

return $return;

}


/*
*
*function to return array containing all the post ids that belong to categories 
*subscribed by given user
*
*/

function user_subscribed_posts($uid=false){

//get subscribed ids by given user
$cat_ids=user_cats($uid);

if(count($cat_ids)){

return get_posts_by_cat_ids($cat_ids);

}

else {

return array();

}

}


/*
* function to delete all the posts belonging to given categories 
*from given user's status view
*/

function remove_posts_by_cats($cat_ids,$uid=false){

//get posts
$posts=get_posts_by_cat_ids($cat_ids);

if(count($posts)){

foreach($posts as $post){

$posts_[]="'".$post['post_id']."'";

}

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

//delete records
$mysqli->query("delete from status_view_of_user".uid($uid)." where ".SQL_not_in($posts_,'post_id',false) ." AND fromid!=".uid($uid));

}


}



function update_status_view_with_cat_posts($uid=false,$db_obj=false){

$uid=uid($uid);

//get MYSQLI databse object if not already provided
$db_obj=$db_obj?$db_obj:new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

//get all the posts from database belonging to categories that user has subscribed to
$posts=user_subscribed_posts($uid);

if(count($posts)){

//update Status View
$db_obj->query(update_status_view_query($uid,$posts));

}

}


/*
*
*function to return MYSQL query to update status
*view of given user with posts of subscribed categories
*
*/

function update_status_view_query($uid,$posts){

//static part of query
$query="INSERT INTO  status_view_of_user{$uid} (`fromid`,`post_id`,`date`) VALUES ";

foreach($posts as $post){

$query.= "({$post['from_id']},'{$post['post_id']}','{$post['date']}'),";

}

//final query
return str_lreplace(",", "", $query). "  ON DUPLICATE KEY UPDATE `date`=VALUES(`date`)";


}

//function to return Post ids and users to whom they belong from given user's Status View

function get_status_view($start=0,$end=15,$p_id=false,$order_filter=false,$uid=false,$from_id=false,$promotional=true){

//get part of query if "fromid" is given
if($from_id){
$uid=$from_id;
$query_part=" fromid={$from_id} ";
}

//part of query to get only promotional posts
if($promotional){
$promotional_part=SQL_QUERY_promotional_part();
}
else {
$promotional_part=SQL_QUERY_promotional_part(true);
}

//prepare query by adjusting "where" and "AND" clauses
$promotional_part=!$from_id?" where ".$promotional_part:" AND ".$promotional_part;

if(!$p_id){
if($order_filter)
$sql="SELECT * FROM (SELECT * from status_view_of_user".uid($uid).($from_id?(" where {$query_part}"):"")." {$promotional_part} limit {$start},{$end}) tmp ORDER BY `date` DESC";
else 
$sql="select * from status_view_of_user".uid($uid).($from_id?(" where {$query_part}"):"")." {$promotional_part} order by `date` desc limit {$start}, {$end}";
}
else
{
$sql="select * from status_view_of_user".uid($uid)." where post_id='{$p_id}'";
}

//execute query to pull records
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

/*
*
*Now everytime this function is called, we ensure that user's
*status view is updated with posts belonging to categories that 
*they have subscribed to
*/

update_status_view_with_cat_posts($uid,$mysqli);


$fromid_arr=array();
$postid_arr=array();
$ts_arr=array();
$i=0;
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if(account_status($row['fromid']))
{
$fromid_arr[]=$row['fromid'];
$postid_arr[]=$row['post_id'];
$ts_arr[]=$row['date'];
}
}
}
}

return array (

"fromids"=>$fromid_arr,
"postids"=>$postid_arr,
"ts"=>$ts_arr
);

}


//function to get a given Relation List's abbriviation

function get_list_abbr($ls){

switch($ls)
{
case"friend":return "fr";break;
case"colleague":return "col";break;
case"aquantaince":return "aqu";break;
case"aquantaince":return "aqu";break;
case"No prior aquaintance":return "npa";break;
case"family":return "fam";break;
}

}

//function to get icon for given list

function get_list_icon($ls){

switch($ls)
{
case"friend":return get_image("friends_icon.png");break;
case"colleague":return get_image("colleague_icon.png");break;
case"aquantaince":return get_image("aqu_icon.png");break;
case"No prior aquaintance":case "NPA":return get_image("no_aqu.png");break;
case"family":return get_image("family_icon.png");break;
default:break;
}

}

//function to apply some filtering to given list name

function filter_list_name($ls){

if($ls=="No prior aquaintance")return "NPA";

return $ls;
}

//function to get picture for given pic id

function get_post_pic($pic_id){

return SITE_URL."/get_post_pic.php?pic_id={$pic_id}";
}

//function to display posts

function display_posts($start=0,$end=15,$p_id=false,$order_filter=false,$uid=false,$from_id=false,$display_comments=true,$promotional=false)
{

//get data from given user's status view
$ids=get_status_view($start,$end,$p_id,$order_filter,$uid,$from_id,$promotional);

//get ids of all the posts that are in given user's post view
$postid_arr=$ids["postids"];

//get ids of all the users that various posts belong to
$fromid_arr=$ids["fromids"];

//get timestamps of all the fetched posts from Status View
$ts_arr=$ids["ts"];

//get array of all post categories
$post_cats=post_cats();

//connect to Post Records database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['posts_db']);

//now checking each individual post's visibility configuration prior to it being displayed
for($i=0;$i<sizeof($fromid_arr);$i++)
{

if($result=$mysqli->query("select * from posts_record_of_user{$fromid_arr[$i]} where post_id='{$postid_arr[$i]}'"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

//get list in which the logged in user is (abbriviated form)
$ls=get_list_abbr(get_list_status($fromid_arr[$i],false));

//get list in which the current user is
$ls_wrt_lu=filter_list_name(get_list_status($fromid_arr[$i]));

//get list icon
if(!empty($ls_wrt_lu)){
$rel_img_src=get_list_icon($ls_wrt_lu);

//get label showing relation 
$rel_text="<span class='light_text'><img class='post_rel_img' src='{$rel_img_src}' width='20' align='middle'/>In your {$ls_wrt_lu} list</span>";
}
else
{
$rel_text="";
}

//proceed only if logged-in user is eligible for viewing this post

if(!in_array(uid($uid),explode_(",",$row['excluded'])) && ( in_array($ls,explode_(",",$row['relations'])) || $fromid_arr[$i]==uid($uid) || $row['public'])){

//if user is viewing their own post, give them options to manage it

if($fromid_arr[$i]==uid($uid))
{
$post_options="<div class='post_options none'>

<img title='Promote this post' class='promote-post-btn' src='".get_image('promote.gif')."'/> | <img src='images/post_visibility.png' class='pv_edit' title='Control post visibility'>|<img src='images/red_pencil_icon.png' class='edit_post' title='Edit this post'>|<img src='images/crossmark.gif' class='del_post' title='Delete this post'></div>";
}
else
{
$post_options="<div class='post_options none'><img src='images/crossmark.gif' class='rp-frm-feed' title='Remove this post from your feed'/></div>";
}

//checking if this post contains picture
if(!if_empty($row['pic_id'])){
$post_img_content="<img title='Enlarge this picture' src='".get_post_pic($row['pic_id'])."'/>";
}
else{
$post_img_content=null;
}

//checking if this post contains any news
if(!if_empty($row['news_id'])){
$post_news_content=hp_post_news_content($row['news_id']);
}
else{
$post_news_content='';
}

//checking if this post contains any movie
if(!if_empty($row['movie_id'])){
$post_movie_content=hp_post_movie_content($row['movie_id']);
}
else{
$post_movie_content='';
}

//checking if this post contains any video
if(!if_empty($row['video_id'])){
$post_video_content=hp_post_video_content($row['video_id']);
}
else{
$post_video_content='';
}

//getting user's feedback string to post   
$fback=get_fback_to_post_string(entity_value($postid_arr[$i],"fback","fromid",uid($uid),$GLOBALS['fback_to_posts_db']),entity_value($postid_arr[$i],"when1","fromid",uid($uid),$GLOBALS['fback_to_posts_db']));

//calculating total number of those who gave their feedback to this post
$t=total_entries($postid_arr[$i],"fromid",$GLOBALS['fback_to_posts_db'])-deleted_accounts($postid_arr[$i],"fromid",$GLOBALS['fback_to_posts_db']);

//calculating total number of comments on this post
$total_cmnt=(total_entries($postid_arr[$i],"fromid",$GLOBALS['cmnt_on_posts_db'])-deleted_accounts($postid_arr[$i],"fromid",$GLOBALS['cmnt_on_posts_db']));


if($total_cmnt<=0)
$tc_class='pointer underline_onHover comnts_to_posts';
else{$tc_class='';}

/**
* get post category
*/

$post_cat_content=post_cat_content($row['cat'],$post_cats);
$post_cat_content=!empty($post_cat_content)?"In ".$post_cat_content:"";

echo "<div ts='".strtotime($ts_arr[$i])."' id='{$postid_arr[$i]}' class='hp_post_container'>
<div class='post-top'><div class='fl'>
<span onclick='post_get_clist(this);' title='Change the background color of feeds' class='pointer red_onhover post_get_clist'>&#916;</span>
<div class='colorlist'></div>
<div class='clear'>

<div class='no_wh'>

<div class='absolute post-user-name-cont'>
<a href='".get_profile_url($fromid_arr[$i])."' class='dui' data-hovercard-id='{$fromid_arr[$i]}'><b>".user_name($fromid_arr[$i])."</b></a> 
</div>
</div>

</div>

<div class='post-last-online small grey'>".post_last_online($fromid_arr[$i])."</div>


<div>

</div>

</div>

<div class='fr'>{$post_options}</div><div class='clear'></div></div><div><div class='fl post_user_pic'><span>


</span><br/><a href='".get_profile_url($fromid_arr[$i])."'><img class='post_owner_pic' src='".prof_pic($fromid_arr[$i])."'/></a><div>{$rel_text}</div><div class='grey small post-cat-container'><span title='Posted {$post_cat_content}'>{$post_cat_content}</span></div></div><div class='fr'><div class='post_content'><div id='pc_{$postid_arr[$i]}' class='post_content_text'>".text($row["post_content"])."</div>{$post_news_content}{$post_movie_content}{$post_video_content}<div class='post_content_img'>{$post_img_content}</div></div></div><div class='clear'></div></div><div class='p_block_bottom'><div class='p_fback_oc'></div><div class='post_features_div'><span class='light_text'>".ago(strtotime($row['created']))."</span> | <span class='fback_tp pointer'>{$fback}</span>| <a class='pbar4posts_anchor' href='percentagebar4posts.php?p_id={$postid_arr[$i]}' target='fback_statistic_post'>Feedback</a> from <span class='underline_onHover pointer fback_fromothers'>{$t} others</span> | <span class='{$tc_class}'><span class='post_cmnt_count_main'>{$total_cmnt}</span> comments</span></div><div class='cmnts_to_post_container"; if($total_cmnt<=0)echo " none"; echo "'>";

if($display_comments){

//displaying comments
if($total_cmnt>0)
{

put_comments_on_post($postid_arr[$i],$total_cmnt);

}

//put comment textarea
put_comment_textarea();

}

echo "</div></div></div>";


}
}
}
}
}
}


/***
* function to return the HTML content for Post Category
*/

function post_cat_content($cat,$post_cats){

if(!empty($cat)){

$post_cat=searchSubArray($post_cats,'id',$cat);

if(count($post_cat)){
return $post_cat['value'];

}

}

return "" ;
}

/*

funtion to put "last online" timestamp next to person's name on a post

*/

function post_last_online($uid){

if(uid()!=$uid){

if(is_online($uid)){

return "Online now";

}

else {

return "last online ". ago(strtotime(user_last_online($uid)));

}

}

else return "";

}



function if_empty($val){

return (empty($val) || $val=="null" || $val==NULL);

}

function explode_($char,$str){

return array_filter(explode($char,$str));

}


function hp_post_news_content($news_id){

$content='';

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['ps_news_db']);

if($result=$mysqli->query("select * from news where news_id='{$news_id}'"))
{
if($result->num_rows>0)
{
$content.="<div class='sta-block attachment-sta-api-news'>";
while($row=$result->fetch_array())
{
$content.="<div><strong news-api-url='".$row['url']."' class='pointer api-news-rfn-toggle'>".stripslashes($row['title'])."</strong></div><div>".stripslashes($row['description'])."&nbsp;...<span class='small light_text pointer api-news-rfn-toggle'>read full news</span></div><div class='none api-news-rfn-content'>".stripslashes($row['content'])."&nbsp;<span class='small light_text pointer api-news-rfn-clp'>...collapse</span></div>";
}
}
}
return $content.="</div>";
}

function hp_post_movie_content($m_id){

$content='';

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['ps_movies_db']);

if($result=$mysqli->query("select * from movies where movie_id='{$m_id}'"))
{
if($result->num_rows>0)
{
$content.="<div class='sta-block api-movie-content'>";
while($row=$result->fetch_array()){
$content.="<div class='api-movie-content'>
<p><strong class='smd-movie pointer ps-m-title'>".stripslashes($row['title'])."</strong></p>
<div>
<img class='smd-movie pointer' src='".$row['pic_url']."' height='300' width='250'/>
</div>
<div>
<strong>Release date:</strong> ". date("M d, Y",strtotime($row['release_date']))."
</div>
<div>
<strong>Vote:</strong> <span class='ps-m-vote'>{$row['vote']}</span>/10
</div>
<div class='md-container none' m-path='{$GLOBALS['movie_module']}/get_details.php' m-id='{$m_id}'></div>
<div class='right'><span class='pointer small smd-movie light_text'><u>...More details</u></span></div>
</div></div>";
break;
}
}
}

return $content;

}

function hp_post_video_content($v_id){

$content='';

//connect to database
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['ps_videos_db']);

if($result=$mysqli->query("select * from videos where video_id='{$v_id}'"))
{
if($result->num_rows>0)
{
$content.="<div class='sta-block api-video-content'>";
while($row=$result->fetch_array()){

$href="http://youtube.com/watch?v={$row['video_id']}";


$content.="<diV><strong class='pointer yt-v-title'>".stripslashes($row['title'])."</strong></div>
<p><a class='yt-video' href='{$href}'><img class='yt-v-pic' src='".filter_API_images($row['pic_url'],$GLOBALS['youtube_dir'])."'/></a></p>
<div style='position:relative;width:0px;height:0px;'><a title='Play' class='yt-video yt-v-play' href='{$href}'><img src='images/play.png'/></a></div>
<div><strong>Published:</strong>".date("M d, Y",strtotime($row['published']))."</div>
<div><strong>Views:</strong> <span class='yt-v-views'>{$row['views']}</span></div>
<p class='yt-v-des none'>".stripslashes($row['description'])."</p>
<div class='right'><span class='pointer small smd-video light_text'><u>...More details</u></span></div>";

}
$content.="</div>";
}
}

return $content;

}

function filter_API_images($url,$third_party){
if(strpos($url,SITE_URL)!==false){
return $url;
}
else{
$url_suffix="";
if($third_party==$GLOBALS['tmdb_dir']){
$url=$GLOBALS['movie_api_pic_base'].$url;
}
$url=$url.$url_suffix;
}
return $url;
}

function put_comments_on_post($post_id,$total,$start=0,$end=6,$show_textarea=true,$default_view=true)
{
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['cmnt_on_posts_db']);
if($default_view)
{
$l1=($total-6);
$l2=$total;
if($l1<=0){
$l1=0;
$l2=$total;
}
$sql="select * from {$post_id} ORDER BY when1 limit {$l1},{$l2}";
}
else
{
$l1=$total-$start-6;
$l2=$start;
if($l1<=0){
$l1=0;
$l2=$total-$start;
}
$sql="select * from {$post_id} ORDER BY when1 limit {$l1},{$l2}";
}

if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
echo "<div class='cmnt_to_post_info'>";
if($end<$total)
{
if(($total-$end)>=6)
{
$cmnt_no=6;
}
else
{
$cmnt_no=$total-$end;
}
echo "<div class='fl'><span class='light_text pointer underline_onHover prev_cmnts_to_post'>Previous {$cmnt_no} comments
</span></div>
<div class='fr'><span class='light_text'>Last <span class='posts_cmnts_count'>".($result->num_rows+$start)."</span> of <span class='posts_total_cmnts'>{$total}</span></span></div>
<div class='clear'></div>";
}

else
{
echo "<span class='light_text'><span class='posts_cmnts_count'>{$total}</span> of <span class='posts_total_cmnts'>{$total}</span></span>";
}

echo "</div>";

while($row=$result->fetch_array())
{
if(account_status($row['fromid']))
{
echo "<div class='cmnt2post_block'>";
if($row['fromid']==uid()){
echo "<div class='cmn2post_top'><div align='right'><span title='Delete' id='{$row['comment_id']}' class='red_onhover pointer remove_p_cmnt none'>&#215</span></div></div>";
}
echo "<div class='fl left'><a href='".get_profile_url($row['fromid'])."'><table><tr><td><img src='".get_thumb($row['fromid'],40,40)."'/></td><td valign='top'>".TuneTheName(user_name($row['fromid']),13).":</td></tr></table></a></div><div class='fr right'>".stripslashes(nl2br(auto_link_text($row['comment'])))."</div><div class='clear'></div><div class='light_text  small hp_cmnt_time'>about ".ago(strtotime($row['when1']))."</div></div>";
}
}
}
}

/*if($show_textarea)
{
echo "
<div class='ctpc_child'><table><tr><td><textarea class='flexible_textarea shaded_textarea cmnt_textarea'></textarea></td><td><input type='button' value='Comment' class='pointer special_btn pctp_btn'/></td></tr></table></div>";
}*/

}



function put_comment_textarea(){

echo "<div class='ctpc_child'><table><tr>
<td class='cmnt-area'>
<div class='shaded_textarea'>
<div class='fl'>
<table class='lu-cmnt-pic_container none'>
<tr>
<td><a href='".get_profile_url(uid())."'><img src='".get_thumb(uid(),40,40)."' /></a></td>
<td><a href='".get_profile_url(uid())."'>".TuneThename(user_name(uid()),13)."</a>:</td>
</tr>
</table>
</div>
<div class='fr hp-cmnt-div'>
<textarea class='flexible_textarea cmnt_textarea'></textarea>
</div>
<div class='clear'></div>
</div>
</td>
<td><input type='button' value='Comment' class='pointer special_btn pctp_btn'/></td></tr></table></div>";
}


function get_fback_to_post_string($fback,$time)
{

//make a little tweak to correct a spelling mistake
$fback=$fback=="awesom"?awesome:$fback;

switch($fback){
case "like":
return "<img class='fbacktop_img' src='{$fback}.bmp' /><span title='about ".ago(strtotime($time))."'>You liked this post</span>";
break;
case "awesome":
case "awesom":
case "best":
return "<img class='fbacktop_img' src='{$fback}.bmp' /><span title='about ".ago(strtotime($time))."'>You thought this post was {$fback}</span>";
break;
default:
return "No feedback from you";
break;
}
}

function get_points_for_fback($fback)
{
switch($fback)
{
case "like":
return "1";
break;
case "awesome":
case "awesom":
return "2";
break;
case "best":
return "3";
break;
default:
return 0;
break;
}
}

function get_points($id){
return entity_value("userdata","points","id",$id);
}

function update_points($id,$points,$action="add"){
if($action=="add"){
if(update_entity("userdata","id",$id,"points",(entity_value("userdata","points","id",$id)+$points)))
return true;else return false;
}
else{
if(update_entity("userdata","id",$id,"points",(entity_value("userdata","points","id",$id)-$points)))
return true;else return false;
}
}

function get_recommended_points($id){
$rp=floor(total_entries("user{$id}","listid")/10);
if($rp<1){return "1";}
else{return $rp;}
}

function get_points_offered($id){
return entity_value("user{$_SESSION['userid']}","points","requestid",$id);
}

function put_new_posts($id1,$id2,$limit=5)
{


//database connection
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

/*
*getting last few posts from id2's status view and inserting them into id1's status view
*/

$q1=swap_posts_query($id1,$id2,$limit);
if($q1){$mysqli->query($q1);}

/*
*getting last few posts from id1's status view and inserting them into id2's status view
*/

$q2=swap_posts_query($id2,$id1,$limit);

if($q2){$mysqli->query($q2);}

return true;

}


function swap_posts_query($id1,$id2,$limit=5){

$posts=array();

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

//query to last few posts from id2's status view 
$sql="SELECT * from status_view_of_user{$id2} WHERE fromid={$id2} order by `date` desc limit {$limit}";

if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

$posts[]=array(

"post_id"=>$row['post_id'],
"from_id"=>$row['fromid'],
"date"=>$row['date']

);

}

}
}

return count($posts)?update_status_view_query($id1,$posts):false;

}


function remove_posts_record($id1,$id2)
{
//database connection
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);


$r1=$mysqli->query("delete from status_view_of_user{$id1} WHERE fromid={$id2}");
$r2=$mysqli->query("delete from status_view_of_user{$id2} WHERE fromid={$id1}");

if($r1 && $r2)
return true;

else {
return false;
}

}

function put_lu_points($id,$style){
echo "<div class='points_count lu_strip_back' style='{$style}'><span id='points_digit' class='points_digit'>+".get_points($id)."</span><div class='spend_it underline_onHover hidden'>Spend it</div></div>";
}

/*//function to put new user's picture grid
function put_new_users_grid($coulmn=5,$total=20){
@include('class_lib.php');
$i=0;
echo "<table><tr>";
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($result=$mysqli->query("select * from userdata order by created desc"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{

$u=new user($row['id']);
if($u->user_pic() && $u->get_account_status() &&  !in_array($row['id'],$GLOBALS['not_featured']))
{
if($i>0 && $i%$coulmn==0)
echo "</tr><tr>";
echo "<td itemscope itemtype ='http://schema.org/person'><a itemprop='contactPoint' href='".get_profile_url($row['id'])."'><img alt='".$u->get_name()."' title='".$u->get_name()." from ".$u->get_country()."' src='".$u->prof_pic()."' itemprop='image'/></a></td>";
$i++;
}
if($i==$total)break;
}
}
}
echo "</tr></table>";
}
*/

function send_invitation_mails($emails,$text,$fromid){
@include(HOME."/class_lib.php");
//instantiating class user 
$lu=new user($fromid);
$msg="
<html>
<head>
<title>Untitled Document</title>
</head>
<body>
<div style='text-align:justify;margin:0px auto;text-align:left;'>
<a href='".SITE_URL."'><img src='".SITE_URL."/frendsdom.gif'/></a>
<h1 style='color:#666;margin-top:20px;'>Invitation to join Frendsdom</h1>
<p style='color:#666;font-weight:bold;border-bottom:1px dotted #000;padding-bottom:20px;'>
<br/>Hi there,<br/><br/>
<a style='text-decoration:none;' href='".get_profile_url($fromid,true)."'><img src='".SITE_URL."/".$lu->prof_pic()."' align='middle' height='45' width='45'/>&nbsp;&nbsp;".$lu->get_name()."</a> has sent you this invitation to join <a style='text-decoration:none;' href='".SITE_URL."'>Frendsdom</a>.
</p>
<div style='color:#666;font-weight:bold;border-bottom:1px dotted #000;padding-bottom:20px;'><br/>
<div><br/>".nl2br(stripslashes(urldecode($text)))."</div>
</div>
<p style='padding-top:20px;font-weight:bold;'>Please do not directly reply to this email. If you do, it will be received by admins at Frendsdom, not by the real sender.
</b></p>
<p style='border-top:1px dotted #000;margin-top:20px;padding-top:20px;'>
Contact us at : <b style='color:#666;'>admin@frendsdom.com</b>
</p>
</div>
</body>
</html>";
$headers = 'From: Frendsdom.com <admin@frendsdom.com>' . "\r\n" .
'Reply-To: admin@frendsdom.com' . "\r\n" .
"X-Mailer: PHP/" . phpversion()."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//sending mails
foreach($emails as $email){
mail(urldecode($email),"Invitation to join Frendsdom from ".$lu->get_name(),$msg,$headers);
}
return true;
}

//function to check if email is set to be visible by the user
function is_email_visible($user){
if((($user->get_email_visibility()=="relations" && $user->if_exists($_SESSION['userid'])) || $user->get_email_visibility()=="public") && $user->get_email_verified()==1)
return true;else return false;
}

//function to get number of latest news
function get_new_news($id){
mysql_select_db($GLOBALS['news_db'], $GLOBALS['con']);
$news=0;
$rr=mysql_query("SELECT from_id FROM news4user{$id} where viewed=0 || when1>'".entity_value("userdata","last_home_visit","id",$id)."'");
while($row=mysql_fetch_array($rr)){if(account_status($row['from_id']))$news++;}
return $news;
}

//function to get total number of unread messages
function get_unread_msgs($id){
mysql_select_db($GLOBALS['msg_inbox'], $GLOBALS['con']);
$totalnewmsg=0;
$rr=mysql_query("SELECT from1id FROM msgboxofuser{$id} where read1='no'&&read2='no'");
while($row=mysql_fetch_array($rr)){if(account_status($row['from1id']))$totalnewmsg++;}
return $totalnewmsg;
}


//function to get number of new nudges
function get_new_nudges($id){
mysql_select_db($GLOBALS["nudgeset_records"], $GLOBALS['con']);
$nudgesets=0; 
$rr=mysql_query("SELECT fromid FROM nudgeboxofuser{$id} where viewed='no'");
while($row=mysql_fetch_array($rr)){if(account_status($row['fromid']))$nudgesets++;}
return $nudgesets;
}

//function to get the number of authority request
function get_atr_req($id){
mysql_select_db($GLOBALS['authority_recpients_db'], $GLOBALS['con']);
$atr_req=0;
$rr=mysql_query("SELECT request_from FROM authorityrecpients4user{$id} where request_from!='' && requested!=''");
while($row=mysql_fetch_array($rr)){if(account_status($row['request_from']))$atr_req++;}
return $atr_req;
}

//function to get number of invitations
function get_invitations($id){
$count=0;$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($result=$mysqli->query("select* from user{$id}"))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{
if($row['requestid']!="" && account_status($row['requestid']))
$count++;
}
}
}
return $count;
}
function images_only( $file )
{
return preg_match( '/\.(gif|jpg|png)$/i', $file );
}


//function to get all the file names in specified directory 
function get_files($dir,$filter_images=false)
{
$files = scandir($dir);
if($filter_images)
return array_filter( $files,'images_only');
else $files;
}

function get_vpb_images($n=20){

//getting all background image's names 
$image_files=get_files($GLOBALS['vpb_dir'],true);

//picking any n random images
$rand_keys = array_rand($image_files,$n);

$img_array=array();
for($i=0;$i<sizeof($rand_keys);$i++){
$img_array[$i]=$image_files[$rand_keys[$i]];
}
return $img_array;
}

function get_vp_colors($n=20)
{
$colors=array_filter(array_unique(array_merge(array("#FF69B4","#FFD700","#00FA9A","#7CFC00","#90EE90","#EEE","#CD853F","#E6E6FA","#EEE8AA","#FFB6C1","#D3D3D3","#9370D8","#FF8C00","#2F4F4F","#00BFFF","#F0F8FF","#DAA520","#FFFF99","#FF9999","#87CEEB","#fff"),light_colors())));

//picking any n random colors
$rand_keys = array_rand($colors,$n);

$color_array=array();
for($i=0;$i<sizeof($rand_keys);$i++){
$color_array[$i]=$colors[$rand_keys[$i]];
}
shuffle($color_array);
return $color_array;
}

//function to get number of records after a particular record
function get_records($table,$id,$id_value,$database=false){
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($result=$mysqli->query("SELECT * FROM {$table} WHERE {$id} > '{$id_value}'"))
{
return $result->num_rows;
}
}


function get_new_posts_wrt($id,$post_id){

/*
*variables for holidng number of new posts
*/

$new_posts=0;
$l1=0;
$l2=0;

/*
*first, get the date this post was inserted 
*into given user's Status View
*/


$lp_date=entity_value("status_view_of_user{$id}","date","post_id",$post_id,$GLOBALS['status_view_db']);


/*
* check if there are any posts that are more recent
*/

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);
if($result=$mysqli->query("select count(`post_id`) as c from status_view_of_user{$id} where `date` > '{$lp_date}'"))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
$new_posts=$row['c'];
}
}
}

if($new_posts){

$l2=total_entries("status_view_of_user{$id}","post_id",$GLOBALS['status_view_db'])-$new_posts;
$l1=$new_posts;

}


return array("l1"=>$l1,"l2"=>$l2);



/*OLD LOGIC*/
/*
//getting UNIX timestamp from given post id
$ts=explode("_",$post_id);
$ts=$ts[2];

//getting all the post ids in given user's status view
$post_ids=return_array_tweaked($GLOBALS['status_view_db'],"status_view_of_user{$id}","post_id");

$count=0;
$first_encounter=0;
$i=0;

//finding posts ids with greater timestamp
foreach($post_ids as $post_id){

$ts1=explode("_",$post_id);
$ts1=$ts1[2];

if($ts1>$ts){
if($first_encounter==0)
$first_encounter=$i;
$count++;
}
$i++;
}
return array("l1"=>$first_encounter,"l2"=>$count);
*/


}


function get_posts_aia($id,$inv_from_id){
$i=0;
$count=0;
$fe=0;
$ga=return_array_tweaked($GLOBALS['status_view_db'],"status_view_of_user{$id}","fromid");
foreach($ga as $from_id){
if($from_id==$inv_from_id)
{
if($fe==0)
$fe=$i;
$count++;
}
$i++;
}
return array("l1"=>$fe,"l2"=>$count);
}


//function to get a field's value from last record
function get_last_filed($table,$entity,$id,$database=false){
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($database));
if($result=$mysqli->query("SELECT {$entity} FROM {$table} order by {$id} DESC LIMIT 1"))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
return $row[$entity];break;
}
}
}
}

//function to delete given post from all the lu's relation's status views
function delete_posts_record($id,$p_id){
$rel_list=return_array("user{$id}","listid");
array_push($rel_list,$id);
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);
for($i=0;$i<sizeof($rel_list);$i++)
{
$mysqli->query("delete from status_view_of_user{$rel_list[$i]} where post_id='{$p_id}'");
}
}



//function to handle Noty actions on home page
function handle_noty_actions(){
if(!empty($_GET['noty_action']) && in_array($_GET['noty_action'],array("n_ns","n_in","n_ar","n_n","n_m","invite_fr","s_v","view_mp","trigger_cats","trigger_hobbies")))
{
switch($_GET['noty_action']){
case "n_ns":
?>
<script>$("#news").click();</script>
<?php
break;
case "n_in":
?>
<script>$("#invitation").click();</script>
<?php
break;
case "n_atr":
?>
<script>$("#atr_rqst").click();</script>
<?php
break;
case "n_n":
?>
<script>$("#nudge_received").click();</script>
<?php
break;
case "n_m":
?>
<script>$("#mbox").click();</script>
<?php
break;
case "invite_fr":
?>
<script>$("#invite_fr").click();</script>
<?php
break;
case "s_v":
?>
<script>switch_view();</script>
<?php
break;
case "view_mp":
?>
<script>$("#main_view_vc_mp").click();</script>
<?php
break;
case "trigger_hobbies":
?>
<script>trigger_hobbies()</script>
<?php
break;
case "trigger_cats":
?>
<script>trigger_cats()</script>
<?php
break;
}
}
}


//function to get asl query
function get_asl_query($limit=100){

//manipulating received age  
if($_POST['age']!="all")
{
if(strpos($_POST['age'],"60")===false)
{
$_POST['age']=explode("-",$_POST['age']);
$age_from=$_POST['age'][0];
$age_to=$_POST['age'][1];
$age_part="&& (FLOOR((DATEDIFF(CURDATE(),CONCAT(year,'-',month,'-',day)))/ 365.25) BETWEEN {$age_from} AND {$age_to})";
}
else{
$age_part="&& (FLOOR((DATEDIFF(CURDATE(),CONCAT(year,'-',month,'-',day)))/ 365.25) >= 60)";
}
}
else{
$age_part="";
}

//manipulating received sex  
if($_POST['sex']!="all")
{
$sex_part=" && sex='{$_POST['sex']}'";
}
else
{
$sex_part="";
}

//manipulating received country  
if($_POST['country']!="all")
{
$query="%".$_POST['country']."%";
$query=entryfordatabase($query);
$country_part=" && country like $query";
}
else
{
$country_part="";
}

//manipulating received state  
if(!empty($_POST['state']))
{
$query="%".$_POST['state']."%";
$query=entryfordatabase($query);
$state_part=" && state like $query";
}
else
{
$state_part="";
}

//manipulating received city  
if(!empty($_POST['city']))
{
$query="%".$_POST['city']."%";
$query=entryfordatabase($query);
$city_part=" && city like $query";
}
else
{
$city_part="";
}

//manipulating user's ids
if(!empty($_POST['filter_ids']))
$filter_ids_part="&& id NOT IN(".implode(",",$GLOBALS['not_featured']).")";
else
$filter_ids_part="";

//checking if user has profile picture 
if(!empty($_POST['check_pic']))
$check_pic_part="&& `picture`='yes'";
else
$check_pic_part="";

//mysql query
return "select * from userdata where account_status='open' AND accept_invitations=1 {$sex_part} {$country_part} {$state_part} {$city_part} {$age_part} {$filter_ids_part} {$check_pic_part} ORDER BY RAND() limit {$limit}";

}


//function to return array of all tables in a given database

function get_tables($db,$filter=false)
{
$arr=array();
$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$db);
if($result=$mysqli->query("Show tables"))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){
if($filter){
if(!in_array($row[0],$filter))
array_push($arr,$row[0]);
}
else{
array_push($arr,$row[0]);
}
}
}
}
return $arr;
}

function get_profile_url($id,$absolute=false){
return ($absolute?SITE_URL."/":"")."visit.php?id={$id}";
}

function profile_url_with_username($user_name){

return SITE_URL."/".$user_name;
}

function get_blog_url(){
return "http://blog.frendsdom.com";
}

//function to check if email given is valid 
function checkemail($email){return filter_var( $email, FILTER_VALIDATE_EMAIL );}

function check_email($email){
if(checkemail($email) && validemail($email))
return true;
else return false;
}

function get_date_time($ts=false){
$ts=!$ts?mktime():$ts;
return date('Y-m-d H:i:s',$ts);
}

//function to get content from given remote URL
function get_remote_content($url){
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($curl);
curl_close($curl);
return $output;
}

//function to get total number of relations for a given user id 
function get_total_rel($id,$get_array=false){
$rels=return_array("user{$id}","listid");
$arr=array();
foreach($rels as $rel){
if(account_status($rel))array_push($arr,$rel);
}
if($get_array)return $arr;
else return sizeof($arr);
}


//function to get sub-array from a multidimensional array
function searchSubArray(Array $array, $key, $value) {   
    foreach ($array as $subarray){  
        if (isset($subarray[$key]) && $subarray[$key] == $value)
          return $subarray;       
    } 
}

//function to generate thumbnail for a given image

function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$t_width=150,$t_height=150)
{


    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $t_width / $t_height;
    if ($source_image_width <= $t_width && $source_image_height <= $t_height) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) ($t_height * $source_aspect_ratio);
        $thumbnail_image_height = $t_height;
    } else {
        $thumbnail_image_width = $t_width;
        $thumbnail_image_height = (int) ($t_width / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}


//function to get path to a specified user's directory

function get_user_dir($id,$absolute=false){

return ($absolute?HOME."/":"")."user_data/".$id;

}

function get_prof_pic_path_from_url($pic_url){

return str_replace(SITE_URL,HOME,$pic_url);

}

//function to get thumbnail of a given user's profile picture

function get_thumb($id,$t_width=150,$t_height=150){

$target=get_user_dir($id,true)."/".$id."_{$t_width}.jpg";

if(!file_exists($target))
generate_image_thumbnail(get_prof_pic_path_from_url(prof_pic($id)),$target,$t_width,$t_height);

return str_replace(HOME,SITE_URL,$target);
}

//function to check if specified users are in each other's relation lists or not
function is_stranger($id1,$id2){
return in_array($id2,get_total_rel($id1,true))?false:true;
}

//function to update the value of given configuration option
function update_conf_option_value($id,$option,$value){
$lu=get_user_instance($id);
return $lu->update_conf_option_value($option,$value);
}


//function to get value of given configuration option
function conf_option_value($id,$option){
$lu=get_user_instance($id);
return $lu->conf_option_value($option);
}


//function to get the 'user' object for the given userid
function get_user_instance($id,$conf=false){
include_once('class_lib.php');
return $lu=user::getInstance($id,$conf);
}


//function to include a file if not already included
function include_file($file){
if(!in_array($file,get_included_files()) && !in_array($file,get_required_files()))
include($file);
}


//function to check if given timestamps is n hours old
function if_hours_old($ts,$hours=24){
return $ts <= strtotime("-{$hours} hours")?true:false;
}

//function to get how old the given time stamp is 
function hours_old($ts){
return floor(abs(mktime()-(int)$ts)/3600);
}

function current_year(){
return date("Y",mktime());
}

function get_unique_key($n=false){
return md5(mktime().(!$n?rand():$n));
}

function check_mp_(){
if(isset($_COOKIE['mp_playing']))
exit;
}

function get_thumb_2($id,$t_width=150,$t_height=150){

$temp_dir=$GLOBALS["mp_temp_pic_dir"];

if(!file_exists($temp_dir))
mkdir($temp_dir);

$target=$temp_dir."/".md5(mktime().$id).".jpg";

copy(get_thumb($id,$t_width,$t_height), $target);

return $target;
}

//function to pick a random image from given directory

function random_pic($imagesDir){

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

return $images[array_rand($images)];

}

function get_logo(){

return "images/frendsdom.gif";

}

//function to get HTML code for logo in top bar 

function top_bar_logo(){

return "<a href='".SITE_URL."'><img class='top-bar-logo' src='".get_logo()."'/></a>";

}


//function to download a remote file at given path

function download_remote_file($url,$path){
	
   $fp=fopen($path, "w");
 	
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
 
    $data = curl_exec($ch);
 
    curl_close($ch);
    fclose($fp);

}


function filter_url($url){

$temp=explode("?",$url);
return $temp[0];

}

//function to save images from third parties

function save_API_images($url,$third_party){

$url=filter_url($url);

$common_path=$GLOBALS['third_party_dir']."/".$third_party."/".md5($url).".".get_file_type($url);

$path=HOME."/".$common_path;

if(!file_exists($path)){
download_remote_file($url,$path);
}

return SITE_URL."/".$common_path;

}


//function to manipulate a country name

function country_name($country){

switch($country){

case "Tanzania, United Republic Of":
return "Tanzania";
break;

case "United States Of America":
return "United States";
break;

default:
return $country;
break;

}

}

function check_auth(){

if(!is_logged_in())
{
header('location:'.SITE_URL.'/main.php');
exit;
}


}

function database($database=false){

return $database?$database:$GLOBALS['selected_db'];

}


//function to check if an user is logged in
function is_logged_in(){

return !empty($_SESSION["username"]) && !empty($_SESSION["userkey"]) && !empty($_SESSION["userid"]);

}


 //if logged-in cookies or sessions are found on client's system then redirect user to home page

function to_home(){

if ((isset($_COOKIE['usn'])) && (isset($_COOKIE['usk'])) || is_logged_in())
   {
   header('location:'.SITE_URL.'/home.php');
   }
}

function get_header_1(){
?>
<div class="nav-blue-back nav-bar-wrapper">
<div class="top-nav-bar-1 site_width left">
<a href="<?php echo SITE_URL; ?>" title="Go back to main page"><img class="navbar-site-logo" src="<?php echo SITE_URL; ?>/images/frendsdom.gif" width="200"/></a>
</div>
</div>
<?php
}



function get_footer_1($at_bottom=false){

?>
<div class="footer nav-blue-back <?php echo $at_bottom?" at_bottom ":""; ?>">
           <a href="users.php" title="People who joined us recently">Recent Users</a> | <a href="http://circleshouts.com" target="_blank" title="Our official blog">Circle Shouts</a> | <a href="<?php echo SITE_URL."/terms.php"; ?>">Terms & Conditions</a> | <a href="<?php echo SITE_URL."/privacy.php"; ?>">Privacy Policy</a> | <a href="<?php echo SITE_URL."/copyright.php"; ?>">Copyright</a> | <a href="<?php echo SITE_URL; ?>/contact.php">Contact</a> | Frendsdom &copy; <?php echo current_year(); ?>
         </div>

<?php
}

function get_image($img){

return SITE_URL."/images/".$img;
}

//function to set a given field's value in userdata table

function set_user_value($entity,$value,$uid=false){

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['selected_db']);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
return $mysqli->query("update userdata set {$entity}='{$value}' where id='".uid($uid)."'");

}

function uid($uid=false){
return $uid?$uid:$_SESSION['userid'];
}

//function to return part of SQL query ensuring to return valid users

function SQL_valid_users($pic=true){

return " account_status='open' ".($pic?"&& picture='yes'":"")." && ". SQL_not_in($GLOBALS['not_featured']);

}

function SQL_not_in($arr,$entity="id",$not=true){

return "{$entity} ".($not?"NOT":"")." IN (".implode(",",$arr).") ";

}

function enclose_array_elements($arr){

foreach ($arr as $a)
$return[]="'".$a."'";
return $return;
}

function get_module_path($module){
return HOME.DS."modules".DS.$module;
}

function fback_icon($fback){

return "{$fback}.bmp";

}


function array_to_obj($array, &$obj)
  {
    foreach ($array as $key => $value)
    {
      if (is_array($value))
      {
      $obj->$key = new stdClass();
      array_to_obj($value, $obj->$key);
      }
      else
      {
        $obj->$key = $value;
      }
    }
  return $obj;
  }

function arrayToObject($array)
{
 $object= new stdClass();
 return array_to_obj($array,$object);
}

//function to get cover pic for a given user

function cover_pic($user){

//get user
$user=get_user($user);

return has_cover_pic($user)?SITE_URL."/".cover_pic_dir($user->id)."/".$user->cover_pic:get_image("c2.jpg");

}

//function to get the path of directory containing cover pic for given user

function cover_pic_path($uid){
$cover_dir=HOME."/".cover_pic_dir($uid);
if(!file_exists($cover_dir)){
mkdir($cover_dir);
}
return $cover_dir;
}


function cover_pic_dir($uid){
return get_user_dir($uid)."/cover";
}


function get_lu(){
return get_user($_SESSION['userid']);
}

//function to check if given user has any cover pic

function has_cover_pic($user){
$user=get_user($user);
return !empty($user->cover_pic);
}

//function to get user object for given user id

function get_user($user){
if(is_object($user))return $user;
$user=get_all_fields("select * from userdata where id={$user}");
foreach ($user as $u){
return $u;
}
}


//function to get all the fields as an object

function get_all_fields($query,$database=false){

$connect = mysql_connect($GLOBALS['host'], $GLOBALS['db_user'],$GLOBALS['db_passwd']) or die ("unable to connect");
mysql_select_db(database($database), $connect);
$result = mysql_query($query) or die(mysql_error());
$arr=array();
while($row = mysql_fetch_assoc($result))
{
$arr_temp=array();
foreach ($row as $col => $val) {
            $arr_temp[$col]=$val;
        }
$arr[]=$arr_temp;
}

return arrayToObject($arr);

}


//check if supplied file is an image

function check_if_image($file){

$info = getimagesize($file);
if ($info === FALSE) {
   return false;
}

if (($info[2] !== 1) && ($info[2] !== 2) && ($info[2] !== 3)) {
   return false;
}

return true;

}

//function to get extension from given file name
function get_extension($fname){
return strtolower(pathinfo($fname, PATHINFO_EXTENSION));
}

//function to get path to a library

function lib_path($lib){
return HOME."/includes/libs/".$lib;
}

//function to filter given text

function text($text){

return auto_link_text(nl2br(stripslashes($text)));

}

//function to get extension from given file's MIME type

function extension_from_type($type){

$temp=explode("/",$type);

return $temp[1];

}

//method to get absolute PATH of "clips" directory for a given user

function get_clip_path($uid){
$clips_dir=HOME."/".clips_dir($uid);
if(!file_exists($clips_dir)){
mkdir($clips_dir);
}
return $clips_dir;
}

function clips_dir($uid){
return get_user_dir($uid)."/clips";
}

//URL to a specified clip

function get_clip($uid,$clip){
return SITE_URL."/".clips_dir($uid)."/".$clip;
}

function get_selected_clip_from_db($uid){
return entity_value("soundclipsofuser{$uid}","clipid","set1","yes",$GLOBALS['soundclips_db']);
}

//function to get selected audio clip for given user

function get_selected_clip($uid){
return get_clip($uid,get_selected_clip_from_db($uid));
}


//function to pick up a random element from given array
function pick_random($arr){

return $arr[array_rand($arr)];

}


//function to get Share_pics directory

function share_pic_dir($uid){
return get_user_dir($uid)."/share_pics";
}

//function to get absolute path to a given user's share pics dir

function get_share_pic_dir($uid){
$path=HOME."/".share_pic_dir($uid);
if(!file_exists($path)){
mkdir($path);
}
return $path;
}

//function to get name of smaller version of a share picture whose share id is given

function get_share_pic_name_smaller($share_id){

return $share_id."_".$GLOBALS['sbox_pics']['width_smaller']."_".$GLOBALS['sbox_pics']['height_smaller'];

}

//function to get URL of a given share picture

function get_share_pic($uid,$share_id,$ext,$size="small"){

return SITE_URL."/".share_pic_dir($uid)."/".($size=="small"?get_share_pic_name_smaller($share_id):$share_id).".".$ext;

}

function get_gender_noun($user){
$user=get_user($user);
return $user->sex=="female"?"her":"him";
}

//this function returns the entire HTML image tag for given "share" object and creator's id

function get_share_image($share,$created_by,$height=false,$width=false){

//convert into object if array

if(!is_object($share)){

$share=arrayToObject($share);

}

return '<img align="middle" show-image="'. get_share_pic($created_by,$share->share_id,$share->share_pic_type,"big").'" class="share_pic" src="'.get_share_pic($created_by,$share->share_id,$share->share_pic_type).'"/>';

}

//function to get Profile Page slider for given user

function get_slider_conf($user){

//get default slider configuration
if(!empty($user->pp_slider_conf)){

return json_decode($user->pp_slider_conf,true);

}

else {

return $GLOBALS['pp_slider_conf'];

}

}

//function to parse a given string as Boolean

function parseBool($value){
return filter_var($value, FILTER_VALIDATE_BOOLEAN);
}

//function to return Updation MYSQL query string for given array

function SQL_updation_query($arr,$table="userdata",$condition=""){

$query="update {$table} set ";

foreach ($arr as $text=>$elm){

$val=parseBool($elm);

if(empty($val)){
$val="'".$elm."'";
}

$query.=$text."={$val},";

}

return str_lreplace(",","",($query." ".$condition));

}

//function to remove last occurance of a string in given STRING

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

/*
Function to check whether USER2 is allowed to send text messages to USER1
Takes two arguments:

USER1's object
USER2's id

*/

function is_allowd_to_text($user1,$user2_id){

switch($user1->user->messages_from){

case PUBLIC_LABEL:
$is_allowd_to_text=true;
break;
case RELATIONS:
$is_allowd_to_text=$user1->if_exists($user2_id);
break;
default:
$is_allowd_to_text=false;
break;
}

return $is_allowd_to_text;

}

//function to return last primary key in given database table

function get_last_id($table="userdata",$db=false){

$mysqli=new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database($db));
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}

if($result=$mysqli->query("SELECT MAX(id) FROM {$table}"))
{

if($result->num_rows>0)
{
while($row=$result->fetch_array())                        
{
return $row[0];
}
}
}
}

function get_uid_from_post_id($p_id){

$uid=explode("_",$_POST['p_id']);

return $uid[1];
}

function light_colors(){

return array("#FFFFF9","#FCFEF7","#FFF8F9","#F8FFFA","#FEF9FF","#F9F9FF","#F9FFFF","#FFFDFA","#F9FCFF","#FCFFFA");

}


//this function checks whether a given promotional post already exists in specified user's Status view

function post_promotional_points($uid,$post_id){

//connect to database
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

$rows=$mysqli->query("select * from status_view_of_user{$uid} where post_id='{$post_id}' AND promotional_points>0");

if($rows->num_rows){

while($row=$rows->fetch_array()){

return array(

"promotional_points"=>$row['promotional_points'],
"seen"=>$row['seen']


);

}                        


}

else return 0;


}


function get_promotional_posts($uid){

$return=array();

//connect to database
$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['status_view_db']);

$rows=$mysqli->query("select * from status_view_of_user{$uid} where ".SQL_QUERY_promotional_part());

if($rows->num_rows){

while($row=$rows->fetch_array()){

$return[]=$row;

}                        


}

return $return;

}

//function to get the part of SQL

function SQL_QUERY_promotional_part($non_promotional=false){

return ($non_promotional? " promotional_points=0 ":" promotional_points>0 ")." AND seen=0";

}

//function to validate a give USERNAME

function validate_username($str) 
{	
    //allowed characters

    $allowed = array(".", "-", "_");

    return ctype_alnum(str_replace($allowed, '', $str )) && strlen($str)<=50 && if_contains_chars($str);
        
}

function if_contains_chars($str){
return preg_match('/[a-zA-Z]/', $str);
}

function user_name_exists($user_name){
return check_if_exists("userdata","user_name",$user_name);
}

//function to check if given STRING contains any EXTENSION out of set of extensions

function extension_exists($src_file_name){
$supported_exts = array('gif','jpg','jpeg','png','php','html','htm','jpeg');
return in_array(strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)), $supported_exts) ;
}

//function to check if a given user name is available

function is_user_name_available($user_name){

return validate_username($user_name) && !user_name_exists($user_name) && !in_array($user_name,scandir (HOME)) && !extension_exists($user_name);

}

function get_id_by_user_name($user_name){

$id=entity_value("userdata","id","user_name",$user_name);

return !empty($id)?$id:false;

}

//function to resolve ID of user on profile page

function get_user_id(){

return if_contains_chars($_GET['id'])?get_id_by_user_name($_GET['id']):$_GET['id'];

}


/*

function to get array of Posts Categories

*/

function post_cats(){

//aray to be returned
$return=array();

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],database());
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select * from post_cats";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0){
while($row=$result->fetch_array()){

$return[]=array("id"=>$row['id'],"value"=>$row['cat']);

}
}
}
return $return;
}

/***
* function to get post owner's id by given Post id
**/

function owner_from_post_id($post_id){

$owner_id=explode("_",$post_id);
return $owner_id[1];

}


/**
* function to return array of all the hobbies subscribed 
* by given user
*/

function subscribed_hobbies($uid=false){

$return=array();

$mysqli =new mysqli($GLOBALS['host'],$GLOBALS['db_user'],$GLOBALS['db_passwd'],$GLOBALS['hobbies_subscription_db']);
$sql="select hobby_id from hobbies_subscription where uid=".uid($uid);
if($result=$mysqli->query($sql))
{
if($result->num_rows>0){
while($row=$result->fetch_array())
{

$return[]=$row['hobby_id'];

}
}

}


return $return;

}


function hobby_title($hobby_id){

return entity_value("hobbies","hobby","id",$hobby_id,$GLOBALS['hobbies_db']);

}
?>