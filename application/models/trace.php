<?php


class Trace extends CI_Model{

    function get_trace($ser_numb, $start=0, $num=10){
        
       // $this->db->select()->from('users')->order_by('first_name', 'desc')->limit($num,$start);
       $query= $this->db->query( "select trace_date, first_name, last_name, email, serial_number, location, gps_lat, gps_long
from users, banknotes, traces
where users.id=traces.user_id and banknotes.id=traces.sn_id and banknotes.serial_number='$ser_numb'order by trace_date desc limit $num;");
        
        //$query=$this->db->get();
        return $query->result();
        
    }
    
    
    function get_last_trace($ser_numb, $email){ // add a date threshold 7 days 1 week to register
        // date_modify($date,"+15 days");
        
       // $this->db->select()->from('users')->order_by('first_name', 'desc')->limit($num,$start);
       $query= $this->db->query( "select trace_date, first_name, last_name, email, serial_number, location, gps_lat, gps_long
from users, banknotes, traces
where users.id=traces.user_id and banknotes.id=traces.sn_id and banknotes.serial_number='$ser_numb' and users.email='$email' order by trace_date desc limit 1;");
        
        //$query=$this->db->get();
        return $query->result();
        
    }
    
    function get_last_traces($ser_numb, $email, $date_limit){ // add a date threshold 7 days 1 week to register
        // date_modify($date,"+15 days");
        
       // $this->db->select()->from('users')->order_by('first_name', 'desc')->limit($num,$start);
       $query= $this->db->query( "select trace_date, first_name, last_name, email, serial_number, location, gps_lat, gps_long
from users, banknotes, traces
where users.id=traces.user_id and banknotes.id=traces.sn_id and banknotes.serial_number='$ser_numb' and users.email='$email' and traces.trace_date>'$date_limit' order by trace_date desc limit 1;");
        
        //$query=$this->db->get();
        return $query->result();
        
    }
    
    // Method to add a new user
    function add_new_user($email, $first_name, $last_name) {
    
        $query= $this->db->query( "insert into users (email, first_name,last_name) values ('$email','$first_name', '$last_name');");
        
    }
    
    // Get the serial number ID baknote.
    function get_sn_id($sn) {
    
       $query= $this->db->query( "select id from banknotes where serial_number='$sn';");
        return $query->result();
        
    }
    
    // Get the user ID email
    function get_user_id($email) {
    
      $query= $this->db->query( "select id from users where email='$email';");
        return $query->result();
    }
    
    // Add a new banknote location
    function add_new_location($snID, $userID, $trace_date, $gps_lat, $gps_long, $location) {
    
       $query= $this->db->query( "insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values ($snID, $userID, '$trace_date' , '$location' , $gps_lat , $gps_long  );
");
            
    }
    
}

?>