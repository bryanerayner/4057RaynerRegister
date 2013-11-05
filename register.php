<?php
//All the code to process the form goes up here


include "includes/db.inc.php";

if (isset($_POST["btnSubmit"])
{
    $valid = true;

    //Test for empty fields.

    if (!isset($_POST["email"]) || empty($_POST["email"]) || strlen($_POST["email"]) < 1)
    {
        $valid = false;
        $output .= "<p>Email was empty</p>";
    }    
    if (!isset($_POST["firstname"]) || empty($_POST["firstname"]) || strlen($_POST["firstname"]) < 1)
    {
        $valid = false;
        $output .= "<p>First name was empty</p>";
    }    
    if (!isset($_POST["lastname"]) || empty($_POST["lastname"]) || strlen($_POST["lastname"]) < 1)
    {
        $valid = false;
        $output .= "<p>Last name was empty</p>";
    }    
    if (!isset($_POST["pass"]) || empty($_POST["pass"]) || strlen($_POST["pass"]) < 1)
    {
        $valid = false;
        $output .= "<p>Password was empty</p>";
    }    
    if (!isset($_POST["pass2"]) || empty($_POST["pass2"]) || strlen($_POST["pass2"]) < 1)
    {
        $valid = false;
        $output .= "<p>Password 2 was empty</p>";
    }

    if (!$valid)
    {
        echo $output;
    }else
    {
        //Validate the password
        if ($_POST['pass'] != $_POST['pass2'])
        {
            $valid = false;
            $output .= "<p>Passwords didn't match</p>";
        }

        if (!is_numeric($_POST["usertype"]))
        {
            $valid = false;
            $output .= "<p>Invalid usertype</p>";
        }

        if ($valid)
        {
            $email = trim($_POST["email"]);
            $pwd = trim($_POST["pass"]);

            $sql = "INSERT INTO mtm4057_save_user_types ('email', 'first_name', 'last_name', 'user_type', 'pass') VALUES ('" . $email . "','" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $_POST["user_type"] . "','". $_POST["pass"] ."')";

            $ret = $link->query($sql);
        }else
        {
            echo $output;
        }
    }

    $link = null;
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
        <section class="main">
        	<h2>User Registration</h2>
            <?php
			//The user feedback should be written here AFTER the form is submitted and the data INSERTed into the database
			
			
            ?>
            <p>How would you like to register on this site? Please provide an email, password, first and last name. Passwords must be between 8 &amp; 20 characters long.</p>
            <form autocomplete = "off" action="register.php" method="post" enctype="application/x-www-form-urlencoded">
            	<div class="formbox">
                	<label for="email">E-mail</label>
                    <input type="email" name="email" id="email" autocomplete="off" required placeholder="Your e-mail address" />
                </div>
                <div class="formbox">
                	<label for="pass">Password</label>
                    <input required type="password" name="pass" id="pass" />
                </div>
                <div class="formbox">
                	<label for="pass2">Re-type Password</label>
                    <input required type="password" name="pass2" id="pass2" />
                </div>
                <div class="formbox">
                	<label for="firstname">First Name</label>
                    <input required type="text" name="firstname" id="firstname" />
                </div>
                <div class="formbox">
                	<label for="lastname">Last Name</label>
                    <input required type="text" name="lastname" id="lastname"  />
                </div>
                <div class="formbox">
                	<label for="usertype">Account Type</label>
                    <select required name="usertype" id="usertype">
                    <?php
					//Generate the list of user types
                    include "includes/userTypeList.php";
					?>
                    </select>
                </div>
                <div class="formbox buttons">
                	<input required type="submit" name="btnSubmit" id="btnSubmit" value="Register" />
                </div>
            </form>
        </section>
        <footer class="footer">
        	<p>&copy; Chicken Stuff Inc.</p>
        </footer>
    </div>
</body>
</html>