<?php 
add_action('wp_ajax_nopriv_blogFeatured', 'blogFeatured');  
add_action('wp_ajax_blogFeatured', 'blogFeatured');

function blogFeatured(){
    $PsnThemes = new PsnThemes();
    $psn_themes_blogs_title = get_theme_mod( 'psn_themes_blogs_title' );
    $psn_themes_blogs_excerpt = get_theme_mod( 'psn_themes_blogs_excerpt' );
    $linkArchive = $PsnThemes->getUrlSite() . '/noticias';

    if($_POST['count'])
        $count = $_POST['count'];
    else
        $count = -1;
    
    if($_POST['home'])
        $home = $_POST['home'];
    else
        $home = false;
    
    if($_POST['paged'])
        $paged = $_POST['paged'];
    else
        $paged = 1;
    
    if($_POST['id'])
        $id = $_POST['id'];
    else
        $id = '';

    ?>
    <div class="spacer feature2">
        <div class="container">
            <?php 
            if($home){
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title"><?php echo $psn_themes_blogs_title; ?></h2>
                        <h6 class="subtitle"><?php echo $psn_themes_blogs_excerpt; ?></h6>
                    </div>
                </div>
            <?php 
            }
            ?>
            <div class="row m-t-40 justify-content-center">
                <!-- Column -->
                <?php 
                $args = array(
                    'post_type'=> BLOGS,
                    'posts_per_page'=> $count,
                    'post__not_in' => array($id),
                    'paged' => $paged
                );
                $loop = new WP_Query($args);
                if($loop->have_posts()){
                    while($loop->have_posts()) { 
                        $loop->the_post();
                        set_query_var('model', 2);
                        get_template_part( 'incs/partial/blogs/blogs', 'template' );                       
                    }
                }    
                ?>
            </div>
            <?php 
            if($home){
            ?>
                <div class="row">
                    <div class="col-md-12 m-t-40 text-center">
                        <a class="btn btn-primary btn-md btn-arrow" href="<?php echo $linkArchive; ?>"><span>Ver mais <i class="ti-arrow-right"></i></span></a>
                    </div>
                </div>
            <?php 
            }
            ?>
        </div>
    </div>
    <?php
    die;
}

?>