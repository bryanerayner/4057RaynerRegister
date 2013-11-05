<?php

include "db.inc.php";

$mySelect = "SELECT * FROM mtm4057_save_user_types";


$save_user_types = $link->query($mySelect);


$output = "";

$count = $save_user_types->rowCount();
for ($i = 0; $i < $count; $i++)
{
$row = $save_user_types->fetch(PDO::FETCH_ASSOC);

$output = $output . '<option value = "' . $row["type_id"] . '">' . $row["type_name"] . '</option>';
}


echo $output;


$link = null;