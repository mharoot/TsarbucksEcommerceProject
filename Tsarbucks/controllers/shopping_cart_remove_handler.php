<?php
$path = '/';
$day = 86400; // 86400 = 1 day
$cookie_name = 'shopping_cart_items';

if ( !isset($_POST['product_id']) || !isset($_POST['quantity']) || !isset($_COOKIE[$cookie_name]) ) { 
    return 1;
}
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$items = json_decode($_COOKIE[$cookie_name],TRUE); // turns to php assoc array
    

$n = sizeof($items);
for ($i = 0; $i < $n; $i++) {
    $key = $items[$i]['product_id'];
    $quantity = $items[$i]['quantity'];
    if ($key == $product_id) { // duplicate found just change the quantity update the cookie.
        array_splice($items, $i, 1); // removes at offest $i up to 1 element
        setcookie($cookie_name, json_encode($items), time()+$day, $path);
        break;
    }
}



?>