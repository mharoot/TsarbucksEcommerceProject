<?php


/*
In this test were looking to do a table join with product display names using the product_id from a users orders. 

*/



/* load required configuaration for DBController.php */
require_once("../controllers/Orders.php"); 
include_once('../views/templates/header.php');
?>

<!-- block horizontal scrolling -->
<link rel="stylesheet" href="../assets/css/blockHorizontalScrolling.css">
<h1>Orders</h1> 
</br>

<?php new Orders(); ?>


<?php
include_once('../views/templates/footer.php');
?>