<?php 
get_header();
    get_template_part( 'incs/partial/banners/banners', 'home' );
    get_template_part( 'incs/partial/all/all', 'featured' );
    get_template_part( 'incs/partial/services/services', 'featured' );
    get_template_part( 'incs/partial/projects/projects', 'featured' );
    get_template_part( 'incs/partial/blogs/blogs', 'featured' );
get_footer();
?>