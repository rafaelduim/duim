<?php 
class PsnLead
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }
    public function getUrlSite()
    {
        $url = get_bloginfo("url");
        return $url;
    }
    public function getUrlPlugin()
    {
        $url = plugin_dir_url( __FILE__ );
        return $url;
    }
    public function getTableUser()
    {
        $table = $this->wpdb->prefix . 'psn_lead_user';
        return $table;
    }
    public function getTableSign()
    {
        $table = $this->wpdb->prefix . 'psn_lead_subscribed';
        return $table;
    }
    public function createTable()
    {
        $psn_leads = new PsnLead();

        $psn_table_users = $psn_leads->getTableUser();
        $psn_table_subscribed = $psn_leads->getTableSign();

        // Criando a tabela
        $table_user = $this->wpdb->prepare( "CREATE TABLE $psn_table_users (
            psn_lead_user_id integer primary key auto_increment,
            psn_lead_user_status int(1),
            psn_lead_user_name varchar(100),
            psn_lead_user_email varchar(40) NOT NULL,
            psn_lead_user_type varchar(100),
            psn_lead_user_city int(30),
            psn_lead_user_state int(30),
            psn_lead_user_news int(1),
            psn_lead_user_hash varchar(100) NOT NULL,
            psn_lead_user_birth date,
            psn_lead_user_date_update date,
            psn_lead_user_date_created date,
            UNIQUE KEY (psn_lead_user_email),
            UNIQUE KEY (psn_lead_user_hash)
        )" , "");	
        // Executando a query
        $this->wpdb->query($table_user);


        $table_subscribed = $this->wpdb->prepare( "CREATE TABLE $psn_table_subscribed (
            psn_lead_content_id integer primary key auto_increment,
            fk_psn_lead_user_id int(30)  NOT NULL,
            fk_psn_lead_user_hash varchar(100) NOT NULL,
            psn_lead_content int(30), 
            psn_lead_count int(30), 
            psn_lead_content_date_update date,
            psn_lead_content_date_created date,
            FOREIGN KEY (fk_psn_lead_user_id) REFERENCES $psn_table_users (psn_lead_user_id) ON UPDATE CASCADE ON DELETE CASCADE
        )", ""); 
        // Executando a query
        $this->wpdb->query($table_subscribed);
    }
    public function removeTable()
    {
        $PsnLead = new PsnLead();

        $psn_table_users = $PsnLead->getTableUser();
        $psn_table_subscribed = $PsnLead->getTableSign();
        
        // Del
        $sql_del = "DROP TABLE IF EXISTS $psn_table_subscribed ";
        $this->wpdb->query($sql_del);
        $sql_del = "DROP TABLE IF EXISTS $psn_table_users";
        $this->wpdb->query($sql_del);
    }
}
?>