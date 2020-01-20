<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
    session_cache_expire(120);
    session_start();
    // session_destroy();
    // print_r($_SESSION);
}


add_action('wp_ajax_nopriv_psn_area_restrita','psn_area_restrita');
add_action('wp_ajax_psn_area_restrita','psn_area_restrita');

function psn_area_restrita() {
    $valid = check_ajax_referer('psn_area_restrita', 'verify');
    if($_POST && $valid){
        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();


        $users = $_POST['usersPsnRestrictedArea'];
        $senha = $_POST['senhaPsnRestrictedArea'];

        $loginusers = $PsnRestrictedAreaUsers->loginusers($users,$senha);

        if($loginusers['stats'] == 1)
        {
            $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
            $PsnRestrictedAreaSession = new PsnRestrictedAreaSession();
            $users = array('users' => $loginusers );
            $token = $PsnRestrictedAreaJWT->createToken($loginusers['nome'],$loginusers['email']) ;

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $validadeToken = $token['exp'];

            $adicionandosession = $PsnRestrictedAreaSession->createSession($loginusers['id'],$ip,$token['token']);
            $registerSession = $PsnRestrictedAreaSession->registerSession($loginusers['nome'],$loginusers['email'],$adicionandosession['id'],$token['token'],$validadeToken);


            $session = array('session' => $adicionandosession , '$_SESSION' => $registerSession );
            $token = array('token' => $token);

            $stats =  array_merge($users,$token,$session);
        }
        else 
        {
            $stats =  array( 'cod' => 0 , 'message' => $loginusers['message'] );
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

add_action('wp_ajax_nopriv_psn_area_restrita_esqueceu_senha','psn_area_restrita_esqueceu_senha');
add_action('wp_ajax_psn_area_restrita_esqueceu_senha','psn_area_restrita_esqueceu_senha');

function psn_area_restrita_esqueceu_senha() {
    $valid = check_ajax_referer('psn_area_restrita_esqueceu_senha', 'verify_esqueceu_senha');
    if($_POST && $valid){
        $users = $_POST['usersPsnRestrictedArea'];
        $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();

        $searchUserEmail = $PsnRestrictedAreaUsers->searchUser(2,$users);

        if($searchUserEmail['stats'] == 1)
        {
            $nome = $searchUserEmail['campo']->user_name;

            $token = $PsnRestrictedAreaJWT->createToken($nome,$users);

            $resetarSenha = $PsnRestrictedAreaUsers->resetPassword($users,$nome,$token['token']);

            $stats =  array( 'cod' => 1 , 'resetar_senha' => $resetarSenha );
            
        }else {
            $stats =  array( 'cod' => 0 , 'message' => 'Usuário não encontrado.' );
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

add_action('wp_ajax_nopriv_psn_area_restrita_nova_senha','psn_area_restrita_nova_senha');
add_action('wp_ajax_psn_area_restrita_nova_senha','psn_area_restrita_nova_senha');

function psn_area_restrita_nova_senha() {
    $valid = check_ajax_referer('psn_area_restrita_nova_senha', 'verify_nova_senha');
    if($_POST && $valid){
        $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();
        $token = $_POST['tokenPsnRestrictedArea'];
        $pass = $_POST['novaSenhaPsnRestrictedArea'];
        $validateToken = $PsnRestrictedAreaJWT->validateToken($token);
        
        if($validateToken['stats'] == 1 && $pass){
            $users = new Users("",$validateToken['login'],"",$pass,"");

            $inputPass = $users->getPassword();
            $newPass = $PsnRestrictedAreaUsers->newPassword($validateToken['login'],$inputPass);
            $stats =  $newPass;

        }else {
            $stats =  array( 'cod' => 0 , 'message' => 'Solicitação não permitida ou expirada.' , 'token' => $validateToken );
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

add_action('wp_ajax_nopriv_psn_area_restrita_cadastro','psn_area_restrita_cadastro');
add_action('wp_ajax_psn_area_restrita_cadastro','psn_area_restrita_cadastro');

function psn_area_restrita_cadastro() {
    $valid = check_ajax_referer('psn_area_restrita_cadastro', 'verify_cadastrar');
    if($_POST && $valid){
        $usersPsnRestrictedArea = $_POST['usersPsnRestrictedArea'];
        $emailPsnRestrictedArea = $_POST['emailPsnRestrictedArea'];
        $cpfPsnRestrictedArea = $_POST['cpfPsnRestrictedArea'];
        $dataNascimentoPsnRestrictedArea = $_POST['dataNascimentoPsnRestrictedArea'];
        $senhaPsnRestrictedArea = $_POST['senhaPsnRestrictedArea'];


        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();

        $Novousers = $PsnRestrictedAreaUsers->createUser($usersPsnRestrictedArea,$emailPsnRestrictedArea,$cpfPsnRestrictedArea,$senhaPsnRestrictedArea,$dataNascimentoPsnRestrictedArea);

        if($Novousers['stats'] == 1){
            $stats = $Novousers;
            
            $PsnThemes = new PsnThemes();

            $html = '';
            $html .= '<h2>Novo cadastro do Site - '. $PsnThemes->getTemplateName() .'</h2>';
            $html .= '<p><strong>Assunto:</strong> Cadastro para discussão</p>';
            $html .= '<p><strong>Nome:</strong> '. $usersPsnRestrictedArea .'</p>';
            $html .= '<p><strong>E-mail:</strong> '. $emailPsnRestrictedArea .'</p>';
            if($cpfPsnRestrictedArea)
                $html .= '<p><strong>CPF:</strong> '. $cpfPsnRestrictedArea .'</p>';
            if($dataNascimentoPsnRestrictedArea)
                $html .= '<p><strong>Data de nascimento:</strong> '. $dataNascimentoPsnRestrictedArea .'</p>';
                    
            $title = 'Novo cadastro do Site';		

            $configuration_email_area_restrita = get_option('configuration_email_area_restrita');
            $send_email_area_restrita = get_option('send_email_area_restrita');

            if(class_exists('PsnMail') && $configuration_email_area_restrita) { 

                if($send_email_area_restrita)
                    $sendTo = $send_email_area_restrita;
                else
                    $sendTo = 'rafael@rafaelduim.com.br';


                $sendEmail = new PsnMail();
                $sendEmail = $sendEmail->send($title, $html, $sendTo,true);
            }

        }else {
            $stats =  array( 'cod' => 0 , 'message' => 'Usuário já criado' );
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

add_action('wp_ajax_nopriv_psn_area_restrita_atualizar','psn_area_restrita_atualizar');
add_action('wp_ajax_psn_area_restrita_atualizar','psn_area_restrita_atualizar');

function psn_area_restrita_atualizar() {
    $valid = check_ajax_referer('psn_area_restrita_atualizar', 'verify_atualizar');
    if($_POST && $valid){
        $usersPsnRestrictedArea = $_POST['usersPsnRestrictedArea'];
        $emailPsnRestrictedArea = $_POST['emailPsnRestrictedArea'];
        $cpfPsnRestrictedArea = $_POST['cpfPsnRestrictedArea'];
        $dataNascimentoPsnRestrictedArea = $_POST['dataNascimentoPsnRestrictedArea'];
        

        $token = $_POST['tokenPsnRestrictedArea'];
        $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
        $validateToken = $PsnRestrictedAreaJWT->validateToken($token);
        
        if($validateToken['stats'] == 1){
            $PsnRestrictedArea = new PsnRestrictedArea();

            $dataNascimento = str_replace("/", "-", $dataNascimentoPsnRestrictedArea);
            $dataNascimentoTratada = date('Y-m-d', strtotime($dataNascimento));

            $data = array(
                'user_name' => $usersPsnRestrictedArea,
                'user_email' => $emailPsnRestrictedArea,
                'user_cpf' => $cpfPsnRestrictedArea,
                'user_date_birth' => $dataNascimentoTratada,
                'user_update' => date('Y-m-d  H:i:s')
            );

            $where = array(
                'user_email' => $emailPsnRestrictedArea
            );
            $tabela = $PsnRestrictedArea->tableUsers();
            $updateUsers = $PsnRestrictedArea->updateLine($data,$tabela,$where);

            if($updateUsers['stats']==1) {
                $stats = $updateUsers;       
            }
            else
            {
                $stats = array(
                    'stats' => 0 ,
                    'message' => $updateUsers['message']
                );
                $PsnRestrictedAreaSession = new PsnRestrictedAreaSession();
                $PsnRestrictedAreaSession->removeSession();
            }

        }else {
            $stats =  array( 'cod' => 0 , 'message' => 'Solicitação não permitida ou expirada.' , 'token' => $validateToken );
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



add_action('wp_ajax_nopriv_psn_area_restrita_vincular','psn_area_restrita_vincular');
add_action('wp_ajax_psn_area_restrita_vincular','psn_area_restrita_vincular');

function psn_area_restrita_vincular() {
    if($_POST){
        $membro = $_POST['membro'];
        $usersID = $_POST['usersID'];

        $data = array(
            'user_member' => $membro
        );

        $where = array(
            'user_id' => $usersID
        );

        $PsnRestrictedArea = new PsnRestrictedArea(); 

        $tabela = $PsnRestrictedArea->tableUsers();
        $updateUsers = $PsnRestrictedArea->updateLine($data,$tabela,$where);

        if($updateUsers['stats']==1) {
            $stats = $updateUsers;       
        }
        else
        {
            $stats = array(
                'stats' => 0 ,
                'message' => $updateUsers['message']
            );
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

add_action('wp_ajax_nopriv_psn_area_restrita_bloquear','psn_area_restrita_bloquear');
add_action('wp_ajax_psn_area_restrita_bloquear','psn_area_restrita_bloquear');

function psn_area_restrita_bloquear() {
    if($_POST){
        $usersID = $_POST['usersID'];

        $data = array(
            'user_stats' => 3
        );

        $where = array(
            'user_id' => $usersID
        );

        $PsnRestrictedArea = new PsnRestrictedArea(); 

        $tabela = $PsnRestrictedArea->tableUsers();
        $updateUsers = $PsnRestrictedArea->updateLine($data,$tabela,$where);

        if($updateUsers['stats']==1) {
            $stats = $updateUsers;       
        }
        else
        {
            $stats = array(
                'stats' => 0 ,
                'message' => $updateUsers['message']
            );
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

add_action('wp_ajax_nopriv_psn_area_restrita_desbloquear','psn_area_restrita_desbloquear');
add_action('wp_ajax_psn_area_restrita_desbloquear','psn_area_restrita_desbloquear');

function psn_area_restrita_desbloquear() {
    if($_POST){
        $usersID = $_POST['usersID'];

        $data = array(
            'user_stats' => 1
        );

        $where = array(
            'user_id' => $usersID
        );

        $PsnRestrictedArea = new PsnRestrictedArea(); 

        $tabela = $PsnRestrictedArea->tableUsers();
        $updateUsers = $PsnRestrictedArea->updateLine($data,$tabela,$where);

        if($updateUsers['stats']==1) {
            $stats = $updateUsers;       
        }
        else
        {
            $stats = array(
                'stats' => 0 ,
                'message' => $updateUsers['message']
            );
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