<?php 
get_header();
    psn_newsletter_form();
    $PsnRestrictedAreaForm = new PsnRestrictedAreaForm();
    $PsnRestrictedAreaForm->register();
get_footer();
?>