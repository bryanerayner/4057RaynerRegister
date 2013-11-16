<?php
//All the code to process the form goes up here 
//There will be a collection of if statements checking for the various submit buttons in the $_POST array


require_once "includes/db.inc.php";


$clickedButton = "";
$typename = "";
$typeid = -1;
$sql = "";

$message = "";
$error = false;

if (isset($_POST["btnAdd"]))
{
    $clickedButton="add";
}
else if (isset($_POST["btnEdit"]))
{
    $clickedButton="edit";
}
else if (isset($_POST["btnDelete"]))
{
    $clickedButton="delete";
}
else if (isset($_POST["btnSave"]))
{
    $clickedButton="save";
}
else if (isset($_POST["btnCancel"]))
{
    $clickedButton="none";
}
else
{
    $clickedButton="none";
}



//Prep typeid and typename;


if (isset($_POST["typeid"]) && is_numeric($_POST["typeid"]))
{
    $typeid = $_POST["typeid"];
}
if ($clickedButton == "edit" || $clickedButton == "delete")
{
    if (isset($_POST["usertypes"]) && is_numeric($_POST["usertypes"]))
    {
        $typeid = $_POST["usertypes"];
    }
}


if (isset($_POST["typename"]))
{
    $typename = $_POST["typename"];
}else
{
    if ($typeid >= 0)
    {
        //Fetch the typename from the database

        $sql = "SELECT type_name FROM mtm4057_save_user_types WHERE type_id = '".$typeid."'";
        $result = $pdo->query($sql);

        if ($result)
        {
            $typename = $result->fetch(PDO::FETCH_ASSOC)["type_name"];
        }
    }
}


switch($clickedButton)
{
    case"add":

    break;
    case"edit":

    break;
    case"save":
        
        if (isset($typename))
        {
            $saveType = "";
            if ($typeid >= 0)
            {
                $sql = "UPDATE mtm4057_save_user_types SET type_name = '".$typename."' WHERE type_id = '".$typeid."'";
                $saveType = "updat";
            }else
            {
                $sql = "INSERT INTO mtm4057_save_user_types (type_name) VALUES ('".$typename."')";
                $saveType = "add";
            }
            
           $result = $pdo->query($sql);
           if ($result)
           {
                $message = "Succesfully ".$saveType . "ed user type '" . $typename . "'.";
           }else
           {
                $message = 'An error occured when '.$saveType . "ing user type '" . $typename . "'.";
                $error = true;
           }
        }

    break;
    case"delete":
        if ($typeid >= 0)
        {
            $sql = "DELETE FROM mtm4057_save_user_types WHERE type_id = '".$typeid."'";
        }
        $result = $pdo->query($sql);
        if ($result)
           {
                $message = "Succesfully deleted user type '" . $typename . "'.";
           }else
           {
                $message = "An error occured when deleting user type '" . $typename . "'.";
                $error = true;
           }
    break;
    case"none":

    break;
}
//DELETE


//INSERT


//EDIT


//FETCH LIST OF USER TYPES


//FETCH SINGLE USER TYPE data

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Type Management</title>
    <link href="register.css" rel="stylesheet" />
    <link href="edit.css" rel="stylesheet" />
</head>

<body>
    
	<div class="wrapper">
    	<header class="masthead">
        	<h1>Online Forum</h1>
        </header>
        <section class="main">
        	<h2>User Type Management</h2>
            <?php
			//The user feedback should be written here AFTER the form is submitted and the data INSERTed into the database


            if ($clickedButton == "save" || $clickedButton == "delete")
            { if ($message != '') 
            { 
            ?><div class = "feedback <?php echo ($error) ? 'error' : 'success'; ?> "><p><?php echo $message ?></p></div><?php    
            }
        }
            
			if ($clickedButton == "delete" || $clickedButton == "none" )
            { ?>
            <p>Welcome to the User Types administration panel. Please select a User Type to edit or delete, or, alternatively, add a new one.</p>
			<?php }

            if ($clickedButton == "add")
            { ?>
            <p>Please type in the name for the new user type.</p>
            <?php }
            
            if ($clickedButton == "edit")
            { ?>
            <p>Please type in the new name for user type "<?php echo $typename ?>".</p>
            <?php }
            

            ?>


            <?php
			//This form appears when a user clicks Add or Edit

            if($clickedButton == "add" || $clickedButton == "edit")
            {

                

			?>
            <form action="edit.php" method="post" enctype="application/x-www-form-urlencoded">
            	<legend>Add | Edit Form</legend>


                <input type="hidden" name="typeid" id="typeid" value="<?php echo $typeid ?>" />
                <div class="formbox">
                	<label for="typename">First Name</label>
                    <input type="text" name="typename" id="typename" value="<?php echo $typename ?>" />
                </div>
                
                <div class="formbox buttons">
                	<input type="submit" name="btnCancel" id="btnCancel" value="Cancel" />
                	<input type="submit" name="btnSave" id="btnSave" value="Save" />
                </div>
            </form>
            <?php } ?>
            


            <?php
			//This form appears when the page loads without ANY buttons being clicked (no $_POST data)
			//OR if the Delete button was clicked

            if($clickedButton == "delete" || $clickedButton == "none" || $clickedButton == "save")
            {

			?>
            <form action="edit.php" method="post" enctype="application/x-www-form-urlencoded">
         		<legend>Account Types</legend>
                <div class="formbox">
                	<label for="usertypes">Account Type</label>
                    <select name="usertypes" id="usertypes">
                    <option value = "-1">Select Type:</option>
                        <?php
					//PHP to dynamically build this list goes here
					//Fetch all the usertypes from the db table. type_id is the value and type_name is the text
					
                    include("includes/userTypeListEdit.php");

                    $userTypes_count = count($userTypes);

                    // foreach($userTypes as $user)
                    // {
                    //     echo '<option>'+$user[""]
                    // }

                    for ($i = 0; $i < $userTypes_count; $i ++)
                    {
                        $typeid = $userTypes[$i]["type_id"];
                        $typename = $userTypes[$i]["type_name"]; 
                        ?>
                        <option value = "<?php echo $typeid;?>"><?php echo $typename; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="formbox buttons">
                	<input type="submit" name="btnAdd" id="btnAdd" value="Add New Type" />
                	<input type="submit" name="btnEdit" id="btnEdit" value="Edit Selected Type" />
                	<input type="submit" name="btnDelete" id="btnDelete" value="Delete Selected Type" />
                </div>
            </form>
            <?php } ?>
        </section>
        <footer class="footer">
        	<p>&copy; Chicken Stuff Inc.</p>
        </footer>
    </div>
    <script src = "verify.js" type = "text/javascript"></script>
</body>
</html>