<?php include_once('core.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Frendsdom's Heartbeat - Online</title>
 <link rel="stylesheet" href="modules/map/res/jquery-jvectormap-1.1.1.css" type="text/css" media="screen"/>
 <link rel="stylesheet" type="text/css" href="css8.css"/>
  <script src="modules/map/res/jquery-1.7.min.js"></script>
  <script src="modules/map/res/jquery-jvectormap-1.1.1.min.js"></script>
  <script src="modules/map/res/jquery-jvectormap-world-mill-en.js"></script>
</head>
<body>
<div class="nav">
<?php 
include("modules/nav/nav.php");
$nav=new nav();
$nav->get_nav_3();
?>
</div>
<div class="map-loader" style="position: relative;top: 90px;">
<div id="map" style="width: 1000px; height: 600px;margin:0 auto;"></div>
</div>

 <script>
 var data = <?php echo calculate_online_users();?>;
   $('#map').vectorMap({
  map: 'world_mill_en',
  series: {
    regions: [{
      values: data,
      scale: ['#C8EEFF', '#0071A4'],
      normalizeFunction: 'polynomial'
    }]
  },
  onRegionLabelShow: function(e, el, code){
	  var num =0;
	  if(data[code] != undefined)
	  num = data[code];
	  
    el.html(el.html()+' (Online - '+num+')');
  }
});
  </script>
</body>
</html>