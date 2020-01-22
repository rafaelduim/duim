<?php 
$PsnThemes = new PsnThemes();
?>
<div class="bg-light">
    <?php 
    $args = array(
    'post_type'=> BANNERS,
    'posts_per_page'=> 5,
    'paged' => $paged
    );
    $loop = new WP_Query($args);
    $banner = array();
    if($loop->have_posts()):
        while($loop->have_posts()) : $loop->the_post();
            $banner[] = array(
                'title' => get_the_title(),
                'image' => get_the_post_thumbnail_url( $post->ID , 'full' ),
                'link' => get_field('banners_link'),
                'link_external' => get_field('banners_link_external')
            );
        endwhile;
    endif;
    ?>
    <section id="slider-sec" class="slider1">
        <div id="slider1" class="carousel bs-slider slide  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="7000">
            <ol class="carousel-indicators">
                <?php 
                for ($i=0; $i < count($banner) ; $i++) { 
                    if($i == 0) 
                        echo '<li data-target="#slider1" data-slide-to="'. $i .'" class="active"></li>';
                    else
                        echo '<li data-target="#slider1" data-slide-to="'. $i .'"></li>';
                }
                ?>
            </ol>
            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">
                <?php 
                $first = true;
                foreach ($banner as $b) {                
                ?>
                    <div class="carousel-item <?php echo ( $first ? "active" : "") ?>">
                        <!-- Slide Background --><img src="<?php echo $b['image']; ?>" alt="<?php echo $b['title']; ?>" class="slide-image" />
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                            <h2 data-animation="animated zoomInRight" class="bg-success-gradiant title"><?php echo $b['title']; ?></h2>
                            <p data-animation="animated fadeInLeft">
                                <a class="bg-white btn btn-md btn-arrow" <?php echo ( $b['link_external'] ? "target='_blank'" : "") ?>  href="<?php echo $b['link']; ?>"> <span>Saiba mais <i class="ti-arrow-right"></i></span> </a>
                            </p>
                        </div>
                    </div>
                <?php 
                    $first = false;
                }
                ?>
                <!-- End of Wrapper For Slides -->
            </div>
        </div>
        <!-- End Slider -->
    </section>
</div>
<?php 
add_footer('script_slider');
function script_slider(){
    ?>
    <script>
        $('#slider1').bsTouchSlider();
        $(".carousel .carousel-inner").swipe({
            swipeLeft: function (event, direction, distance, duration, fingerCount) {
                this.parent().carousel('next');
            }
            , swipeRight: function () {
                this.parent().carousel('prev');
            }
            , threshold: 0
        });
    </script>
    <?php
}
?>