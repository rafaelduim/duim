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
    $contact_email = get_field('contact_email');
    $contact_image = get_field('contact_image');

?>
    <div class="contact3 m-t-30">
        <div class="row">
            <div class="container">
                <div class="row m-0">
                    <div class="col-lg-6">
                        <div class="card-shadow" data-aos="flip-left" data-aos-duration="1200">
                            <img src="<?php echo $contact_image['url']; ?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-box m-l-30">
                            <?php the_content(); ?>
                            <form class="m-t-30" data-aos="fade-left" data-aos-duration="1200" data-form="contact">
                                <input type="hidden" name="sendTo" value="<?php echo $contact_email; ?>" >
                                <input type="hidden" name="action" value="sendContact" >
                                <?php wp_nonce_field('form_contact', 'verify'); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group m-t-10">
                                            <input name="nameContact" class="form-control" type="text" placeholder="Nome"> </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group m-t-10">
                                            <input name="emailContact" class="form-control" type="email" placeholder="E-mail"> </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group m-t-10">
                                            <input name="subjectContact" class="form-control" type="text" placeholder="Assunto"> </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group m-t-10">
                                            <input name="phoneContact" mask="phone" class="form-control" type="text" placeholder="Telefone"> </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group m-t-10">
                                            <textarea name="messageContact" class="form-control" rows="3" placeholder="Mensagem"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" data-loading-text="Enviando... Aguarde!" class="btn btn-info-gradiant btn-md m-t-20 m-b-20 btn-arrow"><span> Enviar Mensagem <i class="ti-arrow-right"></i></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
}
add_footer('script_contato');
function script_contato() {
    ?>
    <script>
        jQuery(function ($) {
            $('#menu-contato').addClass('active');
        });
    </script>
    <?php
}
get_footer(); ?>