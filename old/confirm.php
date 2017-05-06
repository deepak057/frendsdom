<?php

if(!empty($_POST['first'])&& !empty($_POST['last'])&& !empty($_POST['sex'])&& !empty($_POST['day'])&& !empty($_POST['month'])&& !empty($_POST['year'])&& !empty($_POST['email'])&& !empty($_POST['pass1'])&& !empty($_POST['pass2'])&& !empty($_POST['country'])&& !empty($_POST['state'])&& !empty($_POST['city']))
{

include('/home/frendryg/FunctionList.php');
set_error_handler('errorHandler');

//function to remove data provided in case of failure to create account
function removeLeftoverData($email){$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="select id from userdata where user_id='{$email}'";if($result=$mysqli->query($sql)){if($result->num_rows>0){while($row=$result->fetch_array()){if(!empty($row['id']))$id=$row['id'];}}else $id=null;}if(!empty($id)){$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("Could not connect to database");}$sql="delete from userdata where id={$id}";if($mysqli->query($sql)===false){}
$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="drop table msgboxofuser{$id}";if($mysqli->query($sql)===true){}$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="drop table sentboxofuser{$id}";if($mysqli->query($sql)===true){}$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="drop table user{$id}";if($mysqli->query($sql)===true){}$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="drop table nudgeboxofuser{$id}";if($mysqli->query($sql)===true){}$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("<p>Error :".mysqli_connect_error());}$sql="drop table soundclipsofuser{$id}";if($mysqli->query($sql)===true){}$userdir="user_data\\".$id;if(file_exists($userdir)){removeDir($userdir);}return true;}return true;}
//function to display the message in case of failure
function diemsg($email){if(removeLeftoverData($email)){echo "<b>Error:</b> Failed to create your database</br><a href='http://localhost/signup.php'>You can try again</a>";die("");}}

//retreiving data required to be verified first
$day=htmlentities(trim($_POST['day']));
$month=htmlentities(trim($_POST['month']));
$year=htmlentities(trim($_POST['year']));
$email=htmlentities(trim($_POST['email']));
$pass1=htmlentities(trim($_POST['pass1']));
$pass2=htmlentities(trim($_POST['pass2']));

if(checkdate ($month ,$day ,$year ) && ($pass1==$pass2) && checkemail($email) && validemail($email))
{
$first=entryfordatabase(ucwords(htmlentities(trim($_POST['first']))));
$last=entryfordatabase(ucwords(htmlentities(trim($_POST['last']))));
$sex=$_POST['sex'];
$country=ucwords(htmlentities(trim($_POST['country'])));
$state=ucwords(htmlentities(trim($_POST['state'])));
$city=ucwords(htmlentities(trim($_POST['city'])));

//encrypting password by sha1 algorithm
$pass=sha1($pass1);

$data=sha1(md5(date('Y-m-d H:i:s')."_{$pass}_{$email}"));
//connecting to database
$mysqli=new mysqli("localhost","frendryg_root","#Pooja1957_root","frendryg_userinfo");if($mysqli===false){die("Could not connect to database");}

//inserting data into table userdata
if($mysqli->query("insert into userdata (user_id,first,last,sex,day,month,year,password,country,state,city,created,email_verified) values('{$email}',$first,$last,'{$sex}','{$day}','{$month}','{$year}','{$pass}','{$country}','{$state}','{$city}','".date('Y-m-d H:i:s')."','{$data}')")===false)
{
diemsg($email);
}

//retreiving unique id of newly created user
if($result=$mysqli->query("select id from userdata where user_id='{$email}'")){if($result->num_rows>0){while($row=$result->fetch_array()){$id=$row['id'];}}}


//crating additional required tables 
if($mysqli->query("create table user{$id} (`No` Int Unsigned Not Null Auto_Increment,primary key(No),type varchar(20),requestid varchar(30),friendid varchar(30),familyid varchar(30),colid varchar (30),aquid varchar(30),noid varchar(30),listid varchar(30),points varchar(20),when1 datetime)")){

//creating news4user table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$news_db);
if(!$mysqli->query("create table news4user{$id} (news_id Int Unsigned Not Null Auto_Increment,primary key(news_id),news text(100),from_id varchar(20),when1 datetime,viewed Boolean default '0',viewed_on datetime)"))
{
echo "Error: failed to create news4user table ";
}

//creating sboxofuser table
$mysqli=new mysqli($host,$db_user,$db_passwd,$share_box_db);
if(!$mysqli->query("create table sboxofuser{$id} (share_index Int Unsigned Not Null Auto_Increment,primary key(share_index),share_title varchar(200) not null default 'New share',share_data text(500) not null,share_pic_name varchar(100),share_pic_data MediumBlob,share_pic_type varchar(15),share_pic_size varchar(15),share_id varchar(200) not null,created datetime)"))
{
echo "Error: failed to create sbox table";
}


//creating piccollection4user table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$pic_collection_record_db);
if(!$mysqli->query("create table piccollection4user{$id} (collection_index Int Unsigned Not Null Auto_Increment,primary key(collection_index),collection_name varchar(200) not null default'New collection',collection_id varchar(200) not null,created datetime)"))
{
echo "Error: failed to create piccollection4user table ";
}

//creating profilefeedback4user table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$feedback_to_profile_db);
if(!$mysqli->query("create table profilefeedback4user{$id} (fromid varchar(20),primary key(fromid),feedback1 varchar(20),when1 datetime)"))
{
echo "Error: failed to create profilefeedback4user table ";
}

//creating profilecomments4user table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$comment_on_profile_db);
if(!$mysqli->query("create table profilecomments4user{$id}(comment_no Int Unsigned Not Null Auto_Increment,primary key(comment_no),fromid varchar(20) not null,comment text(5000),when1 datetime)"))
{
echo "Error: failed to create profilecomments4user table ";
}

//creating authorityrecpients table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$authority_recpients_db);
if(!$mysqli->query("create table authorityrecpients4user{$id} (recpient_id varchar(20),when1 datetime,last_change_made datetime,requested datetime,request_from varchar(20))")) 
{
echo "Error : failed to create authorityrecpients table";
}

//creating autoresponses4user table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$autoresponses_db);
if(!$mysqli->query("create table autoresponses4user{$id} (response_index Int Unsigned Not Null Auto_Increment,primary key(response_index),feedback varchar(20) not null,response varchar(200))") || !$mysqli->query("insert into autoresponses4user{$id} (feedback,response) values('like','Thank you for your feedback!'),('dislike','Thank you for your feedback!'),('love','Thank you for your feedback!'),('hate','Thank you for your feedback!'),('stupid','Thank you for your feedback!'),('awesom','Thank you for your feedback!'),('alterd','Thank you for your feedback!'),('likeminded','Thank you for your feedback!'),('best','Thank you for your feedback!')")) 
{
echo "Error : failed to create autoresponse table";
}


//creating soundclip table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$soundclips_db);
if(!$mysqli->query("create table soundclipsofuser{$id} (`id` Int Unsigned Not Null Auto_Increment,`name` VarChar(255) Not Null Default 'Untitled.txt',`mime` VarChar(50) Not Null Default 'text/plain',`size` BigInt Unsigned Not Null Default 0,`data` MediumBlob Not Null,`created` DateTime Not Null,set1 varchar(5),clipid varchar(200) not null, PRIMARY KEY (`id`))")) 
{
echo "Error : failed to create soundclip table";
}

//creating msgbox table  
$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_inbox);
if(!$mysqli->query("create table msgboxofuser{$id} (msg_no Int Unsigned Not Null Auto_Increment,primary key(msg_no),from1id varchar(20) not null,msg text(5000),title1 text(1000), when1 datetime,read1 varchar(5) not null default 'no',read2 varchar(5) not null default 'no',msgid varchar (25))"))
{
echo "Error : failed to create msgbox table";
}

//creating sentbox table
$mysqli=new mysqli($host,$db_user,$db_passwd,$msg_sentbox);
if(!$mysqli->query("create table sentboxofuser{$id} (msg_no Int Unsigned Not Null Auto_Increment,primary key(msg_no),to1id varchar(20) not null,msg text(5000),title1 text(1000), when1 datetime,msgid varchar(25))"))
{
echo "Error : failed to create sentgbox table";
}

//creating nudgebox table
$mysqli=new mysqli($host,$db_user,$db_passwd,$nudgeset_records);
if(!$mysqli->query("create table nudgeboxofuser{$id} (`id` Int Unsigned Not Null Auto_Increment,`fromid` VarChar(50) Not Null ,`fromname` VarChar(50) Not Null ,`viewed` varchar (5) default 'no',`nudgeset` varchar(100) not null, PRIMARY KEY (`id`))"))
{
echo "Error : failed to create nudgebox table";
}

//creating eyecandy_pic table
$mysqli=new mysqli($host,$db_user,$db_passwd,$eyecandy_db);
if(!$mysqli->query("create table eyecandy_pics_of_user{$id} (pic_index Int Unsigned Not Null Auto_Increment,primary key(pic_index),pic_name varchar(100),pic_data MediumBlob,pic_data_thumb Blob,pic_type varchar(15),pic_size varchar(15),pic_id varchar(200) not null,created datetime,belongs_to_id varchar(20) not null,is_set boolean not null default 0)"))
{
echo "Error : failed to create nudgebox table";
}

//creating posts_record table
$mysqli=new mysqli($host,$db_user,$db_passwd,$posts_db);
if(!$mysqli->query("create table posts_record_of_user{$id} (post_index int unsigned not null auto_increment primary key,post_id varchar(35) not null ,post_content text(1000),pic_id varchar(35),created datetime,public boolean not null default 0,relations varchar(20) not null default 'fr,col,fam,aqu,npa',excluded text(500))"))
{
echo "Error : failed to create posts_record table";
}

//inserting data into configuration table
$mysqli=new mysqli($host,$db_user,$db_passwd,$conf_db);
if(!$mysqli->query("insert into user_conf (id) values({$id})"))
{
echo "Error : failed to set default configuration";
}

//creating status_view table
$mysqli=new mysqli($host,$db_user,$db_passwd,$status_view_db);
if(!$mysqli->query("create table status_view_of_user{$id} (status_index bigint unsigned not null auto_increment primary key,fromid bigint unsigned not null,post_id varchar(35) not null )"))
{
echo "Error : failed to create posts_record table";
}


//creating other_conf table
$mysqli=new mysqli($host,$db_user,$db_passwd,$other_conf_db2);
if(!$mysqli->query("create table conf_for_user{$id} (option_id bigint unsigned auto_increment primary key,`option` varchar(50) not null,`value` varchar(100) not null)"))
{
echo "Error : failed to create posts_record table";
}



send_msg("1",$id,"Welcome to frendsdom","Hi there!!...First, You are warmely welcome on Frendsdom.com.Since we're just evolving yet , maybe you are unlikely to find your relations here. In case you don't have anybody known to you here, I have sent you an invitation. You may accept it and can then play around.So come and take a look at my profile by clicking at my name in from section above. Thank you!");
send_invitetion("1",$id,"no");
send_verification_mail($email,"id={$id}&data={$data}");
}
else {
diemsg($email);}

//user's directory where all the user related data will be stored in user_data directory
$userdir="user_data/{$id}";     

//deleting the directory already existing with same name as new user's unique id if any
if(file_exists($userdir))
{
removeDir($userdir);
}

//creating user's directory in http://localhost/user_data
if(!file_exists($userdir))                
{
if(!mkdir($userdir))
{
removeLeftoverData($email);                   
die("Error: Failed to create your directory on server</br><a href='/signup.php'>You can try again</a>");
}
}
else
{
removeLeftoverData($email);                   
die("Error: Failed to create your directory on server</br><a href='/signup.php'>You can try again</a>");
}

//if all goes fine, account is successfully created
//creating new home session in order to verify that user has successfuly registered
//session_start();
//$_SESSION["home"]="successful"; $_SESSION['userid']=$id;$_SESSION['userfulname']=user_name($id);$_SESSION['username']=$email;$_SESSION['userkey']=$pass;
?>
<div style='width:500px;'><h3><img src='thumbup.gif' align='middle'>&nbsp;<font color="green">Congratulations !! You're just one step away</font></h3><p>We have sent a confirmation link to your e-mail address. Please verify your e-mail address by clicking at that link before you can finally be able to access your account on <b>Frendsdom</b>.</br></br>Thank you for being a part of our network!</br></br><a title='Frendsdom' href='http://www.frendsdom.com'><b>Back to main page</b></a></p></div> 
<?php
}
else
{
die("<b>Error:</b> Can't create your account.</br>Please check the information provided by you carefully and make sure every bit of it is valid</br><a href='signup.php'>You can try again</a>");
}
}
else
{
session_start();
if(!empty($_SESSION['userid']))
{
header('location:home.php');
}
else
{
header('location:signup.php');
}
}
?>