<?php 
class PsnLeadUsers extends PsnLead
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->tableUser = $this->getTableUser();
        $this->tableSign = $this->getTableSign();
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
                    'user' => $user[0]
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
        $save_data = $this->wpdb->insert($this->tableUser, $data_ins, array('%s'));
        $returnID = $this->wpdb->insert_id;
        if ($save_data) {
            return $returnID;
        }

    }
    #endregion
    
    #region UPDADE
    public function updateUser($data_ins, $email)
    {
        $save_data = $this->wpdb->update($this->tableUser, $data_ins, array('psn_lead_user_email' => $email), array('%s', '%s'));
        if ($save_data) {
            $this->user = new PsnLeadUsers();
            $idUser = $this->user->getUserByEmail($email);
            return $idUser;
        }
    }
    #endregion

    #region DELETE
    public function removeUser($type=1,$value){
        // $type = 1 - ID
        // $type = 2 - HASH
        // $type = 3 - E-MAIL

        if($type==1)
        {
            $user = $this->wpdb->delete($this->tableUser, array('psn_lead_user_id' => $value), array('%d'));
        }
        elseif($type==2)
        {
            $user = $this->wpdb->delete($this->tableUser, array('psn_lead_user_hash' => $value), array('%d'));
        }
        elseif($type==3)
        {
            $user = $this->wpdb->delete($this->tableUser, array('psn_lead_user_email' => $value), array('%d'));
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