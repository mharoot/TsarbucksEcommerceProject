<?php
$username = '';
$password = '';

// if the user has provided the username and password
if ( isset($_POST['username']) && isset($_POST['password']) ) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
} else {
    echo 'Please enter username and password';
    return 1;
}

/* 
    begin search for user if found return the entire row and compare the sha1 hash codes.  if they match continue else echo 'Username or Password Incorrect';
*/

/* load required configuaration for DBController.php */
require_once("../config/database.php"); 
/* load database access class */
require_once("../models/DBController.php");  
/* load stored procedure varaibles */
require_once("../config/stored_procedures.php");
/* create instance of database access class */
$db_handler = new DBController();



/* begin search for user */
$db_handler->query(SP_GET_ROW_WITH_ROLE_BY_USERNAME);

/*
    bind username with a PDO sort of sanitation but not really it just prevents the nasty stuff from breaking the sql compiler.
 */
$db_handler->bind(':username', $username, PDO::PARAM_INT);

/* fetch a single user row into an associative array*/
$user_row_result = $db_handler->single();

/* user is not found */
if (sizeof($user_row_result) == 0) {
    //echo '<b><font color="red">username or password is incorrect</font></b>';
    ?>
        <b><font color="red">username or password is incorrect</font></b
    <?php
    return 1;
}

/* user is found check if the sha1() hashed password matches the one in the database */
if ($password != $user_row_result['password']) {
    //echo '<b><font color="red">username or password is incorrect</font></b>';
     ?>
        <b><font color="red">username or password is incorrect</font></b>
    <?php
    return 1;
}


/* saving users 'display name'(from sql query) into associative array $_SESSION */                
session_start();
$_SESSION['user_id']  = $user_row_result['user_id'];
$_SESSION['username'] = $user_row_result['username'];
$_SESSION["display_name"] = $user_row_result['display_name'];
$_SESSION["role"]     = $user_row_result['role'];
echo $_SESSION["role"]; // return customer role from ajax call in login.php
session_write_close();



/* saved login into cookie*/
$cookie_name = "username";
$cookie_value = sha1($username);
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

// refrence for later use: foreach($db_handler->resultset() as $rows) echo $rows['order_id'];




?>