<?php
//Template Start
function startup_psn(){
    add_action('wp_enqueue_scripts', 'scripts_pns', 2);
    add_action('wp_enqueue_scripts', 'style_psn',2);
}
add_action('after_setup_theme','startup_psn');
function scripts_pns() {

    $PsnThemes = new PsnThemes();

    if(is_admin())
        return;
  

    wp_enqueue_script( 'script-bundle' , $PsnThemes->getUrlTemplate() . '/dist/assets/plugins/bundle.plugins.js', '', '', true );
    // wp_enqueue_script( 'script-themes' , $PsnThemes->getUrlTemplate() . '/dist/assets/js/custom.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'script-themes' , $PsnThemes->getUrlTemplate() . '/dist/assets/js/scripts.js', array('jquery'), '', true );
    wp_localize_script( 'script-themes', 'ajaxForm', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}
function style_psn(){
    $PsnThemes = new PsnThemes();

    if(is_admin())
        return;    
        
    wp_enqueue_style( 'style', $PsnThemes->getUrlTemplate() . '/style.css', array());
    wp_enqueue_style( 'style-bundle', $PsnThemes->getUrlTemplate() . '/dist/assets/css/bundle.styles.css', array(),'1.0.0');

}
?>