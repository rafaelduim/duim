<?php 
class PsnRestrictedAreaLogin 
{
    public function __construct()
    { 
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->session = $_SESSION['psn_restricted_area'];

    }
    
    public function sessionLogin() {
        return $this->session['session_id'];
    }

    public function nameLogin() {
        return $this->session['name'];
    }
    
    public function emailLogin() {
        return $this->session['email'];
    }

    public function tokenLogin() {
        return $this->session['token'];
    }

    public function validadeLogin() {
        return $this->session['validade'];
    }

}
?>
