<?php
$PsnThemes = new PsnThemes();
// Register ADMIN
if(function_exists("register_options_page")){
    acf_add_options_page(array(
		'page_title' 	=> 'PSN Themes',
		'menu_title'	=> 'PSN Themes',
		'menu_slug' 	=> $PsnThemes->getSlug() . '-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
// Hide ACF menu item from the admin menu
add_action('admin_head', 'hide_admin_menu');
function hide_admin_menu(){
    global $current_user;
    get_currentuserinfo();
    if( ($current_user->user_login != 'admin') && ($current_user->user_login != 'root') ){
        echo "<style type=\"text/css\">#toplevel_page_edit-post_type-acf{display:none;}</style>";
    }
}
// GOOGLE API
function my_acf_google_map_api( $api ){  
    $api['key'] = 'AIzaSyD99kvGQduAJkNq7QEnxtNRcg6idpNM23c';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
function my_acf_init() { 
    acf_update_setting('google_api_key', 'AIzaSyD99kvGQduAJkNq7QEnxtNRcg6idpNM23c');
}
add_action('acf/init', 'my_acf_init');
?>