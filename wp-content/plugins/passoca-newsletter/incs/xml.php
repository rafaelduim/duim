<?php 
    include('../../../../wp-load.php');
	// define(WP_USE_THEMES, false);

	global $wpdb;

    $PsnNewsletter = new PsnNewsletter();
    $tableNewsletter = $PsnNewsletter->tableNewsletter();

    $PsnLocation = new PsnLocation();


    $ids = $_GET['ids'];
    if($ids):
        $query = "SELECT * FROM $tableNewsletter u
        WHERE u.newsletter_id in ($ids)
        ORDER BY u.newsletter_created DESC";
    else:
        $query = "SELECT * FROM $tableNewsletter u
        ORDER BY u.newsletter_created DESC";
    endif;


    $users_data = $wpdb->get_results( $query , OBJECT );

    if($users_data):

        $date = new DateTime();
        $today = $date->getTimestamp();
        $nameFile = 'usuarios_newsletter_' . $today . '.xls';

        $exporter = new ExportDataExcel('browser', $nameFile);

        $exporter->initialize(); // starts streaming data to web browser

        $exporter->addRow(array("Nome", "E-mail","Estado","Cidade","Criado em")); 
        
        foreach ($users_data as $u) :
            $timestamp          = strtotime($u->newsletter_created); // Gera o timestamp de $data_mysql
            $newsletter_created       = date('d/m/Y', $timestamp);
            $city = "";
            $state = "";
            $city = $PsnLocation->getNameCity($u->newsletter_city);
            $state = $PsnLocation->getNameState($u->newsletter_state);
            $exporter->addRow(array($u->newsletter_name,$u->newsletter_email,$state,$city,$newsletter_created));
        endforeach;
        $exporter->finalize();
    endif;
    exit(); // all done
?>