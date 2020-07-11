<?php 
get_header(); 

$PsnThemes = new PsnThemes();
set_query_var('PsnThemes', $PsnThemes);

$psn_themes_blogs_image = get_theme_mod( 'psn_themes_blogs_image' );
the_post();
set_query_var('title', ' Categoria : '. single_cat_title($prefix = '', $display = false));
set_query_var('image', $psn_themes_blogs_image);
set_query_var('description', get_field('pages_featured'));

get_template_part( 'incs/partial/all/all', 'banner-internal' );

?>
    <div class="container-fluid">
        <div class="spacer feature22">
            <div class="container">
                <div class="row m-t-0">
                    <div class="col-lg-9">
                        <?php 
                        if(have_posts()):
                            while(have_posts()) : the_post();
                            set_query_var('model', 1);
                                get_template_part( 'incs/partial/blogs/blogs', 'template' );
                            endwhile;
                        endif;
                        if(function_exists('wp_pagenavi')) { 
                            echo '<div class="text-center clearfix mt-4">';
                                $list = wp_pagenavi( array( 'echo' => false ) ); 
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