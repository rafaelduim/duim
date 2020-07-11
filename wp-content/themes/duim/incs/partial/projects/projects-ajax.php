<?php 
add_action('wp_ajax_nopriv_projectsFeatured', 'projectsFeatured');  
add_action('wp_ajax_projectsFeatured', 'projectsFeatured');

function projectsFeatured(){

    if($_POST['count'])
        $count = $_POST['count'];
    else
        $count = 4;
    
    if($_POST['id'])
        $id = $_POST['id'];
    else
        $id = '';
    
    if($_POST['home'])
        $home = $_POST['home'];
    else
        $home = false;
    
    if($_POST['paged'])
        $paged = $_POST['paged'];
    else
        $paged = 1;


    $PsnThemes = new PsnThemes();
    $psn_themes_projects_title = get_theme_mod( 'psn_themes_projects_title' );
    $psn_themes_projects_excerpt = get_theme_mod( 'psn_themes_projects_excerpt' );
    $linkArchive = get_post_type_archive_link(PROJECTS);
    $args = array(
        'post_type'=> PROJECTS,
        'posts_per_page'=> $count,
        'post__not_in' => array($id),
        'paged' => $paged
    );
    $loop = new WP_Query($args);
    if($loop->have_posts()){
    ?>
        <div class="bg-light spacer feature18">
            <div class="container">
                <?php 
                if($home){
                ?>
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center">
                            <h2 class="title"><?php echo $psn_themes_projects_title; ?></h2>
                            <h6 class="subtitle"><?php echo $psn_themes_projects_excerpt; ?></h6>
                        </div>
                    </div>
                <?php 
                }
                ?>
                <div class="row  wrap-feature-18 m-t-40">
                    <!-- Column -->
                    <?php 
                    while($loop->have_posts()) { 
                        $loop->the_post();
                        get_template_part( 'incs/partial/projects/projects', 'template' );                       
                    } 
                    ?>
                </div>
                <?php 
                if($home){
                ?>
                    <div class="row">
                        <div class="col-md-12 m-t-40 text-center">
                            <a class="btn btn-primary-gradiant btn-md btn-arrow" href="<?php echo $linkArchive; ?>"><span>Ver mais <i class="ti-arrow-right"></i></span></a>
                        </div>
                    </div>
                <?php 
                }
                ?>
            </div>
        </div>
    <?php
    }
    die;
}

add_action('wp_ajax_nopriv_projectsGallery', 'projectsGallery');  
add_action('wp_ajax_projectsGallery', 'projectsGallery');
function projectsGallery() {
    if($_POST['id']){
        $id = $_POST['id'];
        $projects_gallery = get_field('projects_gallery',$id);
    ?>
        <div class="owl-carousel owl-theme port1 m-t-40">
            <?php 
            if($projects_gallery){
                foreach ($projects_gallery as $image) {
                    ?>
                    <div class="item" data-aos="fade-right">
                        <img src="<?php echo $image['url']?>" alt="<?php echo $image['alt']?>" class="img-fluid" />
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <script>
            $(function () {
                // portfolio slider
                $('.port1').owlCarousel({
                    loop: true,
                    margin: 30,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: false
                        },
                        1170: {
                            items: 1
                        }
                    }
                })
            });
        </script>
    <?php
    }
    die;
}
?>