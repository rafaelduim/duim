<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
  	die();

global $wpdb;
$PsnLead = new PsnLead();

$psn_table_users = $PsnLead->getTableUser();
$psn_table_subscribed = $PsnLead->getTableSign();

// Del
$sql_del = "DROP TABLE IF EXISTS $psn_table_subscribed ";
$wpdb->query($sql_del);
$sql_del = "DROP TABLE IF EXISTS $psn_table_users";
$wpdb->query($sql_del);


?>