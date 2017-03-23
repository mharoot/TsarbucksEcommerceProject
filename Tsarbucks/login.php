<?php

include_once('views/templates/header.php');
$cookie_name = 'username';
if(!isset($_COOKIE[$cookie_name])) 
{
?>
		<div id="userFormArea" class="row">
            <div id="form_errors"></div>
			<div class="col-md-12">
				<form id="userLoginForm">
					<div class = "form-group">
						<label for="username">Enter Username</label>
						<input type="text" required="true"  class="form-control" id="username" name="username"> </input>
						<br />
						<label for="password"> Enter Password </label>
						<input type="password" required="true" class="form-control" id="password" name="password"> </input>
						<br />
						<input type="submit" class="btn btn-primary" value="login"></input>
					</div>
				</form>
			</div>
		</div>

        <!-- 
            Idea : use ajax to check password and login credentials.  If successful use ajax to bring a string of what page to go to -> customer.php  || ->barista.php  
            
            Problem:
            This doesn't work because it is dynamically brought by ajax already and it gets tricky to deal with additional javascript code this way and its best to avoid designing this way.  Use ajax just for CRUD.  Anything dynamically loaded that requires javascript will not work properly.  Use simple php routing method.

            Workaround: use php to route to a login page outside of views and pages.  Then use ajax to check the login and bring back the results 
            case 1: return 'error password or username incorrect'
            case 2: found password and username brought back ajax string that id's the user, usertype, and delivers them to the page where they have access rights to.


            current strategy used: i used the workaround...
        
        -->
        <script>

        $('#userLoginForm').on('submit', function (e) {
            e.preventDefault();
            var form    = $(this);
            var form_errors = document.getElementById('form_errors');
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var post = 'username='+username+'&password='+password;
            form_errors.innerHTML = '';
            //ajax handler

            
            $.ajax({
            type: "POST",
            url: "<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Tsarbucks/controllers/login_router.php'?>", 
            dataType: 'text',
            cache: false,
            data:post,
            success:function(response){
                if (response === 'customer') {
                    //form.parent().html(response);
                    window.location = '<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Tsarbucks/index.php'?>';
                } else if (response === 'barista') {
                    //form.parent().html(response);
                    window.location = '<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Tsarbucks/index.php'?>';
                } else {
                    form_errors.innerHTML = response;
                    return 1;
                }

                form_errors.parentNode.removeChild(form_errors);

            },
            error:function (xhr, ajaxOptions, thrownError){
                alert("ERROR: login.php in ajax call -> "+thrownError+", xhr:"+xhr.responseText);
            }
            });

        });

        </script>
<?php 
} else {

echo "Cookie '" . $cookie_name . "' is set!<br>";
echo "Value is: " . $_COOKIE[$cookie_name];
header('Location: index.php', true);
exit();

}
include_once('views/templates/footer.php');
?>