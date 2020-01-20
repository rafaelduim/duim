<?php 
class PsnLog
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->tableLog = $wpdb->prefix . 'psn_log';
        
    }
    public function urlSite()
    {
        return get_bloginfo("url");
    }
    public function urlPlugin()
    {
        return plugins_url( '', dirname(__FILE__) );
    }
    public function tableLog()
    {
        return $this->tableLog;
    }

    public function createsTables()
    {
        $PsnLog = new PsnLog();
        // $Log
        $Log = $PsnLog->tableLog();

        $tableLog = $this->wpdb->prepare( "CREATE TABLE $Log (
            log_id integer primary key auto_increment,
            log_stats int(1),
            log_function varchar(255),
            log_requesting varchar(255),
            log_sent TEXT NOT NULL,
            log_return TEXT NOT NULL,
            log_created date
        )" , "");        
        $this->wpdb->query($tableLog);
    }
    public function removeTables()
    {
        $PsnLog = new PsnLog();
        $Log = $PsnLog->tableLog();
        
        // Del
        $sql_del = "DROP TABLE IF EXISTS $Log";
        $this->wpdb->query($sql_del);
    }

    public function createdLog($stats,$function,$requesting='',$sent,$return) {
        $data = array(
            'log_stats' => $stats,
            'log_function' => $function,
            'log_requesting' => $requesting,
            'log_sent' => json_encode($sent),
            'log_return' => json_encode($return),
            'log_created' => date('Y-m-d  H:i:s')
        );
        
        $PsnHelper = new PsnHelper();
        $addLog = $PsnHelper->addLine($data,$this->tableLog);

        if($addLog['stats'] == 1){
            $return = array(
                'stats' => 1,
                'id' => $addLog['id'],
                'message' => 'Adicionado com sucesso'
            );
        }else{
            $return = array(
                'stats' => 0,
                'message' => 'Erro ao adicionar'
            );
        }

        return $return;
    }
}

?>