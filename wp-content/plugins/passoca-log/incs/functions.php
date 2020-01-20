<?php 

add_action('wp_ajax_nopriv_psn_area_restrita','psn_area_restrita');
add_action('wp_ajax_psn_area_restrita','psn_area_restrita');

function psn_area_restrita() {
    $valid = check_ajax_referer('psn_area_restrita', 'verify');
    if($_POST && $valid){
        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();


        $usuario = $_POST['usuarioPsnRestrictedArea'];
        $senha = $_POST['senhaPsnRestrictedArea'];

        $loginUsuario = $PsnRestrictedAreaUsers->loginUsuario($usuario,$senha);

        if($loginUsuario['stats'] == 1)
        {
            $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
            $PsnRestrictedAreaSession = new PsnRestrictedAreaSession();
            $usuario = array('usuario' => $loginUsuario );
            $token = $PsnRestrictedAreaJWT->createToken($loginUsuario['nome'],$loginUsuario['email']) ;

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $validadeToken = $token['exp'];

            $adicionandoSessao = $PsnRestrictedAreaSession->createSession($loginUsuario['id'],$ip,$token['token']);
            $registerSession = $PsnRestrictedAreaSession->registerSession($loginUsuario['nome'],$loginUsuario['email'],$adicionandoSessao['id'],$token['token'],$validadeToken);


            $session = array('sessao' => $adicionandoSessao , '$_SESSION' => $registerSession );
            $token = array('token' => $token);

            $stats =  array_merge($usuario,$token,$session);
        }
        else 
        {
            $stats =  array( 'cod' => 0 , 'message' => $loginUsuario['message'] );
        }

        

        $return = json_encode($stats);

        if (is_array($return)) {
            print_r($return);
        } else {
            echo $return;
        }
    
        
    
        die;
    }
}

?>