<?php
/*
Testing the accuracy of new Orders() Stored procedure... 

The following test is successfull.
*/





/* load required configuaration for DBController.php */
require_once("../controllers/Orders.php"); 
include_once('../views/templates/header.php');
?>

<!-- block horizontal scrolling -->
<link rel="stylesheet" href="../assets/css/blockHorizontalScrolling.css">
<h1>Orders</h1> 
</br>
<div class="row">
    <div class="col-md-9">
        <table class="table table--striped table--bordered table--padded table--hover">
            <thead>
                <tr><th>Products</th> 
                <th>Price</th> <!-- given by a join with product_id to products table total of each order is calculated at run time.-->
                <th>Quantity</th> 
                <th>Status</th>
            </tr></thead>
            <tbody>
            <?php new Orders(); ?>
            </tbody>
        </table>
    </div>
</div>
<br></br>
<div class="row">
    <p id="shopping_cart_total"></p>
</div>

<?php
include_once('../views/templates/footer.php');
?>