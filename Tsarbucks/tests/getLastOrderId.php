<?php

/* load required configuaration for DBController.php */
require_once("../config/database.php"); 
/* load database access class */
require_once("../models/DBController.php");  
/* load stored procedure varaibles */
require_once("../config/stored_procedures.php");
/* create instance of database access class */
$db_handler = new DBController();



/*get last order id */
$db_handler->query(SP_GET_LAST_ORDER_ID);
$order_id_assoc = $db_handler->single();
$order_id = $order_id_assoc['order_id'] + 1;

echo 'order_id: '.$order_id.'</br>';
$cookie_name = 'shopping_cart_items';
if (!isset($_COOKIE[$cookie_name])) {
    echo 'nothing in shopping cart cookie, add something to begin test.';
    return 1;
}

$items = json_decode($_COOKIE[$cookie_name],TRUE);


foreach ($items as $item) {
    $product_id = $item['product_id'];
    $quantity   = $item['quantity'];
    echo 'product_id: '.$product_id.'</br>';
    echo 'quantity: '.$quantity.'</br>';
    // to do insert into orders table
}

session_start();
echo "something: ".$something = $_SESSION["user_id"]; // return customer role from ajax call in login.php
session_write_close();

?>