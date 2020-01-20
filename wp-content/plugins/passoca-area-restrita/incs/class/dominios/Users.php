<?php 
class Users extends PsnRestrictedArea
{
    public function __construct($name="",$email,$cpf="",$password,$dateBirth="")
    { 
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->name = $name;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->password = $password;
        $this->dateBirth = $dateBirth;
        $this->mamber = $member;

        $PsnRestrictedArea = new PsnRestrictedArea();
        $this->tableUsers = $PsnRestrictedArea->tableUsers();
    }

    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getCPF() {
        return $this->cpf;
    }
    public function getPassword() {;
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
    public function getDateBirth() {
        return $this->dateBirth;
    }
    public function validadePassword($email,$password) {
        $users = $this->wpdb->get_results("SELECT * FROM $this->tableUsers WHERE user_email = '$email' ", OBJECT);

        if(password_verify($password, $users[0]->user_password)){
            if($users[0]->user_stats == 1) {
                $message = "Usuário validado";
            }elseif($users[0]->user_stats == 0 ) {
                $message = "Usuário não validado";
            }elseif($users[0]->user_stats == 3 ) {
                $message = "Usuário bloqueado";
            }
            
            $return = array(
                'stats' => $users[0]->user_stats,
                'id' => $users[0]->user_id,
                'nome' => $users[0]->user_name,
                'email' => $users[0]->user_email,
                'message' => $message
            );
        }else {
            $return = array(
                'stats' => 0,
                'message' => 'Usuário ou senha inválido'
            );
        }
        return $return;
    }
}
?>