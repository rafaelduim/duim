<?php 
$PsnThemes = new PsnThemes();

$psn_themes_logo = get_theme_mod( 'psn_themes_logo' );

if(!$psn_themes_logo){
    $psn_themes_logo = $PsnThemes->getUrlTemplate() . '/dist/assets/images/logo.png';
}

$psn_themes_social_facebook = get_theme_mod( 'psn_themes_social_facebook' );
$psn_themes_social_twitter = get_theme_mod( 'psn_themes_social_twitter' );
$psn_themes_social_instagram = get_theme_mod( 'psn_themes_social_instagram' );
$psn_themes_social_linkedin = get_theme_mod( 'psn_themes_social_linkedin' );

$psn_themes_footer_number = get_theme_mod( 'psn_themes_footer_number' );
$psn_themes_footer_email = get_theme_mod( 'psn_themes_footer_email' );


$linkArchiveProjects = get_post_type_archive_link(PROJECTS);
$linkArchiveServices = get_post_type_archive_link(SERVICES);

?>
<!-- ============================================================== -->
<!-- Header 17  -->
<!-- ============================================================== -->
<div class="header17">
    <div class="container">
        <!-- Header 13 navabar -->
        <nav class="h17-nav">
            <div class="">
                <a class="navbar-brand" href="<?php echo $PsnThemes->getUrlSite(); ?>">
                    <img src="<?php echo $psn_themes_logo; ?>" alt="<?php echo $PsnThemes->getTemplateName(); ?>" />
                </a>
            </div>
            <div class="ml-auto align-self-center">
                <ul class="list-inline h17nav-bar">
                    <li><a class="nav-link tgl-cl" href="javascript:void(0)"><i class="ti-menu "></i></a></li>
                </ul>
            </div>
        </nav>
        <!-- End Header 13 navabar -->
    </div>
    <div class="h17-main-nav animated fadeInDown justify-content-center" data-aos="fade-up">
        <div class="h-17navbar align-self-center">
            <a href="javascript:void(0)" class="close-icons tgl-cl"><i class="ti-close"></i></a>
            <ul class="nav-menu">
                <li><a href="<?php echo $PsnThemes->getUrlSite(); ?>"><img src="<?php echo $psn_themes_logo; ?>" alt="<?php echo $PsnThemes->getTemplateName(); ?>" /></a></li>
                <li class="active"><a href="#">Home</a></li>
                <li><a href="<?php echo $PsnThemes->getUrlSite(); ?>/quem-somos">Quem Somos</a></li>
                <li><a href="<?php echo $linkArchiveProjects; ?>">Projetos</a></li>
                <li><a href="<?php echo $linkArchiveServices; ?>">Serviços</a></li>
                <li><a href="<?php echo $PsnThemes->getUrlSite(); ?>/noticias">Noticias</a></li>
                <li><a href="<?php echo $PsnThemes->getUrlSite(); ?>/contato">Contato</a></li>
            </ul>
            <ul class="info-nav">
                <li class="half-width"><a href="mailto:<?php echo $psn_themes_footer_email; ?>"><i class="fa fa-envelope text-info"></i> <?php echo $psn_themes_footer_email; ?></a></li>
                <li class="half-width"><a href="tel:<?php echo $psn_themes_footer_number; ?>"><i class="fa fa-phone text-info"></i> <?php echo $psn_themes_footer_number; ?></a></li>
            </ul>
            <ul class="social-nav">
                <li><a href="<?php echo $psn_themes_social_facebook; ?>" class=""><i class="fa fa-facebook"></i></a></li>
                <li><a href="<?php echo $psn_themes_social_linkedin; ?>" class=""><i class="fa fa-linkedin"></i></a></li>
                <li style="display:inline-block"><a href="<?php echo $psn_themes_social_instagram; ?>" class=""><i class="fa fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Header 17 -->
<!-- ============================================================== -->