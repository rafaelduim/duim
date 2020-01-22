<?php 
$classes = array(
    'class/PsnLead.php',
    'class/PsnLeadUsers.php',
    'class/PsnLeadInscription.php',

);
foreach($classes as $file){
    require $file;
}

// include 'extension/user-list.php';
// include 'admin.php';
// include 'functions.php';


?>