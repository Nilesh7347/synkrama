<?php
class User_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');

    }

    function index(){
        // $this->load->view('login_view');
        $this->load->view('registration_view');
    }

    function login_view(){
        $this->load->view('login_view');
    }
    function register_view(){
        $this->load->view('registration_view');
    }

    public function register()
    {
        $this->load->library('form_validation');

    
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'user_type' => $this->input->post('user_type'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
              
          if ($this->user_model->set_user($data))
            {                             
                $this->session->set_flashdata('msg_success','Registration Successful!');
                redirect('User_Controller/login_view');          
            }
            else
            {                
                $this->session->set_flashdata('msg_error','Error! Please try again later.');
                redirect('User_Controller/register_view');
            }
       
    }


    function user_login(){
            $email    = $this->input->post('email',TRUE);
           // $password = md5($this->input->post('password',TRUE));
            $password = $this->input->post('password',TRUE);
            $validate = $this->user_model->validate($email,$password);
            if($validate->num_rows() > 0){
                $data  = $validate->row_array();
                $user_id = $data['id'];
                $name  = $data['first_name']." ".$data['last_name'];
                $email = $data['email'];
                $user_type = $data['user_type'];
                $first_dealer_login = $data['first_dealer_login'];
                $sesdata = array(
                    'user_id' => $user_id,
                    'name'  => $name,
                    'username'     => $email,
                    'user_type'     => $user_type,
                    'first_dealer_login' => $first_dealer_login,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($sesdata);
                // access login for employee
                if($user_type === '1'){
                    redirect('User_Controller/dashboard');
         
                // access login for dealer
                }elseif($user_type === '2'){

                    if($data['first_dealer_login']== 0){
                    //echo "Id - ".$data['id'];
                   $id = $data['id'];
                    $this->dealer_update_view($id);
                   
                    }else{
                        redirect('User_Controller/dealer_dashboard');
                    }

                }
            }else{
                echo $this->session->set_flashdata('msg','Username or Password is Wrong');
                redirect('User_Controller/login_view');
            }
          
    }

    function dashboard(){
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('User_Controller/login_view'));
        } else {
            if ($this->session->userdata('user_type') === '1') {
                // echo "Employee dashboard";
                $this->load->view('employee/dashboard');
            } else {
                echo "Access Denied";
            }
        }
    }


    function dealer_dashboard(){
      
            if ($this->session->userdata('user_type') === '2') {
                // echo "Dealer dashboard";

                $this->load->view('dealer/dealer_dashboard');
            } else {
                echo "Access Denied";
            }
       
       
    }

    function dealer_update_view($id)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('User_Controller/login_view'));
        } else {
            $data['data'] = $this->user_model->getDatafun($id);                    
                        $this->load->view('dealer/dealer_update',$data);
        }
       
    }

    function update_dealer_data(){
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('User_Controller/login_view'));
        } else {
            $id = $this->input->post('id');
            $data = array(
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip_code' => $this->input->post('zip_code'),
                'first_dealer_login' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            );

            $result = $this->user_model->update_dealer_data($id, $data);
            if ($result) {
                redirect('User_Controller/dealer_dashboard');
            } else {
                redirect('User_Controller/login_view');
            }
        }

    }

    function show_Dealer(){      
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('User_Controller/login_view'));
        } else {
            $data = $this->user_model->dealerList();
            echo json_encode($data);
        }     
    }

    function dealer_Update(){
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('User_Controller/login_view'));
        } else {
            $data = $this->user_model->update_dealer();
            echo json_encode($data);
        }
        
    }

    function filter_Dealer_zipcode(){      
        
            $zip_code = $this->input->post('zip_code');
            // print_r($zip_code);
            // die;
            $data = $this->user_model->filter_Dealer_zipcode();
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            echo json_encode($data);
             
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('User_Controller/login_view');
    }

}

?>