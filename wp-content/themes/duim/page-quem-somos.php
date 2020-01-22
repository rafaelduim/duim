<?php 
get_header();
    $PsnThemes = new PsnThemes();
    set_query_var('PsnThemes', $PsnThemes);
    while(have_posts()) { 
        the_post();
        set_query_var('title', get_the_title());
        set_query_var('image', get_the_post_thumbnail_url( $post->ID , 'full' ));
        set_query_var('description', get_field('pages_featured'));

        get_template_part( 'incs/partial/all/all', 'banner-internal' );
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
        <?php
        get_template_part( 'incs/partial/all/all', 'featured' );
        get_template_part( 'incs/partial/about/about', 'teams' );
        get_template_part( 'incs/partial/projects/projects', 'featured' );
        get_template_part( 'incs/partial/services/services', 'featured' );
    }
get_footer();
?>