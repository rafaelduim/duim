<?php 
get_header();

    $psn_themes_services_title = get_theme_mod( 'psn_themes_services_title' );
    $psn_themes_services_excerpt = get_theme_mod( 'psn_themes_services_excerpt' );
    $psn_themes_services_image = get_theme_mod( 'psn_themes_services_image' );

    set_query_var('title', $psn_themes_services_title);
    set_query_var('image', $psn_themes_services_image);
    set_query_var('description', $psn_themes_services_excerpt);

    get_template_part( 'incs/partial/all/all', 'banner-internal' );
?>
<div class="container-fluid" id="services-featured" data-load="ajax" data-parametros='action:"servicesFeatured" , count: -1'>
    <div class="container m-t-40 m-b-40">
        <?php 
        get_template_part( 'incs/partial/all/all', 'loading' );
        ?>
    </div>
</div>
<?php 
    add_footer('script_servicos');
    function script_servicos() {
        ?>
        <script>
            jQuery(function ($) {
                $('#menu-servicos').addClass('active');
            });
        </script>
        <?php
    }
get_footer();
?>