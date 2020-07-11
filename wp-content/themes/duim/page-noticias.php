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
                        <?php 
                        $args = array(
                        'post_type'=> BLOGS,
                        'posts_per_page'=> 10,
                        'paged' => $paged
                        );
                        $loop = new WP_Query($args);
                        if($loop->have_posts()):
                            while($loop->have_posts()) : $loop->the_post();
                            set_query_var('model', 1);
                                get_template_part( 'incs/partial/blogs/blogs', 'template' );
                            endwhile;
                        endif;
                        if(function_exists('wp_pagenavi')) { 
                            echo '<div class="text-center clearfix mt-4">';
                                $list = wp_pagenavi( array( 'echo' => false , 'query' => $loop  ) ); 
                                print_r($list);
                            echo '</div>';
                        }
                        ?>
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