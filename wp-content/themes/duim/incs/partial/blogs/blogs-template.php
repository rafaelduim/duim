<?php 
$title = get_the_title();
$excerpt = get_the_excerpt();
$image350x231 = get_the_post_thumbnail_url( $post->ID , '350x231' );
$link = get_the_permalink();

if($model == 1){
?>
    <div class="row blog-row m-b-40">
        <div class="col-md-4">
            <a href="<?php echo $link; ?>"><img src="<?php echo $image350x231; ?>" alt="<?php echo $title; ?>" class="img-responsive"></a>
        </div>
        <div class="col-md-8">
            <h5 class="font-medium"><?php echo $title; ?></h5>
            <p class="text-muted"><?php echo $excerpt; ?></p>
        </div>
    </div>
<?php 
}elseif($model == 2){
?>
<a href="<?php echo $link; ?>" class="col-sm-6 col-md-4 col-lg-3 wrap-feature2-box" title="<?php echo $title; ?>">
    <div class="card card-shadow" data-aos="flip-left" data-aos-duration="1200">
        <img class="card-img-top" src="<?php echo $image350x231; ?>" alt="<?php echo $title; ?>" />
        <div class="card-body text-center">
            <h5 class="font-medium"><?php echo $title; ?></h5>
            <p class="m-t-20 text-muted"><?php echo $excerpt; ?></p>
        </div>
    </div>
</a>
<?php 
}
?>