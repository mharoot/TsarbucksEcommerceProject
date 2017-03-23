$(document).ready(function() {
var cookie_name = 'number_of_items_in_cart';
var cookiesHandler = new CookiesHandler('/'); // new cookie handler instnace at path '/'
var cookie_value = cookiesHandler.read(cookie_name);
if (cookie_value) { // not empty
    var check = document.getElementById('number_of_items_in_cart');
    if (check != null) {
        check.innerHTML = cookie_value;
    }
} 


$('.logout').on('click', function() {
    var post_data = 'logout=true'; 
    $.ajax({
    type: "POST",
    url: window.location.origin+':'+window.location.port+"/Tsarbucks/controllers/logout.php", 
    dataType:"text",
    data:post_data,
    success:function(response) {
    //var cookie_name = 'number_of_items_in_cart';
    //var cookiesHandler = new CookiesHandler('/'); // new cookie handler instance at path '/'
    //cookiesHandler.delete(cookie_name);
    window.location = response;
    },
    error:function (xhr, ajaxOptions, thrownError){
        alert("ERROR: "+window.location.origin+':'+window.location.port);
        
    }
    });
});

});