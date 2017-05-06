<?php

include("includes.php");

//get details for supplied movie id
$details=$movies->get_content($_POST['m_id'],1);
?>

<?php if($details->tagline){?>
<div style="margin:5px 0px"><b><?php echo $details->tagline; ?></b></div>
<?php
}
?>

<div style="margin:5px 0px"><?php echo $details->overview; ?></div>
<?php if($details->genres){?>
<div><b>Generes:</b>
<?php
foreach ($details->genres as $k=>$genre){
if($k>0)echo ",";
echo $genre->name;
}
?>
</div>
<?php
}
if($details->budget){?>
<div><b>Budget:</b> $ <?php echo $details->budget; ?></div>
<?php
}
if($details->revenue){?>
<div><b>Revenue:</b> $ <?php echo $details->revenue; ?></div>
<?php
}
if($details->runtime){?>
<div><b>Runtime:</b> <?php echo $details->runtime; ?> min</div>
<?php
}

?>