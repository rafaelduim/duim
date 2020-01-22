<?php 
add_action('wp_ajax_nopriv_projectsFeatured', 'projectsFeatured');  
add_action('wp_ajax_projectsFeatured', 'projectsFeatured');

function projectsFeatured(){

    if($_POST['count'])
        $count = $_POST['count'];
    else
        $count = 4;
    
    if($_POST['paged'])
        $paged = $_POST['paged'];
    else
        $paged = 1;


    $PsnThemes = new PsnThemes();
    $psn_themes_projects_title = get_theme_mod( 'psn_themes_projects_title' );
    $psn_themes_projects_excerpt = get_theme_mod( 'psn_themes_projects_excerpt' );
    $linkArchive = get_post_type_archive_link(PROJECTS);
    ?>
    <div class="bg-light spacer feature18">
        <div class="container">
            <!-- Row  -->
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="title"><?php echo $psn_themes_projects_title; ?></h2>
                    <h6 class="subtitle"><?php echo $psn_themes_projects_excerpt; ?></h6>
                </div>
            </div>
            <!-- Row  -->
            <div class="row  wrap-feature-18 m-t-40">
                <!-- Column -->
                <?php 
                $args = array(
                    'post_type'=> PROJECTS,
                    'posts_per_page'=> $count,
                    'paged' => $paged
                );
                $loop = new WP_Query($args);
                if($loop->have_posts()){
                    while($loop->have_posts()) { 
                        $loop->the_post();
                        get_template_part( 'incs/partial/projects/projects', 'template' );                       
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