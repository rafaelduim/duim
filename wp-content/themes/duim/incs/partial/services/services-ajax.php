<?php 
add_action('wp_ajax_nopriv_servicesFeatured', 'servicesFeatured');  
add_action('wp_ajax_servicesFeatured', 'servicesFeatured');

function servicesFeatured(){
    $PsnThemes = new PsnThemes();
    $psn_themes_services_title = get_theme_mod( 'psn_themes_services_title' );
    $psn_themes_services_excerpt = get_theme_mod( 'psn_themes_services_excerpt' );
    $linkArchive = get_post_type_archive_link(SERVICES);
    ?>
    <div class="spacer feature2">
        <div class="container">
            <!-- Row  -->
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="title"><?php echo $psn_themes_services_title; ?></h2>
                    <h6 class="subtitle"><?php echo $psn_themes_services_excerpt; ?></h6>
                </div>
            </div>
            <!-- Row  -->
            <div class="row m-t-40">
                <!-- Column -->
                <?php 
                $args = array(
                    'post_type'=> SERVICES,
                    'posts_per_page'=> -1,
                    'paged' => $paged
                );
                $loop = new WP_Query($args);
                if($loop->have_posts()){
                    while($loop->have_posts()) { 
                        $loop->the_post();
                        get_template_part( 'incs/partial/services/services', 'template' );                       
                    }
                }    
                ?>
            </div>
            <div class="row">
                <div class="col-md-12 m-t-40 text-center">
                    <a class="btn btn-success-gradiant btn-md btn-arrow" href="<?php echo $linkArchive; ?>"><span>Ver mais <i class="ti-arrow-right"></i></span></a>
                </div>
            </div>
        </div>
    </div>
    <?php
    die;
}
?>