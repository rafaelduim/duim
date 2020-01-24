<?php 
$title = get_the_title();
$testimonials_company = get_field('testimonials_company');
?>
<div class="item">
    <div class="quote-bg">
        <h3 class="font-light"><?php echo get_the_content(); ?></h3>
    </div>
    <h6 class="m-b-0 font-medium"><?php echo $title; ?></h6>
    <span class=""><?php echo $testimonials_company; ?></span>
</div>