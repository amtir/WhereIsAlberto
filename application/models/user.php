<?php


class User extends CI_Model{

    function get_users($num=10, $start=0){
        
       // $this->db->select()->from('users')->order_by('first_name', 'desc')->limit($num,$start);
       $query= $this->db->query('select id, first_name, last_name, email from users order by first_name limit 10;');
        //$query=$this->db->get();
        return $query->result();
        
    }
    
}

?>