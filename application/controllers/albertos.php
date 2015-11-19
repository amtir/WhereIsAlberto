<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Albertos extends CI_Controller{
    
    
        public function __construct()
       {
            parent::__construct();
            // Your own constructor code
       }

    
    function index()
    {
        //echo base_url();
        $this->load->view('welcome_page');

    }
    
    /*
    The _check_input function is used to validate Form Data With PHP.

    1 Strip unnecessary characters (extra space, tab, newline) from the user input data (with the PHP trim() function)
    2 Remove backslashes (\) from the user input data (with the PHP stripslashes() function) 
    3 Pass all variables through PHP's htmlspecialchars() function to saved it as HTML escaped code and safe to be displayed on a page: avoid script injection
    
    Another fence/secure layer to front side: HTML5, javascript, code php igniter.
    */
    function _check_input($data) {
      $data = trim($data);
      $data = filter_var($data, FILTER_SANITIZE_STRING); // Sanitizing data = Remove any illegal character from the data.
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function view($page = 'welcome_page')
    {

        // main server side form controller 
        if($page=='formctrl'){
            
            // load libraries and helpers
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            // Codeigniter Input class is initialised/loaded automatically: $this->input->post('');
            // Securely process global input, provide helpers function for getting data, filter GET/POST/COOKIE array key and XSS protection.
                        
            if( $_POST){
                $data=array( //  pass the $_POST variables through PHP's the check_input() function
                    'sn'=>$this->_check_input($this->input->post('serialnumber')),
                    'email'=>$this->_check_input($this->input->post('email')),
                    'firstname'=>$this->_check_input($this->input->post('firstname')),
                    'lastname'=>$this->_check_input($this->input->post('lastname')),
                    'location'=>$this->_check_input($this->input->post('location')),
                    'gps_lat'=>$this->_check_input($this->input->post('gps_lat')),
                    'gps_long'=>$this->_check_input($this->input->post('gps_long')),
                    'owner'=>$this->_check_input($this->input->post('owner'))
                );
                 //print_r($data);
                 //var_dump($data);
                            
                $config=array(
                    array('field'=>'serialnumber',
                         'label'=>'Banknote Serial Number',
                         'rules'=>'trim|required|min_length[10]|max_length[10]' //|is_unique[banknotes.serial_number]'
                    ),
                    array('field'=>'email',
                         'label'=>'E-mail',
                         'rules'=>'trim|required|valid_email'
                    ),
                    array('field'=>'firstname',
                         'label'=>'first name',
                         'rules'=>'trim|required|min_length[3]|max_length[15]'
                    ),
                    array('field'=>'lastname',
                         'label'=>'last name',
                         'rules'=>'trim|required|min_length[3]|max_length[15]'
                    ),
                   array('field'=>'location',
                         'label'=>'location',
                         'rules'=>'trim|required|min_length[3]|max_length[58]'
                    )
                );
                
                $existEmail=array(
                    array('field'=>'email',
                         'label'=>'E-mail',
                         'rules'=>'is_unique[users.email]'
                    )
                );
                
                 $isStamped=array(
                    array('field'=>'serialnumber',
                         'label'=>'Banknote Serial Number',
                         'rules'=>'is_unique[banknotes.serial_number]'
                    )
                );
                
                
                $this->form_validation->set_rules($config);
                if($this->form_validation->run()==FALSE){ // invalid input entered for the form
                    $data['errors']=validation_errors();
                   //print_r($data['errors']);
                    $this->load->view('registerTrack',$data);
                    unset($data['errors']);
                }
                else{ // valid form
                    // if we reach this block of code then the data entrered are indeed well formed and formatted
                    
                   // print_r($data);
                    $this->load->model('trace');
                    
                    //########################################################################
                    //# Business rules Logic
                    //########################################################################
                    // Create new validation object      
                    $this->form_validation = new CI_Form_validation();
                    // Check if this specific banknote Serial Number is valid? registered in our DB?
                     $this->form_validation->set_rules($isStamped);                  
                    if($this->form_validation->run()==FALSE){ // Indeed the banknote sn is registered in the database
                                        
                         // Create new validation object      
                            $this->form_validation = new CI_Form_validation();
                        //Next checking the email registration/existence?? exist? doesnt exist ?? unique ID identifier  
                            $this->form_validation->set_rules($existEmail);
                            if($this->form_validation->run()==FALSE){ // Already registered, then 
                                    // Is this user has entered/registered the last gps location entry ? 
                                    // lets get his/her last entry position
                                   // $lasttrace=$this->trace->get_last_trace($data['sn'],$data['email']); // can register only once with a banknote
                                    // add a date threshold 30 days 1 month prior to register again
                                    $limit_date=new DateTime();
                                        
                                    $limit_date->modify('-1 month');
                                   // echo '<h1>     </h1>';
                                    // echo '<h1>Date limit: '.$limit_date->format("Y-m-d").'</h1>';
                                    $limitdate=$limit_date->format("Y-m-d");
                                    //date_modify($limit_date,"-30 days");
                                    $lasttrace=$this->trace->get_last_traces($data['sn'],$data['email'],$limitdate); 
                                    // does it exist? is it valid?
                                    if (isset($lasttrace[0]) && $lasttrace[0]->email==$data['email']){ 
                                        // yes then just list the trace of this banknote.
                                       //$this->load->model('trace');
                                        $data['traces']=$this->trace->get_trace($data['sn'], 0, 7);
                                       // echo"<pre>"; print_r($data['users']); echo"</pre>";
                                       // $this->load->view('trace_index', $data);
                                       
                                        $this->load->view('trackBill', $data);
                                        
                                        // print_r($data);
                                       // print_r($data);
                                       // echo"#####################RRRR############################";
                                        //print_r($lasttrace);
                                     //   echo "# Case1: Happy path: the user is already registered and last gps location entry. Just list the trace.";
                                        
                                    }
                                    else{ // registered but does not hold the las entry
                                        // echo"\n#################################################\n Last Email: ";
                                        //print_r($lasttrace[0]->email);
                                        // echo"\n#################################################\n Email entered:";
                                        //print_r($data['email']);
                                        //  echo"\n#################################################\n";
                                      //  echo "# Case2: This user is already registered \n but not the last location entered \n and we should ask for his location. ";   
                                        // Model to design: get the user id & banknote id, then insert the (relationship) gps location
                                        $userid=$this->trace->get_user_id($data['email']) ;
                                        $snid=$this->trace->get_sn_id($data['sn']);
                                       // print_r($userid[0]->id);
                                        //print_r($snid[0]->id);
                                        $trace_date=date("Y-m-d") ;
                                        $this->trace->add_new_location($snid[0]->id, $userid[0]->id, $trace_date, $data['gps_lat'], $data['gps_long'], $data['location']);
                                        
                                        //----------------------------------------
                                           $data['traces']=$this->trace->get_trace($data['sn'], 0, 7);
                                       // echo"<pre>"; print_r($data['users']); echo"</pre>";
                                        //$this->load->view('trace_index', $data);
                                        $this->load->view('trackBill', $data);
                                        // echo $trace_date;
                                        
                                    }
                                
                                
                            }
                            else{  // user email doest not exist, should be registered and asked for gps position
                                
                              //   echo '<h1># Case3: New user to register # Ask for gps location and # registerlocation.</h1>';
                              //   echo "# Case3: New user to register # Ask for gps location and # registerlocation.";
                                // Insert/Add the new user details
                                $this->trace->add_new_user($data['email'], $data['firstname'], $data['lastname']);
                                // get user id banknote id and insert the new location (relationship)
                                $userid=$this->trace->get_user_id($data['email']) ;
                                // get serial number banknote id 
                                $snid=$this->trace->get_sn_id($data['sn']);
                                //print_r($uid[0]->id);
                                //print_r($snid[0]->id);
                                $trace_date=date("Y-m-d") ; // today/current date to insert
                                // Insert the trace relationship about the user and the banknote
                                $this->trace->add_new_location($snid[0]->id, $userid[0]->id, $trace_date, $data['gps_lat'], $data['gps_long'], $data['location']);
                                
                                //-----------------------------------------------------
                                // Get the whole trace of the banknotes (users, dates, cities ...)
                                   $data['traces']=$this->trace->get_trace($data['sn'], 0, 7); // Only the last 7 seven entries
                                       // echo"<pre>"; print_r($data['users']); echo"</pre>";
                                        //$this->load->view('trace_index', $data);
                                       // present the result to the user
                                        $this->load->view('trackBill', $data);
                                   // echo $trace_date;

                            }
                        
                    }
                    else{ // this banknote sn is not stamped
                        // we send back the view form to correct/adjust.
                        $data['snerrors']='This Serial Number Banknote is not stamped! Please enter a valid SN.';
                        $this->load->view('registerTrack',$data);
                        //$key = array_search($valueToSearch,$arrayToSearch);
                        //if($key!==false){
                            //unset($array[$key]);
                            unset($data['snerrors']);
                        //}
                    
                    }

                }
            
            }
            
        }
        elseif ( ! file_exists('application/views/'.$page.'.php'))
            {
                // Whoops, we don't have a page for that!
                echo "main controller";
                show_404();
            }
        else{
            $this->load->view($page); 
        }


    }


}



?>