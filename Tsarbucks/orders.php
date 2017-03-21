<?php
$cookie_name = 'username';
if(!isset($_COOKIE[$cookie_name])) 
{
    // redirect to the home page and then exit the script
    header('Location: index.php');
    exit();
}

/* load required configuaration for DBController.php */
require_once("controllers/Orders.php"); 
include_once('views/templates/header.php');
?>

<!-- block horizontal scrolling 
<link rel="stylesheet" href="assets/css/blockHorizontalScrolling.css">
-->
<h1>Orders</h1> 
</br>

<?php new Orders(); ?>


<?php
include_once('views/templates/footer.php');
?>