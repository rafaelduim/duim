<?php 
class PsnLeadUsers
{
    public function __construct()
    {
        global $wpdb;
        $PsnLead = new PsnLead();
        $this->wpdb = $wpdb;
        $this->tableUser = $PsnLead->getTableUser();
        $this->tableSign = $PsnLead->getTableSign();
        
    }

    #region GET
    public function getUser($type=1,$value){
        // $type = 1 - ID
        // $type = 2 - HASH
        // $type = 3 - E-MAIL

        if($type==1)
        {
            $user = $this->wpdb->get_results("SELECT * FROM $this->tableUser WHERE psn_lead_user_id = '$value'", OBJECT);
        }
        elseif($type==2)
        {
            $user = $this->wpdb->get_results("SELECT * FROM $this->tableUser WHERE psn_lead_user_hash = '$value'", OBJECT);
        }
        elseif($type==3)
        {
            $user = $this->wpdb->get_results("SELECT * FROM $this->tableUser WHERE psn_lead_user_email = '$value'", OBJECT);
        }
        else {
            throw new Exception('Type inválido');
        }
        
        try 
        {            
            if(!$user)
                throw new Exception('Erro ao selecionar o usuário');

            try 
            {
                $return = array(
                    'status' => 1,
                    'user' => $user[0],
                    'message' => 'Usuário cadastrado'
                );
                
            }
            catch(Exception $e)
            {
                $return = array(
                    'status' => 0,
                    'message' => $e->getMessage()
                );
            }
        } 
        catch (Exception $e) 
        {
            $return = array(
                'status' => 0,
                'message' => $e->getMessage()
            );
        }

        return $return;

    }

    public function getNameUserByID($id)
    {
        $user = $this->wpdb->get_results("SELECT * FROM $this->tableUser WHERE psn_lead_user_id = '$id'", OBJECT);
        if ($user) {
            return $user[0]->psn_lead_user_name;
        }

    }

    public function getHashUserByID($id)
    {
        $user = $this->wpdb->get_results("SELECT * FROM $this->tableUser WHERE psn_lead_user_id = '$id'", OBJECT);
        if ($user) {
            return $user[0]->psn_lead_user_hash;
        }

    }

    public function getHashUserByEmail($email)
    {
        $user = $this->wpdb->get_results("SELECT * FROM $this->tableUser WHERE psn_lead_user_email = '$email'", OBJECT);
        if ($user) {
            return $user[0]->psn_lead_user_hash;
        }

    }
    #endregion

    #region SET
    public function setUser($data_ins)
    {
        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }

        if(class_exists('PsnHelper')){
            $PsnHelper = new PsnHelper();

            // $save_data = $this->wpdb->insert($this->tableUser, $data_ins, array('%s'));

            $save_data = $PsnHelper->addLine($data_ins,$this->tableUser);

        }else{
            throw new Exception('Plugin PsnHelper not found' );
        }
        
        if (!$save_data) 
        {
            throw new Exception('Erro ao inserir : ' . $save_data );
        }
        else
        {
            $returnID = $save_data['id'];
        }

        try {
            $return = array(
                'status' => 1,
                'id' => $returnID,
                'message' => 'Cadastrado'
            );
            if($PsnLog){
                $PsnLog->createdLog(1,'Adicionando usuário','PsnLead',$data_ins,$save_data);
            }
        }
        catch (Exception $e)
        {
            $return = array(
                'status' => 0,
                'id' => null,
                'message' => $e->getMessage()
            );
            if($PsnLog){
                $PsnLog->createdLog(1,'Error ao adicionar usuário','PsnLead',$data_ins,$save_data);
            }
        }

        return $return;

    }
    #endregion
    
    #region UPDADE
    public function updateUser($data_ins, $email)
    {

        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }

        if(class_exists('PsnHelper')){
            $PsnHelper = new PsnHelper();

            $where = array('psn_lead_user_email' => $email);

            $save_data = $PsnHelper->updateLine($data_ins,$this->tableUser,$where);

            // $save_data = $this->wpdb->update( $this->tableUser, $data_ins, array('psn_lead_user_email' => $email), array('%s', '%s'));

        }else{
            throw new Exception('Plugin PsnHelper not found' );
        }



        if($save_data == 0) 
        {
            $return = array(
                'status' => 2,
                'lead' => $this->getUser(3,$email),
                'message' => 'Nenhuma atualização',
            );
        }
        elseif(!$save_data)
        {
            $return = array(
                'status' => 0,
                'user' => null,
                'message' => 'Não atualizado',
                'insert' => $data_ins,
                'email' => $email ,
                'error' => $this->wpdb->print_error(),
            );
        }
        else
        {
            $user = $this->getUser(3,$email);

            $return = array(
                'status' => 1,
                'user' => $user,
                'message' => 'Usuário atualizado'
            );
            if($PsnLog){
                $PsnLog->createdLog(1,'Atualizado usuário','PsnLead',$data_ins,$save_data);
            }
        }

        return $return;
    }
    #endregion

    #region DELETE
    public function removeUser($type=1,$value){
        // $type = 1 - ID
        // $type = 2 - HASH
        // $type = 3 - E-MAIL

        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }

        if($type==1)
        {
            $data_ins = array('psn_lead_user_id' => $value);
            $user = $this->wpdb->delete($this->tableUser, $data_ins, array('%d'));
        }
        elseif($type==2)
        {
            $data_ins = array('psn_lead_user_hash' => $value);
            $user = $this->wpdb->delete($this->tableUser, $data_ins , array('%d'));
        }
        elseif($type==3)
        {
            $data_ins = array('psn_lead_user_email' => $value);
            $user = $this->wpdb->delete($this->tableUser,$data_ins, array('%d'));
        }
        else {
            throw new Exception('Type inválido');
        }
        
        try 
        {            
            if(!$user)
                throw new Exception('Erro ao selecionar o usuário');

            try 
            {
                $return = array(
                    'status' => 1
                );

                if($PsnLog){
                    $PsnLog->createdLog(1,'Remover usuário','PsnLead',$data_ins,$user);
                }
                
            }
            catch(Exception $e)
            {
                $return = array(
                    'status' => 0,
                    'message' => $e->getMessage()
                );
            }
        } 
        catch (Exception $e) 
        {
            $return = array(
                'status' => 0,
                'message' => $e->getMessage()
            );
        }

        return $return;

    }
    #endregion

}
?>