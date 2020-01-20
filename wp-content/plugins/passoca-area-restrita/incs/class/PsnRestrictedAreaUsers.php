<?php 
class PsnRestrictedAreaUsers extends PsnRestrictedArea
{
    public function __construct()
    { 
        global $wpdb;
        $this->wpdb = $wpdb;
        $PsnRestrictedArea = new PsnRestrictedArea();
        $this->tableUsers = $PsnRestrictedArea->tableUsers();
        $this->nameProject = "PSN Área Restrita";
        $this->urlRecoveryPassword = $PsnRestrictedArea->urlSite();
        $this->activeRegister = $PsnRestrictedArea->urlSite();

    }

    #region ADICIONAR
    public function createUser($nome,$email,$cpf,$senha,$dataNascimento) {

        $users = new Users($nome,$email,$cpf,$senha,$dataNascimento);

        $searchUserEmail = $this->searchUser(2,$email);
        $searchUserCpf = $this->searchUser(3,$cpf);
        
        if($searchUserCpf['stats'] != 1 && !$searchUserEmail['stats'] != 1)
        {

            $data = str_replace("/", "-", $dataNascimento);
            $dataNascimentoTratada = date('Y-m-d', strtotime($data));


            $data = array(
                'user_stats' => 0,
                'user_name' => $users->getName(),
                'user_email' => $users->getEmail(),
                'user_cpf' => $users->getCPF(),
                'user_password' => $users->getPassword(),
                'user_date_birth' => $dataNascimentoTratada,
                'user_created' => date('Y-m-d  H:i:s')
            );
            if(class_exists('PsnLog')){
                $PsnLog = new PsnLog();
            }

            if(class_exists('PsnHelper')){
                $PsnHelper = new PsnHelper();
    
                $addUsers = $PsnHelper->addLine($data,$this->tableUsers);

                if($PsnLog) {
                    $PsnLog->createdLog(0,'Adicionando usuário a área restrita','PsnRestrictedAreaUsers',$data,$addUsers);
                }

                if($addUsers['stats'] == 1){
                    $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();

                    $token = $PsnRestrictedAreaJWT->createToken($nome,$email);
                    $token = urlencode($token['token']);

                    $html = "";
                    $html .= "<h2>Ativação de e-mail - $this->nameProject </h2>";
                    $html .= "<h3>Olá $name,</h3>";
                    
                    $html .= "<p>Você solicitou seu cadastro no site: <a href='http://www.emotrab.ufba.br'>www.emotrab.ufba.br</a></p>";
                    $html .= "<p>Clique no link abaixo para ativar seu cadastro:</p>";
                    $html .= "<p><a href='$this->activeRegister/?active=true&token=$token'>Ativar cadastro!</a></p>";
                    $html .= "<p>Se não foi você. Fique tranquilo e apague esse e-mail.</p>";		
                    $title = "Ativar cadastrado - $this->nameProject";

                    if(class_exists('PsnMail')) { 
                        $sendEmail = new PsnMail();
                        $sendEmail = $sendEmail->send($title, $html, $users->getEmail(),false);

                        $return = array(
                            'stats' => 1,
                            'id' => $addUsers['id'],
                            'email' => 'Enviado',
                            'message' => 'Adicionado com sucesso'
                        );

                        if($PsnLog) {
                            $PsnLog->createdLog(0,'E-mail de ativação enviado','PsnRestrictedAreaUsers',$users->getEmail(),$sendEmail);
                        }
                    }else {
                        $return = array(
                            'stats' => 1,
                            'id' => $addUsers['id'],
                            'email' => 'Não enviado. Sem o plugin PsnMail',
                            'message' => 'Adicionado com sucesso'
                        );
                        if($PsnLog) {
                            $PsnLog->createdLog(0,'E-mail de ativação não enviado - Sem plugin PsnEmail','PsnRestrictedAreaUsers',$users->getEmail(),$sendEmail);
                        }
                    }


                    
                } else{
                    $return = array(
                        'stats' => 0,
                        'message' => 'Erro ao adicionar'
                    );
                    if($PsnHelper) {
                        $PsnLog->createdLog(0,'Erro ao adicionar sessão','PsnRestrictedAreaUsers',$users->getEmail(),'');
                    }
                }
            }else{
                $return = array(
                    'stats' => 0,
                    'message' => 'Erro plugin PsnHelper não encontrado'
                );
                if($PsnLog){
                    $PsnLog->createdLog(0,'Criando sessão','PsnRestrictedAreaSession','','Erro plugin PsnHelper não encontrado');
                }
            }
        }
        else {
            $return = array(
                'stats' => 2,
                'email' => $searchUserEmail,
                'cpf' => $searchUserCpf,
                'message' => 'Usuário cadastrado'
            );
        }

        return $return;
    }

    public function activeUser($token){
        $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
        $validateToken = $PsnRestrictedAreaJWT->validateToken($token,false);
        if($validateToken['stats'] == 1){

            if(class_exists('PsnLog')){
                $PsnLog = new PsnLog();
            }
            
            $login = $validateToken['login'];

            $data = array(
                'user_stats' => 1,
                'user_update' => date('Y-m-d  H:i:s')
            );
    
            $where = array('user_email' => $login);

            if(class_exists('PsnHelper')){
                $PsnHelper = new PsnHelper();
    
                // $updateUsers = $this->updateLine($data,$this->tableUsers,$where);
                $updateUsers = $PsnHelper->updateLine($data,$this->tableUsers,$where);

                if($updateUsers['stats']==1) {
                    $return = $updateUsers;    
                    if($PsnLog) {
                        $PsnLog->createdLog(0,'Ativação de usuário a área restrita','PsnRestrictedAreaUsers',$where,$updateUsers);
                    }            
                }
                else
                {
                    $return = array(
                        'stats' => 0 ,
                        'message' => $updateUsers['message']
                    );
                }
            }else{
                $return = array(
                    'stats' => 0,
                    'message' => 'Erro plugin PsnHelper não encontrado'
                );
                if($PsnLog){
                    $PsnLog->createdLog(0,'Criando sessão','PsnRestrictedAreaSession','','Erro plugin PsnHelper não encontrado');
                }
            }

            

        }else {
            $return = array(
                'stats' => 0 ,
                'message' => $validateToken
            );
        }

        return $return;
    }
    #endregion
    #region BUSCAR
    public function searchUser($type=1,$value){
        // $type = 1 - ID
        // $type = 2 - E-MAIL
        // $type = 3 - CPF

        if($type==1)
        {
            $user = $this->wpdb->get_results("SELECT * FROM $this->tableUsers WHERE user_id = '$value'", OBJECT);
        }
        elseif($type==2)
        {
            $user = $this->wpdb->get_results("SELECT * FROM $this->tableUsers WHERE user_email = '$value'", OBJECT);
        }
        elseif($type==3) {
            $user = $this->wpdb->get_results("SELECT * FROM $this->tableUsers WHERE user_cpf = '$value'", OBJECT);
        }
        else {
            throw new Exception('Type inválido');
        }
        
        try 
        {            
            if(isset($user) && $user != "" && $user != null) 
            {
                $return = array(
                    'stats' => 1,
                    'campo' => $user[0],
                    'message' => 'Usuário cadastrado'
                );
                
            }
            else
            {
                $return = array(
                    'stats' => 2 ,
                    'message' => "Usuário não encontrado"
                );
            }

        } 
        catch (Exception $e) 
        {
            $return = array(
                'stats' => 4,
                'message' => "Erro ao selecionar o usuário"
            );
        }

        return $return;

    }
    
    public function loginusers($login,$senha) {
        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }
        $users = new Users($login,"","",$senha);
        $validateUser = $users->validadePassword($login,$senha);
        if($validateUser['stats']==1) 
        {
            $return = $validateUser;
            
            if($PsnLog) {
                $PsnLog->createdLog(0,'Login do usuário a área restrita','PsnRestrictedAreaUsers',$users,$validateUser);
            }
            
        }
        else
        {
            $return = array(
                'stats' => 0 ,
                'message' => $validateUser['message']
            );
        }

        return $return;
    }

    public function resetPassword($login,$name,$token) {
        
        $token = urlencode($token);

        if($login && $token) {
            $html = "";
            $html .= "<h2>Recuperar Senha - $this->nameProject </h2>";
            $html .= "<h3>Olá $name,</h3>";
            
            $html .= "<p>Você esqueceu a sua senha de acesso?</p>";
            $html .= "<p>Fique tranquilo e clique no link abaixo:</p>";
            $html .= "<p><a href='$this->urlRecoveryPassword/?recovery=true&token=$token'>Quero resetar minha senha</a></p>";
            $html .= "<p>Se não foi você. Fique tranquilo e apague esse e-mail.</p>";		
            $title = "Recuperar Senha - $this->nameProject";

            if(class_exists('PsnMail')) { 
                $sendEmail = new PsnMail();
                $sendEmail = $sendEmail->send($title, $html, $login,true);
                $return = array(
                    'stats' => 1 ,
                    'message' => $sendEmail
                );
            }else {
                $return = array(
                    'stats' => 0 ,
                    'message' => 'Não existe a class PsnMail'
                );
            }

            return $return;
        }
    }

    public function newPassword($login,$pass) {
        $data = array(
            'user_password' => $pass,
            'user_update' => date('Y-m-d  H:i:s')
        );

        $where = array('user_email' => $login);

        $updateUsers = $this->updateLine($data,$this->tableUsers,$where);

        if($updateUsers['stats']==1) 
        {
            $return = $updateUsers;
            
        }
        else
        {
            $return = array(
                'stats' => 0 ,
                'message' => $validateUser['message']
            );
        }

        return $return;
    }

}
?>