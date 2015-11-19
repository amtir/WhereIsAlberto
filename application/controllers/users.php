<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller{

    
    
    function index(){
        
        $this->load->model('user');
        $data['users']=$this->user->get_users();
       // echo"<pre>"; print_r($data['users']); echo"</pre>";
       // $this->load->view('user_index', $data);
        $this->load->view('welcome_page', $data);
    }


}


?>