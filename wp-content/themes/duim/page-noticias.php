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
    <div class="contact3 m-t-30">
        <div class="row">

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