<?php
$cookie_name = "number_of_items_in_cart";
$cookie_value = 1;
$path = '/';
$day = 86400; // 86400 = 1 day
if (isset($_COOKIE[$cookie_name])) {
    $cookie_value = $_COOKIE[$cookie_name] + 1;
}

/* saved into cookie */
setcookie($cookie_name, $cookie_value, time() + ($day * 30), $path);

echo $cookie_value;



if ( !isset($_POST['product_id']) || !isset($_POST['price']) ) { 
    return 1;
}

$cookie_name = 'shopping_cart_items';
$product_id = $_POST['product_id'];
$price = $_POST['price'];
$quantity = 1;
$item = array('product_id' =>$product_id, 'price' =>$price, 'quantity' =>$quantity);
$items = array();
if ( !isset($_COOKIE[$cookie_name])) {
    $items = array(0 =>$item);
    setcookie($cookie_name, json_encode($items), time()+$day, $path);
} else {
    $duplicate_items = false;
    $items = json_decode($_COOKIE[$cookie_name],TRUE);
    

    /*end of output*/
    $n = sizeof($items);
    for ($i = 0; $i < $n; $i++) {
        $key = $items[$i]['product_id'];
        $quantity = $items[$i]['quantity'];
        if ($key == $product_id) { // duplicate found just change the quantity update the cookie.
            $items[$i]['quantity'] = $quantity + 1;
            setcookie($cookie_name, json_encode($items), time()+$day, $path);
            $duplicate_items = true;
            break;
        }
    }
    if(!$duplicate_items) { // no duplicates of the items
        array_push($items, $item);
        setcookie($cookie_name, json_encode($items), time()+$day, $path);
    }
}



function logObject($items) {
    # open your file with append, read, write perms
    # (be sure to check your file perms)
    $fp=fopen('log.php','a+');
    
    # write output to file & close it
    fwrite($fp, var_export($items, true));
    fclose($fp);
}

?>