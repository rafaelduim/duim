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

?>
    <div class="container-fluid">
        <div class="spacer feature22">
            <div class="container">
                <div class="row m-t-0">
                    <div class="col-lg-9">
                        <h2 class="title font-light mt-0 pt-0">
                            <?php the_title() ?>
                        </h2>
                        <article class="text-services">
                            <?php the_content(); ?>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>  
    </div> 
<?php 
}
add_footer('script_noticias');
function script_noticias() {
    ?>
    <script>
        jQuery(function ($) {
            $('#menu-noticias').addClass('active');
        });
    </script>
    <?php
}
get_footer();
?>