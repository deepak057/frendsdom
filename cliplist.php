<?php

include("environment.php");
check_auth();

if(!empty($_POST['flag'])){

$clips=array();

$mysqli=new mysqli($host,$db_user,$db_passwd,$soundclips_db);
if($mysqli===false)
{
die("<p>Error :".mysqli_connect_error());
}
$sql="select name,set1,clipid from soundclipsofuser{$_SESSION['userid']}";
if($result=$mysqli->query($sql))
{
if($result->num_rows>0)
{
while($row=$result->fetch_array())
{

$clips[]=array(

"name"=>$row['name'],
"clipid"=>$row['clipid'],
"set"=>$row['set1']
);

}
}
}

$change='"change"';$del='"del"';
echo "<p>Choose from already uploaded clips </p><form name='selectclip' onsubmit='return false'><select style='width:200px' name='clip'><option value='select'>..................Select clip..............</option>";
foreach($clips as $clip){
?>
<option value='<?php echo $clip['clipid'] ;?>' <?php if($clip['set']=='yes')echo "selected='selected'"; ?>><?php echo $clip['name'];?> </option>
<?php
}
echo "</select>";
echo " <p><input type='submit' class='special_btn' value='Change clip' onclick='changeclip(".$change.");'>&nbsp;<input class='special_btn red_bg' type='submit' value='Delete' onclick='changeclip(".$del.");' ></p></form>";
echo "<p style='margin-top:30px'><b>OR</b></p><p> Upload a new one</p><form action='waveclipupload.php' method='post' enctype='multipart/form-data' target='upload_target' onsubmit='startUpload();'><input type='file' name='uploaded_file' size='30'/>&nbsp;<input class='special_btn' type='submit' value='Upload'/></form>
<div class='center' style='margin:40px 0px 10px -55px;'>
<input type='button' id='btn' value='Close' onclick='fade()'>
</div>";

}
?>