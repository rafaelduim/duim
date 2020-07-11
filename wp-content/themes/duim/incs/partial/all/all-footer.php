<?php 
$psn_themes_social_facebook = get_theme_mod( 'psn_themes_social_facebook' );
$psn_themes_social_twitter = get_theme_mod( 'psn_themes_social_twitter' );
$psn_themes_social_instagram = get_theme_mod( 'psn_themes_social_instagram' );
$psn_themes_social_linkedin = get_theme_mod( 'psn_themes_social_linkedin' );

$psn_themes_footer_number = get_theme_mod( 'psn_themes_footer_number' );
$psn_themes_footer_email = get_theme_mod( 'psn_themes_footer_email' );
$psn_themes_footer_copy = get_theme_mod( 'psn_themes_footer_copy' );

?>
<footer class="footer6 bg-primary spacer">
    <div class="container">
        <div class="row">
            <!-- coluumn -->
            <div class="col-lg-4">
                <div class="d-flex no-block m-b-10 text-white">
                    <div class="display-7 m-r-20 "><i class="icon-Phone-2"></i></div>
                    <div class="info">
                        <span class="db m-t-5"><?php echo $psn_themes_footer_number; ?></span>
                   </div>
               </div>
            </div>
            <!-- coluumn -->
            <!-- coluumn -->
            <div class="col-lg-4">
                <div class="d-flex no-block m-b-10">
                    <div class="display-7 m-r-20 text-white"><i class="icon-Mail"></i></div>
                    <div class="info">
                        <a href="mailto:<?php echo $psn_themes_footer_email?>" class="db white-link m-t-5"><?php echo $psn_themes_footer_email?></a>
                   </div>
               </div>
            </div>
            <!-- coluumn -->
            <!-- coluumn -->
            <div class="col-lg-4 ml-auto">
                <div class="ml-auto round-social dark">
                    <a href="<?php echo $psn_themes_social_facebook; ?>" class=""><i class="fa fa-facebook"></i></a>
                    <a href="<?php echo $psn_themes_social_linkedin; ?>" class=""><i class="fa fa-linkedin"></i></a>
                    <a href="<?php echo $psn_themes_social_instagram; ?>" class=""><i class="fa fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-12 b-t m-t-40 text-center">
                <div class="p-t-20 text-white"><?php echo $psn_themes_footer_copy?></div>
            </div>
        </div>
    </div>
</footer>