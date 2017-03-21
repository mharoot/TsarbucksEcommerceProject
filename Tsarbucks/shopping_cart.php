<?php
include_once('views/templates/header.php');
$cookie_name = 'username';
if(!isset($_COOKIE[$cookie_name])) 
{
    // redirect to the home page and then exit the script
    header('Location: index.php');
    exit();
} 
?>
<!-- block horizontal scrolling -->
<link rel="stylesheet" href="assets/css/blockHorizontalScrolling.css">
<h1>Shopping Cart</h1> 
</br>
<div class="row">
    <div class="col-md-9">
        <table class="table table--striped table--bordered table--padded table--hover">
            <thead>
                <tr><th>Products</th> 
                <th>Price</th> 
                <th>Quantity</th> 
                <th>Remove</th>
            </tr></thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<br></br>
<div class="row">
    <p id="shopping_cart_total"></p>
    <button id ="submit_order" type="button" class="btn btn-success">Submit</button>
    <script src="views/js/shopping_cart.js"></script>
</div>

<?php
include_once('views/templates/footer.php');
?>