<?php
include_once('views/templates/header.php');
?>
<h1>Menu</h1>
<div class="col-md-9">
    <table class="table table--striped table--bordered table--padded table--hover">
        <thead>
            <th>Products</th> 
            <th>Price</th> 
            <th>Size (oz)</th> 
            <th></th>
        </thead>
        <tbody>
            <?php 
                require_once("controllers/Menu.php");
                new Menu();
             ?>
        </tbody>
    </table>
    <script> 
        $('.btn-primary').on('click', function (e) {
            e.preventDefault();
            var add_item_count = document.getElementById('number_of_items_in_cart');
            var btn    = $(this);
            var product_id = btn.val();
            var grandParent = btn.parent().parent();//points to tr, this is jquery
            var target = grandParent.children().eq(1); // select the second child of the tr
            var price = target.text();
            var post = 'product_id='+product_id+'&price='+price;
            //ajax handler
            $.ajax({
            type: "POST",
            url: "controllers/menu_add_handler.php", 
            dataType:"text",
            data:post,
            success:function(response) {
                add_item_count.innerHTML = response;
                var cookie_name = 'number_of_items_in_cart';
                var days = 1;
                var cookiesHandler = new CookiesHandler('/'); // new cookie handler instance at path '/'
                cookiesHandler.create(cookie_name, response, days );
            },
            error:function (xhr, ajaxOptions, thrownError) {
                alert("ERROR in login ajax");
            }
            });

        });

        </script>
</div>




<?php
$cookie_name = 'username';
if(!isset($_COOKIE[$cookie_name])) 
{
?>
<p><a href="login.php">Login</a> to begin order.</p>
<?php
}
include_once('views/templates/footer.php');
?>