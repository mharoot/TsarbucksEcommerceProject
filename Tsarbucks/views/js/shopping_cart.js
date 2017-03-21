function proceed() {
    if (uriComponent == "") {
        $("#submit_order").hide();
        var shopping_cart_total = document.getElementById('shopping_cart_total');
        shopping_cart_total.innerHTML="Total: 0.00";

        return false;
    } 
    return true;

}

var products = [{"id":"1","name":"Black Coffee (Small)","price":"5.00"},
{"id":"2","name":"Black Coffee (Medium)","price":"7.50"},
{"id":"3","name":"Black Coffee (Large)","price":"10.00"},
{"id":"4","name":"Espresso (Small)","price":"6.00"},
{"id":"5","name":"Espresso (Large)","price":"12.00"},
{"id":"6","name":"Tsartisan Coffee (Small)","price":"10.00"},
{"id":"7","name":"Tsartisan Coffee (Large)","price":"20.00"},
{"id":"8","name":"Plum Floating in Perfume, Served in a Man's Hat","price":"15.00"}
];
var cookiesHandler = new CookiesHandler('/');
var uriComponent = cookiesHandler.read('shopping_cart_items');
if (proceed()) {
    var shopping_cart = JSON.parse(decodeURIComponent(uriComponent));

    var tbody = document.querySelector("tbody");


    var m = shopping_cart.length;
    var n = products.length;
    var total = 0;
    for (var j = 0; j < m; j++) {
        var id  = 0;
        var key = shopping_cart[j]['product_id'];
        var quantity = shopping_cart[j]['quantity'];
        for (var i = 0; i < n; i++) {
            if ( key === products[i]['id']) {
                id = i;
                break;
            }

        }

        var tr = document.createElement('TR');
        var td = document.createElement('TD');
        td.setAttribute('data-label', 'Products: ');
        var txt = document.createTextNode(products[id]['name']);
        td.append(txt);
        tr.append(td);

        td = document.createElement('TD');
        td.setAttribute('data-label', 'Price: ');
        txt = document.createTextNode(products[id]['price']);
        td.append(txt);
        tr.append(td);

        td = document.createElement('TD');
        td.setAttribute('data-label', 'Quantity: ');
        txt = document.createTextNode(quantity); // get from cookie
        td.append(txt);
        tr.append(td);

        td = document.createElement('TD');
        td.setAttribute('data-label', 'Remove: ');
        var button = document.createElement('BUTTON');
        button.className="btn-danger";
        button.type="submit";
        button.value=products[id]['id'];
        txt = document.createTextNode('- ');
        button.append(txt);
        var span = document.createElement('SPAN');
        span.className = "glyphicon glyphicon-shopping-cart";
        span.setAttribute("aria-hidden", "true");
        button.append(span);


        td.append(button);
        tr.append(td);
        
        

        tbody.prepend(tr);

        total += quantity*parseFloat(products[id]['price']);
    }


    var shopping_cart_total = document.getElementById('shopping_cart_total');
    shopping_cart_total.innerHTML="Total: "+total.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
    var $submitBtn = $("#submit_order");
    if (total === 0) {
        $submitBtn.hide();
    }


    $('.btn-danger').on('click', function (e) {
        e.preventDefault();
        var add_item_count = document.getElementById('number_of_items_in_cart');
        var btn    = $(this);
        var grandParent = btn.parent().parent();//points to tr, this is jquery
        grandParent.hide(); // hide the row that was clicked
        var quantity= grandParent.children().eq(2); // select the third child of the tr
        var post = 'product_id='+btn.val()+'&quantity='+quantity.text();

        var cookie_name = 'number_of_items_in_cart';
        var num_items = cookiesHandler.read(cookie_name);
        var value = num_items - parseInt(quantity.text());
        //cookie update
        cookiesHandler.create(cookie_name, value, 1); //1 day
        //ajax handler
            $.ajax({
            type: "POST",
            url: "controllers/shopping_cart_remove_handler.php", 
            dataType:"text",
            data:post,
            success:function(response) { //bring back price adjustment adjust in this function
                add_item_count.innerHTML = value;
                var cookie_name = 'number_of_items_in_cart';
                var shopping_cart = JSON.parse(decodeURIComponent(cookiesHandler.read('shopping_cart_items')));
                var m = shopping_cart.length;
                var n = products.length;
                var total = 0;
                for (var j = 0; j < m; j++) {
                    var id  = 0;
                    var key = shopping_cart[j]['product_id'];
                    var quantity = shopping_cart[j]['quantity'];
                    for (var i = 0; i < n; i++) {
                        if ( key === products[i]['id']) {
                            id = i;
                            total += quantity*parseFloat(products[id]['price']);
                            break;
                        }

                    }
                }
                if (total == 0) {
                    $submitBtn.hide();
                }
                shopping_cart_total.innerHTML="Total: "+total;                
            },
            error:function (xhr, ajaxOptions, thrownError) {
                alert("ERROR in login ajax");
            }
            });
            

    });

    $submitBtn.on('click', function (e) {
        e.preventDefault();
        var $number_of_items_in_cart = $('#number_of_items_in_cart');
        var post = 'submit_order=1';
        
        //ajax handler
            $.ajax({
            type: "POST",
            url: "controllers/customer_submit_order_handler.php", 
            dataType:"text",
            data:post,
            success:function(response) { //bring back price adjustment adjust in this function
                var cookie_name = 'number_of_items_in_cart';
                cookiesHandler.delete(cookie_name);
                cookiesHandler.delete('shopping_cart_items');
                var $order_placed = $('div.col-md-9');
                $order_placed.hide();
                shopping_cart_total.innerHTML="Total: 0.00";
                $submitBtn.hide();
                $number_of_items_in_cart.hide();
                // console.log(response);
                shopping_cart_total.innerHTML='<b><font color="green">Submitted order successfully!</font></b> View the status of your orders <a href="orders.php">here</a>.';

            },
            error:function (xhr, ajaxOptions, thrownError) {
                alert("ERROR in login ajax");
            }
            });

    });
}