<?php 

add_action('wp_ajax_nopriv_psn_newsletter_submit','psn_newsletter_submit');
add_action('wp_ajax_psn_newsletter_submit','psn_newsletter_submit');

function psn_newsletter_submit() {
    $valid = check_ajax_referer('psn_newsletter_valid', 'verify');
    if($_POST && $valid){

        $name = $_POST['nameNewsletter'];
        $email = $_POST['emailNewsletter'];
        $city = $_POST['cityNewsletter'];
        $state = $_POST['stateNewsletter'];
        
        $PsnNewsletter = new PsnNewsletter();
        $PsnHelper = new PsnHelper();

        $validUser = $PsnHelper->searchUser($PsnNewsletter->tableNewsletter,'newsletter_email',$email);

        if($validUser['stats'] == 2) {
            $createUser = $PsnNewsletter->createUser(1,$name,$email,$city,$state);
            $return = $createUser;
        }elseif($validUser['stats'] == 1){
            $return = array(
                'stats' => 0,
                'message' => 'Usuário já cadastrado'
            );
        }else{
            $return = array(
                'stats' => 0,
                'message' => 'Erro',
                'return' => $validUser
            );
        }

        $return = json_encode($return);

        if (is_array($return)) {
            print_r($return);
        } else {
            echo $return;
        }      
    
        die;
    }
}

function psn_newsletter_form()
{
    // template do formulario
    $template = '';
        $template .= '<form data-form="psn-newsletter-form" id="psn-newsletter-form" class="newsletterForm">';
            $template .= '<input type="hidden" name="action" value="psn_newsletter_submit">';
            $template .= wp_nonce_field('psn_newsletter_valid', 'verify' , true , false);
            $template .= '<div class="form-group nameForm"><label class="control-label" for="nameNewsletter">Nome</label><input type="text" class="form-control" required="required" id="nameNewsletter" name="nameNewsletter" placeholder="NOME"></div>';  
            $template .= '<div class="form-group emailForm"><label class="control-label" for="emailNewsletter">E-mail</label><input type="text" class="form-control" required="required" id="emailNewsletter" name="emailNewsletter" placeholder="E-MAIL"></div>';         
            if(class_exists('PsnLocation')){
                $PsnLocation = new PsnLocation();
                $template .= '<div class="form-group stateForm"><label class="control-label" for="stateForm">Estado</label><select class="form-control" id="stateForm" name="stateNewsletter">';
                    $states = $PsnLocation->listAllState();
                    $template .= '<option value="">Selecione o estado</option>';
                    if($states){
                        foreach ($states as $s) {
                            $template .= '<option value="'. $s->cod_state .'">'. $s->sigla .'</option>';
                        }
                    }
                $template .= '</select></div>';
                $template .= '<div class="form-group cityForm"><label class="control-label" for="cityForm">Cidade</label><select class="form-control" id="cityForm" name="cityNewsletter">';
                    $template .= '<option value="">Selecione o estado</option>';
                $template .= '</select></div>';
            }         
            $template .= '<input type="submit" class="form-control" loading-text="Enviando..." value="ENVIAR">';                  
        $template .= '</form>';
    echo $template;
}
?>