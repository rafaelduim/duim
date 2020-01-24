<?php 
get_header();

    $psn_themes_projects_title = get_theme_mod( 'psn_themes_projects_title' );
    $psn_themes_projects_excerpt = get_theme_mod( 'psn_themes_projects_excerpt' );
    $psn_themes_projects_image = get_theme_mod( 'psn_themes_projects_image' );

    set_query_var('title', $psn_themes_projects_title);
    set_query_var('image', $psn_themes_projects_image);
    set_query_var('description', $psn_themes_projects_excerpt);

    get_template_part( 'incs/partial/all/all', 'banner-internal' );
?>
<div class="container-fluid" id="projects-featured" data-load="ajax" data-parametros='action:"projectsFeatured" , count:4'>
    <div class="container m-t-40 m-b-40">
        <?php 
        get_template_part( 'incs/partial/all/all', 'loading' );
        ?>
    </div>
</div>
<?php 
get_footer();
?>