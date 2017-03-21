<?php
/* load required configuaration for DBController.php */
require_once("../config/database.php"); 
/* load database access class */
require_once("../models/DBController.php");  
/* load stored procedure varaibles */
require_once("../config/stored_procedures.php");
/* create instance of database access class */
$db_handler = new DBController();



/* creating order id*/
$db_handler->query(SP_GET_LAST_ORDER_ID);
$order_id_assoc = $db_handler->single();
$order_id = $order_id_assoc['order_id'] + 1;

/* fetching user id*/
session_start();
$user_id = $_SESSION["user_id"];
session_write_close();


$cookie_name = 'shopping_cart_items';
if (!isset($_COOKIE[$cookie_name])) {
    return 1;
}



$items = json_decode($_COOKIE[$cookie_name],TRUE);


foreach ($items as $item) {
    $product_id = $item['product_id'];
    $quantity   = $item['quantity'];
    $db_handler->query(SP_INSERT_ORDER);
    $db_handler->bind(':order_id', $order_id, PDO::PARAM_INT);
    $db_handler->bind(':user_id', $user_id, PDO::PARAM_INT);
    $db_handler->bind(':product_id', $product_id, PDO::PARAM_INT);
    $db_handler->bind(':quantity', $quantity, PDO::PARAM_INT);
    //:completed, :created_at, :updated_at taken care of in query..
    echo $db_handler->execute();
    // to do insert into orders table
}






function logObject($items) {
    # open your file with append, read, write perms
    # (be sure to check your file perms)
    $fp=fopen('log.php','a+');//was .txt before php works good too
    
    # write output to file & close it
    fwrite($fp, var_export($items, true));
    fclose($fp);
}



?>