<?php 
class PsnHelper
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        
    }
    
    public function urlSite()
    {
        return get_bloginfo("url");
    }
    
    public function urlPlugin()
    {
        return plugins_url( '', dirname(__FILE__) );
    }

    public function addLine($data_ins,$table)
    {
        $save_data = $this->wpdb->insert($table, $data_ins);
        
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
                'stats' => 1,
                'id' => $returnID,
                'message' => 'Adicionado'
            );
        }
        catch (Exception $e)
        {
            $return = array(
                'stats' => 0,
                'id' => null,
                'message' => $e->getMessage()
            );
        }

        return $return;

    }
    
    public function updateLine($data_ins,$table,$where)
    {
        $update_data = $this->wpdb->update($table, $data_ins,$where);

        if($save_data == 0) 
        {
            $return = array( 
                'stats' => 1,
                'message' => 'Atualizado',
            );
        }
        elseif(!$save_data)
        {
            $return = array(
                'stats' => 0,
                'message' => 'Não atualizado',
                'error' => $this->wpdb->print_error(),
            );
        }
        else
        {


            $return = array(
                'stats' => 1,
                'message' => 'Atualizado'
            );
        }


        return $return;

    }

    public function searchUser($table,$field,$value){

        if(!$table)
        {
            throw new Exception('Table not informed');
        }
        elseif(!$field)
        {
            throw new Exception('Field not informed');
        }
        elseif(!$value)
        {
            throw new Exception('Value not informed');
        }
        else
        {
            $user = $this->wpdb->get_results("SELECT * FROM $table WHERE $field = '$value'", OBJECT);
        }
        
        try 
        {            
            if(isset($user) && $user != "" && $user != null) 
            {
                $return = array(
                    'stats' => 1,
                    'field' => $user[0],
                    'message' => $field . ' encontrado'
                );
                
            }
            else
            {
                $return = array(
                    'stats' => 2 ,
                    'message' => $field . ' não encontrado'
                );
            }

        } 
        catch (Exception $e) 
        {
            $return = array(
                'stats' => 0,
                'message' => $e->getMessage()
            );
        }

        return $return;

    }

    public function removeLine($table,$where) {
        $this->wpdb->delete( $table , $where , array( '%d' ));
        return true;
    }
}

?>