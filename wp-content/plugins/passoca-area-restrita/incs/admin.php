<?php
add_action('admin_menu', 'psn_area_restrita_options');
function psn_area_restrita_options()
{
    add_menu_page('Área Restrita', 'Área Restrita', 'manage_options', 'psn-restricted-area', 'psn_options_area_restrita_users');
    add_submenu_page('psn-restricted-area','Configurações','Configurações','manage_options','psn-restricted-areas-configuration','psn_options_content_area_restrita_configuration');
}

function psn_options_area_restrita_users() {
    include('admin/users.php');
}


$configuration_email_area_restrita = get_option('configuration_email_area_restrita');
$send_email_area_restrita = get_option('send_email_area_restrita');

$configuration_mailchimp_interest_newsletter = get_option('configuration_mailchimp_interest_newsletter');


if ( $configuration_email_area_restrita === false && $send_email_area_restrita  === false  ):
    add_option( 'configuration_email_area_restrita', '' );
    add_option( 'send_email_area_restrita', '' );
endif;


function psn_options_content_area_restrita_configuration(){
    include('admin/configuration.php');      
}

?>
