<?php 
get_header();
    $PsnThemes = new PsnThemes();
    set_query_var('PsnThemes', $PsnThemes);
    while(have_posts()) { 
        the_post();
        $idProjects = get_the_ID();
        $projects_banner = get_field('projects_banner');

        set_query_var('title', get_the_title());
        set_query_var('image', $projects_banner['url']);
        set_query_var('description', get_the_excerpt());

        get_template_part( 'incs/partial/all/all', 'banner-internal' );

        $projects_url = get_field('projects_url');

        $projects_calltoaction_title = get_field('projects_calltoaction_title');
        $projects_calltoaction_text = get_field('projects_calltoaction_text');
        ?>
        <div class="container-fluid">
            <div class="spacer">
                <div class="container">

                    <h1><?php echo $title; ?></h1>

                    <a href="<?php echo $projects_url;?>" target="_blank"><u><?php echo $projects_url?></u></a>
                    
                    <div class="clearfix" id="projects-gallery" data-load="ajax" data-parametros='action:"projectsGallery" , id: <?php echo $idProjects?>'>
                        <?php 
                        get_template_part( 'incs/partial/all/all', 'loading' );
                        ?>
                    </div>

                    <article class="m-t-30 text-projects">
                        <?php the_content(); ?>
                    </article>

                    <div class="mini-spacer"></div> 
                    
                </div>
            </div>
            <div class="spacer bg-info">
                <div class="container">
                    <div class="row justify-content-center m-b-30">
                        <div class="col-md-7 text-center">
                            <h2 class="title text-white"><?php echo $projects_calltoaction_title; ?></h2>
                            <h6 class="subtitle  text-white"><?php echo $projects_calltoaction_text; ?></h6>
                            <a class="btn btn-warning btn-md btn-arrow m-t-20" href="<?php echo $PsnThemes->getUrlSite(); ?>"><span>Entre em contato <i class="ti-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix bg-light" id="projects-featured" data-load="ajax" data-parametros='action:"projectsFeatured" , count: 3 , home: true , id : <?php echo $idProjects; ?>'>
                <?php 
                get_template_part( 'incs/partial/all/all', 'loading' );
                ?>
            </div>
        </div>
        <?php
    }
get_footer();
?>