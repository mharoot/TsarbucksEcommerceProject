<?php

$page = '';

if (isset($_POST['page']) )
     $page = $_POST['page'];


if (file_exists('../views/pages/'.$page.'.php') ) {
    include_once('../views/pages/'.$page.'.php');
} else {
    echo "page does not exist";
}

?>