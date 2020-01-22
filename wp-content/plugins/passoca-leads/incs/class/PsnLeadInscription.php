<?php 
class PsnLeadInscription extends PsnLeadUsers
{
    public function __construct()
    {
        global $wpdb;
        $PsnLead = new PsnLead();
        $this->wpdb = $wpdb;
        $this->PsnLead = $PsnLead;
        $this->tableUser = $PsnLead->getTableUser();
        $this->tableSign = $PsnLead->getTableSign();
    }

    #region Create
    public function createUserLead($name,$email,$type,$city,$state,$news=1,$birth="")
    {
        $verifyUser = $this->getUser(3,$email);

        if($verifyUser['status'] != 1 )
        {
            $dataInsert = array(
                'psn_lead_user_status' => 1,
				'psn_lead_user_name' => $name,
				'psn_lead_user_email' => $email,
				'psn_lead_user_type' => $type,
				'psn_lead_user_city' => $city,
				'psn_lead_user_state' => $state,
				'psn_lead_user_news' => $news,
				'psn_lead_user_hash' => uniqid(),
				'psn_lead_user_birth' => $birth,
				'psn_lead_user_date_created' 	=> date('Y-m-d  H:i:s')
            );
            
            $setUser = $this->setUser($dataInsert);
            $userID = $setUser['id'];

            $status =  array( 
                'cod' => 1 , 
                'status' =>  1,
                'user' => $userID,
                'hash' => $this->getHashUserByID($userID)
            );
        }
        else
        {
            $dataInsert = array(
                'psn_lead_user_status' => 1,
				'psn_lead_user_name' => $name,
				'psn_lead_user_email' => $email,
				'psn_lead_user_type' => $type,
				'psn_lead_user_city' => $city,
				'psn_lead_user_state' => $state,
				'psn_lead_user_news' => $news,
				'psn_lead_user_birth' => $birth,
				'psn_lead_user_date_update' => date('Y-m-d  H:i:s')
            );

            $updateUser = $this->updateUser($dataInsert,$email);


            $status =  array( 
                'cod' => 4 , 
                'status' =>  $updateUser['status'],
                'user' => $updateUser['lead']['user']->psn_lead_user_id , 
                'hash' => $this->getHashUserByID($updateUser['lead']['user']->psn_lead_user_id),
                'message' =>  $updateUser['message'],
                // 'return' => $updateUser,
            );
            
        }

        return $status;
    }

    public function createUserInscription($userID,$userHash,$contentID)
    {
        if($userID) {
            $verifyInscription = $this->getLeadContent(1,$userID,$userHash,$contentID);
            if(!isset($verifyInscription['inscription']))
            {
                $dataInsert = array(
                    'fk_psn_lead_user_id' => $userID,
                    'fk_psn_lead_user_hash' => $userHash,
                    'psn_lead_content' => $contentID,
                    'psn_lead_count' => 1,
                    'psn_lead_content_date_created' 	=> date('Y-m-d  H:i:s')
                );
                
                $userLeadContentID = $this->setUserLeadContent($dataInsert);
    
                $status =  array( 
                    'cod' => 1 , 
                    'inscription' => $userLeadContentID 
                );
            }
            else
            {
                $count = $verifyInscription['inscription']->psn_lead_count + 1;
                $dataInsert = array(
                    'psn_lead_content_date_update' 	=> date('Y-m-d  H:i:s'),
                    'psn_lead_count' => $count
                );
    
                $updateUser = $this->updateUserLeadContent($dataInsert,$userID,$userHash,$contentID);
    
    
                $status =  array( 
                    'cod' => 4 , 
                    'status' =>  $updateUser['status'],
                    'inscricao' => $updateUser['id'] , 
                    'user' => $updateUser['user'] , 
                    'hash' => $updateUser['hash'] , 
                    'message' =>  $updateUser['message'],
                );
            }
            return $status;
        }
    }
    #endregion

    #region GET
    public function getLeadContent($type=1,$userID,$userHash,$contentID)
    {
        // $type = 1 - User x Content
        // $type = 2 - User ALL Content
        // $type = 3 - Content ALL User
        // $type = 4 - Hash x Content
        // $type = 5 - Hash ALL Content
        
        
        if($type==1)
        {
            $inscription = $this->wpdb->get_results("SELECT * FROM $this->tableSign WHERE fk_psn_lead_user_id = '$userID' AND psn_lead_content = '$contentID'", OBJECT);
        }
        elseif($type==2)
        {
            $inscription = $this->wpdb->get_results("SELECT * FROM $this->tableSign WHERE fk_psn_lead_user_id = '$userID'", OBJECT);
        }
        elseif($type==3)
        {
            $inscription = $this->wpdb->get_results("SELECT * FROM $this->tableSign WHERE psn_lead_content = '$contentID' ", OBJECT);
        }
        elseif($type==4)
        {
            $inscription = $this->wpdb->get_results("SELECT * FROM $this->tableSign WHERE fk_psn_lead_user_hash = '$userHash' AND psn_lead_content = '$contentID'", OBJECT);
        }
        elseif($type==5)
        {
            $inscription = $this->wpdb->get_results("SELECT * FROM $this->tableSign WHERE fk_psn_lead_user_hash = '$userHash'", OBJECT);
        }
        else {
            throw new Exception('Type inválido');
        }

        try 
        {            
            if(!$inscription)
                throw new Exception('Erro ao realizar consulta');

            try 
            {
                $return = array(
                    'status' => 1,
                    'inscription' => $inscription[0],
                    'message' => 'Consulta realizada com sucesso'
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

    
    #region SET
    public function setUserLeadContent($data_ins)
    {
        $save_data = $this->wpdb->insert($this->tableSign, $data_ins, array('%s'));
        
        if (!$save_data) 
        {
            throw new Exception('Erro ao inserir : ' . $this->wpdb->print_error() );
        }
        else
        {
            $returnID = $this->wpdb->insert_id;
        }

        try {
            $return = array(
                'status' => 1,
                'id' => $returnID,
                'message' => 'Cadastrado'
            );
        }
        catch (Exception $e)
        {
            $return = array(
                'status' => 0,
                'id' => null,
                'message' => $e->getMessage()
            );
        }

        return $return;
    }
    #endregion

    #region UPDADE
    public function updateUserLeadContent($data_ins, $userID,$userHash,$contentID)
    {
        $save_data = $this->wpdb->update($this->tableSign, $data_ins, array('fk_psn_lead_user_id' => $userID , 'psn_lead_content' => $contentID), array('%s', '%d'));

        if(!$save_data) 
        {
            $return = array(
                'status' => 0,
                'user' => null,
                'message' => 'Inscrição não atualizado'
            );
        }
        else
        {
            $inscription = $this->getLeadContent(1,$userID,$userHash,$contentID);

            $return = array(
                'status' => 1,
                'id' => $inscription['inscription']->psn_lead_content_id,
                'user' => $inscription['inscription']->fk_psn_lead_user_id,
                'hash' => $inscription['inscription']->fk_psn_lead_user_hash,
                'count' => $inscription['inscription']->psn_lead_count,
                'message' => 'Inscrição atualizado'
            );
        }

        return $return;
    }
    #endregion
    
}
?>