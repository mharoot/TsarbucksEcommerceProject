<?php

class Menu {

    function __construct() {
        /* load required configuaration for DBController.php */
        require_once("config/database.php"); 
        /* load database access class */
        require_once("models/DBController.php");  
        /* load stored procedure varaibles */
        require_once("config/stored_procedures.php");
        /* create instance of database access class */
        $db_handler = new DBController();



        /* begin search for user */
        $db_handler->query(SP_GET_ALL_MENU_ITEMS);

        /*
            bind username with a PDO sort of sanitation but not really it just prevents the nasty stuff from breaking the sql compiler.
        */
        // refrence for later use: foreach($db_handler->resultset() as $rows) echo $rows['']; (`product_id`, `display_name`, `price`, `size`)

        foreach($db_handler->resultset() as $rows) {
    ?>
                <tr>
                <td data-label="Products: "><?php echo $rows['display_name']; ?></td>
                <td data-label="Price: "><?php echo $rows['price']; ?></td>
                <td data-label="Size (oz): "><?php echo $rows['size']; ?></td>
                <td><button class="btn-primary" type="submit" value="<?php echo $rows['product_id']; ?>">+ <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add</button></td>
                </tr>
<?php  }
    }
}
?>