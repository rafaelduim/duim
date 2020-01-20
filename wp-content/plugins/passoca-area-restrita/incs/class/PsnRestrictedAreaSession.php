<?php 
class PsnRestrictedAreaSession extends PsnRestrictedArea
{
    public function __construct()  
    {
        $PsnRestrictedArea = new PsnRestrictedArea();
        $this->tableUsers = $PsnRestrictedArea->tableUsers();
        $this->tableSession = $PsnRestrictedArea->tableSession();
        $this->url403 = $PsnRestrictedArea->urlSite();
        $this->logout = $PsnRestrictedArea->urlSite();
    }

    public function createSession($usersID,$ip,$token) {
        $PsnRestrictedArea = new PsnRestrictedArea();
        $now = new DateTime('now');
        $now = $now->format('Y-m-d H:i:s');
        $data = array(
            'fk_user_id' => $usersID,
            'session_ip' => $ip,
            'session_criado' => $now,
            'session_token' => $token
        );

        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }

        if(class_exists('PsnHelper')){
            $PsnHelper = new PsnHelper();

            $addSession = $PsnHelper->addLine($data,$this->tableSession);


            if($addSession['stats'] == 1){
                $return = array(
                    'stats' => 1,
                    'id' => $addSession['id'],
                    'message' => 'Adicionado com sucesso'
                );
                if($PsnLog) {
                    $PsnLog->createdLog(0,'Criando sessão do usuário a área restrita','PsnRestrictedAreaSession',$data,$addSession);
                }
            }
            else {
                $return = array(
                    'stats' => 0,
                    'message' => 'Erro ao adicionar'
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

        return $return;
    }

    public function registerSession($nome,$email,$id,$token,$validade){
        unset($_SESSION['psn_restricted_area']);

        $_SESSION['psn_restricted_area'] = array(
            'name' => $nome,
            'email' => $email,
            'session_id' => $id,
            'token' => $token,
            'validade' => $validade
        );
        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
            $PsnLog->createdLog(0,'Registrando sessão','PsnRestrictedAreaSession',$_SESSION['psn_restricted_area'],'');
        }

        return $_SESSION['psn_restricted_area'];
    }

    public function removeSession() {
        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
            $PsnLog->createdLog(0,'Registrando sessão','PsnRestrictedAreaSession',$_SESSION['psn_restricted_area'],'');
        }
        session_destroy();
        header("Location: $this->logout/?logout=true");
        exit();
    }

    public function verifySession() {
        $now = new DateTime('now');
        // $now = $now->modify('+2 hours')->format('Y-m-d H:i:s');
        $now = $now->format('Y-m-d H:i:s');


        if($_SESSION['psn_restricted_area']) {
            $session = $_SESSION['psn_restricted_area'];
            $expsession = new DateTime($session['validade']);
            $expsession = $expsession->format('Y-m-d H:i:s');

            $PsnRestrictedAreaJWT = new PsnRestrictedAreaJWT();
            $validateToken = $PsnRestrictedAreaJWT->validateToken($session['token']);
            
            if($validateToken['stats'] != 1)
            {
                session_destroy();
                header("Location: $this->url403/?cod=403");
                exit();
            }
            if($now > $expsession) {
                session_destroy();
                header("Location: $this->url403/?cod=403&exp=true");
                exit();
            }
            
            $PsnRestrictedAreaLogin = new PsnRestrictedAreaLogin();
            $emailLogin = $PsnRestrictedAreaLogin->emailLogin();

            $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();
            $validarusers = $PsnRestrictedAreaUsers->searchUser(2,$emailLogin);
            if($validarusers['stats'] != 1) {
                session_destroy();
                header("Location: $this->url403/?cod=403&exp=true");
                exit();
            }
        }
        else 
        {
            session_destroy();
            header("Location: $this->url403/?cod=403");
            exit();
        }
    }


}
?>