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
                    
                    <div class="clearfix" id="services-gallery" data-load="ajax" data-parametros='action:"servicesGallery" , id: <?php echo $idService?>'>
                        <?php 
                        get_template_part( 'incs/partial/all/all', 'loading' );
                        ?>
                    </div>
                    


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

            <div class="spacer ">
                <div class="container">
                    <div class="row justify-content-center m-b-30">
                        <div class="col-md-7 text-center">
                            <h2 class="title"><?php echo $services_calltoaction_title; ?></h2>
                            <h6 class="subtitle"><?php echo $services_calltoaction_text; ?></h6>
                            <a class="btn btn-info-gradiant btn-md btn-arrow m-t-20" href="<?php echo $PsnThemes->getUrlSite(); ?>"><span>Entre em contato <i class="ti-arrow-right"></i></span></a>
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