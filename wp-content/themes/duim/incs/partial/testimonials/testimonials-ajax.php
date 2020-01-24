<?php 
add_action('wp_ajax_nopriv_testimonialsService', 'testimonialsService');  
add_action('wp_ajax_testimonialsService', 'testimonialsService');
function testimonialsService() {
    if($_POST['id']){
        $id = $_POST['id'];
        $args = array(
            'post_type'=> TESTIMONIALS,
            'posts_per_page'=> 5,
            'meta_query' => array(
                array(
                  'key' => 'testimonials_services',
                  'value' => '"' . $id . '"',
                  'compare' => 'LIKE',
                )
              )
        );
        $loop = new WP_Query($args);
        if($loop->have_posts()){
        ?>
            <div class="testimonial10 spacer bg-light">
                <div class="container">
                    <div class="owl-carousel owl-theme text-center testi10">
                        <?php 
                        while($loop->have_posts()) { 
                            $loop->the_post();
                            get_template_part( 'incs/partial/testimonials/testimonials', 'template' );                       
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        die;
    }
    ?>
    <script>
        $(function () {
            // This is for the tesimonial
            $('.testi10').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                dots: false,
                autoplay: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1

                    },
                    1650: {
                        items: 1
                    }
                }
            })
        });
    </script>
    <?php
}

?>