<html>
<head>
<style type="text/css">
.small{

font-size:12px;

}

.grey{

color:grey;

}
</style>

</head>
<body>

<header>
<h3><?php echo Yii::app()->name; ?></h3>
<hr/>
</header>

<div><?php echo $content; ?></div>

<footer>
<br/>
<hr/>

<p class="small grey"><?php echo Yii::app()->name; ?> &copy; <?php echo helpers::current_year(); ?></p>

</footer>

</body>
</html>