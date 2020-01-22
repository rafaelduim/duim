<?php
//  ADD Content FOOTER
function add_footer($function_to_add, $priority = 9999, $accepted_args = 1){
    add_action("wp_footer", $function_to_add, $priority, $accepted_args);
}

//MENU
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menu' ) ) {
    register_nav_menu( 'menu', 'Menu' );
}
// THUMBNAIL
if (function_exists('add_theme_support')){
    add_theme_support('post-thumbnails');
    add_image_size('350x231', 350, 231, array( 'center', 'top' ));
    add_image_size('238x276', 238, 276, false);
    add_image_size('285x505', 285, 505, true);
}
// CONSTANTS
require_once('incs/options/constants.php');
// CLASS
require_once('incs/options/class.php');
// ASSETS
require_once('incs/options/enqueue.php');
// COMPONENTS
require_once("incs/options/components.php");
// ACF
require_once('incs/options/acf.php');


/*
* POST TYPES
*/
foreach(glob(get_template_directory() . "/incs/post-type/*.php") as $file){
    require $file;
}


$PsnThemes = new PsnThemes();

$PsnThemes->customizerTemplate();


function remove_menus(){    
    // remove_menu_page( 'upload.php' );                   //Posts
    // remove_menu_page( 'edit-comments.php' );          //Comments 
}
add_action( 'admin_menu', 'remove_menus' );


// AJAX
require_once('incs/partial/services/services-ajax.php');
require_once('incs/partial/projects/projects-ajax.php');

?>