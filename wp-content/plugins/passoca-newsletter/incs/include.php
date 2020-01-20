<?php 
$classes = array(
    'class/PsnNewsletter.php',

);
foreach($classes as $file){
    require $file;
}

include 'extension/user-list.php';
include 'admin.php';
include 'functions.php';


?>