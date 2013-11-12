<?php

require_once "db.inc.php";

$mySelect = "SELECT * FROM mtm4057_save_user_types";

//echo '<option>'. $mySelect . '</option>';

$output = "";

$save_user_types = $pdo->query($mySelect);

if ($save_user_types)
{
	//echo '<option>'.$save_user_types.'</option>';

	

	//echo '<option>$output '.$output.'</option>';

	$count = $save_user_types->rowCount();


	//echo '<option>'.$count.'</option>';
	for ($i = 0; $i < $count; $i++)
	{
		$row = $save_user_types->fetch(PDO::FETCH_ASSOC);

		$output = $output . '<option value = "' . $row["type_id"] . '">' . $row["type_name"] . '</option>';
	}
}
else
{

	  $errorArray = $save_user_types->errorInfo();
	  echo "<option>The error code is " . $errorArray[0] . "</option>";
	  for ($i = 0; $i < count($errorArray); $i = $i + 1) {
		  echo "<option>The error code is " . $errorArray[$i] . "</option>";
	  }


}

echo $output;

?>