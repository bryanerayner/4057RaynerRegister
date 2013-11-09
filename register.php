<?php
//All the code to process the form goes up here


include "includes/db.inc.php";


$success = "";

$errors = array();

if (isset($_POST["btnSubmit"]))
{
    $valid = true;

    //Test for empty fields.

    

    if (!isset($_POST["email"]) || empty($_POST["email"]) || strlen($_POST["email"]) < 1)
    {
        $valid = false;
        $errors["email"] = '<div class = "feedback error"><p>Please enter a valid email address.</p></div>';
    }    
    if (!isset($_POST["firstname"]) || empty($_POST["firstname"]) || strlen($_POST["firstname"]) < 1)
    {
        $valid = false;
        $errors["firstname"] = '<div class = "feedback error"><p>Please enter your first name.</p></div>';
    }    
    if (!isset($_POST["lastname"]) || empty($_POST["lastname"]) || strlen($_POST["lastname"]) < 1)
    {
        $valid = false;
        $errors["lastname"] = '<div class = "feedback error"><p>Oops! You forgot to enter your last name.</p></div>';
    }    
    if (!isset($_POST["pass"]) || empty($_POST["pass"]) || strlen($_POST["pass"]) < 1)
    {
        $valid = false;
        $errors["pass"] = '<div class = "feedback error"><p>Please enter your password.</p></div>';
    }    
    if (!isset($_POST["pass2"]) || empty($_POST["pass2"]) || strlen($_POST["pass2"]) < 1)
    {
        $valid = false;
        $errors["pass2"] = '<div class = "feedback error"><p>Please fill out the password confirmation.</p></div>';
    }

    
    //Validate the password
    $pwdLen = strlen($_POST['pass']);
    if ($pwdLen > 20 || $pwdLen < 8)
    {
        $valid = false;
        $errors["pass"] = '<div class = "feedback error"><p>Password must be between 8 & 20 characters.</p></div>';
    }

    if ($_POST['pass'] != $_POST['pass2'])
    {
        $valid = false;
        $errors["pass2"] = '<div class = "feedback error"><p>Passwords must match.</p></div>';
    }

    if (!is_numeric($_POST["usertype"]))
    {
        $valid = false;
        $errors["usertype"] = '<div class = "feedback error"><p>Please choose a user type.</p></div>';
    }
    

    if ($valid)
    {
        $email = trim($_POST["email"]);
        $pwd = trim($_POST["pass"]);
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $usertype = $_POST["usertype"];
        

        $sql = "INSERT INTO  `mtm4057_save_users` (  `email` ,  `first_name` ,  `last_name` ,  `user_type` , `pass` ) VALUES ( '".$email."',  '".$firstname."',  '".$lastname."',  '".$usertype."',  '".$pwd."' )";


        $ret = $link->query($sql);

        if ($ret)
        {

        $success = '<div class = "feedback success"><p>Successful Registration</p></div>';    
        }else
        {
            $success = '<div class = "feedback error"><p>Unsuccesful Registration</p></div>';    
        }

        
    }else
    {
        $success = '<div class = "feedback error"><p>There were errors with your submission. Please check the issues below and resubmit. </p></div>';    
    }
    

    

    
}

function printError($msg)
{
    global $errors;

    if (isset($errors[$msg]))
    {
        echo $errors[$msg];
    }
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Registration</title>
    <link href="register.css" rel="stylesheet" />
</head>

<body>
	<div class="wrapper">
    	<header class="masthead">
        	<h1>Online Forum</h1>
        </header>
        <section class="main clearfix">
        	<h2>User Registration</h2>
            <?php
			//The user feedback should be written here AFTER the form is submitted and the data INSERTed into the database
			echo $success;
			
            ?>
            <p>How would you like to register on this site?<br> Please provide an email, password, first and last name.<br> Passwords must be between 8 &amp; 20 characters long.</p>
            <form autocomplete = "off" action="register.php" method="post" enctype="application/x-www-form-urlencoded">
            	<div class="formbox">
                	<label for="email">E-mail</label>
                    <input type="email" name="email" id="email" autocomplete="off" placeholder="Your e-mail address" />
                    <?php printError("email"); ?>
                </div>
                <div class="formbox">
                	<label for="pass">Password</label>
                    <input type="password" name="pass" id="pass" placeholder = "Between 8 &amp; 20 characters"/>
                    <?php printError("pass"); ?>
                </div>
                <div class="formbox">
                	<label for="pass2">Re-type Password</label>
                    <input type="password" name="pass2" id="pass2" placeholder = "Retype password" />
                    <?php printError("pass2"); ?>
                </div>
                <div class="formbox">
                	<label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" />
                    <?php printError("firstname"); ?>
                </div>
                <div class="formbox">
                	<label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname"  />
                    <?php printError("lastname"); ?>
                </div>
                <div class="formbox">
                	<label for="usertype">Account Type</label>
                    <select name="usertype" id="usertype">
                    <option value = "null">Please Select</option>
                    <?php
					//Generate the list of user types
                    include "includes/userTypeList.php";
					?>
                    </select>
                    <?php printError("usertype"); ?>
                </div>
                <div class="formbox buttons">
                	<input type="submit" name="btnSubmit" id="btnSubmit" value="Register" />
                </div>
            </form>
        </section>
        <footer class="footer">
        	<p>&copy; Chicken Stuff Inc.</p>
        </footer>
    </div>
</body>
</html>
<?php
$link = null;
?>