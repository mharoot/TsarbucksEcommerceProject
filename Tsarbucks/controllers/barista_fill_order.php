<?php
/* load required configuaration for DBController.php */
require_once("../config/database.php"); 
/* load database access class */
require_once("../models/DBController.php");  
/* load stored procedure varaibles */
require_once("../config/stored_procedures.php");
/* create instance of database access class */
$db_handler = new DBController();


$order_id = 0;
$product_id = 0;

if ( isset($_POST['order_id']) && isset($_POST['product_id']) ) {
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    echo 'true';
} else {
    return 1;
}

$db_handler->query(SP_COMPLETE_ORDER);
$db_handler->bind(':order_id', $order_id, PDO::PARAM_INT);
$db_handler->bind(':product_id', $product_id, PDO::PARAM_INT);
$db_handler->execute();






function logObject($items) {
    # open your file with append, read, write perms
    # (be sure to check your file perms)
    $fp=fopen('log.php','a+');//was .txt before php works good too
    
    # write output to file & close it
    fwrite($fp, var_export($items, true));
    fclose($fp);
}



?>