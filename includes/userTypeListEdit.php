<?php

require_once "db.inc.php";

$mySelect = "SELECT * FROM mtm4057_save_user_types";

//echo '<option>'. $mySelect . '</option>';

$output = "";

$save_user_types = $pdo->query($mySelect);

if ($save_user_types)
{
	$count = $save_user_types->rowCount();

	$userTypes = array();

	//echo '<option>'.$count.'</option>';
	for ($i = 0; $i < $count; $i++)
	{
		$userTypes[] = $save_user_types->fetch(PDO::FETCH_ASSOC);		
	}
}
else
{

	  
}

?>