
<?php

session_start();
// Unset all of the session variables.
$_SESSION = array();
session_destroy();

//unset all cookies - or make exceptions.
/*
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
*/

setcookie('username', '', time()-1000);
setcookie('username', '', time()-1000, '/');


echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Tsarbucks/index.php';

//$_SERVER['SERVER_NAME'].'/Tsarbucks/';


//echo $_SERVER['SCRIPT_NAME'];


?>