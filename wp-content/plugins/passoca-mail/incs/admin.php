<?php
add_action('admin_menu', 'psn_mail_options');
function psn_mail_options()
{
    add_menu_page('PSN E-mail', 'PSN E-mail', 'manage_options', 'psn-opcoes-mail', 'psn_options_mail');
}

function psn_options_mail()
{    
    include('admin/configuration.php');
}

$configuration_email_name = get_option('configuration_email_name');
$configuration_email_mail = get_option('configuration_email_mail');
$configuration_email_password = get_option('configuration_email_password');
$configuration_email_host = get_option('configuration_email_host');
$configuration_email_port = get_option('configuration_email_port');
$configuration_email_security = get_option('configuration_email_security');


if ( $configuration_email_mail === false && $configuration_email_name  === false && $configuration_email_password  === false && $configuration_email_host  === false && $configuration_email_port  === false && $configuration_email_security  === false ):

    add_option( 'configuration_email_name', '' );
    add_option( 'configuration_email_mail', '' );
    add_option( 'configuration_email_password', '' );
    add_option( 'configuration_email_host', '' );
    add_option( 'configuration_email_port', '' );
    add_option( 'configuration_email_security', '' );
    
endif;
?>
