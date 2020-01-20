<?php
add_action('admin_menu', 'psn_newsletter_options');
function psn_newsletter_options()
{
    add_menu_page('PSN Newsletter', 'PSN Newsletter', 'manage_options', 'psn-opcoes-newsletter', 'psn_options_newsletter_users');
    add_submenu_page('psn-opcoes-newsletter','Configurações','Configurações','manage_options','psn-opcoes-newsletters-configuration','psn_options_content_newsletter_configuration');
}

function psn_options_newsletter_users() {
    include('admin/users.php');
}

function psn_options_content_newsletter_configuration(){
    include('admin/configuration.php');      
}


$configuration_email_newsletter = get_option('configuration_email_newsletter');
$send_email_newsletter = get_option('send_email_newsletter');
$configuration_mailchimp_interest_newsletter = get_option('configuration_mailchimp_interest_newsletter');


if ( $configuration_email_newsletter === false && $send_email_newsletter  === false  ):
    add_option( 'configuration_email_newsletter', '' );
    add_option( 'send_email_newsletter', '' );
endif;
if ( $configuration_mailchimp_interest_newsletter === false  ):
    add_option( 'configuration_mailchimp_interest_newsletter', '' );
endif;
?>
