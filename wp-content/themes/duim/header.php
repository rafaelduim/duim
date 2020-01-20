<?php 
    $PsnThemes = new PsnThemes(); 
    set_query_var( 'PsnThemes', $PsnThemes );
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  	<title><?php wp_title('&laquo;', true, 'right'); ?></title>
    <?php wp_head(); ?>
	<!-- Definindo URL Geral para Javascript -->
    <script type="text/javascript"> 
        var URL_TEMA = "<?php echo $PsnThemes->getUrlTemplate(); ?>";
        var URL_SITE = "<?php echo $PsnThemes->getUrlSite(); ?>";
    </script>

</head>
<body <?php body_class(); ?>>
    <?php 
    get_template_part( 'incs/partial/all/all', 'preloader' );
    ?>
    <div id="main-wrapper">