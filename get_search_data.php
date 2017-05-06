<?php

if(!empty($_POST['page']))
{

//including required file
include("environment.php");

//retrieving data
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 12;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

//manipulating query string
$query=$_POST['q'];
$query=htmlentities(trim($query));
$userid=$query;
$query="%".$query."%";
$query=entryfordatabase($query);

//connecting to database
$con=mysql_connect($host,$db_user,$db_passwd);
mysql_select_db($selected_db,$con);

//calculating number of paginations
$query_pag_num ="SELECT COUNT(*) AS id FROM userdata where account_status='open' AND to_be_found_on_search=1 AND ($query LIKE concat('%', first, '%') AND $query LIKE concat('%', last, '%') or first like $query or last like $query or user_id like $query or city like $query or state like $query or country like $query)";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['id'];
$no_of_paginations = ceil($count / $per_page);

//displaying data
$query_pag_data="select * from userdata where account_status='open' AND to_be_found_on_search=1 AND ($query LIKE concat('%', first, '%') AND $query LIKE concat('%', last, '%') or first like $query or last like $query or user_id like $query or city like $query or state like $query or country like $query) LIMIT $start, $per_page";

$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
$msg = "";
?>

<div class="search-results-grid center">
<div class="fd-notification">
<?php echo $count;?> match(s) found for your query <b>'<?php echo $_POST['q'];?>'</b>
</div>
<div class="data">
<ul>

<?php

while ($row = mysql_fetch_array($result_pag_data)) {

?>

<li>
<div class="sr-user-pic-container"><a href="<?php echo get_profile_url($row['id']); ?>"><img class="sr-user-pic" src="<?php echo get_thumb($row['id'],200,200); ?>"/></a></div>
<div>
<a href="<?php echo get_profile_url($row['id']); ?>"><?php echo ucwords(tunethename($row['first']." ".$row['last'],18)); ?></a>
</div>
<div class="grey">
<?php echo country_name($row['country']);?>
</div>
</li>
<?php
}
?>
</ul>
<div class="clear"></div>
</div>
</div>
<?php

/* ---------------Calculating the starting and ending values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='special_btn active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='special_btn inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='special_btn active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive special_btn '>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#000;' class='active special_btn '>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active special_btn '>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active special_btn'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive special_btn'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active special_btn'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive special_btn'>Last</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
echo $msg;
}

?>