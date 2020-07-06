<?php 
$title = get_the_title();
$excerpt = get_the_excerpt();
$image350x231 = get_the_post_thumbnail_url( $post->ID , '350x231' );
$link = get_the_permalink();
?>
<a href="<?php echo $link; ?>" class="col-md-3 wrap-feature2-box" title="<?php echo $title; ?>">
    <div class="card card-shadow" data-aos="flip-left" data-aos-duration="1200">
        <img class="card-img-top" src="<?php echo $image350x231; ?>" alt="<?php echo $title; ?>" />
        <div class="card-body text-center">
            <h5 class="font-medium"><?php echo $title; ?></h5>
            <p class="m-t-20 text-muted"><?php echo $excerpt; ?></p>
        </div>
    </div>
</a>