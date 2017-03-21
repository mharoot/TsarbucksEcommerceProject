<?php

class Orders{

    function __construct() {
        /* load required configuaration for DBController.php */
        require_once("config/database.php"); 
        /* load database access class */
        require_once("models/DBController.php");  
        /* load stored procedure varaibles */
        require_once("config/stored_procedures.php");
        /* create instance of database access class */
        $db_handler = new DBController();
        $role = '';
        $user_id = 0;

        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
            $user_id = $_SESSION['user_id'];
        } else {
            return 1;
        }


        /* if user is customer then search for customer's orders only */
        if ($role == 'customer') { 
            $db_handler->query(SP_GET_ORDERS_OF_CUSTOMER_WITH_PRODUCT_DISPLAY_NAME_AND_PRICE);
            
        } else if ($role =="barista") {
            $db_handler->query(SP_GET_ALL_ORDERS_WITH_PRODUCT_DISPLAY_NAME_AND_PRICE);
        }
        $db_handler->bind(':user_id', $user_id, PDO::PARAM_INT);

        /*
            bind username with a PDO sort of sanitation but not really it just prevents the nasty stuff from breaking the sql compiler.
        */
        // refrence for later use: foreach($db_handler->resultset() as $rows) echo $rows['']; (`product_id`, `display_name`, `price`, `size`)
?>

<?php
        $order_total = 0;
        $tempOrderId = 0;
        $i = 0;
        $result = $db_handler->resultset();
        $n = sizeof($result);
//        $this->logObject($result);

        foreach($result as $rows) {
            $allowHeadAndFoot = false;
            if ($i < $n - 1) {
                $check = $result[$i+1]['order_id'];
                if($check != $rows['order_id']) {
                    $allowHeadAndFoot  = true;
                }
            }
            if ( $tempOrderId < $rows['order_id'] || $allowHeadAndFoot) { // the head of table
?>
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table--striped table--bordered table--padded table--hover">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Products</th> 
                                    <th>Price</th>
                                    <th>Quantity</th> 
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
            <?php } // the body of table?>
                                <tr>
                                    <td data-label="Order Id: "><?php echo $rows['order_id']; ?></td>
                                    <td data-label="Products: "><?php echo $rows['display_name']; ?></td>
                                    <td data-label="Price: "><?php echo $rows['price']; ?></td>
                                    <td data-label="Quantity: "><?php echo $rows['quantity']; ?></td>
                                    <td data-label="Status: ">
                                    <?php 
                                        if ($rows['completed']) {
                                            if ($role =="barista") {?>
                                                <button type="button" class="btn btn-success">Order Completed</button>
                                <?php       } else {
                                                echo 'Order Completed';
                                            }

                                            
                                        } else {
                                            if ($role =="barista") {?>
                                                <button type="button" class="btn btn-warning" value="<?php echo $rows['order_id'].','.$rows['product_id']; ?>">Order Pending</button>
                                <?php       } else {
                                                echo 'Order Pending';
                                            }
                                        }
                                    ?>
                                    </td>
                                </tr>
<?php
            $order_total += $rows['price'] * $rows['quantity'];
            if ($allowHeadAndFoot) {
?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br></br>
                <div class="row">
                <div class="col-md-4">
                    <p><?php echo  'Order Total: '.$order_total;?> </p>
                </div>    
                </div>
                <br></br>
                <br></br>

<?php  
                $order_total = 0;
            }


             $tempOrderId = $rows['order_id']; // i have to leave it down here
             $i++;
        }// it never hits n
        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br></br>
                <div class="row">
                    <div class="col-md-4">
                        <p><?php echo  'Order Total: '.$order_total;?> </p>
                    </div>    
                </div>
                <br></br>
                <br></br>
                <script>
                $(document).ready(function (){
                    $('.btn.btn-warning').on('click', function() {
                        //ajax handler
                        var btn = $(this);
                        var array = btn.val().split(",");
                        var post_data = 'order_id='+array[0]+'&product_id='+array[1]; 
                        //alert(post_data);

                        $.ajax({
                        type: "POST",
                        url: window.location.origin+"/Tsarbucks/controllers/barista_fill_order.php", 
                        dataType:"text",
                        data:post_data,
                        success:function(response){
                            console.log(response);
                            btn.attr('class', 'btn btn-success');
                            btn.text("Order Completed");

                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            alert("ERROR");
                        }
                        });

                    });
                    
                });

                
                </script>

        <?php
    }



    function logObject($items) {
        # open your file with append, read, write perms
        # (be sure to check your file perms)
        $fp=fopen('controllers/log.php','a+');
        
        # write output to file & close it
        fwrite($fp, var_export($items, true));
        fclose($fp);
    }
}
?>