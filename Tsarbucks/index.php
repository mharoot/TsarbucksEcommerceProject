<?php
include_once('views/templates/header.php');
?>
    <h1>Home</h1>
<?php
$cookie_name = 'username';
if(!isset($_COOKIE[$cookie_name])) 
{  
?>
    <p><a href="login.php">Login</a> or leave.</p>
<?php 
} else {

    $role = $_SESSION['role']; // session_start() is in header. session_write_close() is in footer.

    if ($role == 'customer') {
?>
    <p><a href="menu.php">Buy something </a>or<a class="logout" href="#"> get out.</a></p>
<?php
    } else if ($role == 'barista') {
?>
     <p><a href="orders.php">Make something </a>or<a class="logout" href="#"> get out.</a></p> 
<?php   
    }
}
include_once('views/templates/footer.php');
?>


