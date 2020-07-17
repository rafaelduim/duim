<?php 
$psn_themes_about_title = get_theme_mod('psn_themes_about_title');
$psn_themes_about_excerpt = get_theme_mod('psn_themes_about_excerpt');
?>
<div class="bg-light spacer feature11">
    <div class="container">
        <!-- Row  -->
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="title"><?php echo $psn_themes_about_title; ?></h2>
                <h6 class="subtitle"><?php echo $psn_themes_about_excerpt; ?></h6>
            </div>
        </div>
        <?php 
        if(is_home()){
            $args = array(
                'pagename'=> 'quem-somos',
            );
            $loop = new WP_Query($args);
            $PsnThemes = new PsnThemes();
            if($loop->have_posts()){
                while($loop->have_posts()) { 
                    $loop->the_post();
                    $image = get_field('about_image');  
            ?>
                    <div class="container-fluid">
                        <div class="spacer feature22">
                            <div class="container">
                                <div class="row wrap-feature-22 m-t-0">
                                    <div class="col-lg-5" data-aos="flip-up" data-aos-duration="1200"> <img src="<?php echo $image['url']; ?>" class="rounded img-responsive" alt="<?php echo $PsnThemes->getTemplateName(); ?>" /> </div>
                                    <div class="col-lg-7">
                                        <div class="text-box"> 
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                </div> 
            <?php } 
            }
        }
        ?>
        <!-- Row  -->
        <div class="row m-t-40">
            <?php 
            $about_featured = get_field('about_featured',38); 
            if($about_featured) {   
                foreach ($about_featured as $featured) {
            ?>
                    <div class="col-md-4 wrap-feature11-box">
                        <div class="card card-shadow" data-aos="fade-right" data-aos-duration="1200">
                            <div class="card-body">
                                <div class="icon-space">
                                    <div class="icon-round bg-primary-gradiant"><i class="<?php echo $featured['icon']; ?>"></i></div>
                                </div>
                                <h5 class="font-medium"><?php echo $featured['title']; ?></h5>
                                <p class="m-t-20"><?php echo $featured['text']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php 
                }
            }
            ?>
        </div>
    </div>
</div>