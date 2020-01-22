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
                                    <div class="icon-round bg-success-gradiant"><i class="<?php echo $featured['icon']; ?>"></i></div>
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