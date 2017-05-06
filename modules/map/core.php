<?php
//including system environment

function calculate_online_users()
{
$connect = mysql_connect($GLOBALS['host'], $GLOBALS['db_user'],$GLOBALS['db_passwd']) or die ("unable to connect");
mysql_select_db(database('frendryg_userinfo'), $connect);

//one query for every possible processing
$result = mysql_query(
"SELECT ccode, count(*) as cnt
FROM countries LEFT JOIN userdata
ON countries.country = userdata.country
GROUP BY userdata.country
HAVING count(*) > 0
ORDER BY `countries`.`ccode` ASC");

//returns
$returns = array();
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$returns[$row['ccode']] = $row['cnt'];
}

return json_encode($returns);
}
 ?>