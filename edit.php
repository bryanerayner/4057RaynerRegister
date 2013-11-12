<?php
//All the code to process the form goes up here 
//There will be a collection of if statements checking for the various submit buttons in the $_POST array


require_once "includes/db.inc.php";


$clickedButton = "";


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
else
{
    $clickedButton="none";
}


switch($clickedButton)
{
    case"add":

    break;
    case"edit":

    break;
    case"delete":

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
			
			
            ?>
            <p>Please follow the instructions to fill out this form. If there are no instructions then please add some.</p>
            
            <?php
			//This form appears when a user clicks Add or Edit

            if($clickedButton == "add" || $clickedButton == "edit")
            {
			?>
            <form action="edit.php" method="post" enctype="application/x-www-form-urlencoded">
            	<legend>Add | Edit Form</legend>
                <input type="hidden" name="typeid" id="typeid" value="<?=  ?>" />
                <div class="formbox">
                	<label for="typename">First Name</label>
                    <input type="text" name="typename" id="typename" value="<?=  ?>" />
                </div>
                <div class="formbox buttons">
                	<input type="submit" name="btnCancel" id="btnCancel" value="Cancel" />
                	<input type="submit" name="btnSave" id="btnSave" value="Save" />
                </div>
            </form>
            <?php }
            ?>
            
            <?php
			//This form appears when the page loads without ANY buttons being clicked (no $_POST data)
			//OR if the Delete button was clicked

            if($clickedButton = "delete" || $clickedButton== "none")
            {
			?>
            <form action="edit.php" method="post" enctype="application/x-www-form-urlencoded">
         		<legend>Account Types</legend>
                <div class="formbox">
                	<label for="usertypes">Account Type</label>
                    <select name="usertypes" id="usertypes">
                    <?php
					//PHP to dynamically build this list goes here
					//Fetch all the usertypes from the db table. type_id is the value and type_name is the text
					
					?>
                    </select>
                </div>
                <div class="formbox buttons">
                	<input type="submit" name="btnAdd" id="btnAdd" value="Add New Type" />
                	<input type="submit" name="btnEdit" id="btnEdit" value="Edit Selected Type" />
                	<input type="submit" name="btnDelete" id="btnDelete" value="Delete Selected Type" />
                </div>
            </form>
            <?php
                }
            ?>
        </section>
        <footer class="footer">
        	<p>&copy; Chicken Stuff Inc.</p>
        </footer>
    </div>
</body>
</html>