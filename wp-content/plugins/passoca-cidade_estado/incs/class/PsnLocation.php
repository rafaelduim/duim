<?php 
class PsnLocation {
    function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_city = $wpdb->prefix . 'psn_city';
        $this->table_state = $wpdb->prefix . 'psn_state';
    }

    public function listAllState()
    {
        $states = $this->wpdb->get_results("SELECT * FROM $this->table_state" , OBJECT);
        
        return $states;
    }

    public function listCityState($state)
    {
        $city = $this->wpdb->get_results("SELECT * FROM $this->table_city WHERE state_cod_state = '$state' " , OBJECT);
        
        return $city;
    }

    public function getNameState($state)
    {
        $state = $this->wpdb->get_results("SELECT * FROM $this->table_state WHERE cod_state = '$state' " , OBJECT);
        
        return $state[0]->name;
    }

    public function getNameCity($city)
    {
        $city = $this->wpdb->get_results("SELECT * FROM $this->table_city WHERE cod_city = '$city' " , OBJECT);
        
        return $city[0]->name;
    }
}
 ?>