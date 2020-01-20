<?php 
$classes = array(
    'class/PsnRestrictedArea.php',
    'class/dominios/Users.php',
    'class/PsnRestrictedAreaJWT.php',
    'class/PsnRestrictedAreaSession.php',
    'class/PsnRestrictedAreaUsers.php',
    'class/PsnRestrictedAreaForm.php',
    'class/PsnRestrictedAreaLogin.php'

);
foreach($classes as $file){
    require $file;
}
 
include 'functions.php';


?>