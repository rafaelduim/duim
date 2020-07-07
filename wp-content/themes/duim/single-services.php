<?php 
get_header();
    $PsnThemes = new PsnThemes();
    set_query_var('PsnThemes', $PsnThemes);
    while(have_posts()) { 
        the_post();

        $idService = get_the_ID();
        $services_banner = get_field('services_banner');

        set_query_var('title', get_the_title());
        set_query_var('image', $services_banner['url']);
        set_query_var('description', get_the_excerpt());

        get_template_part( 'incs/partial/all/all', 'banner-internal' );

        $services_url = get_field('services_url');

        $services_calltoaction_title = get_field('services_calltoaction_title');
        $services_calltoaction_text = get_field('services_calltoaction_text');
        ?>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Portfolio  -->
            <!-- ============================================================== -->
            <div class="spacer">
                <div class="container">
                    <h1><?php echo $title; ?></h1>
                    <a href="<?php echo $services_url;?>" target="_blank"><u><?php echo $services_url?></u></a>
                    
                    <!-- <div class="clearfix" id="services-gallery" data-load="ajax" data-parametros='action:"servicesGallery" , id: <?php echo $idService?>'>
                        <?php 
                        // get_template_part( 'incs/partial/all/all', 'loading' );
                        ?>
                    </div> -->
                    


                    <article class="m-t-30 text-services">
                        <?php the_content(); ?>
                    </article>

                    <div class="mini-spacer"></div>
                    
                    
                </div>
            </div>
            
            <div class="container-fluid" id="testimonials-featured" data-load="ajax" data-parametros='action:"testimonialsService" , id: <?php echo $idService; ?>'>
                <div class="container">
                    <?php 
                    get_template_part( 'incs/partial/all/all', 'loading' );
                    ?>
                </div>
            </div>

            <div class="pricing1 spacer">
                    <div class="container">
                        <!-- Row  -->
                        <div class="row m-t-40">
                            <div class="col-lg-4 col-md-12 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1200">

                            </div>

                            <div class="col-lg-4 col-md-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                                <div class="card text-center card-shadow">
                                    <div class="card-body p-40 font-14">
                                        <h5 class="title"><?php echo $services_calltoaction_title; ?></h5>
                                        <h6 class="subtitle"><?php echo $services_calltoaction_text; ?></h6>

                                        <ul class="list-inline text-left">
                                            <?php 
                                            $services_benefits = get_field('services_benefits');
                                            if($services_benefits){
                                                foreach ($services_benefits as $b) {
                                                    echo '<li class="w-100"><i class="icon-Trophy mr-2"></i> '. $b["name"] .'</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div class="bottom-btn">
                                            <a class="btn btn-info-gradiant btn-md btn-arrow m-t-20" href="<?php echo $PsnThemes->getUrlSite(); ?>"><span>Entre em contato <i class="ti-arrow-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        
            
            <div class="clearfix bg-light" id="services-featured" data-load="ajax" data-parametros='action:"servicesFeatured" , count: 3 , home: true , id : <?php echo $idService; ?>'>
                <?php 
                get_template_part( 'incs/partial/all/all', 'loading' );
                ?>
            </div>


        </div>
        <?php
    }
get_footer();
?>