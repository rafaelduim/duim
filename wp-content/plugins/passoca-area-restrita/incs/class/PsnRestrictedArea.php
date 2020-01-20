<?php 
class PsnRestrictedArea
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->tableSession = $wpdb->prefix . 'psn_restricted_area_users_session';
        $this->tableUsers = $wpdb->prefix . 'psn_restricted_area_users';
        
    }
    public function urlSite()
    {
        return get_bloginfo("url");
    }
    public function urlPlugin()
    {
        return plugins_url( '', dirname(__FILE__) );
    }
    public function tableUsers()
    {
        return $this->tableUsers;
    }
    public function tableSession()
    {
        return $this->tableSession;
    }
    public function createsTables()
    {
        $PsnRestrictedArea = new PsnRestrictedArea();
        // $userss
        $userss = $PsnRestrictedArea->tableUsers();
        $tableUsers = $this->wpdb->prepare( "CREATE TABLE $userss (
            user_id integer primary key auto_increment,
            user_stats int(1),
            user_member int(5),
            user_name varchar(100) NOT NULL,
            user_email varchar(100) NOT NULL,
            user_cpf varchar(100),
            user_password varchar(100),
            user_date_birth date,
            user_created date,
            user_update date
        )" , "");        
        $this->wpdb->query($tableUsers);
        // $session
        $session = $PsnRestrictedArea->tableSession();
        $tableSession = $this->wpdb->prepare( "CREATE TABLE $session (
            session_id integer primary key auto_increment,
            fk_user_id int(30)  NOT NULL,
            session_token varchar(300),
            session_ip varchar(100),
            session_criado DATETIME ,
            session_atualizado DATETIME,
            FOREIGN KEY (fk_user_id) REFERENCES $userss (user_id) ON UPDATE CASCADE ON DELETE CASCADE
        )" , "");        
        $this->wpdb->query($tableSession);
    }
    public function removeTables()
    {
        $PsnRestrictedArea = new PsnRestrictedArea();
        $userss = $PsnRestrictedArea->tableUsers();
        $session = $PsnRestrictedArea->tableSession();
        
        // Del
        $sql_del = "DROP TABLE IF EXISTS $session";
        $this->wpdb->query($sql_del);
        $sql_del = "DROP TABLE IF EXISTS $userss";
        $this->wpdb->query($sql_del);
    }

}

?>