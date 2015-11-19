<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class traces extends CI_Controller{

    
    
    function index(){
        
        $this->load->model('trace');
        $data['traces']=$this->trace->get_trace('00K5911063', 0, 3);
       // echo"<pre>"; print_r($data['users']); echo"</pre>";
        $this->load->view('trace_index', $data);
    }


}


?>