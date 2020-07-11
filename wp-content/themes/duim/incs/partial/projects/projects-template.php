<?php 
$title = get_the_title();
$excerpt = get_the_excerpt();
$imagefull = get_the_post_thumbnail_url( $post->ID , 'full' );
$link = get_the_permalink();
$get_the_category = get_the_terms($post->ID,TAXONOMIA_PROJECTS);
$icon = get_field("category_projects_icon", $get_the_category[0]);
?>
<!-- Column  -->
<div class="col-lg-6" data-aos="fade-right" data-aos-duration="1200">
    <!-- card  -->
    <div class="card">
        <div class="row">
            <div class="col-md-5 icon-position" style="background-image:url(<?php echo $imagefull; ?>); background-size: cover; background-position: center;">
                <a href="<?php echo get_category_link( $get_the_category[0]->term_id )?>" title="<?php echo $get_the_category[0]->name?>" class="icon-round bg-primary-gradiant text-white display-5"><i class="<?php echo $icon; ?>"></i></a>
            </div>
            <div class="col-md-7">
                <div class="card-body p-40">
                    <h4 class="font-medium"><?php echo $title; ?></h4>
                    <p><?php echo $excerpt; ?></p>
                    <a href="<?php echo $link; ?>" class="linking text-underline">Ver projeto <i class="ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Column  -->