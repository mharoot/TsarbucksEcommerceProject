<?php 
session_start();
?>
<html>

	<head>
		<title>Tsarbucks</title>
    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>assets/css/style.css">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>    
    <script src="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>views/js/CookiesHandler.js"></script>
	</head>

	<body>

    <nav class="navbar navbar-inverse navbar-custom">
        <div class="container-fluid">
          <div class="navbar-header">
            <h1><a class="navbar-brand"  href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>index.php">Tsarbucks</a></h1>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
            </button>
          </div>
          </br>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li> <a id="home_button" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>index.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
              <li class="dropdown">
                <a id="more" class="dropdown-toggle" data-toggle="dropdown" href="#">More<span class="caret"></span></a>
                <ul class="dropdown-menu">
<?php
$cookie_name = 'username';
$role = '';
if (isset($_COOKIE[$cookie_name])) {
    $role = $_SESSION['role'];
}

if ($role != 'barista') {
?>
                    <li>
                      <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>menu.php">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Menu
                      </a>
                    </li>
<?php
}
if ($role == 'customer') {
?>
                    <li>
                      <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>orders.php">
                        <span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> My Orders
                      </a>
                    </li>
<?php
} else if ($role == 'barista') {
?>
                    <li>
                      <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>orders.php">
                        <span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> Customer Orders
                      </a>
                    </li>
<?php
}
?>

                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
<?php

if (!isset($_COOKIE[$cookie_name])) 
{
?>
                <li>
                  <a id="login_page" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>login.php">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login
                  </a>
                </li>
              
<?php
} else {
?>
                <li>
                  <a href="#">
                    Welcome, 
                    <?php
                    echo $_SESSION['display_name']; // session_start() is at top of this file. session_write_close() is in footer.php
                    ?>
                  </a>
                </li>

<?php
        if ($_SESSION['role'] == 'customer') {
?>
                <li>
                    <a id ="shopping_cart" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>shopping_cart.php">
                      <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> My Cart
                      <span id="number_of_items_in_cart"></span>
                    </a>
                </li>
<?php   }  ?>
              
                <li>
                    <a class="logout" href="#">
                      <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
                    </a>
                </li>
<?php
}
?>
            </ul>
          </div>
        </div>
      </nav>

      <script src="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/Tsarbucks/'?>views/js/headerHandler.js"> </script>


      <div id="place_holder_page" class="container">
        <div style="overflow-x:auto;"class="jumbotron">
